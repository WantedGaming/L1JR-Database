<?php
// categories/maps/map_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get map ID from URL
$mapId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$mapId) {
    echo "<div class='error-message'>No map specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch map details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM mapids WHERE mapid = :id");
    $stmt->bindValue(':id', $mapId, PDO::PARAM_INT);
    $stmt->execute();
    $map = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$map) {
        echo "<div class='error-message'>Map not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to map name
    $page_hero_title = $map['locationname'];
    $page_hero_description = "Detailed information about " . $map['locationname'];
    
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
        <div class="weapon-image-card detail-card full-image-card">
            <div class="weapon-image-large">
                <img src="../../assets/img/icons/<?= $map['pngId'] ?>.png" 
                     alt="<?= htmlspecialchars($map['locationname']) ?>" 
                     onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $map['pngId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/maps.png';}">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info">
                <div class="info-item">
                    <span class="info-label">Map ID:</span>
                    <span class="info-value"><?= $map['mapid'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">PNG ID:</span>
                    <span class="info-value"><?= $map['pngId'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars($map['locationname']) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= $map['dungeon'] ? 'Dungeon' : 'Outdoor' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Coordinates:</span>
                    <span class="info-value">X: <?= $map['startX'] ?>-<?= $map['endX'] ?>, Y: <?= $map['startY'] ?>-<?= $map['endY'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Monster Amount:</span>
                    <span class="info-value"><?= $map['monster_amount'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Drop Rate:</span>
                    <span class="info-value"><?= $map['drop_rate'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Properties Row -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⚙️</span>
                Map Properties
            </h3>
            <div class="properties-grid">
                <div class="property-item">
                    <span class="property-label">Underwater:</span>
                    <span class="property-value <?= $map['underwater'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['underwater'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Markable:</span>
                    <span class="property-value <?= $map['markable'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['markable'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Teleportable:</span>
                    <span class="property-value <?= $map['teleportable'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['teleportable'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Escapable:</span>
                    <span class="property-value <?= $map['escapable'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['escapable'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Resurrection:</span>
                    <span class="property-value <?= $map['resurrection'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['resurrection'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Pain Wand:</span>
                    <span class="property-value <?= $map['painwand'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['painwand'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Penalty:</span>
                    <span class="property-value <?= $map['penalty'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['penalty'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Take Pets:</span>
                    <span class="property-value <?= $map['take_pets'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['take_pets'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Recall Pets:</span>
                    <span class="property-value <?= $map['recall_pets'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['recall_pets'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Usable Items:</span>
                    <span class="property-value <?= $map['usable_item'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['usable_item'] ? '✓' : '✗' ?>
                    </span>
                </div>
                <div class="property-item">
                    <span class="property-label">Usable Skills:</span>
                    <span class="property-value <?= $map['usable_skill'] ? 'property-yes' : 'property-no' ?>">
                        <?= $map['usable_skill'] ? '✓' : '✗' ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Combat Properties Row -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">⚔️</span>
                Combat Properties
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">PC → NPC Damage Modifier:</span>
                    <span class="stat-value"><?= $map['dmgModiPc2Npc'] ?>%</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">NPC → PC Damage Modifier:</span>
                    <span class="stat-value"><?= $map['dmgModiNpc2Pc'] ?>%</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Decrease HP:</span>
                    <span class="stat-value"><?= $map['decreaseHp'] ? 'Yes' : 'No' ?></span>
                </div>
            </div>
        </div>
        
        <!-- Special Zone Properties -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🏆</span>
                Special Zone Properties
            </h3>
            <div class="stats-grid">
                <?php if ($map['beginZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Beginner Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['redKnightZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Red Knight Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['ruunCastleZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Ruun Castle Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['interWarZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Inter War Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['geradBuffZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Gerad Buff Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['growBuffZone']): ?>
                <div class="stat-item">
                    <span class="stat-label">Grow Buff Zone:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['dominationTeleport']): ?>
                <div class="stat-item">
                    <span class="stat-label">Domination Teleport:</span>
                    <span class="stat-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($map['interKind'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">Inter Kind:</span>
                    <span class="stat-value"><?= $map['interKind'] ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($map['script'])): ?>
                <div class="stat-item">
                    <span class="stat-label">Script:</span>
                    <span class="stat-value"><?= htmlspecialchars($map['script']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Monsters Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">👹</span>
                Monsters in this Map
            </h3>
            <?php
            // Get monsters that spawn in this map
            try {
                $monstersStmt = $pdo->prepare("
                    SELECT n.*, s.count, s.locx, s.locy
                    FROM spawnlist s
                    JOIN npc n ON s.npc_templateid = n.npcid
                    WHERE s.mapid = :mapId AND n.impl = 'L1Monster'
                    ORDER BY n.lvl DESC
                    LIMIT 50
                ");
                $monstersStmt->bindValue(':mapId', $map['mapid'], PDO::PARAM_INT);
                $monstersStmt->execute();
                $monsters = $monstersStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($monsters)): ?>
                    <div class="monster-drops-grid">
                        <?php foreach ($monsters as $monster): ?>
                            <div class="monster-drop-card">
                                <a href="../../categories/monsters/monster_detail.php?id=<?= $monster['npcid'] ?>" class="monster-drop-link">
                                    <div class="monster-card-content">
                                        <div class="monster-image">
                                            <img src="../../assets/img/icons/<?= $monster['spriteId'] ?>.png" 
                                                alt="<?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?>" 
                                                onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $monster['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/monsters.png';}">
                                        </div>
                                        <div class="monster-info">
                                            <h3 class="monster-name"><?= htmlspecialchars(getDisplayName($monster['desc_en'])) ?></h3>
                                            <div class="monster-stats">
                                                <div class="monster-stat">
                                                    <span class="stat-text">Lvl <?= $monster['lvl'] ?></span>
                                                </div>
                                                <div class="monster-stat">
                                                    <span class="stat-text">HP: <?= $monster['hp'] ?></span>
                                                </div>
                                                <?php if (isset($monster['locx']) && isset($monster['locy'])): ?>
                                                <div class="monster-stat">
                                                    <span class="stat-icon">📍</span>
                                                    <span class="stat-text"><?= $monster['locx'] ?>, <?= $monster['locy'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (isset($monster['count']) && $monster['count'] > 0): ?>
                                                <div class="monster-stat drop-rate">
                                                    <span class="stat-text">Count: <?= $monster['count'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">No monsters found for this map.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving monsters: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- NPCs Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">👤</span>
                NPCs in this Map
            </h3>
            <?php
            // Get NPCs that spawn in this map
            try {
                $npcsStmt = $pdo->prepare("
                    SELECT n.*, s.locx, s.locy
                    FROM spawnlist_npc s
                    JOIN npc n ON s.npc_templateid = n.npcid
                    WHERE s.mapid = :mapId AND n.impl = 'L1Merchant'
                    ORDER BY n.desc_en ASC
                    LIMIT 50
                ");
                $npcsStmt->bindValue(':mapId', $map['mapid'], PDO::PARAM_INT);
                $npcsStmt->execute();
                $npcs = $npcsStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($npcs)): ?>
                    <div class="monster-drops-grid">
                        <?php foreach ($npcs as $npc): ?>
                            <div class="monster-drop-card">
                                <a href="../../categories/npcs/npc_detail.php?id=<?= $npc['npcid'] ?>" class="monster-drop-link">
                                    <div class="monster-card-content">
                                        <div class="monster-image">
                                            <img src="../../assets/img/icons/<?= $npc['spriteId'] ?>.png" 
                                                alt="<?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?>" 
                                                onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $npc['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/npcs.png';}">
                                        </div>
                                        <div class="monster-info">
                                            <h3 class="monster-name"><?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?></h3>
                                            <div class="monster-stats">
                                                <div class="monster-stat">
                                                    <span class="stat-text">NPC ID: <?= $npc['npcid'] ?></span>
                                                </div>
                                                <?php if (isset($npc['locx']) && isset($npc['locy'])): ?>
                                                <div class="monster-stat">
                                                    <span class="stat-icon">📍</span>
                                                    <span class="stat-text"><?= $npc['locx'] ?>, <?= $npc['locy'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (isset($npc['count']) && $npc['count'] > 0): ?>
                                                <div class="monster-stat drop-rate">
                                                    <span class="stat-text">Count: <?= $npc['count'] ?></span>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">No NPCs found for this map.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving NPCs: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="maps_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Maps List
        </a>
    </div>
</main>


<?php include '../../includes/footer.php'; ?>

