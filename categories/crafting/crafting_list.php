<?php
// categories/crafting/crafting_list.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Add custom CSS for crafting list page
echo '<link rel="stylesheet' . ' href="../../assets/css/style.css">';

// Set page title and description for hero section
$page_hero_title = "Crafting Recipes";
$page_hero_description = "Discover all available crafting recipes to create powerful equipment and items";

include '../../includes/hero.php';

// Get filter parameters
$typeFilter = isset($_GET['type']) ? sanitizeInput($_GET['type']) : '';
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$minLevel = isset($_GET['min_level']) ? (int)$_GET['min_level'] : 0;

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Build WHERE clause for filters
$whereClause = "WHERE 1=1";
$params = [];

if (!empty($typeFilter)) {
    $whereClause .= " AND craft_type = :type";
    $params[':type'] = $typeFilter;
}

if (!empty($searchTerm)) {
    $whereClause .= " AND (desc_kr LIKE :search OR real_desc LIKE :search)";
    $params[':search'] = "%$searchTerm%";
}

if (!empty($minLevel)) {
    $whereClause .= " AND min_level >= :min_level";
    $params[':min_level'] = $minLevel;
}

// Database query with pagination and filters
try {
    // Get total number of recipes with filters
    $countSql = "SELECT COUNT(*) FROM bin_craft_common $whereClause";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalRecipes = $countStmt->fetchColumn();
    
    // Calculate total pages
    $totalPages = ceil($totalRecipes / $itemsPerPage);
    
    // Ensure current page doesn't exceed total pages
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    
    // Get recipes for current page with filters
    // FIXED: Use real_desc instead of desc_en and include icon_id (correct column name)
    $sql = "SELECT c.*, i.real_desc as output_name, i.icon_id 
            FROM bin_craft_common c 
            LEFT JOIN bin_item_common i ON c.craft_id = i.name_id 
            $whereClause ORDER BY c.craft_id ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    // Bind filter parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind pagination parameters
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    $recipes = [];
    $totalRecipes = 0;
    $totalPages = 0;
}

// Get unique values for filter dropdowns
try {
    $typeStmt = $pdo->query("SELECT DISTINCT craft_type FROM bin_craft_common ORDER BY craft_type");
    $types = $typeStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $types = [];
}
?>

<main class="container detail-container">
    <!-- Filters Section -->
    <section class="filters-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="search">Search Recipes</label>
                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           placeholder="Enter recipe name...">
                </div>
                
                <div class="filter-group">
                    <label for="type">Recipe Type</label>
                    <select id="type" name="type">
                        <option value="">All Types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type ?>" <?= $typeFilter === $type ? 'selected' : '' ?>>
                                <?= ucfirst($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="min-level">Min Level</label>
                    <input type="number" id="min-level" name="min_level" min="1" max="99" 
                           value="<?= $minLevel ?>" placeholder="1">
                </div>
                
                <div class="filter-actions">
                    <button type="submit">Apply Filters</button>
                    <a href="crafting_list.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </div>
        </form>
    </section>

    <!-- Crafting Recipes Grid -->
    <section class="crafting-grid">
        <h2 class="page-title">Available Recipes (<?= $totalRecipes ?>)</h2>
        
        <?php if (!empty($recipes)): ?>
            <div class="cards-grid">
                <?php foreach ($recipes as $recipe): 
                    // Use TBL function to get the proper item name
                    $outputName = !empty($recipe['output_name']) ? getTextFromTbl($recipe['output_name']) : $recipe['desc_kr'];
                    $iconId = $recipe['icon_id'] ?? 0;
                    ?>
                    <div class="card">
                        <a href="crafting_detail.php?id=<?= $recipe['craft_id'] ?>" class="card-link">
                            <div class="card-image">
                                <img src="<?= getItemImage($iconId, $outputName) ?>" 
                                     alt="<?= htmlspecialchars($outputName) ?>">
                            </div>
                            <h3 class="card-title"><?= htmlspecialchars($outputName) ?></h3>
                            <p><?= ucfirst($recipe['craft_type'] ?? 'Recipe') ?> - Level <?= $recipe['min_level'] ?>+</p>
                            <p>Success Rate: <?= round($recipe['outputs_success_prob_by_million'] / 10000, 2) ?>%</p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>&min_level=<?= $minLevel ?>" 
                           class="pagination-link">&laquo; Prev</a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == 1 || $i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)): ?>
                            <a href="?page=<?= $i ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>&min_level=<?= $minLevel ?>" 
                               class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                                <?= $i ?>
                            </a>
                        <?php elseif ($i == $currentPage - 3 || $i == $currentPage + 3): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&type=<?= $typeFilter ?>&search=<?= urlencode($searchTerm) ?>&min_level=<?= $minLevel ?>" 
                           class="pagination-link">Next &raquo;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p class="no-weapons">No crafting recipes found matching your criteria.</p>
        <?php endif; ?>
    </section>
</main>

<?php
include '../../includes/footer.php';
?>