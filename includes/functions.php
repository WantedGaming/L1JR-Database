<?php
// include/functions.php
include 'config.php';

function getCategories() {
    return [
        'Weapons', 'Armor', 'Items', 'Monsters', 
        'Maps', 'NPCs', 'Skills', 'Dolls', 'Polymorph', 'Crafting'
    ];
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Normalize weapon grade for display
 */
function normalizeGrade($grade) {
    $gradeMap = [
        'ONLY' => 'Unique',
        'MYTH' => 'Mythic',
        'LEGEND' => 'Legendary',
        'HERO' => 'Heroic',
        'RARE' => 'Rare',
        'ADVANC' => 'Advanced',
        'NORMAL' => 'Normal'
    ];
    
    return isset($gradeMap[$grade]) ? $gradeMap[$grade] : $grade;
}

/**
 * Normalize weapon type for display
 */
function normalizeType($type) {
    $typeMap = [
        'SWORD' => 'Sword',
        'DAGGER' => 'Dagger',
        'TOHAND_SWORD' => 'Two-handed Sword',
        'BOW' => 'Bow',
        'SPEAR' => 'Spear',
        'BLUNT' => 'Blunt Weapon',
        'STAFF' => 'Staff',
        'STING' => 'Sting',
        'ARROW' => 'Arrow',
        'GAUNTLET' => 'Gauntlet',
        'CLAW' => 'Claw',
        'EDORYU' => 'Edoryu',
        'SINGLE_BOW' => 'Single Bow',
        'SINGLE_SPEAR' => 'Single Spear',
        'TOHAND_BLUNT' => 'Two-handed Blunt',
        'TOHAND_STAFF' => 'Two-handed Staff',
        'KEYRINGK' => 'Keyring',
        'CHAINSWORD' => 'Chain Sword'
    ];
    
    return isset($typeMap[$type]) ? $typeMap[$type] : $type;
}

/**
 * Remove prefix text like \aF, \aG, \aH from item names
 */
function removeNamePrefix($name) {
    // Remove \a followed by any uppercase letter (F, G, H, etc.)
    $cleanedName = preg_replace('/\\\\a[A-Z]/', '', $name);
    
    // Also remove any other common prefix patterns if needed
    $cleanedName = preg_replace('/^\\\\[a-zA-Z0-9]/', '', $cleanedName);
    
    return trim($cleanedName);
}

/**
 * Normalize material column by removing Korean text in parentheses
 */
function normalizeMaterial($material) {
    // Remove Korean text in parentheses and anything after it
    $normalized = preg_replace('/\([^)]+\)(.*)/', '', $material);
    
    // Trim any extra whitespace
    $normalized = trim($normalized);
    
    // If the result is empty, return the original
    if (empty($normalized)) {
        return $material;
    }
    
    return $normalized;
}

/**
 * Decode HTML entities in text
 */
function decodeHtmlEntities($text) {
    return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Get a clean display name by applying all normalizations
 */
function getDisplayName($name) {
    $cleaned = removeNamePrefix($name);
    return decodeHtmlEntities($cleaned);
}

/**
 * Get a clean display material by applying all normalizations
 */
function getDisplayMaterial($material) {
    $cleaned = normalizeMaterial($material);
    return decodeHtmlEntities($cleaned);
}

/**
 * Normalize armor type for display
 */
function normalizeArmorType($type) {
    $typeMap = [
        'NONE' => 'None',
        'HELMET' => 'Helmet',
        'ARMOR' => 'Armor',
        'T_SHIRT' => 'T-Shirt',
        'CLOAK' => 'Cloak',
        'GLOVE' => 'Gloves',
        'BOOTS' => 'Boots',
        'SHIELD' => 'Shield',
        'AMULET' => 'Amulet',
        'RING' => 'Ring',
        'BELT' => 'Belt',
        'RING_2' => 'Ring (2)',
        'EARRING' => 'Earring',
        'GARDER' => 'Garder',
        'RON' => 'Ron',
        'PAIR' => 'Pair',
        'SENTENCE' => 'Sentence',
        'SHOULDER' => 'Shoulder',
        'BADGE' => 'Badge',
        'PENDANT' => 'Pendant'
    ];
    
    return isset($typeMap[$type]) ? $typeMap[$type] : $type;
}

/**
 * Normalize item type for display
 */
function normalizeItemType($type) {
    $typeMap = [
        'ARROW' => 'Arrow',
        'WAND' => 'Wand',
        'LIGHT' => 'Light',
        'GEM' => 'Gem',
        'TOTEM' => 'Totem',
        'FIRE_CRACKER' => 'Fire Cracker',
        'POTION' => 'Potion',
        'FOOD' => 'Food',
        'SCROLL' => 'Scroll',
        'QUEST_ITEM' => 'Quest Item',
        'SPELL_BOOK' => 'Spell Book',
        'PET_ITEM' => 'Pet Item',
        'OTHER' => 'Other',
        'MATERIAL' => 'Material',
        'EVENT' => 'Event Item',
        'STING' => 'Sting',
        'TREASURE_BOX' => 'Treasure Box'
    ];
    
    return isset($typeMap[$type]) ? $typeMap[$type] : $type;
}

/**
 * Normalize item use type for display
 */
function normalizeItemUseType($useType) {
    $useTypeMap = [
        'NONE' => 'None',
        'NORMAL' => 'Normal',
        'WAND1' => 'Wand (Type 1)',
        'WAND' => 'Wand',
        'SPELL_LONG' => 'Long Range Spell',
        'NTELE' => 'Nearby Teleport',
        'IDENTIFY' => 'Identify',
        'RES' => 'Resurrection',
        'TELEPORT' => 'Teleport',
        'INVISABLE' => 'Invisibility',
        'POTION' => 'Potion',
        'FOOD' => 'Food',
        'SPELL_SHORT' => 'Short Range Spell',
        'SPELL_BUFF' => 'Buff Spell',
        'HEALING' => 'Healing',
        'ELIXER_RON' => 'Elixir',
        'MAGICDOLL' => 'Magic Doll',
        'PET_POTION' => 'Pet Potion'
    ];
    
    // Return mapped value or original if not in map
    return isset($useTypeMap[$useType]) ? $useTypeMap[$useType] : $useType;
}

/**
 * Normalize monster undead type for display
 */
function normalizeUndeadType($type) {
    $typeMap = [
        'NONE' => 'None',
        'UNDEAD' => 'Undead',
        'DEMON' => 'Demon',
        'UNDEAD_BOSS' => 'Undead Boss',
        'DRANIUM' => 'Dranium'
    ];
    
    return isset($typeMap[$type]) ? $typeMap[$type] : $type;
}

/**
 * Normalize monster poison attack type for display
 */
function normalizePoisonAttack($type) {
    $typeMap = [
        'NONE' => 'None',
        'DAMAGE' => 'Damage',
        'PARALYSIS' => 'Paralysis',
        'SILENCE' => 'Silence'
    ];
    
    return isset($typeMap[$type]) ? $typeMap[$type] : $type;
}

/**
 * Normalize monster weak attribute for display
 */
function normalizeWeakAttribute($attr) {
    $attrMap = [
        'NONE' => 'None',
        'EARTH' => 'Earth',
        'FIRE' => 'Fire',
        'WATER' => 'Water',
        'WIND' => 'Wind'
    ];
    
    return isset($attrMap[$attr]) ? $attrMap[$attr] : $attr;
}

// Function to get text from .tbl file based on real_desc value
function getTextFromTbl($realDesc) {
    // Set the correct path for Windows (XAMPP)
    $tblFilePath = $_SERVER['DOCUMENT_ROOT'] . '/L1JR-Database/database files/desc-e.tbl';
    
    // Extract the number after "$" from real_desc
    if (preg_match('/\$(\d+)/', $realDesc, $matches)) {
        $lineNumber = (int)$matches[1] + 2; // Add 2 to the number
        
        // Check if the .tbl file exists
        if (!file_exists($tblFilePath)) {
            error_log("TBL file not found: " . $tblFilePath);
            return $realDesc; // Return original if file not found
        }
        
        // Read the .tbl file
        $lines = file($tblFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if ($lines === false) {
            error_log("Failed to read TBL file: " . $tblFilePath);
            return $realDesc; // Return original if file can't be read
        }
        
        // Check if the line number exists
        if (isset($lines[$lineNumber - 1])) { // -1 because arrays are 0-indexed
            return trim($lines[$lineNumber - 1]);
        } else {
            error_log("Line number $lineNumber not found in TBL file (total lines: " . count($lines) . ")");
            return $realDesc; // Return original if line not found
        }
    }
    
    return $realDesc; // Return original if no $number pattern found
}

/**
 * Get image path for an item based on icon_id
 */
function getItemImage($iconId, $itemName = '') {
    $basePath = "../../assets/img/icons/";
    $defaultImage = "../../assets/img/placeholders/0png";
    
    // Check if iconId is valid
    if (!empty($iconId) && $iconId > 0) {
        $imagePath = $basePath . $iconId . ".png";
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/L1JR-Database/' . $imagePath;
        
        // Check if the image file exists
        if (file_exists($fullPath)) {
            return $imagePath;
        } else {
            // Log missing images for debugging
            error_log("Image not found: " . $fullPath . " for item: " . $itemName);
        }
    }
    
    // Return default image if no valid iconId or file doesn't exist
    return $defaultImage;
}
?>