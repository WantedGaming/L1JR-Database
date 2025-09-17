<?php
// admin/delete_record.php - Delete Record from Table
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

// Get the primary key
$primaryKey = getPrimaryKey($tableName);

// Check if primary key is available
if (!$primaryKey) {
    displayMessage("Table '$tableName' does not have a primary key, cannot delete records", 'danger');
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

// Process delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        displayMessage('Invalid form submission', 'danger');
    } else {
        // Check for force delete flag
        $forceDelete = isset($_POST['force_delete']) && $_POST['force_delete'] === '1';
        
        // Check if we can delete (no related records or force delete)
        if (empty($relatedRecords) || $forceDelete) {
            // Delete the record
            if (deleteRecord($tableName, $primaryKey, $primaryKeyValue)) {
                // Log the action
                logAdminAction('delete_record', "Deleted record from table: $tableName with $primaryKey = $primaryKeyValue");
                
                displayMessage('Record deleted successfully', 'success');
                
                // Redirect back to table view
                header("Location: view_table.php?table=$tableName");
                exit;
            } else {
                displayMessage('Error deleting record', 'danger');
            }
        } else {
            displayMessage('Cannot delete record due to related records in other tables', 'danger');
        }
    }
}
?>

<div class="admin-delete-record">
    <h1 class="admin-section-title">Delete Record from: <?php echo htmlspecialchars($tableName); ?></h1>
    
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Back to Table</a>
            <a href="edit_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>" class="admin-btn admin-btn-primary">Edit Record</a>
        </div>
        
        <div class="record-details">
            <h3>Record Details</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($record as $field => $value): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($field); ?></td>
                        <td>
                            <?php 
                            if (is_null($value)) {
                                echo '<span class="null-value">NULL</span>';
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
            <p class="warning-text">This record cannot be deleted because it is referenced by records in other tables:</p>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Related Table</th>
                        <th>Related Column</th>
                        <th>Number of Records</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($relatedRecords as $relation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($relation['table']); ?></td>
                        <td><?php echo htmlspecialchars($relation['column']); ?></td>
                        <td><?php echo number_format($relation['count']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <div class="delete-confirmation" style="margin-top: 2rem;">
            <form method="post" action="delete_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($primaryKeyValue); ?>">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                
                <div class="confirmation-message" style="margin-bottom: 1rem;">
                    <p>Are you sure you want to delete this record?</p>
                    <p><strong>This action cannot be undone!</strong></p>
                </div>
                
                <?php if (!empty($relatedRecords)): ?>
                <div class="force-delete-option" style="margin-bottom: 1rem;">
                    <label>
                        <input type="checkbox" name="force_delete" value="1"> Force delete (may cause data integrity issues)
                    </label>
                </div>
                <?php endif; ?>
                
                <div class="form-buttons">
                    <button type="submit" class="admin-btn admin-btn-danger">Delete Record</button>
                    <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>