<?php
// categories/weapon/weapon_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Custom hero content for this specific page (optional)
// Uncomment these lines to override the automatic detection:
// $page_hero_title = "Legendary Weapons Await";
// $page_hero_description = "Discover the most powerful weapons in Lineage Remastered. Filter by grade, type, and damage to find your perfect weapon.";

// Debug: Check what base_url is set to
echo "<!-- SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . " -->";
echo "<!-- HTTP_HOST: " . $_SERVER['HTTP_HOST'] . " -->";
echo "<!-- DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . " -->";
echo "<!-- Base URL: " . $base_url . " -->";
echo "<!-- CSS Path: " . $base_url . "assets/css/style.css -->";

// Test if we can access the CSS file directly
$css_file_path = '../../assets/css/style.css';
if (file_exists($css_file_path)) {
    echo "<!-- CSS file exists at relative path: " . $css_file_path . " -->";
} else {
    echo "<!-- CSS file NOT found at relative path: " . $css_file_path . " -->";
}

include '../../includes/hero.php';

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
    $whereClause .= " AND (desc_en LIKE :search OR desc_kr LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of weapons with filters
    $countSql = "SELECT COUNT(*) FROM weapon $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalWeapons = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalWeapons / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get weapons for current page with filters
    $sql = "SELECT * FROM weapon $whereClause ORDER BY item_name_id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $weapons = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $weapons = [];
    $totalWeapons = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    $gradeStmt = $pdo->query("SELECT DISTINCT itemGrade FROM weapon ORDER BY itemGrade");
    $grades = $gradeStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $typeStmt = $pdo->query("SELECT DISTINCT type FROM weapon ORDER BY type");
    $types = $typeStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $grades = [];
    $types = [];
}
?>

<main class="container">
    <h2 class="page-title">Weapons</h2>
    
        <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search weapons...">
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
                                <?= normalizeType($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="weapon_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($weapons)): ?>
            <table class="weapons-table clickable-rows">
                <thead>
                    <tr>
						<th class="icon-col">Icon</th>
						<th class="id-col">Item ID</th>
						<th class="iconid-col">Icon ID</th>
						<th class="name-col">Name</th>
						<th class="grade-col">Grade</th>
						<th class="type-col">Type</th>
						<th class="damage-col">S</th>
						<th class="damage-col">L</th>
					</tr>
                </thead>
                <tbody>
                    <?php foreach ($weapons as $weapon): ?>
                        <tr class="weapon-row">
							<td class="weapon-icon">
								<a href="weapon_detail.php?id=<?= $weapon['item_id'] ?>">
									<img src="../../assets/img/icons/<?= $weapon['iconId'] ?>.png" 
										 alt="<?= htmlspecialchars(getDisplayName($weapon['desc_en'])) ?>" 
										 onerror="this.src='../../assets/img/placeholders/armor.png'">
								</a>
							</td>
							<td class="weapon-id"><?= $weapon['item_id'] ?></td>
							<td class="weapon-iconid"><?= $weapon['iconId'] ?></td>
							<td class="weapon-name">
								<a href="weapon_detail.php?id=<?= $weapon['item_id'] ?>">
									<?= htmlspecialchars(getDisplayName($weapon['desc_en'])) ?>
								</a>
							</td>
							<td class="weapon-grade"><?= normalizeGrade($weapon['itemGrade']) ?></td>
							<td class="weapon-type"><?= normalizeType($weapon['type']) ?></td>
							<td class="weapon-damage"><?= $weapon['dmg_small'] ?></td>
							<td class="weapon-damage"><?= $weapon['dmg_large'] ?></td>
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
                    
                    <?php if ($currentPage > 10): ?>
                        <a href="?page=<?= max(1, $currentPage - 10) ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            -10
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
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
                        <a href="?page=<?= $i ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage + 10 <= $totalPages): ?>
                        <a href="?page=<?= min($totalPages, $currentPage + 10) ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            +10
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&grade=<?= $gradeFilter ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No weapons found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>