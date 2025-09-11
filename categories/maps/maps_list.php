<?php
// categories/maps/maps_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get filter parameters
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$dungeonFilter = isset($_GET['dungeon']) ? (int)$_GET['dungeon'] : -1; // -1 means all

// Pagination settings
$itemsPerPage = 24; // Show more maps per page for the card layout
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE 1=1";
$params = [];

if (!empty($searchTerm)) {
    $whereClause .= " AND locationname LIKE :search";
    $params[':search'] = "%$searchTerm%";
}

if ($dungeonFilter !== -1) {
    $whereClause .= " AND dungeon = :dungeon";
    $params[':dungeon'] = $dungeonFilter;
}

// Database query with pagination and filters
try {
    // Get total number of maps with filters
    $countSql = "SELECT COUNT(*) FROM mapids $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalMaps = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalMaps / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get maps for current page with filters
    $sql = "SELECT * FROM mapids $whereClause ORDER BY locationname ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $maps = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $maps = [];
    $totalMaps = 0;
    $totalPages = 0;
}

// Set hero title and description
$page_hero_title = "Maps";
$page_hero_description = "Browse all maps in the world of Lineage";

include '../../includes/hero.php';
?>

<main class="container">
    <h2 class="page-title">Maps</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search maps...">
                </div>
                
                <div>
                    <label for="dungeon">Type:</label>
                    <select id="dungeon" name="dungeon">
                        <option value="-1" <?= $dungeonFilter === -1 ? 'selected' : '' ?>>All Maps</option>
                        <option value="1" <?= $dungeonFilter === 1 ? 'selected' : '' ?>>Dungeons</option>
                        <option value="0" <?= $dungeonFilter === 0 ? 'selected' : '' ?>>Outdoor Maps</option>
                    </select>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="maps_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Maps Card Grid -->
    <div class="maps-container">
        <?php if (!empty($maps)): ?>
            <div class="maps-grid">
                <?php foreach ($maps as $map): ?>
                    <div class="map-card">
                        <a href="map_detail.php?id=<?= $map['mapid'] ?>" class="map-card-link">
                            <div class="map-card-image">
                                <img src="../../assets/img/icons/<?= $map['pngId'] ?>.png" 
                                     alt="<?= htmlspecialchars($map['locationname']) ?>" 
                                     onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $map['pngId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/maps.png';}">
                            </div>
                            <div class="map-card-content">
                                <h3 class="map-card-title"><?= htmlspecialchars($map['locationname']) ?></h3>
                                <div class="map-card-details">
                                    <span class="map-id">Map ID: <?= $map['mapid'] ?></span>
                                    <?php if ($map['dungeon'] == 1): ?>
                                        <span class="map-dungeon-tag">Dungeon</span>
                                    <?php else: ?>
                                        <span class="map-outdoor-tag">Outdoor</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage > 10): ?>
                        <a href="?page=<?= max(1, $currentPage - 10) ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link">
                            -10
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link">1</a>
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
                        <a href="?page=<?= $i ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage + 10 <= $totalPages): ?>
                        <a href="?page=<?= min($totalPages, $currentPage + 10) ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link">
                            +10
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($searchTerm) ?>&dungeon=<?= $dungeonFilter ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-maps">No maps found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<style>
    .maps-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .map-card {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.05);
        height: 100%;
    }
    
    .map-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(255, 110, 62, 0.2);
        border-color: var(--accent);
    }
    
    .map-card-link {
        display: block;
        text-decoration: none;
        color: var(--text);
        height: 100%;
    }
    
    .map-card-image {
        height: 180px;
        overflow: hidden;
        position: relative;
        background-color: rgba(0, 0, 0, 0.3);
    }
    
    .map-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .map-card:hover .map-card-image img {
        transform: scale(1.05);
    }
    
    .map-card-content {
        padding: 1.2rem;
    }
    
    .map-card-title {
        font-size: 1.2rem;
        color: var(--accent);
        margin-bottom: 0.8rem;
        font-weight: 600;
        border-bottom: 1px solid rgba(255, 110, 62, 0.3);
        padding-bottom: 0.5rem;
        transition: color 0.3s ease;
    }
    
    .map-card:hover .map-card-title {
        color: #ff8c5a;
    }
    
    .map-card-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }
    
    .map-id {
        opacity: 0.7;
    }
    
    .map-dungeon-tag, .map-outdoor-tag {
        padding: 0.3rem 0.6rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .map-dungeon-tag {
        background-color: rgba(255, 0, 0, 0.2);
        color: #ff6b6b;
        border: 1px solid rgba(255, 0, 0, 0.3);
    }
    
    .map-outdoor-tag {
        background-color: rgba(0, 255, 0, 0.1);
        color: #4ecdc4;
        border: 1px solid rgba(0, 255, 0, 0.2);
    }
    
    .no-maps {
        text-align: center;
        padding: 3rem;
        font-size: 1.2rem;
        opacity: 0.7;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .maps-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }
    
    @media (max-width: 576px) {
        .maps-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php
include '../../includes/footer.php';
?>
