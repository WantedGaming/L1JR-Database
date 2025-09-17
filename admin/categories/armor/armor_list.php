<?php
// admin/categories/armor/armor_list.php - Armor List Admin
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
    $whereClause .= "type = :type";
    $whereParams[':type'] = $_GET['type'];
}

if (isset($_GET['grade']) && !empty($_GET['grade'])) {
    if (!empty($whereClause)) {
        $whereClause .= " AND ";
    }
    $whereClause .= "grade = :grade";
    $whereParams[':grade'] = $_GET['grade'];
}

// Get total count for pagination
try {
    $countSql = "SELECT COUNT(*) FROM armor";
    if (!empty($whereClause)) {
        $countSql .= " WHERE $whereClause";
    }
    
    $countStmt = $pdo->prepare($countSql);
    foreach ($whereParams as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalArmor = $countStmt->fetchColumn();
} catch (PDOException $e) {
    displayMessage('Error counting armor: ' . $e->getMessage(), 'danger');
    $totalArmor = 0;
}

// Get armor with pagination
$armorList = [];
try {
    $sql = "SELECT * FROM armor";
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
    $armorList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    displayMessage('Error retrieving armor: ' . $e->getMessage(), 'danger');
}

// Get armor types and grades for filters
$armorTypes = [];
$armorGrades = [];
try {
    $typesStmt = $pdo->query("SELECT DISTINCT type FROM armor ORDER BY type");
    $armorTypes = $typesStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $gradesStmt = $pdo->query("SELECT DISTINCT grade FROM armor ORDER BY grade");
    $armorGrades = $gradesStmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    // Ignore errors
}

// Calculate pagination
$totalPages = ceil($totalArmor / $limit);

// Build query string for pagination links
$queryParams = $_GET;
unset($queryParams['page']);
$queryString = http_build_query($queryParams);
$queryString = !empty($queryString) ? '&' . $queryString : '';
?>

<div class="admin-armor">
    <h1 class="admin-section-title">Armor Management</h1>
    
    <!-- Search and Filter Form -->
    <div class="admin-filters">
        <form method="get" action="armor_list.php">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Armor name..." 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="type" class="form-label">Armor Type</label>
                    <select id="type" name="type" class="form-control">
                        <option value="">All Types</option>
                        <?php foreach ($armorTypes as $type): ?>
                        <option value="<?php echo $type; ?>" <?php echo (isset($_GET['type']) && $_GET['type'] === $type) ? 'selected' : ''; ?>>
                            <?php echo normalizeArmorType($type); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="grade" class="form-label">Armor Grade</label>
                    <select id="grade" name="grade" class="form-control">
                        <option value="">All Grades</option>
                        <?php foreach ($armorGrades as $grade): ?>
                        <option value="<?php echo $grade; ?>" <?php echo (isset($_GET['grade']) && $_GET['grade'] === $grade) ? 'selected' : ''; ?>>
                            <?php echo normalizeGrade($grade); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="admin-btn admin-btn-primary">Apply Filters</button>
                    <a href="armor_list.php" class="admin-btn admin-btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Armor Table -->
    <div class="admin-section">
        <div class="admin-buttons" style="margin-bottom: 1rem;">
            <a href="add_armor.php" class="admin-btn admin-btn-primary">Add New Armor</a>
            <a href="../../view_table.php?table=armor" class="admin-btn admin-btn-secondary">View Raw Table</a>
        </div>
        
        <?php if (empty($armorList)): ?>
        <div class="no-results">
            <p>No armor found matching your criteria.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Grade</th>
                        <th>AC</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($armorList as $armor): ?>
                    <tr>
                        <td><?php echo $armor['item_id']; ?></td>
                        <td><?php echo getDisplayName($armor['name']); ?></td>
                        <td><?php echo normalizeArmorType($armor['type']); ?></td>
                        <td><?php echo normalizeGrade($armor['grade']); ?></td>
                        <td><?php echo $armor['ac']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="../../view_record.php?table=armor&item_id=<?php echo $armor['item_id']; ?>" class="action-btn action-btn-view">View</a>
                                <a href="../../edit_record.php?table=armor&item_id=<?php echo $armor['item_id']; ?>" class="action-btn action-btn-edit">Edit</a>
                                <a href="../../delete_record.php?table=armor&item_id=<?php echo $armor['item_id']; ?>" class="action-btn action-btn-delete delete-confirm">Delete</a>
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