<?php
// categories/skill/skill_detail.php

// Include config and other files
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/header.php';

// Add custom CSS if needed
// echo '<link rel="stylesheet" href="../../assets/css/map-detail.css">';

// Get skill ID from URL
$skillId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$skillId) {
    echo "<div class='error-message'>No skill specified.</div>";
    include '../../includes/footer.php';
    exit;
}

// Fetch skill details from database
try {
    // Get skill information
    $stmt = $pdo->prepare("SELECT s.*, si.* 
                          FROM skills s 
                          LEFT JOIN skills_info si ON s.skill_id = si.skillId 
                          WHERE s.skill_id = :id");
    $stmt->bindValue(':id', $skillId, PDO::PARAM_INT);
    $stmt->execute();
    $skill = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$skill) {
        echo "<div class='error-message'>Skill not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
    
    // Check if this skill has a passive skill
    $passiveStmt = $pdo->prepare("SELECT * FROM skills_passive WHERE back_active_skill_id = :id");
    $passiveStmt->bindValue(':id', $skillId, PDO::PARAM_INT);
    $passiveStmt->execute();
    $passiveSkill = $passiveStmt->fetch(PDO::FETCH_ASSOC);
    
    // Set hero title to skill name
    $page_hero_title = $skill['desc_en'];
    $page_hero_description = "Detailed information about " . $skill['desc_en'];
    
} catch(PDOException $e) {
    echo "<div class='error-message'>Database Error: " . $e->getMessage() . "</div>";
    include '../../includes/footer.php';
    exit;
}

// Helper function to format reuse delay
function formatReuseDelay($milliseconds) {
    if ($milliseconds < 1000) {
        return $milliseconds . "ms";
    } else {
        $seconds = $milliseconds / 1000;
        if ($seconds < 60) {
            return $seconds . "s";
        } else {
            $minutes = floor($seconds / 60);
            $remainingSeconds = $seconds % 60;
            if ($remainingSeconds == 0) {
                return $minutes . "m";
            } else {
                return $minutes . "m " . $remainingSeconds . "s";
            }
        }
    }
}

include '../../includes/hero.php';
?>

<main class="container detail-container">
    <!-- First Row: Image and Basic Info -->
    <div class="weapon-detail-row">
        <!-- Image Card -->
        <div class="weapon-image-card detail-card full-image-card">
            <div class="weapon-image-large">
                <img src="../../assets/img/icons/<?= $skill['onIconId'] ?>.png" 
                     alt="<?= htmlspecialchars($skill['desc_en']) ?>" 
                     onerror="this.src='../../assets/img/placeholders/0.png'">
            </div>
            
            <!-- Add ID info at the bottom of the image card -->
            <div class="image-card-info">
                <div class="info-item">
                    <span class="info-label">Skill ID:</span>
                    <span class="info-value"><?= $skill['skill_id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Icon ID:</span>
                    <span class="info-value"><?= $skill['onIconId'] ?></span>
                </div>
                <?php if ($skill['tooltipStrId']): ?>
                <div class="info-item">
                    <span class="info-label">Tooltip ID:</span>
                    <span class="info-value"><?= $skill['tooltipStrId'] ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Basic Info Card -->
        <div class="weapon-basic-info detail-card">
            <h2 class="weapon-name-large"><?= htmlspecialchars($skill['desc_en']) ?></h2>
            <div class="basic-info-grid">
                <div class="info-item">
                    <span class="info-label">Grade:</span>
                    <span class="info-value grade-<?= strtolower($skill['grade']) ?>"><?= $skill['grade'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Level:</span>
                    <span class="info-value"><?= $skill['skill_level'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Class:</span>
                    <span class="info-value"><?= $skill['classType'] !== 'none' ? ucfirst($skill['classType']) : 'Normal' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type:</span>
                    <span class="info-value"><?= $skill['type'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">MP Consume:</span>
                    <span class="info-value"><?= $skill['mpConsume'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">HP Consume:</span>
                    <span class="info-value"><?= $skill['hpConsume'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Duration:</span>
                    <span class="info-value"><?= $skill['buffDuration_txt'] ?: 'N/A' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Reuse Delay:</span>
                    <span class="info-value"><?= formatReuseDelay($skill['reuseDelay']) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: Effect Details and Target Info -->
    <div class="weapon-detail-row">
        <!-- Effect Details -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">✨</span>
                Effect Details
            </h3>
            <div class="properties-list">
                <?php if (!empty($skill['effect_txt'])): ?>
                <div class="property-item accent">
                    <span><?= htmlspecialchars($skill['effect_txt']) ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['target'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Target Type:</span>
                    <span class="property-value"><?= $skill['target'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['target_to'] !== 'ME'): ?>
                <div class="property-item">
                    <span class="property-label">Target To:</span>
                    <span class="property-value"><?= $skill['target_to'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($skill['target_to_txt'])): ?>
                <div class="property-item">
                    <span class="property-label">Target Description:</span>
                    <span class="property-value"><?= htmlspecialchars($skill['target_to_txt']) ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['attr'] !== 'NONE'): ?>
                <div class="property-item">
                    <span class="property-label">Attribute:</span>
                    <span class="property-value"><?= $skill['attr'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['ranged'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Range:</span>
                    <span class="property-value"><?= $skill['ranged'] ?> cells</span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['area'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Area:</span>
                    <span class="property-value"><?= $skill['area'] ?> cells</span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['probability_value'] > 0 || $skill['probability_dice'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Success Rate:</span>
                    <span class="property-value">
                        <?php 
                        if ($skill['probability_value'] > 0 && $skill['probability_dice'] > 0) {
                            echo $skill['probability_value'] . '% + d' . $skill['probability_dice'];
                        } elseif ($skill['probability_value'] > 0) {
                            echo $skill['probability_value'] . '%';
                        } else {
                            echo 'd' . $skill['probability_dice'];
                        }
                        ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Damage Info -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">⚔️</span>
                Damage Information
            </h3>
            <div class="properties-list">
                <?php if ($skill['damage_value'] > 0 || $skill['damage_dice'] > 0 || $skill['damage_dice_count'] > 0): ?>
                <div class="property-item accent">
                    <span class="property-label">Damage Formula:</span>
                    <span class="property-value">
                        <?php 
                        $parts = [];
                        if ($skill['damage_value'] > 0) {
                            $parts[] = $skill['damage_value'];
                        }
                        if ($skill['damage_dice'] > 0 && $skill['damage_dice_count'] > 0) {
                            $parts[] = $skill['damage_dice_count'] . 'd' . $skill['damage_dice'];
                        } elseif ($skill['damage_dice'] > 0) {
                            $parts[] = 'd' . $skill['damage_dice'];
                        }
                        echo implode(' + ', $parts);
                        ?>
                    </span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['type'] === 'ATTACK'): ?>
                <div class="property-item">
                    <span class="property-label">Attack Type:</span>
                    <span class="property-value"><?= $skill['type'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['is_through'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Pierce Through:</span>
                    <span class="property-value">Yes</span>
                </div>
                <?php endif; ?>
                
                <?php 
                // If no damage properties
                if ($skill['damage_value'] == 0 && $skill['damage_dice'] == 0 && $skill['damage_dice_count'] == 0 && $skill['type'] !== 'ATTACK' && $skill['is_through'] !== 'true'): 
                ?>
                <div class="no-data-message">No damage information available</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Third Row: Consumption and Animation -->
    <div class="weapon-detail-row">
        <!-- Consumption Info -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">📦</span>
                Item Consumption
            </h3>
            <div class="properties-list">
                <?php if ($skill['itemConsumeId'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Item ID:</span>
                    <span class="property-value"><?= $skill['itemConsumeId'] ?></span>
                </div>
                
                <div class="property-item">
                    <span class="property-label">Item Count:</span>
                    <span class="property-value"><?= $skill['itemConsumeCount'] ?></span>
                </div>
                
                <?php
                // Get item name if available
                try {
                    $itemStmt = $pdo->prepare("SELECT desc_en FROM etcitem WHERE item_id = :id");
                    $itemStmt->bindValue(':id', $skill['itemConsumeId'], PDO::PARAM_INT);
                    $itemStmt->execute();
                    $item = $itemStmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($item): ?>
                    <div class="property-item accent">
                        <span class="property-label">Item Name:</span>
                        <span class="property-value"><?= htmlspecialchars(getDisplayName($item['desc_en'])) ?></span>
                    </div>
                    <?php endif;
                } catch(PDOException $e) {
                    // Silently fail
                }
                ?>
                
                <?php else: ?>
                <div class="no-data-message">No item consumption required</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Animation Info -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🎬</span>
                Animation Effects
            </h3>
            <div class="properties-list">
                <?php if ($skill['castgfx'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Cast GFX 1:</span>
                    <span class="property-value"><?= $skill['castgfx'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['castgfx2'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Cast GFX 2:</span>
                    <span class="property-value"><?= $skill['castgfx2'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['castgfx3'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Cast GFX 3:</span>
                    <span class="property-value"><?= $skill['castgfx3'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['action_id'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Action ID 1:</span>
                    <span class="property-value"><?= $skill['action_id'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['action_id2'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Action ID 2:</span>
                    <span class="property-value"><?= $skill['action_id2'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['action_id3'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Action ID 3:</span>
                    <span class="property-value"><?= $skill['action_id3'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php 
                // If no animation properties
                if ($skill['castgfx'] == 0 && $skill['castgfx2'] == 0 && $skill['castgfx3'] == 0 && 
                    $skill['action_id'] == 0 && $skill['action_id2'] == 0 && $skill['action_id3'] == 0): 
                ?>
                <div class="no-data-message">No animation information available</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Fourth Row: System Messages and Fixed Values -->
    <div class="weapon-detail-row">
        <!-- System Messages -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">📢</span>
                System Messages
            </h3>
            <div class="properties-list">
                <?php if ($skill['sysmsgID_happen'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Happen Message ID:</span>
                    <span class="property-value"><?= $skill['sysmsgID_happen'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['sysmsgID_stop'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Stop Message ID:</span>
                    <span class="property-value"><?= $skill['sysmsgID_stop'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['sysmsgID_fail'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Fail Message ID:</span>
                    <span class="property-value"><?= $skill['sysmsgID_fail'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php 
                // If no system message properties
                if ($skill['sysmsgID_happen'] == 0 && $skill['sysmsgID_stop'] == 0 && $skill['sysmsgID_fail'] == 0): 
                ?>
                <div class="no-data-message">No system messages defined</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Additional Properties -->
        <div class="weapon-info-card detail-card">
            <h3 class="detail-card-title">
                <span class="title-icon">🔧</span>
                Additional Properties
            </h3>
            <div class="properties-list">
                <?php if ($skill['fixDelay'] === 'true'): ?>
                <div class="property-item">
                    <span class="property-label">Fixed Delay:</span>
                    <span class="property-value">Yes</span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['delayGroupId'] > 0): ?>
                <div class="property-item">
                    <span class="property-label">Delay Group:</span>
                    <span class="property-value"><?= $skill['delayGroupId'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['alignment'] !== 0): ?>
                <div class="property-item">
                    <span class="property-label">Alignment Change:</span>
                    <span class="property-value"><?= $skill['alignment'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($skill['isPassiveSpell'] === 'true'): ?>
                <div class="property-item accent">
                    <span class="property-label">Passive Skill:</span>
                    <span class="property-value">Yes</span>
                </div>
                <?php endif; ?>
                
                <?php
                // Show passive skill information if available
                if ($passiveSkill): ?>
                <div class="property-item accent">
                    <span class="property-label">Linked Passive:</span>
                    <span class="property-value"><?= htmlspecialchars($passiveSkill['desc_en']) ?> (ID: <?= $passiveSkill['passive_id'] ?>)</span>
                </div>
                <?php endif; ?>
                
                <?php 
                // If no additional properties
                if ($skill['fixDelay'] !== 'true' && $skill['delayGroupId'] == 0 && $skill['alignment'] == 0 && 
                    $skill['isPassiveSpell'] !== 'true' && !$passiveSkill): 
                ?>
                <div class="no-data-message">No additional properties defined</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Back to List Link -->
    <div class="back-to-list">
        <a href="skill_list.php" class="back-link">
            <span class="back-arrow">&larr;</span>
            Back to Skills List
        </a>
    </div>
</main>

<?php
include '../../includes/footer.php';
?>