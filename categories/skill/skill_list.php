<?php
// categories/skill/skill_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Custom hero content for this specific page (optional)
// Uncomment these lines to override the automatic detection:
// $page_hero_title = "Legendary Skills Await";
// $page_hero_description = "Discover the most powerful skills in Lineage Remastered. Filter by grade, class, and level to find your perfect skill.";

include '../../includes/hero.php';

// Get filter parameters
$gradeFilter = isset($_GET['grade']) ? sanitizeInput($_GET['grade']) : '';
$classFilter = isset($_GET['class_type']) ? sanitizeInput($_GET['class_type']) : '';
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE desc_en != '' AND desc_en != 'none' AND desc_en IS NOT NULL";
$params = [];

if (!empty($gradeFilter)) {
    $whereClause .= " AND grade = :grade";
    $params[':grade'] = $gradeFilter;
}

if (!empty($classFilter)) {
    $whereClause .= " AND classType = :class_type";
    $params[':class_type'] = $classFilter;
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_en LIKE :search OR name LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of skills with filters
    $countSql = "SELECT COUNT(*) FROM skills $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalSkills = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalSkills / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get skills for current page with filters
    $sql = "SELECT * FROM skills $whereClause ORDER BY skill_level ASC, skill_id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $skills = [];
    $totalSkills = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    $gradeStmt = $pdo->query("SELECT DISTINCT grade FROM skills ORDER BY FIELD(grade, 'ONLY', 'MYTH', 'LEGEND', 'RARE', 'NORMAL')");
    $grades = $gradeStmt->fetchAll(PDO::FETCH_COLUMN);
    
    $classStmt = $pdo->query("SELECT DISTINCT classType FROM skills WHERE classType != 'none' ORDER BY classType");
    $classes = $classStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $grades = [];
    $classes = [];
}

// Function to get skill icon from skill_info
function getSkillIcon($skillId, $pdo) {
    try {
        $stmt = $pdo->prepare("SELECT onIconId FROM skills_info WHERE skillId = :id");
        $stmt->bindValue(':id', $skillId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['onIconId'] : 0;
    } catch(PDOException $e) {
        return 0;
    }
}
?>

<main class="container">
    <h2 class="page-title">Skills</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search skills...">
                </div>
                
                <div>
                    <label for="grade">Grade:</label>
                    <select id="grade" name="grade">
                        <option value="">All Grades</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?= $grade ?>" <?= $gradeFilter === $grade ? 'selected' : '' ?>>
                                <?= $grade ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label for="class_type">Class:</label>
                    <select id="class_type" name="class_type">
                        <option value="">All Classes</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class ?>" <?= $classFilter === $class ? 'selected' : '' ?>>
                                <?= ucfirst($class) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="skill_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($skills)): ?>
            <table class="weapons-table clickable-rows">
                <thead>
                    <tr>
                        <th class="icon-col">Icon</th>
                        <th class="id-col">ID</th>
                        <th class="name-col">Name</th>
                        <th class="level-col">Level</th>
                        <th class="grade-col">Grade</th>
                        <th class="class-col">Class</th>
                        <th class="mp-col">MP</th>
                        <th class="hp-col">HP</th>
                        <th class="type-col">Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($skills as $skill): 
                        // Skip skills with empty or meaningless descriptions
                        if (empty(trim($skill['desc_en'])) || strtolower(trim($skill['desc_en'])) === 'none' || trim($skill['desc_en']) === '') continue;
                        
                        // Get the icon ID from skills_info
                        $iconId = getSkillIcon($skill['skill_id'], $pdo);
                        ?>
                        <tr class="weapon-row clickable" onclick="window.location.href='skill_detail.php?id=<?= $skill['skill_id'] ?>';">
                            <td class="weapon-icon">
                                <img src="../../assets/img/icons/<?= $iconId ?>.png" 
                                     alt="<?= htmlspecialchars($skill['desc_en']) ?>" 
                                     onerror="this.src='../../assets/img/placeholders/0.png'">
                            </td>
                            <td class="weapon-id"><?= $skill['skill_id'] ?></td>
                            <td class="weapon-name">
                                <?= htmlspecialchars($skill['desc_en']) ?>
                            </td>
                            <td class="weapon-level"><?= $skill['skill_level'] ?></td>
                            <td class="weapon-grade"><?= $skill['grade'] ?></td>
                            <td class="weapon-class"><?= $skill['classType'] !== 'none' ? ucfirst($skill['classType']) : 'Normal' ?></td>
                            <td class="weapon-mp"><?= $skill['mpConsume'] ?></td>
                            <td class="weapon-hp"><?= $skill['hpConsume'] ?></td>
                            <td class="weapon-type"><?= $skill['type'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&grade=<?= $gradeFilter ?>&class_type=<?= $classFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&grade=<?= $gradeFilter ?>&class_type=<?= $classFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
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
                        <a href="?page=<?= $i ?>&grade=<?= $gradeFilter ?>&class_type=<?= $classFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&grade=<?= $gradeFilter ?>&class_type=<?= $classFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&grade=<?= $gradeFilter ?>&class_type=<?= $classFilter ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No skills found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>