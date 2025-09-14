<?php
// categories/polymorph/polymorph_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Custom hero content for this specific page (optional)
$page_hero_title = "Polymorph Database";
$page_hero_description = "Browse and search all available polymorphs in Lineage Remastered.";

include '../../includes/hero.php';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Get filter parameters
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Build WHERE clause for filters
$whereClause = "WHERE 1=1";
$params = [];

if (!empty($searchTerm)) {
    $whereClause .= " AND name LIKE :search";
    $params[':search'] = "%$searchTerm%";
}

// Database query with pagination and filters
try {
    // Get total number of polymorphs with filters
    $countSql = "SELECT COUNT(*) FROM polymorphs $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalPolymorphs = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalPolymorphs / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get polymorphs for current page with filters
    $sql = "SELECT p.*, pi.name as item_name 
            FROM polymorphs p
            LEFT JOIN polyitems pi ON p.polyid = pi.polyId
            $whereClause
            ORDER BY p.id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $polymorphs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $polymorphs = [];
    $totalPolymorphs = 0;
    $totalPages = 0;
}
?>

<main class="container">
    <h2 class="page-title">Polymorphs</h2>
    
    <!-- Filters Section -->
    <div class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div>
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Search polymorphs...">
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Apply</button>
                    <a href="polymorph_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="weapons-list-container">
        <?php if (!empty($polymorphs)): ?>
            <table class="weapons-table clickable-rows">
                <thead>
                    <tr>
                        <th class="id-col">ID</th>
                        <th class="name-col">Name</th>
                        <th class="id-col">Poly ID</th>
                        <th class="level-col">Min Level</th>
                        <th class="name-col">Item Name</th>
                        <th class="actions-col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($polymorphs as $polymorph): ?>
                        <tr class="weapon-row clickable" data-href="polymorph_detail.php?id=<?= $polymorph['id'] ?>">
                            <td class="id-col"><?= $polymorph['id'] ?></td>
                            <td class="name-col">
                                <a href="polymorph_detail.php?id=<?= $polymorph['id'] ?>">
                                    <?= htmlspecialchars($polymorph['name']) ?>
                                </a>
                            </td>
                            <td class="id-col"><?= $polymorph['polyid'] ?></td>
                            <td class="level-col"><?= $polymorph['minlevel'] ?></td>
                            <td class="name-col"><?= htmlspecialchars($polymorph['item_name'] ?? 'N/A') ?></td>
                            <td class="actions-col">
                                <a href="polymorph_detail.php?id=<?= $polymorph['id'] ?>" class="pagination-link">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-prev">Previous</a>
                    <?php endif; ?>
                    
                    <?php
                    // Always show first page
                    if ($currentPage > 3): ?>
                        <a href="?page=1&search=<?= urlencode($searchTerm) ?>" class="pagination-link">1</a>
                        <?php if ($currentPage > 4): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php
                    // Show page numbers around current page
                    $startPage = max(1, $currentPage - 1);
                    $endPage = min($totalPages, $currentPage + 1);
                    
                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?page=<?= $i ?>&search=<?= urlencode($searchTerm) ?>" 
                           class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">                           
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php
                    // Show ellipsis and last page if needed
                    if ($currentPage < $totalPages - 2): ?>
                        <?php if ($currentPage < $totalPages - 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $totalPages ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link"><?= $totalPages ?></a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($searchTerm) ?>" class="pagination-link pagination-next">Next</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No polymorphs found matching your criteria.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>
