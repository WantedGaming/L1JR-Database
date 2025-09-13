<?php
// categories/armor/armor_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get armor ID from URL
$armorId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$armorId) {
    echo "<div class='error-message'>No armor specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch armor details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM armor WHERE item_id = :id");
    $stmt->bindValue(':id', $armorId, PDO::PARAM_INT);
    $stmt->execute();
    $armor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$armor) {
        echo "<div class='error-message'>Armor not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to armor name
    $page_hero_title = getDisplayName($armor['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($armor['desc_en']);
    
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    include '../../includes/footer.php';
    exit;
}

include '../../includes/hero.php';
?>

<main class="container weapon-detail-container detail-container">
    <!-- First Row: Image and Basic Info -->
    <div class="weapon-detail-row">
        <!-- Image Card -->
        <div class="weapon-image-card detail-card full-image-card">
            <div class="weapon-image-large">
                <img src="../../assets/img/icons/<?= $armor['iconId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($armor['desc_en'])) ?>" 
                     onerror="this.src='../../assets/img/placeholders/armor.png'">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info" style="margin-top: auto; display: flex; width: 100%;">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Item ID:</span>
                    <span class="info-value"><?= $armor['item_id'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Icon ID:</span>
                    <span class="info-value"><?= $armor['iconId'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($armor['desc_en'])) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Grade:</span>
                    <span class="info-value grade-<?= strtolower($armor['itemGrade']) ?>"><?= normalizeGrade($armor['itemGrade']) ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= normalizeArmorType($armor['type']) ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Material:</span>
                    <span class="info-value"><?= normalizeMaterial($armor['material']) ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Weight:</span>
                    <span class="info-value"><?= $armor['weight'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">AC:</span>
                    <span class="info-value damage-value"><?= $armor['ac'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Safe Enchant:</span>
                    <span class="info-value enchant-value">+<?= $armor['safenchant'] ?></span>
                </div>
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
                    <span class="property-value <?= $armor['bless'] ? 'property-yes' : 'property-no' ?>">
                        <?= $armor['bless'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Tradeable:</span>
                    <span class="property-value <?= $armor['trade'] ? 'property-yes' : 'property-no' ?>">
                        <?= $armor['trade'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Be Deleted:</span>
                    <span class="property-value <?= !$armor['cant_delete'] ? 'property-yes' : 'property-no' ?>">
                        <?= !$armor['cant_delete'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Be Sold:</span>
                    <span class="property-value <?= !$armor['cant_sell'] ? 'property-yes' : 'property-no' ?>">
                        <?= !$armor['cant_sell'] ? '✓' : '✗' ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Class Usage and Defense Stats -->
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
                    'Illusionist' => 'use_illusionist'
                ];
                
                foreach ($classes as $className => $dbField): 
                    if ($armor[$dbField]): ?>
                        <div class="class-item can-use">
                            <span class="class-icon">✓</span>
                            <span class="class-name"><?= $className ?></span>
                        </div>
                    <?php else: ?>
                        <div class="class-item cannot-use">
                            <span class="class-icon">✗</span>
                            <span class="class-name"><?= $className ?></span>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        </div>
        
        <!-- Defense Stats -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🛡️</span>
                Defense Stats
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">AC:</span>
                    <span class="stat-value"><?= $armor['ac'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">AC Sub:</span>
                    <span class="stat-value"><?= $armor['ac_sub'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Defense:</span>
                    <span class="stat-value"><?= $armor['m_def'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Fire Defense:</span>
                    <span class="stat-value"><?= $armor['defense_fire'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Water Defense:</span>
                    <span class="stat-value"><?= $armor['defense_water'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Wind Defense:</span>
                    <span class="stat-value"><?= $armor['defense_wind'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Earth Defense:</span>
                    <span class="stat-value"><?= $armor['defense_earth'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stat Bonuses -->
    <div class="weapon-detail-row">
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
                    'MP Regen' => 'add_mpr'
                ];
                
                foreach ($stats as $statName => $dbField): 
                    if ($armor[$dbField] != 0): ?>
                        <div class="bonus-item">
                            <span class="bonus-label"><?= $statName ?>:</span>
                            <span class="bonus-value <?= $armor[$dbField] > 0 ? 'positive-value' : 'negative-value' ?>">
                                <?= $armor[$dbField] > 0 ? '+' : '' ?><?= $armor[$dbField] ?>
                            </span>
                        </div>
                    <?php endif;
                endforeach; 
                
                // If no stat bonuses
                $hasStats = false;
                foreach ($stats as $dbField) {
                    if ($armor[$dbField] != 0) {
                        $hasStats = true;
                        break;
                    }
                }
                
                if (!$hasStats): ?>
                    <div class="no-data-message">No stat bonuses</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Requirements -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">📋</span>
                Requirements
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">Min Level:</span>
                    <span class="stat-value"><?= $armor['min_lvl'] ?: 'None' ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Max Level:</span>
                    <span class="stat-value"><?= $armor['max_lvl'] ?: 'None' ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Dropped By Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🧟</span>
                Dropped By
            </h3>
            <?php
            // Get monsters that drop this armor
            try {
                $dropsStmt = $pdo->prepare("SELECT d.*, n.desc_en as monster_name, n.lvl, n.spriteId
                    FROM droplist d
                    JOIN npc n ON d.mobId = n.npcid
                    WHERE d.itemId = :itemId AND n.impl = 'L1Monster'
                    ORDER BY d.chance DESC");
                $dropsStmt->bindValue(':itemId', $armor['item_id'], PDO::PARAM_INT);
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
                    <div class="no-data-message">No monsters drop this armor.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving monster drops: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Notes Section -->
    <?php if (!empty($armor['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($armor['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="armor_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Armor List
        </a>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>