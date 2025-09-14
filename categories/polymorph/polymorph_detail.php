<?php
// categories/polymorph/polymorph_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Get polymorph ID from URL
$polymorph_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$polymorph_id) {
    echo "<div class='error-message'>No polymorph specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch polymorph details from database
try {
    $stmt = $pdo->prepare("SELECT p.*, pi.name as item_name, pi.itemId, pi.duration, pi.type as item_type
                          FROM polymorphs p
                          LEFT JOIN polyitems pi ON p.polyid = pi.polyId
                          WHERE p.id = :id");
    $stmt->bindValue(':id', $polymorph_id, PDO::PARAM_INT);
    $stmt->execute();
    $polymorph = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$polymorph) {
        echo "<div class='error-message'>Polymorph not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Set hero title to polymorph name
    $page_hero_title = $polymorph['name'];
    $page_hero_description = "Detailed information about the " . $polymorph['name'] . " polymorph.";
    
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
                <img src="../../assets/img/placeholders/polymorph.png" 
                     alt="<?= htmlspecialchars($polymorph['name']) ?>">
            </div>
            
            <!-- Add ID info at the bottom of the image card -->
            <div class="image-card-info">
                <div class="info-item">
                    <span class="info-label">ID:</span>
                    <span class="info-value"><?= $polymorph['id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Poly ID:</span>
                    <span class="info-value"><?= $polymorph['polyid'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars($polymorph['name']) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Minimum Level:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['minlevel']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Weapon Equip:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['weaponequip']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Armor Equip:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['armorequip']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Skill Use:</span>
                    <span class="info-value"><?= $polymorph['isSkillUse'] ? 'Yes' : 'No' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Bonus PVP:</span>
                    <span class="info-value"><?= $polymorph['bonusPVP'] === 'true' ? 'Yes' : 'No' ?></span>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($polymorph['item_name'])): ?>
    <div class="weapon-detail-row">
        <div class="weapon-info-card detail-card full-width">
            <h3 class="detail-card-title">
                <span class="title-icon">📦</span>
                Associated Polymorph Item
            </h3>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Item Name:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['item_name']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Item ID:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['itemId']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Duration:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['duration']) ?> seconds</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= htmlspecialchars($polymorph['item_type']) ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="polymorph_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Polymorphs List
        </a>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>
