<?php
// categories/items/item_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get filter parameters
$gradeFilter = isset($_GET['grade']) ? sanitizeInput($_GET['grade']) : '';
$typeFilter = isset($_GET['type']) ? sanitizeInput($_GET['type']) : '';
$useTypeFilter = isset($_GET['use_type']) ? sanitizeInput($_GET['use_type']) : '';
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE 1=1";
$params = [];

if (!empty($gradeFilter)) {
    $whereClause .= " AND itemGrade = :grade";
    $params[':grade'] = $gradeFilter;
}

if (!empty($typeFilter)) {
    $whereClause .= " AND item_type = :type";
    $params[':type'] = $typeFilter;
}

if (!empty($useTypeFilter)) {
    $whereClause .= " AND use_type = :use_type";
    $params[':use_type'] = $useTypeFilter;
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_en LIKE :search OR desc_kr LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of items with filters
    $countSql = "SELECT COUNT(*) FROM etcitem $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalItems = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get items for current page with filters
    $sql = "SELECT * FROM etcitem $whereClause ORDER BY item_name_id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $items = [];
    $totalItems = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    $gradeStmt = $pdo->query("SELECT DISTINCT itemGrade FROM etcitem ORDER BY itemGrade");
    $grades = $gradeStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $typeStmt = $pdo->query("SELECT DISTINCT item_type FROM etcitem ORDER BY item_type");
    $types = $typeStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $useTypeStmt = $pdo->query("SELECT DISTINCT use_type FROM etcitem ORDER BY use_type");
    $useTypes = $useTypeStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $grades = [];
    $types = [];
    $useTypes = [];
}

include '../../includes/hero.php';
?>

<main class="container">
    <h2 class="page-title">Items</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search items...">
                </div>
                
                <div>
                    <label for="grade">Grade:</label>
                    <select id="grade" name="grade">
                        <option value="">All Grades</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?= $grade ?>" <?= $gradeFilter === $grade ? 'selected' : '' ?>>
                                <?= normalizeGrade($grade) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label for="type">Type:</label>
                    <select id="type" name="type">
                        <option value="">All Types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type ?>" <?= $typeFilter === $type ? 'selected' : '' ?>>
                                <?= normalizeItemType($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label for="use_type">Use Type:</label>
                    <select id="use_type" name="use_type">
                        <option value="">All Use Types</option>
                        <?php foreach ($useTypes as $useType): ?>
                            <option value="<?= $useType ?>" <?= $useTypeFilter === $useType ? 'selected' : '' ?>>
                                <?= normalizeItemUseType($useType) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="item_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($items)): ?>
            <table class="weapons-table">
                <thead>
                    <tr>
                        <th class="icon-col">Icon</th>
                        <th class="id-col">Item ID</th>
                        <th class="iconid-col">Icon ID</th>
                        <th class="name-col">Name</th>
                        <th class="grade-col">Grade</th>
                        <th class="type-col">Type</th>
                        <th class="type-col">Use Type</th>
                        <th class="weight-col">Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr class="weapon-row">
                            <td class="weapon-icon">
                                <a href="item_detail.php?id=<?= $item['item_id'] ?>">
                                    <img src="../../assets/img/icons/<?= $item['iconId'] ?>.png" 
                                         alt="<?= htmlspecialchars(getDisplayName($item['desc_en'])) ?>" 
                                         onerror="this.src='../../assets/img/placeholders/items.png'">
                                </a>
                            </td>
                            <td class="weapon-id"><?= $item['item_id'] ?></td>
                            <td class="weapon-iconid"><?= $item['iconId'] ?></td>
                            <td class="weapon-name">
                                <a href="item_detail.php?id=<?= $item['item_id'] ?>">
                                    <?= htmlspecialchars(getDisplayName($item['desc_en'])) ?>
                                </a>
                            </td>
                            <td class="weapon-grade"><?= normalizeGrade($item['itemGrade']) ?></td>
                            <td class="weapon-type"><?= normalizeItemType($item['item_type']) ?></td>
                            <td class="weapon-type"><?= normalizeItemUseType($item['use_type']) ?></td>
                            <td class="weapon-damage"><?= $item['weight'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage > 10): ?>
                        <a href="?page=<?= max(1, $currentPage - 10) ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            -10
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
                        <?php if ($currentPage > 4): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php
                    // Show page numbers around current page
                    $startPage = max(1, $currentPage - 1);
                    $endPage = min($totalPages, $currentPage + 1);
                    
                    for ($i = $startPage; $i <= $endPage; $i++):
                    ?>
                        <a href="?page=<?= $i ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage + 10 <= $totalPages): ?>
                        <a href="?page=<?= min($totalPages, $currentPage + 10) ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            +10
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&use_type=<?= $useTypeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No items found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>
