<?php
// categories/monsters/monster_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get filter parameters
$levelFilter = isset($_GET['level']) ? sanitizeInput($_GET['level']) : '';
$undeadFilter = isset($_GET['undead']) ? sanitizeInput($_GET['undead']) : '';
$weakAttrFilter = isset($_GET['weakAttr']) ? sanitizeInput($_GET['weakAttr']) : '';
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Pagination settings
$itemsPerPage = 24; // Increased to match maps_list
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE impl = 'L1Monster'"; // Only show monsters
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

if (!empty($undeadFilter)) {
    $whereClause .= " AND undead = :undead";
    $params[':undead'] = $undeadFilter;
}

if (!empty($weakAttrFilter)) {
    $whereClause .= " AND weakAttr = :weakAttr";
    $params[':weakAttr'] = $weakAttrFilter;
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_en LIKE :search OR desc_kr LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of monsters with filters
    $countSql = "SELECT COUNT(*) FROM npc $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalMonsters = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalMonsters / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get monsters for current page with filters
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
    $monsters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $monsters = [];
    $totalMonsters = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    // Get level ranges for dropdown
    $levelStmt = $pdo->query("SELECT MIN(lvl) as min_lvl, MAX(lvl) as max_lvl FROM npc WHERE impl = 'L1Monster'");
    $levelRange = $levelStmt->fetch(PDO::FETCH_ASSOC);
    $minLevel = $levelRange['min_lvl'];
    $maxLevel = $levelRange['max_lvl'];
    
    // Generate level ranges in increments of 10
    $levelRanges = [];
    for ($i = $minLevel; $i <= $maxLevel; $i += 10) {
        $end = min($i + 9, $maxLevel);
        $levelRanges[] = "$i-$end";
    }
    
    // Get unique undead types
    $undeadStmt = $pdo->query("SELECT DISTINCT undead FROM npc WHERE impl = 'L1Monster' AND undead != 'NONE' ORDER BY undead");
    $undeadTypes = $undeadStmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Get unique weak attributes
    $weakAttrStmt = $pdo->query("SELECT DISTINCT weakAttr FROM npc WHERE impl = 'L1Monster' AND weakAttr != 'NONE' ORDER BY weakAttr");
    $weakAttributes = $weakAttrStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $levelRanges = [];
    $undeadTypes = [];
    $weakAttributes = [];
}

// Set hero title and description
$page_hero_title = "Monsters";
$page_hero_description = "Browse all monsters in the world of Lineage";

include '../../includes/hero.php';
?>

<main class="container">
    <h2 class="page-title">Monsters</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search monsters...">
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
                
                <div>
                    <label for="undead">Undead Type:</label>
                    <select id="undead" name="undead">
                        <option value="">All Types</option>
                        <?php foreach ($undeadTypes as $type): ?>
                            <option value="<?= $type ?>" <?= $undeadFilter === $type ? 'selected' : '' ?>>
                                <?= normalizeUndeadType($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label for="weakAttr">Weak Against:</label>
                    <select id="weakAttr" name="weakAttr">
                        <option value="">All Attributes</option>
                        <?php foreach ($weakAttributes as $attr): ?>
                            <option value="<?= $attr ?>" <?= $weakAttrFilter === $attr ? 'selected' : '' ?>>
                                <?= normalizeWeakAttribute($attr) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="monster_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Monsters Card Grid - Updated to match maps_list style -->
    <div class="monsters-container">
        <?php if (!empty($monsters)): ?>
            <div class="maps-grid"> <!-- Using the same class as maps for consistency -->
                <?php foreach ($monsters as $monster): 
                    $monsterType = $monster['undead'] !== 'NONE' ? normalizeUndeadType($monster['undead']) : 'Normal';
                    $typeClass = strtolower(str_replace(' ', '-', $monsterType));
                    
                    // Determine level class for color coding
                    $level = $monster['lvl'];
                    if ($level < 20) {
                        $levelClass = 'low-level';
                    } else if ($level < 40) {
                        $levelClass = 'mid-level';
                    } else if ($level < 60) {
                        $levelClass = 'high-level';
                    } else {
                        $levelClass = 'boss-level';
                    }
                ?>
                    <div class="map-card monster-card <?= $typeClass ?>">
                        <a href="monster_detail.php?id=<?= $monster['npcid'] ?>" class="map-card-link">
                            <div class="map-card-image">
                                <img src="../../assets/img/icons/ms<?= $monster['spriteId'] ?>.png" 
                                     alt="<?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?>" 
                                     onerror="this.onerror=null; this.src='../../assets/img/icons/ms<?= $monster['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/nosprite.png';}">
                            </div>
                            <div class="map-card-content">
                                <h3 class="map-card-title <?= $levelClass ?>"><?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?></h3>
                                <div class="map-card-details">
                                    <span class="map-id map-dungeon-tag">ID: <?= $monster['npcid'] ?></span>
                                    <span class="monster-level">Lv. <?= $monster['lvl'] ?></span>
									<span class="map-id map-outdoor-tag">Sprite: <?= $monster['spriteId'] ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination - Same as maps_list -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage > 10): ?>
                        <a href="?page=<?= max(1, $currentPage - 10) ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            -10
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
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
                        <a href="?page=<?= $i ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage + 10 <= $totalPages): ?>
                        <a href="?page=<?= min($totalPages, $currentPage + 10) ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link">
                            +10
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&level=<?= urlencode($levelFilter) ?>&undead=<?= urlencode($undeadFilter) ?>&weakAttr=<?= urlencode($weakAttrFilter) ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-maps">No monsters found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<style>
/* Monster Card Styles to match Maps List */
.monsters-container {
    margin-top: 2rem;
}

.maps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.map-card.monster-card {
    background-color: var(--secondary);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
    height: auto;
}

.map-card.monster-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(255, 110, 62, 0.25);
    border-color: var(--accent);
}

.map-card-link {
    display: block;
    text-decoration: none;
    color: var(--text);
}

.map-card-image {
    height: 300px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
}

.map-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.5s ease;
}

.map-card:hover .map-card-image img {
    transform: scale(1.08);
}

.map-card-content {
    padding: 1.2rem;
}

.map-card-title {
    font-size: 1.2rem;
    margin: 0 0 0.8rem 0;
    color: var(--accent);
    font-weight: 700;
    text-align: center;
}

.map-card-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.85rem;
}

.map-id, .monster-level {
    color: rgba(255, 255, 255, 0.7);
    background: rgba(0, 0, 0, 0.3);
    padding: 0.3rem 0.6rem;
    border-radius: 12px;
}

.map-dungeon-tag, .map-outdoor-tag {
    padding: 0.3rem 0.6rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.8rem;
}

.map-dungeon-tag {
    background: rgba(63, 215, 219, 0.7);
    color: #f7ffff;
}

.map-outdoor-tag {
    background: rgba(223, 128, 32, 0.75);
    color: #f7ffff;
}

/* Monster type specific styling */
.monster-type-undead {
    background: rgba(255, 107, 107, 0.2);
    color: #ff6b6b;
    border: 1px solid rgba(255, 107, 107, 0.3);
}

.monster-type-animal {
    background: rgba(78, 205, 196, 0.2);
    color: #4ecdc4;
    border: 1px solid rgba(78, 205, 196, 0.3);
}

.monster-type-demon {
    background: rgba(255, 0, 255, 0.2);
    color: #ff00ff;
    border: 1px solid rgba(255, 0, 255, 0.3);
}

.monster-type-dragon {
    background: rgba(255, 140, 0, 0.2);
    color: #ff8c00;
    border: 1px solid rgba(255, 140, 0, 0.3);
}

.monster-type-human {
    background: rgba(0, 180, 255, 0.2);
    color: #00b4ff;
    border: 1px solid rgba(0, 180, 255, 0.3);
}

/* Level-based color coding for monster names */
.map-card-title.low-level {
    color: #4ecdc4; /* Teal for low levels */
}

.map-card-title.mid-level {
    color: #ffcc00; /* Yellow for mid levels */
}

.map-card-title.high-level {
    color: #ff6e3e; /* Orange for high levels */
}

.map-card-title.boss-level {
    color: #ff00ff; /* Magenta for bosses */
}

.no-maps {
    text-align: center;
    padding: 3rem;
    font-size: 1.2rem;
    opacity: 0.7;
    grid-column: 1 / -1;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .maps-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .maps-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1rem;
    }
    
    .map-card-image {
        height: 160px;
    }
    
    .map-card-content {
        padding: 1rem;
    }
    
    .map-card-title {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .maps-grid {
        grid-template-columns: 1fr;
    }
    
    .map-card.monster-card {
        max-width: 320px;
        margin: 0 auto;
    }
}
</style>

<?php
include '../../includes/footer.php';
?>