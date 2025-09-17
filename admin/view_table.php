<?php
// admin/view_table.php - View Database Table
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

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Search and filter
$whereClause = '';
$whereParams = [];
$searchFields = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchValue = $_GET['search'];
    $searchConditions = [];
    
    // Build search conditions for each column
    foreach ($tableColumns as $column) {
        $columnName = $column['Field'];
        $columnType = $column['Type'];
        
        // Only search in string-like columns
        if (strpos($columnType, 'varchar') !== false || 
            strpos($columnType, 'text') !== false || 
            strpos($columnType, 'char') !== false) {
            $searchConditions[] = "$columnName LIKE :search";
            $searchFields[] = $columnName;
        }
    }
    
    if (!empty($searchConditions)) {
        $whereClause = '(' . implode(' OR ', $searchConditions) . ')';
        $whereParams[':search'] = '%' . $searchValue . '%';
    }
}

// Column filter
if (isset($_GET['filter_column']) && !empty($_GET['filter_column']) && 
    isset($_GET['filter_value']) && $_GET['filter_value'] !== '') {
    $filterColumn = $_GET['filter_column'];
    $filterValue = $_GET['filter_value'];
    
    // Check if this is a valid column
    $isValidColumn = false;
    foreach ($tableColumns as $column) {
        if ($column['Field'] === $filterColumn) {
            $isValidColumn = true;
            break;
        }
    }
    
    if ($isValidColumn) {
        if (!empty($whereClause)) {
            $whereClause .= ' AND ';
        }
        $whereClause .= "$filterColumn = :filter_value";
        $whereParams[':filter_value'] = $filterValue;
    }
}

// Sort order
$orderBy = '';
if (isset($_GET['sort_column']) && !empty($_GET['sort_column'])) {
    $sortColumn = $_GET['sort_column'];
    $sortDirection = (isset($_GET['sort_dir']) && $_GET['sort_dir'] === 'desc') ? 'DESC' : 'ASC';
    
    // Check if this is a valid column
    $isValidColumn = false;
    foreach ($tableColumns as $column) {
        if ($column['Field'] === $sortColumn) {
            $isValidColumn = true;
            break;
        }
    }
    
    if ($isValidColumn) {
        $orderBy = "$sortColumn $sortDirection";
    }
}

// Default sort by primary key if set
if (empty($orderBy) && $primaryKey) {
    $orderBy = "$primaryKey ASC";
}

// Get total count for pagination
try {
    $countSql = "SELECT COUNT(*) FROM $tableName";
    if (!empty($whereClause)) {
        $countSql .= " WHERE $whereClause";
    }
    
    $countStmt = $pdo->prepare($countSql);
    foreach ($whereParams as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalRecords = $countStmt->fetchColumn();
} catch (PDOException $e) {
    displayMessage('Error counting records: ' . $e->getMessage(), 'danger');
    $totalRecords = 0;
}

// Get the data
$tableData = [];
try {
    $sql = "SELECT * FROM $tableName";
    if (!empty($whereClause)) {
        $sql .= " WHERE $whereClause";
    }
    if (!empty($orderBy)) {
        $sql .= " ORDER BY $orderBy";
    }
    $sql .= " LIMIT :limit OFFSET :offset";
    
    $stmt = $pdo->prepare($sql);
    foreach ($whereParams as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    displayMessage('Error retrieving data: ' . $e->getMessage(), 'danger');
}

// Calculate pagination
$totalPages = ceil($totalRecords / $limit);

// Build query string for pagination links
$queryParams = $_GET;
unset($queryParams['page']);
$queryString = http_build_query($queryParams);
$queryString = !empty($queryString) ? '&' . $queryString : '';
?>

<div class="admin-table-view">
    <h1 class="admin-section-title">Table: <?php echo htmlspecialchars($tableName); ?></h1>
    
    <div class="admin-section">
        <div class="table-metadata">
            <div class="metadata-item">
                <span class="metadata-label">Total Records:</span>
                <span class="metadata-value"><?php echo number_format($totalRecords); ?></span>
            </div>
            <div class="metadata-item">
                <span class="metadata-label">Primary Key:</span>
                <span class="metadata-value"><?php echo $primaryKey ? htmlspecialchars($primaryKey) : 'None'; ?></span>
            </div>
            <div class="metadata-item">
                <span class="metadata-label">Columns:</span>
                <span class="metadata-value"><?php echo count($tableColumns); ?></span>
            </div>
        </div>
        
        <div class="admin-buttons" style="margin: 1rem 0;">
            <a href="tables.php" class="admin-btn admin-btn-secondary">Back to Tables</a>
            <a href="add_record.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-primary">Add New Record</a>
            <a href="export_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-info">Export Data</a>
        </div>
    </div>
    
    <!-- Search and Filter Form -->
    <div class="admin-filters">
        <form method="get" action="view_table.php">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($tableName); ?>">
            
            <div class="filter-grid">
                <div class="form-group">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search text..." 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <?php if (!empty($searchFields)): ?>
                    <div class="form-text">Searches in: <?php echo implode(', ', $searchFields); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="filter_column" class="form-label">Filter Column</label>
                    <select id="filter_column" name="filter_column" class="form-control">
                        <option value="">Select Column</option>
                        <?php foreach ($tableColumns as $column): ?>
                        <option value="<?php echo $column['Field']; ?>" <?php echo (isset($_GET['filter_column']) && $_GET['filter_column'] === $column['Field']) ? 'selected' : ''; ?>>
                            <?php echo $column['Field']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="filter_value" class="form-label">Filter Value</label>
                    <input type="text" id="filter_value" name="filter_value" class="form-control" placeholder="Exact value..." 
                           value="<?php echo isset($_GET['filter_value']) ? htmlspecialchars($_GET['filter_value']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="sort_column" class="form-label">Sort By</label>
                    <select id="sort_column" name="sort_column" class="form-control">
                        <option value="">Default</option>
                        <?php foreach ($tableColumns as $column): ?>
                        <option value="<?php echo $column['Field']; ?>" <?php echo (isset($_GET['sort_column']) && $_GET['sort_column'] === $column['Field']) ? 'selected' : ''; ?>>
                            <?php echo $column['Field']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="sort_dir" class="form-label">Sort Direction</label>
                    <select id="sort_dir" name="sort_dir" class="form-control">
                        <option value="asc" <?php echo (!isset($_GET['sort_dir']) || $_GET['sort_dir'] === 'asc') ? 'selected' : ''; ?>>Ascending</option>
                        <option value="desc" <?php echo (isset($_GET['sort_dir']) && $_GET['sort_dir'] === 'desc') ? 'selected' : ''; ?>>Descending</option>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="admin-btn admin-btn-primary">Apply Filters</button>
                    <a href="view_table.php?table=<?php echo urlencode($tableName); ?>" class="admin-btn admin-btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Table Data -->
    <div class="admin-section">
        <?php if (empty($tableData)): ?>
        <div class="no-results">
            <p>No records found.</p>
        </div>
        <?php else: ?>
        <div class="table-preview">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <?php foreach ($tableColumns as $column): ?>
                            <th><?php echo htmlspecialchars($column['Field']); ?></th>
                            <?php endforeach; ?>
                            <th class="action-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tableData as $row): ?>
                        <tr>
                            <?php foreach ($tableColumns as $column): ?>
                            <td>
                                <?php 
                                $value = $row[$column['Field']];
                                
                                // Format the display based on column type
                                if (is_null($value)) {
                                    echo '<span class="null-value">NULL</span>';
                                } elseif (strpos($column['Type'], 'text') !== false) {
                                    // Truncate long text fields
                                    echo strlen($value) > 100 ? htmlspecialchars(substr($value, 0, 100)) . '...' : htmlspecialchars($value);
                                } else {
                                    echo htmlspecialchars($value);
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td class="action-col">
                                <div class="action-buttons">
                                    <?php if ($primaryKey && isset($row[$primaryKey])): ?>
                                    <a href="view_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($row[$primaryKey]); ?>" class="action-btn action-btn-view">View</a>
                                    <a href="edit_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($row[$primaryKey]); ?>" class="action-btn action-btn-edit">Edit</a>
                                    <a href="delete_record.php?table=<?php echo urlencode($tableName); ?>&<?php echo urlencode($primaryKey); ?>=<?php echo urlencode($row[$primaryKey]); ?>" class="action-btn action-btn-delete delete-confirm">Delete</a>
                                    <?php else: ?>
                                    <span class="no-primary-key">No Primary Key</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <div class="admin-pagination">
                <?php if ($page > 1): ?>
                <a href="?table=<?php echo urlencode($tableName); ?>&page=1<?php echo $queryString; ?>" class="pagination-item">First</a>
                <a href="?table=<?php echo urlencode($tableName); ?>&page=<?php echo $page - 1; ?><?php echo $queryString; ?>" class="pagination-item">Previous</a>
                <?php endif; ?>
                
                <?php
                // Show up to 5 page links around the current page
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                // Show ellipsis for many pages
                if ($startPage > 1) {
                    echo '<span class="pagination-ellipsis">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++): 
                ?>
                <a href="?table=<?php echo urlencode($tableName); ?>&page=<?php echo $i; ?><?php echo $queryString; ?>" class="pagination-item <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($endPage < $totalPages): ?>
                <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
                
                <?php if ($page < $totalPages): ?>
                <a href="?table=<?php echo urlencode($tableName); ?>&page=<?php echo $page + 1; ?><?php echo $queryString; ?>" class="pagination-item">Next</a>
                <a href="?table=<?php echo urlencode($tableName); ?>&page=<?php echo $totalPages; ?><?php echo $queryString; ?>" class="pagination-item">Last</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Table Structure -->
    <div class="admin-section">
        <h2 class="admin-section-title">Table Structure</h2>
        <div class="table-preview">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Type</th>
                        <th>Null</th>
                        <th>Key</th>
                        <th>Default</th>
                        <th>Extra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableColumns as $column): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($column['Field']); ?></td>
                        <td><?php echo htmlspecialchars($column['Type']); ?></td>
                        <td><?php echo $column['Null']; ?></td>
                        <td><?php echo $column['Key']; ?></td>
                        <td><?php echo is_null($column['Default']) ? '<span class="null-value">NULL</span>' : htmlspecialchars($column['Default']); ?></td>
                        <td><?php echo $column['Extra']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>