<?php
// categories/armor/armor_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get filter parameters
$gradeFilter = isset($_GET['grade']) ? sanitizeInput($_GET['grade']) : '';
$typeFilter = isset($_GET['type']) ? sanitizeInput($_GET['type']) : '';
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
    $whereClause .= " AND type = :type";
    $params[':type'] = $typeFilter;
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_en LIKE :search OR note LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of armor items with filters
    $countSql = "SELECT COUNT(*) FROM armor $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalArmor = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalArmor / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get armor for current page with filters
    $sql = "SELECT * FROM armor $whereClause ORDER BY item_name_id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $armorItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $armorItems = [];
    $totalArmor = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    $gradeStmt = $pdo->query("SELECT DISTINCT itemGrade FROM armor ORDER BY itemGrade");
    $grades = $gradeStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $typeStmt = $pdo->query("SELECT DISTINCT type FROM armor ORDER BY type");
    $types = $typeStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $grades = [];
    $types = [];
}

include '../../includes/hero.php';
?>

<main class="container">
    <h2 class="page-title">Armor</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search armor...">
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
                                <?= normalizeArmorType($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="armor_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($armorItems)): ?>
            <table class="weapons-table">
                <thead>
                    <tr>
                        <th class="icon-col">Icon</th>
                        <th class="id-col">Item ID</th>
                        <th class="name-col">Name</th>
                        <th class="grade-col">Grade</th>
                        <th class="type-col">Type</th>
                        <th class="ac-col">AC</th>
                        <th class="weight-col">Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($armorItems as $armor): ?>
                        <tr class="weapon-row">
                            <td class="weapon-icon">
                                <a href="armor_detail.php?id=<?= $armor['item_id'] ?>">
                                    <img src="../../assets/img/icons/<?= $armor['iconId'] ?>.png" 
                                         alt="<?= htmlspecialchars(getDisplayName($armor['desc_en'])) ?>" 
                                         onerror="this.src='../../assets/img/placeholders/armor.png'">
                                </a>
                            </td>
                            <td class="weapon-id"><?= $armor['item_id'] ?></td>
                            <td class="weapon-name">
                                <a href="armor_detail.php?id=<?= $armor['item_id'] ?>">
                                    <?= htmlspecialchars(getDisplayName($armor['desc_en'])) ?>
                                </a>
                            </td>
                            <td class="weapon-grade"><?= normalizeGrade($armor['itemGrade']) ?></td>
                            <td class="weapon-type"><?= normalizeArmorType($armor['type']) ?></td>
                            <td class="weapon-damage"><?= $armor['ac'] ?></td>
                            <td class="weapon-damage"><?= $armor['weight'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                        <a href="?page=<?= $i ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-weapons">No armor items found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>