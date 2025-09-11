<?php
// categories/monsters/monster_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get monster ID from URL
$monsterId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$monsterId) {
    echo "<div class='error-message'>No monster specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch monster details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM npc WHERE npcid = :id AND impl = 'L1Monster'");
    $stmt->bindValue(':id', $monsterId, PDO::PARAM_INT);
    $stmt->execute();
    $monster = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$monster) {
        echo "<div class='error-message'>Monster not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to monster name
    $page_hero_title = getDisplayName($monster['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($monster['desc_en']);
    
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    include '../../includes/footer.php';
    exit;
}

include '../../includes/hero.php';
?>

<style>
    /* Spawn Locations Grid Layout */
    .spawn-locations-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Two cards per row by default */
        gap: 1.5rem;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
    }
    
    /* When there's only one location, make it take full width */
    .spawn-locations-grid.single-location {
        grid-template-columns: 1fr; /* One card taking full width */
    }
    
    /* For single location cards, make them taller */
    .spawn-locations-grid.single-location .spawn-location-card {
        height: 250px; /* Taller card for single location */
    }
    
    /* Spawn Location Card */
    .spawn-location-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        height: 180px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .spawn-location-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 110, 62, 0.3);
    }
    
    .spawn-card-link {
        display: block;
        height: 100%;
        width: 100%;
        text-decoration: none;
        color: #fff;
    }
    
    .spawn-card-image {
        position: relative;
        height: 100%;
        width: 100%;
    }
    
    .spawn-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .spawn-location-card:hover .spawn-card-image img {
        transform: scale(1.1);
    }
    
    /* Overlay for text */
    .spawn-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1rem;
        background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 70%, rgba(0,0,0,0) 100%);
        z-index: 2;
    }
    
    .spawn-location-name {
        font-size: 1.2rem;
        margin: 0 0 0.5rem 0;
        color: #fff;
        font-weight: 600;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
    }
    
    .spawn-location-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .spawn-coordinates {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.9);
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    }
    
    .coordinate-icon {
        margin-right: 0.3rem;
    }
    
    .spawn-type {
        background-color: rgba(255, 110, 62, 0.3);
        color: #fff;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.8rem;
        border: 1px solid rgba(255, 110, 62, 0.5);
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .spawn-locations-grid {
            grid-template-columns: 1fr; /* One card per row on smaller screens */
        }
    }
</style>

<main class="container weapon-detail-container">
    <!-- First Row: Image and Basic Info -->
    <div class="weapon-detail-row">
        <!-- Image Card -->
        <div class="weapon-image-card detail-card full-image-card" style="display: flex; flex-direction: column;">
            <div class="weapon-image-large" style="flex: 1; display: flex; align-items: center; justify-content: center;">
                <img src="../../assets/img/icons/<?= $monster['spriteId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?>" 
                     onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $monster['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/monsters.png';}">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info" style="margin-top: auto; display: flex; width: 100%;">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Monster ID:</span>
                    <span class="info-value"><?= $monster['npcid'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Sprite ID:</span>
                    <span class="info-value"><?= $monster['spriteId'] ?></span>
                </div>
                <?php if ($monster['bowSpritetId'] > 0): ?>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Bow Sprite ID:</span>
                    <span class="info-value"><?= $monster['bowSpritetId'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Level:</span>
                    <span class="info-value"><?= $monster['lvl'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">HP:</span>
                    <span class="info-value"><?= $monster['hp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">MP:</span>
                    <span class="info-value"><?= $monster['mp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">AC:</span>
                    <span class="info-value"><?= $monster['ac'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">EXP:</span>
                    <span class="info-value"><?= $monster['exp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Alignment:</span>
                    <span class="info-value"><?= $monster['alignment'] ?></span>
                </div>
                <?php if ($monster['undead'] !== 'NONE'): ?>
                <div class="info-item">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= normalizeUndeadType($monster['undead']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['weakAttr'] !== 'NONE'): ?>
                <div class="info-item">
                    <span class="info-label">Weak Against:</span>
                    <span class="info-value"><?= normalizeWeakAttribute($monster['weakAttr']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Monster Stats Row -->
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
                    <span class="stat-value"><?= $monster['str'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">CON:</span>
                    <span class="stat-value"><?= $monster['con'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">DEX:</span>
                    <span class="stat-value"><?= $monster['dex'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">WIS:</span>
                    <span class="stat-value"><?= $monster['wis'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">INT:</span>
                    <span class="stat-value"><?= $monster['intel'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MR:</span>
                    <span class="stat-value"><?= $monster['mr'] ?></span>
                </div>
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
                    <span class="stat-label">Passive Speed:</span>
                    <span class="stat-value"><?= $monster['passispeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Speed:</span>
                    <span class="stat-value"><?= $monster['atkspeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Attack Speed:</span>
                    <span class="stat-value"><?= $monster['atk_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Sub Magic Speed:</span>
                    <span class="stat-value"><?= $monster['sub_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Range:</span>
                    <span class="stat-value"><?= $monster['ranged'] ?></span>
                </div>
                <?php if ($monster['damage_reduction'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Damage Reduction:</span>
                    <span class="stat-value"><?= $monster['damage_reduction'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Monster Properties Row -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⚙️</span>
                Monster Properties
            </h3>
            <div class="properties-grid">
                <div class="property-item">
                    <span class="property-label">Aggressive:</span>
                    <span class="property-value <?= $monster['is_agro'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_agro'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Aggressive to Polymorphs:</span>
                    <span class="property-value <?= $monster['is_agro_poly'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_agro_poly'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Aggressive to Invisible:</span>
                    <span class="property-value <?= $monster['is_agro_invis'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_agro_invis'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Teleport:</span>
                    <span class="property-value <?= $monster['is_teleport'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_teleport'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Pick Up Items:</span>
                    <span class="property-value <?= $monster['is_picupitem'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_picupitem'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Brave Speed:</span>
                    <span class="property-value <?= $monster['is_bravespeed'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_bravespeed'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Tameable:</span>
                    <span class="property-value <?= $monster['is_taming'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_taming'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Boss Monster:</span>
                    <span class="property-value <?= $monster['is_bossmonster'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_bossmonster'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Hard Monster:</span>
                    <span class="property-value <?= $monster['is_hard'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['is_hard'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can Turn Undead:</span>
                    <span class="property-value <?= $monster['can_turnundead'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['can_turnundead'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Hidden:</span>
                    <span class="property-value <?= $monster['isHide'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['isHide'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Can't Resurrect:</span>
                    <span class="property-value <?= $monster['cant_resurrect'] === 'true' ? 'property-yes' : 'property-no' ?>">
                        <?= $monster['cant_resurrect'] === 'true' ? '✓' : '✗' ?>
                    </span>
                </div>
                <?php if ($monster['big'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Big Monster:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($monster['poison_atk'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Poison Attack:</span>
                    <span class="property-value"><?= normalizePoisonAttack($monster['poison_atk']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Regeneration Stats -->
    <?php if ($monster['hpr'] > 0 || $monster['mpr'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">♻️</span>
                Regeneration
            </h3>
            <div class="stats-grid">
                <?php if ($monster['hpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">HP Regen:</span>
                    <span class="stat-value"><?= $monster['hpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">HP Regen Interval:</span>
                    <span class="stat-value"><?= $monster['hprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
                <?php if ($monster['mpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">MP Regen:</span>
                    <span class="stat-value"><?= $monster['mpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MP Regen Interval:</span>
                    <span class="stat-value"><?= $monster['mprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Random Stats -->
    <?php 
    $hasRandomStats = $monster['randomlevel'] > 0 || $monster['randomhp'] > 0 || $monster['randommp'] > 0 || 
                     $monster['randomac'] != 0 || $monster['randomexp'] > 0 || $monster['randomAlign'] != 0;
    
    if ($hasRandomStats):
    ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🎲</span>
                Random Stats
            </h3>
            <div class="stats-grid">
                <?php if ($monster['randomlevel'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random Level:</span>
                    <span class="stat-value">±<?= $monster['randomlevel'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['randomhp'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random HP:</span>
                    <span class="stat-value">±<?= $monster['randomhp'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['randommp'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random MP:</span>
                    <span class="stat-value">±<?= $monster['randommp'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['randomac'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random AC:</span>
                    <span class="stat-value">±<?= $monster['randomac'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['randomexp'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random EXP:</span>
                    <span class="stat-value">±<?= $monster['randomexp'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['randomAlign'] != 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Random Alignment:</span>
                    <span class="stat-value">±<?= $monster['randomAlign'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Family Info -->
    <?php if (!empty($monster['family']) || $monster['agrofamily'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">👪</span>
                Family Information
            </h3>
            <div class="stats-grid">
                <?php if (!empty($monster['family'])): ?>
                <div class="stat-item">
                    <span class="stat-label">Family:</span>
                    <span class="stat-value"><?= htmlspecialchars($monster['family']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['agrofamily'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Aggro Family:</span>
                    <span class="stat-value"><?= $monster['agrofamily'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['agrogfxid1'] >= 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Aggro GFX ID 1:</span>
                    <span class="stat-value"><?= $monster['agrogfxid1'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['agrogfxid2'] >= 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Aggro GFX ID 2:</span>
                    <span class="stat-value"><?= $monster['agrogfxid2'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Transformation Info -->
    <?php if ($monster['transform_id'] > 0 || $monster['transform_gfxid'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🔄</span>
                Transformation
            </h3>
            <div class="stats-grid">
                <?php if ($monster['transform_id'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Transform ID:</span>
                    <span class="stat-value"><?= $monster['transform_id'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($monster['transform_gfxid'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Transform GFX ID:</span>
                    <span class="stat-value"><?= $monster['transform_gfxid'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Drops Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">💰</span>
                Item Drops
            </h3>
            <?php
            // Get drops for this monster
            try {
                $dropsStmt = $pdo->prepare("SELECT d.*, 
                    CASE 
                        WHEN e.item_id IS NOT NULL THEN e.desc_en
                        WHEN a.item_id IS NOT NULL THEN a.desc_en
                        WHEN w.item_id IS NOT NULL THEN w.desc_en
                        ELSE d.itemname_en
                    END as item_desc
                    FROM droplist d
                    LEFT JOIN etcitem e ON d.itemId = e.item_id
                    LEFT JOIN armor a ON d.itemId = a.item_id
                    LEFT JOIN weapon w ON d.itemId = w.item_id
                    WHERE d.mobId = :mobId
                    ORDER BY d.chance DESC");
                $dropsStmt->bindValue(':mobId', $monster['npcid'], PDO::PARAM_INT);
                $dropsStmt->execute();
                $drops = $dropsStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($drops)): ?>
                    <div class="monster-drops-grid">
                        <?php foreach ($drops as $drop): 
                            // Determine item type and link
                            $itemLink = '#';
                            $itemType = '';
                            $iconId = 0;
                            
                            // Check which table the item belongs to
                            $checkStmt = $pdo->prepare("SELECT 
                                CASE 
                                    WHEN e.item_id IS NOT NULL THEN 'etcitem' 
                                    WHEN a.item_id IS NOT NULL THEN 'armor' 
                                    WHEN w.item_id IS NOT NULL THEN 'weapon'
                                END as type,
                                COALESCE(e.iconId, a.iconId, w.iconId) as iconId
                                FROM (SELECT :id as id) as i
                                LEFT JOIN etcitem e ON i.id = e.item_id
                                LEFT JOIN armor a ON i.id = a.item_id
                                LEFT JOIN weapon w ON i.id = w.item_id");
                            $checkStmt->bindValue(':id', $drop['itemId'], PDO::PARAM_INT);
                            $checkStmt->execute();
                            $itemResult = $checkStmt->fetch(PDO::FETCH_ASSOC);
                            
                            if ($itemResult && $itemResult['type']) {
                                $itemType = $itemResult['type'];
                                $iconId = $itemResult['iconId'];
                                
                                switch($itemType) {
                                    case 'etcitem':
                                        $itemLink = '../../categories/items/item_detail.php?id=' . $drop['itemId'];
                                        $placeholderImg = 'items.png';
                                        break;
                                    case 'armor':
                                        $itemLink = '../../categories/armor/armor_detail.php?id=' . $drop['itemId'];
                                        $placeholderImg = 'armor.png';
                                        break;
                                    case 'weapon':
                                        $itemLink = '../../categories/weapon/weapon_detail.php?id=' . $drop['itemId'];
                                        $placeholderImg = 'weapons.png';
                                        break;
                                }
                            } else {
                                $placeholderImg = 'items.png';
                            }
                            
                            // Calculate drop chance percentage
                            $dropChance = $drop['chance'] / 1000000 * 100;
                            ?>
                            <div class="monster-drop-card">
                                <a href="<?= $itemLink ?>" class="monster-drop-link">
                                    <div class="monster-card-content">
                                        <div class="monster-image">
                                            <img src="../../assets/img/icons/<?= $iconId ?>.png" 
                                                alt="<?= htmlspecialchars(getDisplayName($drop['item_desc'])) ?>" 
                                                onerror="this.src='../../assets/img/placeholders/<?= $placeholderImg ?>'">
                                        </div>
                                        <div class="monster-info">
                                            <h3 class="monster-name"><?= htmlspecialchars(getDisplayName($drop['item_desc'])) ?></h3>
                                            <div class="monster-stats">
                                                <div class="monster-stat">
                                                    <span class="stat-icon">🎲</span>
                                                    <span class="stat-text"><?= $drop['min'] ?>-<?= $drop['max'] ?></span>
                                                </div>
                                                <?php if ($drop['Enchant'] > 0): ?>
                                                <div class="monster-stat">
                                                    <span class="stat-icon">✨</span>
                                                    <span class="stat-text">+<?= $drop['Enchant'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <div class="monster-stat drop-rate">
                                                    <span class="stat-icon">📊</span>
                                                    <span class="stat-text"><?= number_format($dropChance, 3) ?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                <?php else: ?>
                    <div class="no-data-message">No drops recorded for this monster.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving drops: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Spawn Locations Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🗺️</span>
                Spawn Locations
            </h3>
            <?php
            // Get spawn locations for this monster from all spawn tables
            try {
                // Query all spawn tables that might contain this monster
                // First, get the spawn locations
                $spawnQuery = "
                    SELECT 
                        'Regular' as spawn_type, 
                        s.id, 
                        s.name, 
                        s.locx as locx, 
                        s.locy as locy, 
                        s.mapid as mapid
                    FROM `spawnlist` s
                    WHERE s.npc_templateid = :npcid
                ";
                
                $spawnStmt = $pdo->prepare($spawnQuery);
                $spawnStmt->bindValue(':npcid', $monster['npcid'], PDO::PARAM_INT);
                $spawnStmt->execute();
                $spawns = $spawnStmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Now get the map names and image IDs for each spawn location
                $mapIds = array_unique(array_column($spawns, 'mapid'));
                $mapInfo = [];
                
                if (!empty($mapIds)) {
                    $placeholders = implode(',', array_fill(0, count($mapIds), '?'));
                    $mapQuery = "SELECT mapid, locationname, pngId FROM `mapids` WHERE mapid IN ($placeholders)";
                    
                    $mapStmt = $pdo->prepare($mapQuery);
                    foreach ($mapIds as $i => $mapId) {
                        $mapStmt->bindValue($i+1, $mapId, PDO::PARAM_INT);
                    }
                    
                    $mapStmt->execute();
                    $mapResults = $mapStmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($mapResults as $map) {
                        $mapInfo[$map['mapid']] = [
                            'name' => $map['locationname'],
                            'pngId' => $map['pngId']
                        ];
                    }
                }
                
                // Add map names and image info to spawn data
                foreach ($spawns as &$spawn) {
                    $mapId = $spawn['mapid'];
                    $spawn['map_name'] = isset($mapInfo[$mapId]['name']) ? $mapInfo[$mapId]['name'] : 'Map ' . $mapId;
                    $spawn['map_image_id'] = isset($mapInfo[$mapId]['pngId']) ? $mapInfo[$mapId]['pngId'] : 0;
                }
                
                // Group spawns by map
                $spawnsByMap = [];
                foreach ($spawns as $spawn) {
                    $mapId = $spawn['mapid'];
                    $mapName = !empty($spawn['map_name']) ? $spawn['map_name'] : 'Map ' . $mapId;
                    
                    if (!isset($spawnsByMap[$mapId])) {
                        $spawnsByMap[$mapId] = [
                            'map_name' => $mapName,
                            'spawns' => []
                        ];
                    }
                    
                    $spawnsByMap[$mapId]['spawns'][] = $spawn;
                }
                
                if (!empty($spawnsByMap)): 
                    // Count total number of spawn locations
                    $totalSpawnLocations = 0;
                    foreach ($spawnsByMap as $mapData) {
                        $totalSpawnLocations += count($mapData['spawns']);
                    }
                    ?>
                    <div class="spawn-locations-grid <?= $totalSpawnLocations === 1 ? 'single-location' : '' ?>">
                        <?php foreach ($spawnsByMap as $mapId => $mapData): 
                            // Get the first spawn to get the map image ID
                            $firstSpawn = reset($mapData['spawns']);
                            $mapImageId = isset($firstSpawn['map_image_id']) ? $firstSpawn['map_image_id'] : 0;
                            
                            // Try to find the map image in different formats
                            $mapImagePath = "../../assets/img/icons/{$mapImageId}.png";
                            $mapImagePathJpg = "../../assets/img/icons/{$mapImageId}.jpg";
                            $mapImagePathJpeg = "../../assets/img/icons/{$mapImageId}.jpeg";
                            $placeholderImage = "../../assets/img/placeholders/maps.png";
                            
                            foreach ($mapData['spawns'] as $spawn): ?>
                                <div class="spawn-location-card">
                                    <a href="../../categories/maps/map_detail.php?id=<?= $mapId ?>" class="spawn-card-link">
                                        <div class="spawn-card-image">
                                            <img src="<?= $mapImageId > 0 ? $mapImagePath : $placeholderImage ?>" 
                                                 onerror="if (this.src !== '<?= $mapImagePathJpg ?>') this.src='<?= $mapImagePathJpg ?>'; else if (this.src !== '<?= $mapImagePathJpeg ?>') this.src='<?= $mapImagePathJpeg ?>'; else this.src='<?= $placeholderImage ?>';"
                                                 alt="<?= htmlspecialchars($mapData['map_name']) ?>">
                                            <div class="spawn-card-overlay">
                                                <h3 class="spawn-location-name"><?= htmlspecialchars($mapData['map_name']) ?></h3>
                                                <div class="spawn-location-details">
                                                    <div class="spawn-coordinates">
                                                        <span class="coordinate-icon">📍</span>
                                                        <span class="coordinate-text"><?= $spawn['locx'] ?>, <?= $spawn['locy'] ?></span>
                                                    </div>
                                                    <?php if (!empty($spawn['spawn_type']) && $spawn['spawn_type'] != 'Regular'): ?>
                                                        <div class="spawn-type"><?= $spawn['spawn_type'] ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">No spawn locations found for this monster.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving spawn locations: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Notes Section -->
    <?php if (!empty($monster['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($monster['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="monster_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Monsters List
        </a>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>
