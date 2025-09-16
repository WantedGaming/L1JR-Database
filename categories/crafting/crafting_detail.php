<?php
// categories/crafting/crafting_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Add custom CSS for crafting detail page
echo '<link rel="stylesheet" href="../../assets/css/style.css">';

// Get crafting recipe ID from URL
$recipeId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$recipeId) {
    echo "<div class='error-message'>No recipe specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch crafting recipe details from database
try {
    // FIXED: Use real_desc instead of desc_en and include icon_id (correct column name)
    $stmt = $pdo->prepare("SELECT c.*, i.real_desc as output_name, i.icon_id 
                          FROM bin_craft_common c 
                          LEFT JOIN bin_item_common i ON c.craft_id = i.name_id 
                          WHERE c.craft_id = :id");
    $stmt->bindValue(':id', $recipeId, PDO::PARAM_INT);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$recipe) {
        echo "<div class='error-message'>Recipe not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to recipe name using TBL text
    $outputName = !empty($recipe['output_name']) ? getTextFromTbl($recipe['output_name']) : $recipe['desc_kr'];
    $page_hero_title = htmlspecialchars($outputName);
    $page_hero_description = "Crafting recipe for " . htmlspecialchars($outputName);
    
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    include '../../includes/footer.php';
    exit;
}

include '../../includes/hero.php';

// Parse input and output data
$inputs = !empty($recipe['inputs_arr_input_item']) ? json_decode($recipe['inputs_arr_input_item'], true) : [];
$options = !empty($recipe['inputs_arr_option_item']) ? json_decode($recipe['inputs_arr_option_item'], true) : [];
$successOutputs = !empty($recipe['outputs_success']) ? json_decode($recipe['outputs_success'], true) : [];
$failureOutputs = !empty($recipe['outputs_failure']) ? json_decode($recipe['outputs_failure'], true) : [];
$periods = !empty($recipe['period_list']) ? json_decode($recipe['period_list'], true) : [];

// Function to get item name by ID with TBL integration
function getItemName($itemId, $pdo) {
    static $itemCache = [];
    
    if (!isset($itemCache[$itemId])) {
        try {
            $stmt = $pdo->prepare("SELECT real_desc, icon_id FROM bin_item_common WHERE name_id = :id");
            $stmt->bindValue(':id', $itemId, PDO::PARAM_INT);
            $stmt->execute();
            $item = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($item && !empty($item['real_desc'])) {
                // Use the TBL function to get text from .tbl file
                $itemCache[$itemId] = [
                    'name' => getTextFromTbl($item['real_desc']),
                    'icon_id' => $item['icon_id'] ?? 0
                ];
            } else {
                $itemCache[$itemId] = [
                    'name' => "Item #$itemId",
                    'icon_id' => 0
                ];
            }
        } catch(PDOException $e) {
            $itemCache[$itemId] = [
                'name' => "Item #$itemId",
                'icon_id' => 0
            ];
        }
    }
    
    return $itemCache[$itemId];
}

$outputName = !empty($recipe['output_name']) ? getTextFromTbl($recipe['output_name']) : $recipe['desc_kr'];
$iconId = $recipe['icon_id'] ?? 0;
?>

<main class="container weapon-detail-container detail-container">
    <!-- First Row: Image and Basic Info -->
    <div class="weapon-detail-row">
        <!-- Image Card -->
        <div class="weapon-image-card detail-card full-image-card">
            <div class="weapon-image-large">
                <img src="<?= getItemImage($iconId, $outputName) ?>" 
                     alt="<?= htmlspecialchars($outputName) ?>">
            </div>
            
            <div class="image-card-info">
                <div class="info-item">
                    <span class="info-label">Recipe ID:</span>
                    <span class="info-value"><?= $recipe['craft_id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Success Rate:</span>
                    <span class="info-value"><?= round($recipe['outputs_success_prob_by_million'] / 10000, 2) ?>%</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Craft Time:</span>
                    <span class="info-value"><?= $recipe['batch_delay_sec'] ?> seconds</span>
                </div>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars($outputName) ?></h2>
            
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Min Level:</span>
                    <span class="info-value"><?= $recipe['min_level'] ?: 'None' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Max Level:</span>
                    <span class="info-value"><?= $recipe['max_level'] ?: 'None' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Required Gender:</span>
                    <span class="info-value">
                        <?= $recipe['required_gender'] == 0 ? 'Any' : ($recipe['required_gender'] == 1 ? 'Male' : 'Female') ?>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Alignment:</span>
                    <span class="info-value">
                        <?= $recipe['min_align'] . ' to ' . $recipe['max_align'] ?>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Karma:</span>
                    <span class="info-value">
                        <?= $recipe['min_karma'] . ' to ' . $recipe['max_karma'] ?>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Max Success Count:</span>
                    <span class="info-value"><?= $recipe['max_successcount'] ?: 'Unlimited' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Current Success:</span>
                    <span class="info-value"><?= $recipe['cur_successcount'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Count Type:</span>
                    <span class="info-value"><?= $recipe['SuccessCountType'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">PC Cafe Only:</span>
                    <span class="info-value"><?= $recipe['PCCafeOnly'] == 'true' ? 'Yes' : 'No' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: Required Materials -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📦</span>
                Required Materials
            </h3>
            
            <?php if (!empty($inputs)): ?>
                <div class="materials-list">
                    <?php foreach ($inputs as $input): 
                        $itemInfo = getItemName($input['id'], $pdo);
                        $itemIconId = $itemInfo['icon_id'] ?? 0;
                        $itemName = $itemInfo['name'] ?? "Item #" . $input['id'];
                    ?>
                        <div class="material-item">
                            <div class="material-image">
                                <img src="<?= getItemImage($itemIconId, $itemName) ?>" 
                                     alt="<?= htmlspecialchars($itemName) ?>">
                            </div>
                            <div class="material-info">
                                <span class="material-name"><?= htmlspecialchars($itemName) ?></span>
                                <span class="material-count">x<?= $input['count'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-data-message">No required materials specified.</div>
            <?php endif; ?>
            
            <?php if (!empty($options)): ?>
                <h4 class="detail-card-title" style="margin-top: 1.5rem;">
                    <span class="title-icon">🔧</span>
                    Optional Materials
                </h4>
                <div class="materials-list">
                    <?php foreach ($options as $option): 
                        $itemInfo = getItemName($option['id'], $pdo);
                        $itemIconId = $itemInfo['icon_id'] ?? 0;
                        $itemName = $itemInfo['name'] ?? "Item #" . $option['id'];
                    ?>
                        <div class="material-item">
                            <div class="material-image">
                                <img src="<?= getItemImage($itemIconId, $itemName) ?>" 
                                     alt="<?= htmlspecialchars($itemName) ?>">
                            </div>
                            <div class="material-info">
                                <span class="material-name"><?= htmlspecialchars($itemName) ?></span>
                                <span class="material-count">x<?= $option['count'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Third Row: Crafting Results -->
    <div class="weapon-detail-row">
        <!-- Success Results -->
        <div class="detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">✅</span>
                Success Results (<?= round($recipe['outputs_success_prob_by_million'] / 10000, 2) ?>%)
            </h3>
            
            <?php if (!empty($successOutputs)): ?>
                <div class="materials-list">
                    <?php foreach ($successOutputs as $output): 
                        $itemInfo = getItemName($output['id'], $pdo);
                        $itemIconId = $itemInfo['icon_id'] ?? 0;
                        $itemName = $itemInfo['name'] ?? "Item #" . $output['id'];
                    ?>
                        <div class="material-item accent">
                            <div class="material-image">
                                <img src="<?= getItemImage($itemIconId, $itemName) ?>" 
                                     alt="<?= htmlspecialchars($itemName) ?>">
                            </div>
                            <div class="material-info">
                                <span class="material-name"><?= htmlspecialchars($itemName) ?></span>
                                <span class="material-count">x<?= $output['count'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-data-message">No success outputs specified.</div>
            <?php endif; ?>
        </div>
        
        <!-- Failure Results -->
        <div class="detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">❌</span>
                Failure Results (<?= round((1000000 - $recipe['outputs_success_prob_by_million']) / 10000, 2) ?>%)
            </h3>
            
            <?php if (!empty($failureOutputs)): ?>
                <div class="materials-list">
                    <?php foreach ($failureOutputs as $output): 
                        $itemInfo = getItemName($output['id'], $pdo);
                        $itemIconId = $itemInfo['icon_id'] ?? 0;
                        $itemName = $itemInfo['name'] ?? "Item #" . $output['id'];
                    ?>
                        <div class="material-item">
                            <div class="material-image">
                                <img src="<?= getItemImage($itemIconId, $itemName) ?>" 
                                     alt="<?= htmlspecialchars($itemName) ?>">
                            </div>
                            <div class="material-info">
                                <span class="material-name"><?= htmlspecialchars($itemName) ?></span>
                                <span class="material-count">x<?= $output['count'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-data-message">No failure outputs specified.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Fourth Row: Additional Requirements -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📋</span>
                Additional Requirements
            </h3>
            
            <div class="properties-grid">
                <?php if (!empty($recipe['required_classes'])): ?>
                    <div class="property-item">
                        <span class="property-label">Required Classes:</span>
                        <span class="property-value"><?= $recipe['required_classes'] ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($recipe['required_quests'])): ?>
                    <div class="property-item">
                        <span class="property-label">Required Quests:</span>
                        <span class="property-value"><?= htmlspecialchars($recipe['required_quests']) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($recipe['required_sprites'])): ?>
                    <div class="property-item">
                        <span class="property-label">Required Sprites:</span>
                        <span class="property-value"><?= htmlspecialchars($recipe['required_sprites']) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($recipe['required_items'])): ?>
                    <div class="property-item">
                        <span class="property-label">Required Items:</span>
                        <span class="property-value"><?= htmlspecialchars($recipe['required_items']) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($periods)): ?>
                    <div class="property-item">
                        <span class="property-label">Available Periods:</span>
                        <span class="property-value"><?= implode(', ', $periods) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($recipe['except_npc'] == 'true'): ?>
                    <div class="property-item">
                        <span class="property-label">NPC Exception:</span>
                        <span class="property-value">Yes</span>
                    </div>
                <?php endif; ?>
                
                <?php if ($recipe['is_show'] == 'true'): ?>
                    <div class="property-item">
                        <span class="property-label">Visible:</span>
                        <span class="property-value">Yes</span>
                    </div>
                <?php endif; ?>
                
                <?php if ($recipe['bmProbOpen'] == 'true'): ?>
                    <div class="property-item">
                        <span class="property-label">BM Prob Open:</span>
                        <span class="property-value">Yes</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="crafting_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Crafting Recipes
        </a>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>