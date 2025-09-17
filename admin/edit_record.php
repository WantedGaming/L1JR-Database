<?php
// admin/edit_record.php - Edit Record in Table
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

// Check if primary key is provided
if (!$primaryKey) {
    displayMessage("Table '$tableName' does not have a primary key, cannot edit records", 'danger');
    echo '<div class="admin-section"><a href="view_table.php?table=' . urlencode($tableName) . '" class="admin-btn admin-btn-primary">Back to Table</a></div>';
    include_once 'includes/footer.php';
    exit;
}

// Get the primary key value
if (!isset($_GET[$primaryKey]) || empty($_GET[$primaryKey])) {
    displayMessage('No record identifier provided', 'danger');
    echo '<div class="admin-section"><a href="view_table.php?table=' . urlencode($tableName) . '" class="admin-btn admin-btn-primary">Back to Table</a></div>';
    include_once 'includes/footer.php';
    exit;
}

$primaryKeyValue = $_GET[$primaryKey];

// Get the record
$record = getRecordByPrimaryKey($tableName, $primaryKey, $primaryKeyValue);

if (!$record) {
    displayMessage("Record with $primaryKey = $primaryKeyValue not found", 'danger');
    echo '<div class="admin-section"><a href="view_table.php?table=' . urlencode($tableName) . '" class="admin-btn admin-btn-primary">Back to Table</a></div>';
    include_once 'includes/footer.php';
    exit;
}

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
            
            // Skip primary key to avoid changing it
            if ($columnName === $primaryKey) {
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
        
        // Update the record
        if (updateRecord($tableName, $data, $primaryKey, $primaryKeyValue)) {
            // Log the action
            logAdminAction('edit_record', "Updated record in table: $tableName with $primaryKey = $primaryKeyValue");
            
            displayMessage('Record updated successfully', 'success');
            
            // Get the updated record
            $record = getRecordByPrimaryKey($tableName, $primaryKey, $primaryKeyValue);
        } else {
            displayMessage('Error updating record', 'danger');
        }
    }
}
?>

<div class="admin-edit-record">
    <h1 class="admin-section-title">Edit Record in: <?php echo htmlspecialchars($tableName); ?></h1>
    
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Back to Table</a>
            <a href="view_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-info">View Record</a>
        </div>
        
        <form method="post" action="edit_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-form">
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
                $isPrimaryKey = ($column['Field'] === $primaryKey);
                $isRequired = ($column['Null'] === 'NO' && !$isAutoIncrement);
                $isReadOnly = ($isAutoIncrement || $isPrimaryKey);
                
                // Get the current value
                $currentValue = isset($record[$column['Field']]) ? $record[$column['Field']] : null;
                
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
                    // Convert MySQL datetime to HTML datetime-local format
                    if ($currentValue) {
                        $currentValue = date('Y-m-d\TH:i:s', strtotime($currentValue));
                    }
                }
                // For text types
                elseif (strpos($fieldType, 'text') !== false) {
                    $inputType = 'textarea';
                }
                
                // Special handling for boolean/tinyint(1)
                if ($fieldType === 'tinyint(1)') {
                    // Render as checkbox/select
                    echo '<select name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . ($isReadOnly ? ' readonly' : '') . '>';
                    echo '<option value="1"' . ($currentValue == 1 ? ' selected' : '') . '>Yes (1)</option>';
                    echo '<option value="0"' . ($currentValue == 0 ? ' selected' : '') . '>No (0)</option>';
                    if ($column['Null'] === 'YES') {
                        echo '<option value=""' . (is_null($currentValue) ? ' selected' : '') . '>NULL</option>';
                    }
                    echo '</select>';
                }
                // For enum types
                elseif (strpos($fieldType, 'enum') === 0) {
                    // Extract enum values
                    preg_match('/enum\((.*)\)/', $fieldType, $matches);
                    $enumValues = explode(',', $matches[1]);
                    
                    echo '<select name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . 
                         ($isRequired ? ' required' : '') . 
                         ($isReadOnly ? ' readonly' : '') . '>';
                    
                    if ($column['Null'] === 'YES') {
                        echo '<option value=""' . (is_null($currentValue) ? ' selected' : '') . '>Select...</option>';
                    }
                    
                    foreach ($enumValues as $value) {
                        $value = trim($value, "'\"");
                        echo '<option value="' . htmlspecialchars($value) . '"' . 
                             ($currentValue === $value ? ' selected' : '') . '>' . 
                             htmlspecialchars($value) . '</option>';
                    }
                    
                    echo '</select>';
                }
                // For regular input types
                else {
                    if ($inputType === 'textarea') {
                        echo '<textarea name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . 
                             ($isRequired ? ' required' : '') . 
                             ($isReadOnly ? ' readonly' : '') . 
                             ' rows="5">' . htmlspecialchars($currentValue ?? '') . '</textarea>';
                    } else {
                        echo '<input type="' . $inputType . '" name="' . $column['Field'] . '" id="' . $column['Field'] . '" class="form-control"' . 
                             ($isRequired ? ' required' : '') . 
                             ($isReadOnly ? ' readonly' : '') . 
                             $inputAttrs . 
                             ' value="' . htmlspecialchars($currentValue ?? '') . '">';
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
                <button type="submit" class="admin-btn admin-btn-primary">Update Record</button>
                <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Cancel</a>
                <a href="delete_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-danger delete-confirm">Delete Record</a>
            </div>
        </form>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>