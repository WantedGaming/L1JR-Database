<?php
// categories/dolls/doll_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get doll ID from URL
$dollId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$dollId) {
    echo "<div class='error-message'>No magic doll specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch doll details from database
try {
    $stmt = $pdo->prepare("SELECT n.*, e.iconId, m.itemId as etcItemId, m.grade, m.bonusItemId, m.bonusCount, m.bonusInterval, m.damageChance, m.attackSkillEffectId, m.haste
                          FROM npc n
                          LEFT JOIN magicdoll_info m ON n.npcid = m.dollNpcId
                          LEFT JOIN etcitem e ON m.itemId = e.item_id
                          WHERE n.npcid = :id AND n.impl = 'L1Doll'");
    $stmt->bindValue(':id', $dollId, PDO::PARAM_INT);
    $stmt->execute();
    $doll = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get potential upgrades for this doll
    $potentialUpgrades = [];
    if (!empty($doll['etcItemId'])) {
        // First, get the potential bonuses from the magicdoll_potential table
        $potentialStmt = $pdo->prepare("
            SELECT * FROM magicdoll_potential 
            WHERE isUse = 'true' 
            ORDER BY bonusId ASC
        ");
        $potentialStmt->execute();
        $potentialUpgrades = $potentialStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    if (!$doll) {
        echo "<div class='error-message'>Magic doll not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to doll name
    $page_hero_title = getDisplayName($doll['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($doll['desc_en']);
    
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
                <img src="../../assets/img/icons/<?= $doll['iconId'] ? $doll['iconId'] : $doll['spriteId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($doll['desc_en'])) ?>" 
                     onerror="this.src='../../assets/img/placeholders/dolls.png'">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info">
                <div class="info-item">
                    <span class="info-label">Doll ID:</span>
                    <span class="info-value"><?= $doll['npcid'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Icon ID:</span>
                    <span class="info-value"><?= $doll['iconId'] ?: 'N/A' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Sprite ID:</span>
                    <span class="info-value"><?= $doll['spriteId'] ?></span>
                </div>
                <?php if ($doll['bowSpritetId'] > 0): ?>
                <div class="info-item">
                    <span class="info-label">Bow Sprite ID:</span>
                    <span class="info-value"><?= $doll['bowSpritetId'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($doll['desc_en'])) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Level:</span>
                    <span class="info-value"><?= $doll['lvl'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">HP:</span>
                    <span class="info-value"><?= $doll['hp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">MP:</span>
                    <span class="info-value"><?= $doll['mp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">AC:</span>
                    <span class="info-value"><?= $doll['ac'] ?></span>
                </div>
                <?php if ($doll['alignment'] != 0): ?>
                <div class="info-item">
                    <span class="info-label">Alignment:</span>
                    <span class="info-value"><?= $doll['alignment'] ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($doll['family'])): ?>
                <div class="info-item">
                    <span class="info-label">Family:</span>
                    <span class="info-value"><?= htmlspecialchars($doll['family']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Doll Stats Row -->
    <div class="weapon-detail-row">
        <!-- Stats Card -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">📊</span>
                Stats
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">STR:</span>
                    <span class="stat-value"><?= $doll['str'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">CON:</span>
                    <span class="stat-value"><?= $doll['con'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">DEX:</span>
                    <span class="stat-value"><?= $doll['dex'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">WIS:</span>
                    <span class="stat-value"><?= $doll['wis'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">INT:</span>
                    <span class="stat-value"><?= $doll['intel'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MR:</span>
                    <span class="stat-value"><?= $doll['mr'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Movement Stats -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🏃</span>
                Movement & Speed
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">Passive Speed:</span>
                    <span class="stat-value"><?= $doll['passispeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Speed:</span>
                    <span class="stat-value"><?= $doll['atkspeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Attack Speed:</span>
                    <span class="stat-value"><?= $doll['atk_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Sub Magic Speed:</span>
                    <span class="stat-value"><?= $doll['sub_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Range:</span>
                    <span class="stat-value"><?= $doll['ranged'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Doll Properties Row -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⚙️</span>
                Doll Properties
            </h3>
            <div class="properties-grid">
                <?php if ($doll['light_size'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Light Size:</span>
                    <span class="property-value"><?= $doll['light_size'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($doll['is_teleport'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Can Teleport:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($doll['isHide'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Hidden:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($doll['is_change_head'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Can Change Head:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($doll['weakAttr'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Weak Against:</span>
                    <span class="property-value"><?= normalizeWeakAttribute($doll['weakAttr']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($doll['undead'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Type:</span>
                    <span class="property-value"><?= normalizeUndeadType($doll['undead']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Regeneration Stats -->
    <?php if ($doll['hpr'] > 0 || $doll['mpr'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">♻️</span>
                Regeneration
            </h3>
            <div class="stats-grid">
                <?php if ($doll['hpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">HP Regen:</span>
                    <span class="stat-value"><?= $doll['hpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">HP Regen Interval:</span>
                    <span class="stat-value"><?= $doll['hprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
                <?php if ($doll['mpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">MP Regen:</span>
                    <span class="stat-value"><?= $doll['mpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MP Regen Interval:</span>
                    <span class="stat-value"><?= $doll['mprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Magic Doll Info Section -->
    <?php if (!empty($doll['etcItemId'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">✨</span>
                Magic Doll Information
            </h3>
            <div class="stats-grid">
                <?php if ($doll['grade'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Grade:</span>
                    <span class="stat-value"><?= $doll['grade'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['haste'] === 'true'): ?>
                <div class="stat-item">
                    <span class="stat-label">Haste:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['bonusItemId'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Bonus Item ID:</span>
                    <span class="stat-value"><?= $doll['bonusItemId'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['bonusCount'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Bonus Count:</span>
                    <span class="stat-value"><?= $doll['bonusCount'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['bonusInterval'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Bonus Interval:</span>
                    <span class="stat-value"><?= $doll['bonusInterval'] ?> seconds</span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['damageChance'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Damage Chance:</span>
                    <span class="stat-value"><?= $doll['damageChance'] ?>%</span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['attackSkillEffectId'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Attack Skill Effect ID:</span>
                    <span class="stat-value"><?= $doll['attackSkillEffectId'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($doll['etcItemId'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Item ID:</span>
                    <span class="stat-value"><?= $doll['etcItemId'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Potential Upgrades Section -->
    <?php if (!empty($potentialUpgrades)): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🔮</span>
                Potential Upgrades
            </h3>
            
            <?php
            // Organize potentials by category
            $categories = [
                'combat' => ['Combat Enhancements', []],
                'stats' => ['Stat Boosts', []],
                'defense' => ['Defensive Abilities', []],
                'special' => ['Special Abilities', []],
                'other' => ['Other Enhancements', []]
            ];
            
            // Sort potentials into categories
            foreach ($potentialUpgrades as $potential) {
                // Skip empty potentials
                $hasStats = false;
                
                // Check if this potential has any stats
                foreach ($potential as $key => $value) {
                    if ($key != 'bonusId' && $key != 'name' && $key != 'desc_kr' && $key != 'isUse' && 
                        $value != 0 && $value != '0' && $value != 'false' && $value != -1) {
                        $hasStats = true;
                        break;
                    }
                }
                
                if (!$hasStats) continue;
                
                // Determine category based on stats
                $category = 'other';
                
                if ($potential['shortDamage'] > 0 || $potential['shortHit'] > 0 || 
                    $potential['longDamage'] > 0 || $potential['longHit'] > 0 || 
                    $potential['shortCritical'] > 0 || $potential['longCritical'] > 0 ||
                    $potential['spellpower'] > 0 || $potential['magicHit'] > 0 ||
                    $potential['magicCritical'] > 0 || $potential['PVPDamage'] > 0) {
                    $category = 'combat';
                } else if ($potential['str'] > 0 || $potential['con'] > 0 || 
                          $potential['dex'] > 0 || $potential['int'] > 0 || 
                          $potential['wis'] > 0 || $potential['cha'] > 0 || 
                          $potential['allStatus'] > 0) {
                    $category = 'stats';
                } else if ($potential['ac_bonus'] != 0 || $potential['mr'] > 0 || 
                          $potential['reduction'] > 0 || $potential['PVPReduction'] > 0 || 
                          $potential['dg'] > 0 || $potential['er'] > 0 ||
                          $potential['toleranceAll'] > 0) {
                    $category = 'defense';
                } else if ($potential['firstSpeed'] === 'true' || $potential['secondSpeed'] === 'true' || 
                          $potential['thirdSpeed'] === 'true' || $potential['forthSpeed'] === 'true' ||
                          $potential['skilId'] > 0) {
                    $category = 'special';
                }
                
                $categories[$category][1][] = $potential;
            }
            
            // Display potentials by category
            foreach ($categories as $categoryKey => $categoryData):
                list($categoryName, $potentials) = $categoryData;
                
                // Skip empty categories
                if (empty($potentials)) continue;
            ?>
            <div class="doll-potential-category">
                <h4 class="category-title"><?= $categoryName ?></h4>
                <div class="monster-drops-grid">
                    <?php foreach ($potentials as $potential): ?>
                    <div class="monster-drop-card">
                        <div class="monster-card-content">
                            <div class="monster-image">
                                <?php 
                                // Choose an appropriate icon based on category
                                $icon = '⚔️';
                                if ($categoryKey === 'stats') $icon = '📊';
                                if ($categoryKey === 'defense') $icon = '🛡️';
                                if ($categoryKey === 'special') $icon = '✨';
                                if ($categoryKey === 'other') $icon = '🔮';
                                ?>
                                <div class="potential-icon"><?= $icon ?></div>
                            </div>
                            <div class="monster-info">
                                <h3 class="monster-name"><?= htmlspecialchars($potential['name']) ?></h3>
                                <div class="monster-stats">
                        <?php 
                        // Display relevant stats for this potential
                        if ($potential['ac_bonus'] != 0): 
                            $acClass = $potential['ac_bonus'] < 0 ? 'positive' : 'negative'; // For AC, negative is good
                        ?>
                            <div class="monster-stat <?= $acClass ?>">
                                <span class="stat-icon">🛡️</span>
                                <span class="stat-text">AC: <?= $potential['ac_bonus'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['str'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">💪</span>
                                <span class="stat-text">STR: +<?= $potential['str'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['con'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">❤️</span>
                                <span class="stat-text">CON: +<?= $potential['con'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['dex'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🏃</span>
                                <span class="stat-text">DEX: +<?= $potential['dex'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['int'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🧠</span>
                                <span class="stat-text">INT: +<?= $potential['int'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['wis'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">📚</span>
                                <span class="stat-text">WIS: +<?= $potential['wis'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['cha'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">👑</span>
                                <span class="stat-text">CHA: +<?= $potential['cha'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['allStatus'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">⭐</span>
                                <span class="stat-text">All Stats: +<?= $potential['allStatus'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['shortDamage'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">⚔️</span>
                                <span class="stat-text">DMG: +<?= $potential['shortDamage'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['shortHit'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🎯</span>
                                <span class="stat-text">Hit: +<?= $potential['shortHit'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['shortCritical'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">💥</span>
                                <span class="stat-text">Crit: +<?= $potential['shortCritical'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['longDamage'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🏹</span>
                                <span class="stat-text">R-DMG: +<?= $potential['longDamage'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['longHit'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🎯</span>
                                <span class="stat-text">R-Hit: +<?= $potential['longHit'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['longCritical'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">💥</span>
                                <span class="stat-text">R-Crit: +<?= $potential['longCritical'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['spellpower'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">✨</span>
                                <span class="stat-text">SP: +<?= $potential['spellpower'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['magicHit'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🔮</span>
                                <span class="stat-text">M-Hit: +<?= $potential['magicHit'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['magicCritical'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">💫</span>
                                <span class="stat-text">M-Crit: +<?= $potential['magicCritical'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['hp'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">❤️</span>
                                <span class="stat-text">HP: +<?= $potential['hp'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['mp'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🔵</span>
                                <span class="stat-text">MP: +<?= $potential['mp'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['hpr'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">♻️</span>
                                <span class="stat-text">HP Regen: +<?= $potential['hpr'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['mpr'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">♻️</span>
                                <span class="stat-text">MP Regen: +<?= $potential['mpr'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['mr'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🔰</span>
                                <span class="stat-text">MR: +<?= $potential['mr'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['expBonus'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🌟</span>
                                <span class="stat-text">EXP: +<?= $potential['expBonus'] ?>%</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['carryBonus'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">💰</span>
                                <span class="stat-text">Weight: +<?= $potential['carryBonus'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['dg'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🙅</span>
                                <span class="stat-text">DG: +<?= $potential['dg'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['er'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🏃</span>
                                <span class="stat-text">ER: +<?= $potential['er'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['reduction'] > 0): ?>
                            <div class="monster-stat positive">
                                <span class="stat-icon">🛡️</span>
                                <span class="stat-text">DMG Red: +<?= $potential['reduction'] ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['firstSpeed'] === 'true'): ?>
                            <div class="monster-stat special">
                                <span class="stat-icon">💨</span>
                                <span class="stat-text">1st Speed</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['secondSpeed'] === 'true'): ?>
                            <div class="monster-stat special">
                                <span class="stat-icon">💨</span>
                                <span class="stat-text">2nd Speed</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['thirdSpeed'] === 'true'): ?>
                            <div class="monster-stat special">
                                <span class="stat-icon">💨</span>
                                <span class="stat-text">3rd Speed</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($potential['forthSpeed'] === 'true'): ?>
                            <div class="monster-stat special">
                                <span class="stat-icon">💨</span>
                                <span class="stat-text">4th Speed</span>
                            </div>
                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    
    <!-- Notes Section -->
    <?php if (!empty($doll['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($doll['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="doll_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Magic Dolls List
        </a>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>
