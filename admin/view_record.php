<?php
// admin/view_record.php - View a Record
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

// Check if primary key is available
if (!$primaryKey) {
    displayMessage("Table '$tableName' does not have a primary key, cannot view specific record", 'danger');
    echo '<div class="admin-section"><a href="view_table.php?table=' . urlencode($tableName) . '" class="admin-btn admin-btn-primary">Back to Table</a></div>';
    include_once 'includes/footer.php';
    exit;
}

// Check if primary key value is provided
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

// Check for related records in other tables
$relatedTables = getRelatedTables($tableName);
$relatedRecords = [];

foreach ($relatedTables as $relation) {
    $relatedTable = $relation['TABLE_NAME'];
    $relatedColumn = $relation['COLUMN_NAME'];
    
    // Check for related records
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM $relatedTable WHERE $relatedColumn = :value");
        $stmt->bindValue(':value', $primaryKeyValue);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            $relatedRecords[] = [
                'table' => $relatedTable,
                'column' => $relatedColumn,
                'count' => $count
            ];
        }
    } catch (PDOException $e) {
        // Just skip if there's an error
    }
}
?>

<div class="admin-view-record">
    <h1 class="admin-section-title">View Record from: <?php echo htmlspecialchars($tableName); ?></h1>
    
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Back to Table</a>
            <a href="edit_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-primary">Edit Record</a>
            <a href="delete_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-danger delete-confirm">Delete Record</a>
        </div>
        
        <div class="record-details">
            <h3>Record Details</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Type</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Group columns by key type (primary key first, then other)
                    $columnsByType = [
                        'primary' => [],
                        'other' => []
                    ];
                    
                    foreach ($tableColumns as $column) {
                        if ($column['Field'] === $primaryKey) {
                            $columnsByType['primary'][] = $column;
                        } else {
                            $columnsByType['other'][] = $column;
                        }
                    }
                    
                    // Display primary key first
                    foreach ($columnsByType['primary'] as $column): 
                    ?>
                    <tr class="primary-key-row">
                        <td><?php echo htmlspecialchars($column['Field']); ?> <span class="key-tag">Primary Key</span></td>
                        <td><?php echo htmlspecialchars($column['Type']); ?></td>
                        <td>
                            <?php 
                            $value = $record[$column['Field']];
                            if (is_null($value)) {
                                echo '<span class="null-value">NULL</span>';
                            } else {
                                echo htmlspecialchars($value);
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <!-- Display other columns -->
                    <?php foreach ($columnsByType['other'] as $column): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($column['Field']); ?></td>
                        <td><?php echo htmlspecialchars($column['Type']); ?></td>
                        <td>
                            <?php 
                            $value = $record[$column['Field']];
                            if (is_null($value)) {
                                echo '<span class="null-value">NULL</span>';
                            } elseif (strpos($column['Type'], 'text') !== false) {
                                // For text fields, provide option to view full text
                                if (strlen($value) > 100) {
                                    echo '<div class="truncated-text">';
                                    echo htmlspecialchars(substr($value, 0, 100)) . '...';
                                    echo '</div>';
                                    echo '<div class="text-actions">';
                                    echo '<button class="admin-btn admin-btn-sm admin-btn-info toggle-full-text">Show Full Text</button>';
                                    echo '</div>';
                                    echo '<div class="full-text" style="display: none;">';
                                    echo nl2br(htmlspecialchars($value));
                                    echo '</div>';
                                } else {
                                    echo nl2br(htmlspecialchars($value));
                                }
                            } else {
                                echo htmlspecialchars($value);
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if (!empty($relatedRecords)): ?>
        <div class="related-records" style="margin-top: 1.5rem;">
            <h3>Related Records</h3>
            <p>This record is referenced by records in the following tables:</p>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Related Table</th>
                        <th>Related Column</th>
                        <th>Number of Records</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($relatedRecords as $relation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($relation['table']); ?></td>
                        <td><?php echo htmlspecialchars($relation['column']); ?></td>
                        <td><?php echo number_format($relation['count']); ?></td>
                        <td>
                            <a href="view_table.php?table=<?php echo urlencode($relation['table']); ?>&filter_column=<?php echo urlencode($relation['column']); ?>&filter_value=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-sm admin-btn-info">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript for toggling full text display -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle full text for long text fields
    const toggleButtons = document.querySelectorAll('.toggle-full-text');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const truncatedText = row.querySelector('.truncated-text');
            const fullText = row.querySelector('.full-text');
            
            if (fullText.style.display === 'none') {
                truncatedText.style.display = 'none';
                fullText.style.display = 'block';
                this.textContent = 'Show Less';
            } else {
                truncatedText.style.display = 'block';
                fullText.style.display = 'none';
                this.textContent = 'Show Full Text';
            }
        });
    });
});
</script>

<?php
include_once 'includes/footer.php';
?>