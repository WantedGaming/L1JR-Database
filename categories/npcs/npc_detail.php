<?php
// categories/npcs/npc_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get NPC ID from URL
$npcId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$npcId) {
    echo "<div class='error-message'>No NPC specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch NPC details from database
try {
    $stmt = $pdo->prepare("SELECT * FROM npc WHERE npcid = :id AND impl = 'L1Merchant'");
    $stmt->bindValue(':id', $npcId, PDO::PARAM_INT);
    $stmt->execute();
    $npc = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$npc) {
        echo "<div class='error-message'>NPC not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to NPC name
    $page_hero_title = getDisplayName($npc['desc_en']);
    $page_hero_description = "Detailed information about " . getDisplayName($npc['desc_en']);
    
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
                <img src="../../assets/img/icons/<?= $npc['spriteId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?>" 
                     onerror="this.onerror=null; this.src='../../assets/img/icons/<?= $npc['spriteId'] ?>.gif'; this.onerror=function(){this.src='../../assets/img/placeholders/npcs.png';}">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info" style="margin-top: auto; display: flex; width: 100%;">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">NPC ID:</span>
                    <span class="info-value"><?= $npc['npcid'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Sprite ID:</span>
                    <span class="info-value"><?= $npc['spriteId'] ?></span>
                </div>
                <?php if ($npc['bowSpritetId'] > 0): ?>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Bow Sprite ID:</span>
                    <span class="info-value"><?= $npc['bowSpritetId'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars(getDisplayName($npc['desc_en'])) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Level:</span>
                    <span class="info-value"><?= $npc['lvl'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">HP:</span>
                    <span class="info-value"><?= $npc['hp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">MP:</span>
                    <span class="info-value"><?= $npc['mp'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">AC:</span>
                    <span class="info-value"><?= $npc['ac'] ?></span>
                </div>
                <?php if ($npc['alignment'] != 0): ?>
                <div class="info-item">
                    <span class="info-label">Alignment:</span>
                    <span class="info-value"><?= $npc['alignment'] ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($npc['family'])): ?>
                <div class="info-item">
                    <span class="info-label">Family:</span>
                    <span class="info-value"><?= htmlspecialchars($npc['family']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- NPC Stats Row -->
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
                    <span class="stat-value"><?= $npc['str'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">CON:</span>
                    <span class="stat-value"><?= $npc['con'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">DEX:</span>
                    <span class="stat-value"><?= $npc['dex'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">WIS:</span>
                    <span class="stat-value"><?= $npc['wis'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">INT:</span>
                    <span class="stat-value"><?= $npc['intel'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MR:</span>
                    <span class="stat-value"><?= $npc['mr'] ?></span>
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
                    <span class="stat-value"><?= $npc['passispeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Speed:</span>
                    <span class="stat-value"><?= $npc['atkspeed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Magic Attack Speed:</span>
                    <span class="stat-value"><?= $npc['atk_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Sub Magic Speed:</span>
                    <span class="stat-value"><?= $npc['sub_magic_speed'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Attack Range:</span>
                    <span class="stat-value"><?= $npc['ranged'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- NPC Properties Row -->
    <div class="weapon-detail-row">
        <div class="detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">⚙️</span>
                NPC Properties
            </h3>
            <div class="properties-grid">
                <?php if ($npc['light_size'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Light Size:</span>
                    <span class="property-value"><?= $npc['light_size'] ?></span>
                </div>
                <?php endif; ?>
                <?php if ($npc['is_teleport'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Can Teleport:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($npc['isHide'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Hidden:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
                <?php if ($npc['is_change_head'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Can Change Head:</span>
                    <span class="property-value property-yes">✓</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Regeneration Stats -->
    <?php if ($npc['hpr'] > 0 || $npc['mpr'] > 0): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">♻️</span>
                Regeneration
            </h3>
            <div class="stats-grid">
                <?php if ($npc['hpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">HP Regen:</span>
                    <span class="stat-value"><?= $npc['hpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">HP Regen Interval:</span>
                    <span class="stat-value"><?= $npc['hprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
                <?php if ($npc['mpr'] > 0): ?>
                <div class="stat-item">
                    <span class="stat-label">MP Regen:</span>
                    <span class="stat-value"><?= $npc['mpr'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">MP Regen Interval:</span>
                    <span class="stat-value"><?= $npc['mprinterval'] ?> ms</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Spawn Locations Section -->
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">🗺️</span>
                Spawn Locations
            </h3>
            <?php
            // Get spawn locations for this NPC from all spawn tables
            try {
                // Query all spawn tables that might contain this NPC
                // First, get the spawn locations
                $spawnQuery = "
                    SELECT 
                        'Regular' as spawn_type, 
                        s.id, 
                        s.name, 
                        s.locx as locx, 
                        s.locy as locy, 
                        s.mapid as mapid
                    FROM `spawnlist_npc` s
                    WHERE s.npc_templateid = :npcid
                ";
                
                $spawnStmt = $pdo->prepare($spawnQuery);
                $spawnStmt->bindValue(':npcid', $npc['npcid'], PDO::PARAM_INT);
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
                    <div class="no-data-message">No spawn locations found for this NPC.</div>
                <?php endif;
            } catch(PDOException $e) {
                echo "<div class='error-message'>Error retrieving spawn locations: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Notes Section -->
    <?php if (!empty($npc['note'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📝</span>
                Additional Notes
            </h3>
            <p class="weapon-notes"><?= nl2br(htmlspecialchars($npc['note'])) ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="npc_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to NPCs List
        </a>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>
