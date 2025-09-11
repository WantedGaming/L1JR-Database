<?php
// categories/npcs/npc_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get filter parameters
$levelFilter = isset($_GET['level']) ? sanitizeInput($_GET['level']) : '';
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE impl = 'L1Merchant'"; // Only show NPCs
$params = [];

if (!empty($levelFilter)) {
    // Handle level ranges
    if (strpos($levelFilter, '-') !== false) {
        list($minLevel, $maxLevel) = explode('-', $levelFilter);
        $whereClause .= " AND lvl BETWEEN :minLevel AND :maxLevel";
        $params[':minLevel'] = (int)$minLevel;
        $params[':maxLevel'] = (int)$maxLevel;
    } else {
        $whereClause .= " AND lvl = :level";
        $params[':level'] = (int)$levelFilter;
    }
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_en LIKE :search OR desc_kr LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of NPCs with filters
    $countSql = "SELECT COUNT(*) FROM npc $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalNpcs = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalNpcs / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get NPCs for current page with filters
    $sql = "SELECT * FROM npc $whereClause ORDER BY lvl ASC, desc_en ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $npcs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $npcs = [];
    $totalNpcs = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    // Get level ranges for dropdown
    $levelStmt = $pdo->query("SELECT MIN(lvl) as min_lvl, MAX(lvl) as max_lvl FROM npc WHERE impl = 'L1Merchant'");
    $levelRange = $levelStmt->fetch(PDO::FETCH_ASSOC);
    $minLevel = $levelRange['min_lvl'];
    $maxLevel = $levelRange['max_lvl'];
    
    // Generate level ranges in increments of 10
    $levelRanges = [];
    for ($i = $minLevel; $i <= $maxLevel; $i += 10) {
        $end = min($i + 9, $maxLevel);
        $levelRanges[] = "$i-$end";
    }
} catch(PDOException $e) {
    $levelRanges = [];
}

include '../../includes/hero.php';
?>

<main class="container">
    <h2 class="page-title">NPCs</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search NPCs...">
                </div>
                
                <div>
                    <label for="level">Level Range:</label>
                    <select id="level" name="level">
                        <option value="">All Levels</option>
                        <?php foreach ($levelRanges as $range): ?>
                            <option value="<?= $range ?>" <?= $levelFilter === $range ? 'selected' : '' ?>>
                                <?= $range ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="npc_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($npcs)): ?>
            <table class="weapons-table">
                <thead>
                    <tr>
                        <th class="icon-col">Image</th>
                        <th class="id-col">ID</th>
                        <th class="name-col">Name</th>
                        <th class="level-col">Level</th>
                        <th class="hp-col">HP</th>
                        <th class="mp-col">MP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($npcs as $npc): ?>
                        <tr class="weapon-row">
                            <td class="weapon-icon">
                                <a href="npc_detail.php?id=<?= $npc['npcid'] ?>">
                                    <img src="../../assets/img/icons/<?= $npc['spriteId'] ?>.png" 
                                         alt="<?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?>" 
                                         onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $npc['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/npcs.png';}">
                                </a>
                            </td>
                            <td class="weapon-id"><?= $npc['npcid'] ?></td>
                            <td class="weapon-name">
                                <a href="npc_detail.php?id=<?= $npc['npcid'] ?>">
                                    <?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?>
                                </a>
                            </td>
                            <td class="weapon-level"><?= $npc['lvl'] ?></td>
                            <td class="weapon-hp"><?= $npc['hp'] ?></td>
                            <td class="weapon-mp"><?= $npc['mp'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage > 10): ?>
                        <a href="?page=<?= max(1, $currentPage - 10) ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            -10
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
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
                        <a href="?page=<?= $i ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage + 10 <= $totalPages): ?>
                        <a href="?page=<?= min($totalPages, $currentPage + 10) ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            +10
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&level=<?= urlencode($levelFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No NPCs found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>
