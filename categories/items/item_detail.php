<?php
// categories/items/item_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get item ID from URL
$itemId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$itemId) {
    echo "<div class='error-message'>No item specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch item details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM etcitem WHERE item_id = :id");
    $stmt->bindValue(':id', $itemId, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$item) {
        echo "<div class='error-message'>Item not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to item name
    $page_hero_title = getDisplayName($item['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($item['desc_en']);
    
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    include '../../includes/footer.php';
    exit;
}

include '../../includes/hero.php';
?>

<main class="container weapon-detail-container">
    <!-- First Row: Image and Basic Info -->
    <div class="weapon-detail-row">
        <!-- Image Card -->
        <div class="weapon-image-card detail-card full-image-card" style="display: flex; flex-direction: column;">
            <div class="weapon-image-large" style="flex: 1; display: flex; align-items: center; justify-content: center;">
                <img src="../../assets/img/icons/<?= $item['iconId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($item['desc_en'])) ?>" 
                     onerror="this.src='../../assets/img/placeholders/items.png'">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info" style="margin-top: auto; display: flex; width: 100%;">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Item ID:</span>
                    <span class="info-value"><?= $item['item_id'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Icon ID:</span>
                    <span class="info-value"><?= $item['iconId'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Sprite ID:</span>
                    <span class="info-value"><?= $item['spriteId'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($item['desc_en'])) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Grade:</span>
                    <span class="info-value grade-<?= strtolower($item['itemGrade']) ?>"><?= normalizeGrade($item['itemGrade']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= normalizeItemType($item['item_type']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Use Type:</span>
                    <span class="info-value"><?= normalizeItemUseType($item['use_type']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Material:</span>
                    <span class="info-value"><?= getDisplayMaterial($item['material']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Weight:</span>
                    <span class="info-value"><?= $item['weight'] ?></span>
                </div>
                <?php if ($item['max_charge_count'] > 0): ?>
                <div class="info-item">
                    <span class="info-label">Max Charges:</span>
                    <span class="info-value"><?= $item['max_charge_count'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['food_volume'] > 0): ?>
                <div class="info-item">
                    <span class="info-label">Food Volume:</span>
                    <span class="info-value"><?= $item['food_volume'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['level'] > 0): ?>
                <div class="info-item">
                    <span class="info-label">Level:</span>
                    <span class="info-value"><?= $item['level'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- New Row: Additional Properties -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⚙️</span>
                Additional Properties
            </h3>
            <div class="properties-grid">
                <div class="property-item">
                    <span class="property-label">Bless:</span>
                    <span class="property-value <?= $item['bless'] ? 'property-yes' : 'property-no' ?>">
                        <?= $item['bless'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Tradeable:</span>
                    <span class="property-value <?= $item['trade'] ? 'property-yes' : 'property-no' ?>">
                        <?= $item['trade'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Retrievable:</span>
                    <span class="property-value <?= $item['retrieve'] ? 'property-yes' : 'property-no' ?>">
                        <?= $item['retrieve'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Special Retrievable:</span>
                    <span class="property-value <?= $item['specialretrieve'] ? 'property-yes' : 'property-no' ?>">
                        <?= $item['specialretrieve'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Be Deleted:</span>
                    <span class="property-value <?= !$item['cant_delete'] ? 'property-yes' : 'property-no' ?>">
                        <?= !$item['cant_delete'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Be Sold:</span>
                    <span class="property-value <?= !$item['cant_sell'] ? 'property-yes' : 'property-no' ?>">
                        <?= !$item['cant_sell'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Mergeable:</span>
                    <span class="property-value <?= $item['merge'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $item['merge'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <?php if ($item['attr'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Attribute:</span>
                    <span class="property-value"><?= $item['attr'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['alignment'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Alignment:</span>
                    <span class="property-value"><?= $item['alignment'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Class Usage and Stats -->
    <div class="weapon-detail-row">
        <!-- Class Usage -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">👥</span>
                Class Usage
            </h3>
            <div class="class-usage-grid">
                <?php
                $classes = [
                    'Royal' => 'use_royal',
                    'Knight' => 'use_knight', 
                    'Mage' => 'use_mage',
                    'Elf' => 'use_elf',
                    'Dark Elf' => 'use_darkelf',
                    'Dragon Knight' => 'use_dragonknight',
                    'Illusionist' => 'use_illusionist',
                    'Warrior' => 'use_warrior',
                    'Fencer' => 'use_fencer',
                    'Lancer' => 'use_lancer'
                ];
                
                foreach ($classes as $className => $dbField): 
                    if (isset($item[$dbField])): ?>
                        <div class="class-item <?= $item[$dbField] ? 'can-use' : 'cannot-use' ?>">
                            <span class="class-icon"><?= $item[$dbField] ? '✓' : '✗' ?></span>
                            <span class="class-name"><?= $className ?></span>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        </div>
        
        <!-- Stat Bonuses -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">📊</span>
                Stat Bonuses
            </h3>
            <div class="bonus-grid">
                <?php
                $stats = [
                    'STR' => 'add_str',
                    'CON' => 'add_con',
                    'DEX' => 'add_dex', 
                    'INT' => 'add_int',
                    'WIS' => 'add_wis',
                    'CHA' => 'add_cha',
                    'HP' => 'add_hp',
                    'MP' => 'add_mp',
                    'HP Regen' => 'add_hpr',
                    'MP Regen' => 'add_mpr',
                    'SP' => 'add_sp',
                    'Magic Defense' => 'm_def',
                    'Carry Bonus' => 'carryBonus'
                ];
                
                foreach ($stats as $statName => $dbField): 
                    if ($item[$dbField] != 0): ?>
                        <div class="bonus-item">
                            <span class="bonus-label"><?= $statName ?>:</span>
                            <span class="bonus-value <?= $item[$dbField] > 0 ? 'positive-value' : 'negative-value' ?>">
                                <?= $item[$dbField] > 0 ? '+' : '' ?><?= $item[$dbField] ?>
                            </span>
                        </div>
                    <?php endif;
                endforeach; 
                
                // If no stat bonuses
                $hasStats = false;
                foreach ($stats as $dbField) {
                    if ($item[$dbField] != 0) {
                        $hasStats = true;
                        break;
                    }
                }
                
                if (!$hasStats): ?>
                    <div class="no-data-message">No stat bonuses</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Defense Stats and Resistances -->
    <?php
    $hasDefense = $item['defense_water'] != 0 || $item['defense_wind'] != 0 || 
                 $item['defense_fire'] != 0 || $item['defense_earth'] != 0 || 
                 $item['attr_all'] != 0;
                 
    $hasResistance = $item['regist_stone'] != 0 || $item['regist_sleep'] != 0 || 
                    $item['regist_freeze'] != 0 || $item['regist_blind'] != 0 || 
                    $item['regist_skill'] != 0 || $item['regist_spirit'] != 0 || 
                    $item['regist_dragon'] != 0 || $item['regist_fear'] != 0 || 
                    $item['regist_all'] != 0;
    
    if ($hasDefense || $hasResistance):
    ?>
    <div class="weapon-detail-row">
        <?php if ($hasDefense): ?>
        <!-- Defense Stats -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🛡️</span>
                Defense Stats
            </h3>
            <div class="stats-grid">
                <?php if ($item['defense_water'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Water Defense:</span>
                    <span class="stat-value"><?= $item['defense_water'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['defense_wind'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Wind Defense:</span>
                    <span class="stat-value"><?= $item['defense_wind'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['defense_fire'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Fire Defense:</span>
                    <span class="stat-value"><?= $item['defense_fire'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['defense_earth'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Earth Defense:</span>
                    <span class="stat-value"><?= $item['defense_earth'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['attr_all'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">All Attributes:</span>
                    <span class="stat-value"><?= $item['attr_all'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($hasResistance): ?>
        <!-- Resistances -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🔰</span>
                Resistances
            </h3>
            <div class="stats-grid">
                <?php
                $resistances = [
                    'Stone' => 'regist_stone',
                    'Sleep' => 'regist_sleep',
                    'Freeze' => 'regist_freeze',
                    'Blind' => 'regist_blind',
                    'Skill' => 'regist_skill',
                    'Spirit' => 'regist_spirit',
                    'Dragon' => 'regist_dragon',
                    'Fear' => 'regist_fear',
                    'All' => 'regist_all'
                ];
                
                foreach ($resistances as $resistName => $dbField): 
                    if ($item[$dbField] != 0): ?>
                        <div class="stat-item">
                            <span class="stat-label"><?= $resistName ?>:</span>
                            <span class="stat-value"><?= $item[$dbField] ?></span>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- Special Properties -->
    <?php
    $hasSpecialProps = $item['damage_reduction'] != 0 || $item['MagicDamageReduction'] != 0 || 
                      $item['reductionEgnor'] != 0 || $item['reductionPercent'] != 0 || 
                      $item['PVPDamage'] != 0 || $item['PVPDamageReduction'] != 0 || 
                      $item['PVPDamageReductionPercent'] != 0 || $item['PVPMagicDamageReduction'] != 0 || 
                      $item['expBonus'] != 0 || $item['rest_exp_reduce_efficiency'] != 0 || 
                      $item['poisonRegist'] === 'true';
    
    if ($hasSpecialProps):
    ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">✨</span>
                Special Properties
            </h3>
            <div class="properties-list">
                <?php
                $properties = [];
                
                // Damage Reduction
                if ($item['damage_reduction'] > 0) {
                    $properties[] = "Damage Reduction: +" . $item['damage_reduction'];
                }
                
                // Magic Damage Reduction
                if ($item['MagicDamageReduction'] > 0) {
                    $properties[] = "Magic Damage Reduction: +" . $item['MagicDamageReduction'];
                }
                
                // PVP Damage
                if ($item['PVPDamage'] > 0) {
                    $properties[] = "PVP Damage: +" . $item['PVPDamage'];
                }
                
                // PVP Damage Reduction
                if ($item['PVPDamageReduction'] > 0) {
                    $properties[] = "PVP Damage Reduction: +" . $item['PVPDamageReduction'];
                }
                
                // PVP Damage Reduction Percent
                if ($item['PVPDamageReductionPercent'] > 0) {
                    $properties[] = "PVP Damage Reduction: " . $item['PVPDamageReductionPercent'] . "%";
                }
                
                // PVP Magic Damage Reduction
                if ($item['PVPMagicDamageReduction'] > 0) {
                    $properties[] = "PVP Magic Damage Reduction: +" . $item['PVPMagicDamageReduction'];
                }
                
                // Experience Bonus
                if ($item['expBonus'] > 0) {
                    $properties[] = "Experience Bonus: +" . $item['expBonus'] . "%";
                }
                
                // Poison Resistance
                if ($item['poisonRegist'] === 'true') {
                    $properties[] = "Poison Resistance";
                }
                
                // Reduction Percent
                if ($item['reductionPercent'] > 0) {
                    $properties[] = "Damage Reduction: " . $item['reductionPercent'] . "%";
                }
                
                // Reduction Ignore
                if ($item['reductionEgnor'] > 0) {
                    $properties[] = "Ignore Reduction: +" . $item['reductionEgnor'];
                }
                
                // Rest EXP Reduce Efficiency
                if ($item['rest_exp_reduce_efficiency'] > 0) {
                    $properties[] = "Rest EXP Efficiency: +" . $item['rest_exp_reduce_efficiency'] . "%";
                }
                
                // Display properties or message if none
                if (!empty($properties)) {
                    foreach ($properties as $property) {
                        echo "<div class='property-item'>" . htmlspecialchars($property) . "</div>";
                    }
                } else {
                    echo "<div class='no-data-message'>No special properties</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Teleport Location (if applicable) -->
    <?php if ($item['locx'] > 0 && $item['locy'] > 0 && $item['mapid'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🗺️</span>
                Teleport Location
            </h3>
            <div class="properties-grid">
                <div class="property-item">
                    <span class="property-label">Map ID:</span>
                    <span class="property-value"><?= $item['mapid'] ?></span>
                </div>
                <div class="property-item">
                    <span class="property-label">X Coordinate:</span>
                    <span class="property-value"><?= $item['locx'] ?></span>
                </div>
                <div class="property-item">
                    <span class="property-label">Y Coordinate:</span>
                    <span class="property-value"><?= $item['locy'] ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Delay Info (if applicable) -->
    <?php if ($item['delay_id'] > 0 || $item['delay_time'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⏱️</span>
                Delay Information
            </h3>
            <div class="properties-grid">
                <?php if ($item['delay_id'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Delay ID:</span>
                    <span class="property-value"><?= $item['delay_id'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['delay_time'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Delay Time:</span>
                    <span class="property-value"><?= $item['delay_time'] ?> ms</span>
                </div>
                <?php endif; ?>
                <?php if ($item['delay_effect'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Delay Effect:</span>
                    <span class="property-value"><?= $item['delay_effect'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['buffDurationSecond'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Buff Duration:</span>
                    <span class="property-value"><?= $item['buffDurationSecond'] ?> seconds</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Magic Information (if applicable) -->
    <?php if (!empty($item['Magic_name']) || $item['skill_type'] !== 'none'): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">✨</span>
                Magic Information
            </h3>
            <div class="properties-grid">
                <?php if (!empty($item['Magic_name'])): ?>
                <div class="property-item">
                    <span class="property-label">Magic Name:</span>
                    <span class="property-value"><?= htmlspecialchars($item['Magic_name']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['skill_type'] !== 'none'): ?>
                <div class="property-item">
                    <span class="property-label">Skill Type:</span>
                    <span class="property-value"><?= ucfirst($item['skill_type']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($item['prob'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Probability:</span>
                    <span class="property-value"><?= $item['prob'] ?>%</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Dropped By Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🧟</span>
                Dropped By
            </h3>
            <?php
            // Get monsters that drop this item
            try {
                $dropsStmt = $pdo->prepare("SELECT d.*, n.desc_en as monster_name, n.lvl, n.spriteId
                    FROM droplist d
                    JOIN npc n ON d.mobId = n.npcid
                    WHERE d.itemId = :itemId AND n.impl = 'L1Monster'
                    ORDER BY d.chance DESC");
                $dropsStmt->bindValue(':itemId', $item['item_id'], PDO::PARAM_INT);
                $dropsStmt->execute();
                $monsters = $dropsStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($monsters)): ?>
                    <div class="monster-drops-grid">
                        <?php foreach ($monsters as $monster): 
                            // Calculate drop chance percentage
                            $dropChance = $monster['chance'] / 1000000 * 100;
                            ?>
                            <div class="monster-drop-card">
                                <a href="../../categories/monsters/monster_detail.php?id=<?= $monster['mobId'] ?>" class="monster-drop-link">
                                    <div class="monster-card-content">
                                        <div class="monster-image">
                                            <img src="../../assets/img/icons/<?= $monster['spriteId'] ?>.png" 
                                                alt="<?= htmlspecialchars(getDisplayName($monster['monster_name'])) ?>" 
                                                onerror="this.src='../../assets/img/placeholders/monsters.png'">
                                        </div>
                                        <div class="monster-info">
                                            <h3 class="monster-name"><?= htmlspecialchars(getDisplayName($monster['monster_name'])) ?></h3>
                                            <div class="monster-stats">
                                                <div class="monster-stat">
                                                    <span class="stat-icon">⚔️</span>
                                                    <span class="stat-text">Lvl <?= $monster['lvl'] ?></span>
                                                </div>
                                                <div class="monster-stat">
                                                    <span class="stat-icon">🎲</span>
                                                    <span class="stat-text"><?= $monster['min'] ?>-<?= $monster['max'] ?></span>
                                                </div>
                                                <?php if ($monster['Enchant'] > 0): ?>
                                                <div class="monster-stat">
                                                    <span class="stat-icon">✨</span>
                                                    <span class="stat-text">+<?= $monster['Enchant'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <div class="monster-stat drop-rate">
                                                    <span class="stat-icon">📊</span>
                                                    <span class="stat-text"><?= number_format($dropChance, 6) ?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">No monsters drop this item.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving monster drops: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Notes Section -->
    <?php if (!empty($item['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($item['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="item_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Items List
        </a>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>
