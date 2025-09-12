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
    $stmt = $pdo->prepare("SELECT * FROM npc WHERE npcid = :id AND impl = 'L1Doll'");
    $stmt->bindValue(':id', $dollId, PDO::PARAM_INT);
    $stmt->execute();
    $doll = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
        <div class="weapon-image-card detail-card full-image-card" style="display: flex; flex-direction: column;">
            <div class="weapon-image-large" style="flex: 1; display: flex; align-items: center; justify-content: center;">
                <img src="../../assets/img/icons/<?= $doll['spriteId'] ?>.png" 
                     alt="<?= htmlspecialchars(getDisplayName($doll['desc_en'])) ?>" 
                     onerror="this.src='../../assets/img/placeholders/dolls.png'">
            </div>
            
            <!-- Add these columns at the bottom of the image card -->
            <div class="image-card-info" style="margin-top: auto; display: flex; width: 100%;">
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Doll ID:</span>
                    <span class="info-value"><?= $doll['npcid'] ?></span>
                </div>
                <div class="info-item" style="flex: 1; text-align: center;">
                    <span class="info-label">Sprite ID:</span>
                    <span class="info-value"><?= $doll['spriteId'] ?></span>
                </div>
                <?php if ($doll['bowSpritetId'] > 0): ?>
                <div class="info-item" style="flex: 1; text-align: center;">
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
