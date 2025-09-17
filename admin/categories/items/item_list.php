<?php
// admin/categories/items/item_list.php - Items List Admin
require_once '../../includes/functions.php';
include_once '../../includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Search and filter
$whereClause = '';
$whereParams = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchValue = $_GET['search'];
    $whereClause = "name LIKE :search";
    $whereParams[':search'] = '%' . $searchValue . '%';
}

if (isset($_GET['type']) && !empty($_GET['type'])) {
    if (!empty($whereClause)) {
        $whereClause .= " AND ";
    }
    $whereClause .= "item_type = :type";
    $whereParams[':type'] = $_GET['type'];
}

if (isset($_GET['use_type']) && !empty($_GET['use_type'])) {
    if (!empty($whereClause)) {
        $whereClause .= " AND ";
    }
    $whereClause .= "use_type = :use_type";
    $whereParams[':use_type'] = $_GET['use_type'];
}

// Get total count for pagination
try {
    $countSql = "SELECT COUNT(*) FROM etcitem";
    if (!empty($whereClause)) {
        $countSql .= " WHERE $whereClause";
    }
    
    $countStmt = $pdo->prepare($countSql);
    foreach ($whereParams as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalItems = $countStmt->fetchColumn();
} catch (PDOException $e) {
    displayMessage('Error counting items: ' . $e->getMessage(), 'danger');
    $totalItems = 0;
}

// Get items with pagination
$items = [];
try {
    $sql = "SELECT * FROM etcitem";
    if (!empty($whereClause)) {
        $sql .= " WHERE $whereClause";
    }
    $sql .= " ORDER BY name ASC LIMIT :limit OFFSET :offset";
    
    $stmt = $pdo->prepare($sql);
    foreach ($whereParams as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    displayMessage('Error retrieving items: ' . $e->getMessage(), 'danger');
}

// Get item types and use types for filters
$itemTypes = [];
$useTypes = [];
try {
    $typesStmt = $pdo->query("SELECT DISTINCT item_type FROM etcitem ORDER BY item_type");
    $itemTypes = $typesStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $useTypesStmt = $pdo->query("SELECT DISTINCT use_type FROM etcitem ORDER BY use_type");
    $useTypes = $useTypesStmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    // Ignore errors
}

// Calculate pagination
$totalPages = ceil($totalItems / $limit);

// Build query string for pagination links
$queryParams = $_GET;
unset($queryParams['page']);
$queryString = http_build_query($queryParams);
$queryString = !empty($queryString) ? '&' . $queryString : '';
?>

<div class="admin-items">
    <h1 class="admin-section-title">Items Management</h1>
    
    <!-- Search and Filter Form -->
    <div class="admin-filters">
        <form method="get" action="item_list.php">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Item name..." 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="type" class="form-label">Item Type</label>
                    <select id="type" name="type" class="form-control">
                        <option value="">All Types</option>
                        <?php foreach ($itemTypes as $type): ?>
                        <option value="<?php echo $type; ?>" <?php echo (isset($_GET['type']) && $_GET['type'] === $type) ? 'selected' : ''; ?>>
                            <?php echo normalizeItemType($type); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="use_type" class="form-label">Use Type</label>
                    <select id="use_type" name="use_type" class="form-control">
                        <option value="">All Use Types</option>
                        <?php foreach ($useTypes as $useType): ?>
                        <option value="<?php echo $useType; ?>" <?php echo (isset($_GET['use_type']) && $_GET['use_type'] === $useType) ? 'selected' : ''; ?>>
                            <?php echo normalizeItemUseType($useType); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="admin-btn admin-btn-primary">Apply Filters</button>
                    <a href="item_list.php" class="admin-btn admin-btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Items Table -->
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="add_item.php" class="admin-btn admin-btn-primary">Add New Item</a>
            <a href="../../view_table.php?table=etcitem" class="admin-btn admin-btn-secondary">View Raw Table</a>
        </div>
        
        <?php if (empty($items)): ?>
        <div class="no-results">
            <p>No items found matching your criteria.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Use Type</th>
                        <th>Weight</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['item_id']; ?></td>
                        <td><?php echo getDisplayName($item['name']); ?></td>
                        <td><?php echo normalizeItemType($item['item_type']); ?></td>
                        <td><?php echo normalizeItemUseType($item['use_type']); ?></td>
                        <td><?php echo $item['weight']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="../../view_record.php?table=etcitem&item_id=<?php echo $item['item_id']; ?>" class="action-btn action-btn-view">View</a>
                                <a href="../../edit_record.php?table=etcitem&item_id=<?php echo $item['item_id']; ?>" class="action-btn action-btn-edit">Edit</a>
                                <a href="../../delete_record.php?table=etcitem&item_id=<?php echo $item['item_id']; ?>" class="action-btn action-btn-delete delete-confirm">Delete</a>
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
            <a href="?page=1<?php echo $queryString; ?>" class="pagination-item">First</a>
            <a href="?page=<?php echo $page - 1; ?><?php echo $queryString; ?>" class="pagination-item">Previous</a>
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
            <a href="?page=<?php echo $i; ?><?php echo $queryString; ?>" class="pagination-item <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($endPage < $totalPages): ?>
            <span class="pagination-ellipsis">...</span>
            <?php endif; ?>
            
            <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?><?php echo $queryString; ?>" class="pagination-item">Next</a>
            <a href="?page=<?php echo $totalPages; ?><?php echo $queryString; ?>" class="pagination-item">Last</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php
include_once '../../includes/footer.php';
?>