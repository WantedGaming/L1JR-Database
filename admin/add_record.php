<?php
// admin/add_record.php - Add New Record to Table
require_once 'includes/functions.php';
include_once 'includes/header.php';

// Check if table name is provided
if (!isset($_GET['table']) || empty($_GET['table'])) {
    displayMessage('No table specified', 'danger');
    echo '<div class="admin-section"><a href="tables.php" class="admin-btn admin-btn-primary">Back to Tables</a></div>';
    include_once 'includes/footer.php';
    exit;
}

$tableName = $_GET['table'];

// Check if table exists
try {
    $stmt = $pdo->query("SHOW TABLES LIKE '$tableName'");
    if ($stmt->rowCount() === 0) {
        displayMessage("Table '$tableName' does not exist", 'danger');
        echo '<div class="admin-section"><a href="tables.php" class="admin-btn admin-btn-primary">Back to Tables</a></div>';
        include_once 'includes/footer.php';
        exit;
    }
} catch (PDOException $e) {
    displayMessage('Error checking table: ' . $e->getMessage(), 'danger');
    echo '<div class="admin-section"><a href="tables.php" class="admin-btn admin-btn-primary">Back to Tables</a></div>';
    include_once 'includes/footer.php';
    exit;
}

// Get the table structure
$tableColumns = getTableColumns($tableName);
$primaryKey = getPrimaryKey($tableName);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        displayMessage('Invalid form submission', 'danger');
    } else {
        // Collect form data
        $data = [];
        foreach ($tableColumns as $column) {
            $columnName = $column['Field'];
            $isAutoIncrement = ($column['Extra'] === 'auto_increment');
            
            // Skip auto-increment fields
            if ($isAutoIncrement) {
                continue;
            }
            
            // Check if field was submitted
            if (isset($_POST[$columnName])) {
                // Handle empty values based on NULL allowed
                if ($_POST[$columnName] === '' && $column['Null'] === 'YES') {
                    $data[$columnName] = null;
                } else {
                    $data[$columnName] = $_POST[$columnName];
                }
            }
        }
        
        // Insert the record
        if (insertRecord($tableName, $data)) {
            // Log the action
            logAdminAction('add_record', "Added new record to table: $tableName");
            
            displayMessage('Record added successfully', 'success');
            
            // Redirect to view table
            header("Location: view_table.php?table=$tableName");
            exit;
        } else {
            displayMessage('Error adding record', 'danger');
        }
    }
}
?>

<div class="admin-add-record">
    <h1 class="admin-section-title">Add New Record to: <?php echo htmlspecialchars($tableName); ?></h1>
    
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Back to Table</a>
        </div>
        
        <form method="post" action="add_record.php?table=<?php echo urlencode($tableName); ?>" class="admin-form">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            
            <?php foreach ($tableColumns as $column): ?>
            <div class="form-group">
                <label for="<?php echo $column['Field']; ?>" class="form-label">
                    <?php echo htmlspecialchars($column['Field']); ?>
                    <?php if ($column['Key'] === 'PRI') echo ' (Primary Key)'; ?>
                    <?php if ($column['Null'] === 'NO') echo ' <span class="required">*</span>'; ?>
                </label>
                
                <?php
                // Determine if this field should be editable
                $isAutoIncrement = ($column['Extra'] === 'auto_increment');
                $isRequired = ($column['Null'] === 'NO' && !$isAutoIncrement);
                
                // Determine field type based on column type
                $inputType = 'text';
                $inputAttrs = '';
                $fieldType = strtolower($column['Type']);
                
                // For numeric types
                if (strpos($fieldType, 'int') !== false) {
                    $inputType = 'number';
                    if (strpos($fieldType, 'unsigned') !== false) {
                        $inputAttrs .= ' min="0"';
                    }
                } 
                // For date/time types
                elseif ($fieldType === 'date') {
                    $inputType = 'date';
                } 
                elseif ($fieldType === 'time') {
                    $inputType = 'time';
                } 
                elseif ($fieldType === 'datetime' || $fieldType === 'timestamp') {
                    $inputType = 'datetime-local';
                }
                // For text types
                elseif (strpos($fieldType, 'text') !== false) {
                    $inputType = 'textarea';
                }
                
                // Special handling for boolean/tinyint(1)
                if ($fieldType === 'tinyint(1)') {
                    // Render as checkbox/select
                    echo '<select name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control">';
                    echo '<option value="1">Yes (1)</option>';
                    echo '<option value="0">No (0)</option>';
                    if ($column['Null'] === 'YES') {
                        echo '<option value="">NULL</option>';
                    }
                    echo '</select>';
                }
                // For enum types
                elseif (strpos($fieldType, 'enum') === 0) {
                    // Extract enum values
                    preg_match('/enum\((.*)\)/', $fieldType, $matches);
                    $enumValues = explode(',', $matches[1]);
                    
                    echo '<select name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . ($isRequired ? ' required' : '') . '>';
                    
                    if ($column['Null'] === 'YES') {
                        echo '<option value="">Select...</option>';
                    }
                    
                    foreach ($enumValues as $value) {
                        $value = trim($value, "'\"");
                        echo '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</option>';
                    }
                    
                    echo '</select>';
                }
                // For regular input types
                else {
                    if ($inputType === 'textarea') {
                        echo '<textarea name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . 
                             ($isRequired ? ' required' : '') . 
                             ($isAutoIncrement ? ' readonly' : '') . 
                             ' rows="5"></textarea>';
                    } else {
                        echo '<input type="' . $inputType . '" name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . 
                             ($isRequired ? ' required' : '') . 
                             ($isAutoIncrement ? ' readonly' : '') . 
                             $inputAttrs . '>';
                    }
                }
                ?>
                
                <div class="form-text">
                    Type: <?php echo $column['Type']; ?> | 
                    <?php echo $column['Null'] === 'YES' ? 'NULL allowed' : 'NOT NULL'; ?> |
                    <?php if (!empty($column['Default'])): ?>
                    Default: <?php echo $column['Default']; ?> |
                    <?php endif; ?>
                    <?php echo $column['Extra']; ?>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="form-buttons">
                <button type="submit" class="admin-btn admin-btn-primary">Add Record</button>
                <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>