<?php
// categories/weapon/weapon_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get weapon ID from URL
$weaponId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$weaponId) {
    echo "<div class='error-message'>No weapon specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch weapon details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM weapon WHERE item_id = :id");
    $stmt->bindValue(':id', $weaponId, PDO::PARAM_INT);
    $stmt->execute();
    $weapon = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$weapon) {
        echo "<div class='error-message'>Weapon not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to weapon name (with prefix removed and HTML entities decoded)
    $page_hero_title = getDisplayName($weapon['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($weapon['desc_en']);
    
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
        <!-- Image Card - Now takes full height -->
        <div class="weapon-image-card detail-card full-image-card">
        <div class="weapon-image-large">
            <img src="../../assets/img/icons/<?= $weapon['iconId'] ?>.png" 
                 alt="<?= htmlspecialchars(getDisplayName($weapon['desc_en'])) ?>" 
                 onerror="this.src='../../assets/img/placeholders/weapon.png'">
        </div>
        
        <!-- Add these three columns at the bottom of the image card -->
        <div class="image-card-info">
            <div class="info-item">
                <span class="info-label">Item ID:</span>
                <span class="info-value"><?= $weapon['item_id'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Icon ID:</span>
                <span class="info-value"><?= $weapon['iconId'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Desc ID:</span>
                <span class="info-value"><?= $weapon['desc_id'] ?></span>
            </div>
        </div>
    </div>
        
        <!-- Basic Info Card - Remove the fields we're moving to the new row -->
    <div class="weapon-basic-info detail-card">
        <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($weapon['desc_en'])) ?></h2>
        <div class="basic-info-grid">
            <div class="info-item">
                <span class="info-label">Grade:</span>
                <span class="info-value grade-<?= strtolower($weapon['itemGrade']) ?>"><?= normalizeGrade($weapon['itemGrade']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Type:</span>
                <span class="info-value"><?= normalizeType($weapon['type']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Material:</span>
                <span class="info-value"><?= getDisplayMaterial($weapon['material']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Weight:</span>
                <span class="info-value"><?= $weapon['weight'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Small Damage:</span>
                <span class="info-value damage-value"><?= $weapon['dmg_small'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Large Damage:</span>
                <span class="info-value damage-value"><?= $weapon['dmg_large'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Safe Enchant:</span>
                <span class="info-value enchant-value">+<?= $weapon['safenchant'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Min Level:</span>
                <span class="info-value"><?= $weapon['min_lvl'] ?: 'None' ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Max Level:</span>
                <span class="info-value"><?= $weapon['max_lvl'] ?: 'None' ?></span>
            </div>
            <!-- Removed: bless, trade, cant_delete from here -->
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
                <span class="property-label">Haste:</span>
                <span class="property-value <?= $weapon['haste_item'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['haste_item'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Can Be Damaged:</span>
                <span class="property-value <?= $weapon['canbedmg'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['canbedmg'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Bless:</span>
                <span class="property-value <?= $weapon['bless'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['bless'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Tradeable:</span>
                <span class="property-value <?= $weapon['trade'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['trade'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Retrievable:</span>
                <span class="property-value <?= $weapon['retrieve'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['retrieve'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Special Retrievable:</span>
                <span class="property-value <?= $weapon['specialretrieve'] ? 'property-yes' : 'property-no' ?>">
                    <?= $weapon['specialretrieve'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Can Be Deleted:</span>
                <span class="property-value <?= !$weapon['cant_delete'] ? 'property-yes' : 'property-no' ?>">
                    <?= !$weapon['cant_delete'] ? '✓' : '✗' ?>
                </span>
            </div>
            <div class="property-item">
                <span class="property-label">Can Be Sold:</span>
                <span class="property-value <?= !$weapon['cant_sell'] ? 'property-yes' : 'property-no' ?>">
                    <?= !$weapon['cant_sell'] ? '✓' : '✗' ?>
                </span>
            </div>
        </div>
    </div>
</div>
    
    <!-- Second Row: Class Usage and Combat Stats -->
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
                    if ($weapon[$dbField]): ?>
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
        
        <!-- Combat Stats -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">⚔️</span>
                Combat Stats
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">Hit Modifier:</span>
                    <span class="stat-value <?= $weapon['hitmodifier'] > 0 ? 'positive-value' : ($weapon['hitmodifier'] < 0 ? 'negative-value' : '') ?>">
                        <?= $weapon['hitmodifier'] > 0 ? '+' : '' ?><?= $weapon['hitmodifier'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Damage Modifier:</span>
                    <span class="stat-value <?= $weapon['dmgmodifier'] > 0 ? 'positive-value' : ($weapon['dmgmodifier'] < 0 ? 'negative-value' : '') ?>">
                        <?= $weapon['dmgmodifier'] > 0 ? '+' : '' ?><?= $weapon['dmgmodifier'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Double Damage Chance:</span>
                    <span class="stat-value"><?= $weapon['double_dmg_chance'] ?>%</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Damage Modifier:</span>
                    <span class="stat-value <?= $weapon['magicdmgmodifier'] > 0 ? 'positive-value' : ($weapon['magicdmgmodifier'] < 0 ? 'negative-value' : '') ?>">
                        <?= $weapon['magicdmgmodifier'] > 0 ? '+' : '' ?><?= $weapon['magicdmgmodifier'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Haste:</span>
                    <span class="stat-value <?= $weapon['haste_item'] ? 'positive-value' : '' ?>">
                        <?= $weapon['haste_item'] ? 'Yes' : 'No' ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Short Critical:</span>
                    <span class="stat-value <?= $weapon['shortCritical'] > 0 ? 'positive-value' : '' ?>">
                        +<?= $weapon['shortCritical'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Long Critical:</span>
                    <span class="stat-value <?= $weapon['longCritical'] > 0 ? 'positive-value' : '' ?>">
                        +<?= $weapon['longCritical'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Critical:</span>
                    <span class="stat-value <?= $weapon['magicCritical'] > 0 ? 'positive-value' : '' ?>">
                        +<?= $weapon['magicCritical'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Speed Delay Rate:</span>
                    <span class="stat-value <?= $weapon['attackSpeedDelayRate'] > 0 ? 'positive-value' : ($weapon['attackSpeedDelayRate'] < 0 ? 'negative-value' : '') ?>">
                        <?= $weapon['attackSpeedDelayRate'] > 0 ? '+' : '' ?><?= $weapon['attackSpeedDelayRate'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Move Speed Delay Rate:</span>
                    <span class="stat-value <?= $weapon['moveSpeedDelayRate'] > 0 ? 'positive-value' : ($weapon['moveSpeedDelayRate'] < 0 ? 'negative-value' : '') ?>">
                        <?= $weapon['moveSpeedDelayRate'] > 0 ? '+' : '' ?><?= $weapon['moveSpeedDelayRate'] ?>
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Can Be Damaged:</span>
                    <span class="stat-value"><?= $weapon['canbedmg'] ? 'Yes' : 'No' ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Regist Skill:</span>
                    <span class="stat-value"><?= $weapon['regist_skill'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Third Row: Stat Bonuses and Special Properties -->
    <div class="weapon-detail-row">
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
                    'Magic Defense' => 'm_def'
                ];
                
                foreach ($stats as $statName => $dbField): 
                    if ($weapon[$dbField] != 0): ?>
                        <div class="bonus-item">
                            <span class="bonus-label"><?= $statName ?>:</span>
                            <span class="bonus-value <?= $weapon[$dbField] > 0 ? 'positive-value' : 'negative-value' ?>">
                                <?= $weapon[$dbField] > 0 ? '+' : '' ?><?= $weapon[$dbField] ?>
                            </span>
                        </div>
                    <?php endif;
                endforeach; 
                
                // If no stat bonuses
                $hasStats = false;
                foreach ($stats as $dbField) {
                    if ($weapon[$dbField] != 0) {
                        $hasStats = true;
                        break;
                    }
                }
                
                if (!$hasStats): ?>
                    <div class="no-data-message">No stat bonuses</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Special Properties -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">✨</span>
                Special Properties
            </h3>
            <div class="properties-list">
                <?php
                $properties = [];
                
                // Damage Reduction
                if ($weapon['damage_reduction'] > 0) {
                    $properties[] = "Damage Reduction: +" . $weapon['damage_reduction'];
                }
                
                // Magic Damage Reduction
                if ($weapon['MagicDamageReduction'] > 0) {
                    $properties[] = "Magic Damage Reduction: +" . $weapon['MagicDamageReduction'];
                }
                
                // PVP Damage
                if ($weapon['PVPDamage'] > 0) {
                    $properties[] = "PVP Damage: +" . $weapon['PVPDamage'];
                }
                
                // PVP Damage Reduction
                if ($weapon['PVPDamageReduction'] > 0) {
                    $properties[] = "PVP Damage Reduction: +" . $weapon['PVPDamageReduction'];
                }
                
                // PVP Damage Reduction Percent
                if ($weapon['PVPDamageReductionPercent'] > 0) {
                    $properties[] = "PVP Damage Reduction: " . $weapon['PVPDamageReductionPercent'] . "%";
                }
                
                // PVP Magic Damage Reduction
                if ($weapon['PVPMagicDamageReduction'] > 0) {
                    $properties[] = "PVP Magic Damage Reduction: +" . $weapon['PVPMagicDamageReduction'];
                }
                
                // Experience Bonus
                if ($weapon['expBonus'] > 0) {
                    $properties[] = "Experience Bonus: +" . $weapon['expBonus'] . "%";
                }
                
                // Poison Resistance
                if ($weapon['poisonRegist'] === 'true') {
                    $properties[] = "Poison Resistance";
                }
                
                // Reduction Percent
                if ($weapon['reductionPercent'] > 0) {
                    $properties[] = "Damage Reduction: " . $weapon['reductionPercent'] . "%";
                }
                
                // Reduction Ignore
                if ($weapon['reductionEgnor'] > 0) {
                    $properties[] = "Ignore Reduction: +" . $weapon['reductionEgnor'];
                }
                
                // PVP Reduction Ignore
                if ($weapon['PVPReductionEgnor'] > 0) {
                    $properties[] = "PVP Ignore Reduction: +" . $weapon['PVPReductionEgnor'];
                }
                
                // PVP Magic Damage Reduction Ignore
                if ($weapon['PVPMagicDamageReductionEgnor'] > 0) {
                    $properties[] = "PVP Magic Ignore Reduction: +" . $weapon['PVPMagicDamageReductionEgnor'];
                }
                
                // Abnormal Status Damage Reduction
                if ($weapon['abnormalStatusDamageReduction'] > 0) {
                    $properties[] = "Abnormal Status Reduction: +" . $weapon['abnormalStatusDamageReduction'];
                }
                
                // Abnormal Status PVP Damage Reduction
                if ($weapon['abnormalStatusPVPDamageReduction'] > 0) {
                    $properties[] = "PVP Abnormal Status Reduction: +" . $weapon['abnormalStatusPVPDamageReduction'];
                }
                
                // PVP Damage Percent
                if ($weapon['PVPDamagePercent'] > 0) {
                    $properties[] = "PVP Damage: +" . $weapon['PVPDamagePercent'] . "%";
                }
                
                // Rest EXP Reduce Efficiency
                if ($weapon['rest_exp_reduce_efficiency'] > 0) {
                    $properties[] = "Rest EXP Efficiency: +" . $weapon['rest_exp_reduce_efficiency'] . "%";
                }
                
                // Add DG/ER/ME
                if ($weapon['addDg'] > 0) {
                    $properties[] = "Add DG: +" . $weapon['addDg'];
                }
                if ($weapon['addEr'] > 0) {
                    $properties[] = "Add ER: +" . $weapon['addEr'];
                }
                if ($weapon['addMe'] > 0) {
                    $properties[] = "Add ME: +" . $weapon['addMe'];
                }
                
                // Immun Ignore
                if ($weapon['imunEgnor'] > 0) {
                    $properties[] = "Immunity Ignore: +" . $weapon['imunEgnor'];
                }
                
                // Potion Effects
                if ($weapon['potionRegist'] > 0) {
                    $properties[] = "Potion Regist: +" . $weapon['potionRegist'];
                }
                if ($weapon['potionPercent'] > 0) {
                    $properties[] = "Potion Effect: +" . $weapon['potionPercent'] . "%";
                }
                if ($weapon['potionValue'] > 0) {
                    $properties[] = "Potion Value: +" . $weapon['potionValue'];
                }
                
                // HP/MP Regen
                if ($weapon['hprAbsol32Second'] > 0) {
                    $properties[] = "HP Regen/32s: +" . $weapon['hprAbsol32Second'];
                }
                if ($weapon['mprAbsol64Second'] > 0) {
                    $properties[] = "MP Regen/64s: +" . $weapon['mprAbsol64Second'];
                }
                if ($weapon['mprAbsol16Second'] > 0) {
                    $properties[] = "MP Regen/16s: +" . $weapon['mprAbsol16Second'];
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
    
    <!-- Fourth Row: Additional Stats -->
    <div class="weapon-detail-row">
        <!-- Additional Combat Stats -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🛡️</span>
                Defense & Resistance
            </h3>
            <div class="stats-grid">
                <?php
                $defenseStats = [
                    'Regist Spirit' => 'regist_spirit',
                    'Regist Dragon' => 'regist_dragon',
                    'Regist Fear' => 'regist_fear',
                    'Regist All' => 'regist_all',
                    'Hitup Skill' => 'hitup_skill',
                    'Hitup Spirit' => 'hitup_spirit',
                    'Hitup Dragon' => 'hitup_dragon',
                    'Hitup Fear' => 'hitup_fear',
                    'Hitup All' => 'hitup_all',
                    'Hitup Magic' => 'hitup_magic',
                    'Stun Duration' => 'stunDuration',
                    'Triple Arrow Stun' => 'tripleArrowStun'
                ];
                
                foreach ($defenseStats as $statName => $dbField): 
                    if ($weapon[$dbField] != 0): ?>
                        <div class="stat-item">
                            <span class="stat-label"><?= $statName ?>:</span>
                            <span class="stat-value <?= $weapon[$dbField] > 0 ? 'positive-value' : ($weapon[$dbField] < 0 ? 'negative-value' : '') ?>">
                                <?= $weapon[$dbField] > 0 ? '+' : '' ?><?= $weapon[$dbField] ?>
                            </span>
                        </div>
                    <?php endif;
                endforeach;
                
                // Check if any defense stats exist
                $hasDefenseStats = false;
                foreach ($defenseStats as $dbField) {
                    if ($weapon[$dbField] != 0) {
                        $hasDefenseStats = true;
                        break;
                    }
                }
                
                if (!$hasDefenseStats): ?>
                    <div class="no-data-message">No defense properties</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Additional Properties -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">⏱️</span>
                Time & Potion Effects
            </h3>
            <div class="properties-list">
                <?php
                $timeProperties = [];
                
                // Strange Time Effects
                if ($weapon['strangeTimeIncrease'] > 0) {
                    $timeProperties[] = "Strange Time Increase: +" . $weapon['strangeTimeIncrease'];
                }
                if ($weapon['strangeTimeDecrease'] > 0) {
                    $timeProperties[] = "Strange Time Decrease: +" . $weapon['strangeTimeDecrease'];
                }
                
                // Potion Delay Effects
                if ($weapon['hpPotionDelayDecrease'] > 0) {
                    $timeProperties[] = "HP Potion Delay Decrease: +" . $weapon['hpPotionDelayDecrease'];
                }
                if ($weapon['hpPotionCriticalProb'] > 0) {
                    $timeProperties[] = "HP Potion Critical: +" . $weapon['hpPotionCriticalProb'] . "%";
                }
                
                // Armor Skill Probability
                if ($weapon['increaseArmorSkillProb'] > 0) {
                    $timeProperties[] = "Armor Skill Probability: +" . $weapon['increaseArmorSkillProb'] . "%";
                }
                
                // Display properties or message if none
                if (!empty($timeProperties)) {
                    foreach ($timeProperties as $property) {
                        echo "<div class='property-item'>" . htmlspecialchars($property) . "</div>";
                    }
                } else {
                    echo "<div class='no-data-message'>No time-related properties</div>";
                }
                
                // Magic Name if exists
                if (!empty($weapon['Magic_name'])) {
                    echo "<div class='property-item highlight'>Magic: " . htmlspecialchars($weapon['Magic_name']) . "</div>";
                }
                ?>
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
            // Get monsters that drop this weapon
            try {
                $dropsStmt = $pdo->prepare("SELECT d.*, n.desc_en as monster_name, n.lvl, n.spriteId
                    FROM droplist d
                    JOIN npc n ON d.mobId = n.npcid
                    WHERE d.itemId = :itemId AND n.impl = 'L1Monster'
                    ORDER BY d.chance DESC");
                $dropsStmt->bindValue(':itemId', $weapon['item_id'], PDO::PARAM_INT);
                $dropsStmt->execute();
                $monsters = $dropsStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($monsters)): ?>
                    <div class="full-image-monster-grid">
                        <?php foreach ($monsters as $monster): 
                            // Calculate drop chance percentage
                            $dropChance = $monster['chance'] / 1000000 * 100;
                            ?>
                            <div class="full-image-monster-card">
                                <a href="../../categories/monsters/monster_detail.php?id=<?= $monster['mobId'] ?>" class="full-image-monster-link">
                                    <div class="monster-background-image">
                                        <img src="../../assets/img/icons/ms<?= $monster['spriteId'] ?>.png" 
                                            alt="<?= htmlspecialchars(getDisplayName($monster['monster_name'])) ?>" 
                                            onerror="this.onerror=null; this.src='../../assets/img/icons/ms<?= $monster['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/monsters.png';}">
                                    </div>
                                    <div class="monster-overlay">
                                        <h3 class="monster-name"><?= htmlspecialchars(getDisplayName($monster['monster_name'])) ?></h3>
                                        <span class="monster-level">Drop: <?= number_format($dropChance, 6) ?>%</span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">No monsters drop this weapon.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving monster drops: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Additional Notes -->
    <?php if (!empty($weapon['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($weapon['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="weapon_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Weapons List
        </a>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>