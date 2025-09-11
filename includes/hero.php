<?php
// includes/hero.php - Dynamic hero section

// Get the current page information
$current_script = basename($_SERVER['SCRIPT_NAME'], '.php');
$current_dir = basename(dirname($_SERVER['SCRIPT_NAME']));
$full_path = $_SERVER['SCRIPT_NAME'];

// Default values
$hero_title = "L1J-R Database";
$hero_description = "Your comprehensive resource for all things related to Lineage Remastered.";
$hero_class = "hero";

// Determine page-specific content
if (strpos($full_path, '/categories/weapon/') !== false) {
    if ($current_script === 'weapon_list') {
        $hero_title = "Weapons Database";
        $hero_description = "Explore our complete collection of weapons with detailed stats, damage values, and item grades.";
    } elseif ($current_script === 'weapon_detail') {
        $hero_title = "Weapon Details";
        $hero_description = "In-depth information about this weapon including stats, requirements, and attributes.";
    }
    $hero_class = "hero hero-weapons";
} elseif (strpos($full_path, '/categories/armor/') !== false) {
    if ($current_script === 'armor_list') {
        $hero_title = "Armor Database";
        $hero_description = "Browse through our extensive armor collection with AC values, materials, and protective stats.";
    } elseif ($current_script === 'armor_detail') {
        $hero_title = "Armor Details";
        $hero_description = "Complete armor specifications including defense ratings, durability, and special properties.";
    }
    $hero_class = "hero hero-armor";
} elseif (strpos($full_path, '/categories/items/') !== false) {
    $hero_title = "Items Database";
    $hero_description = "Discover consumables, materials, and special items with their effects and usage information.";
    $hero_class = "hero hero-items";
} elseif (strpos($full_path, '/categories/spells/') !== false) {
    $hero_title = "Spells & Magic";
    $hero_description = "Master the arcane arts with our complete spell database including damage, mana costs, and effects.";
    $hero_class = "hero hero-spells";
} elseif ($current_script === 'index') {
    // Keep default for home page
    $hero_class = "hero hero-home";
}

// Allow pages to override hero content by setting variables before including hero.php
if (isset($page_hero_title)) {
    $hero_title = $page_hero_title;
}
if (isset($page_hero_description)) {
    $hero_description = $page_hero_description;
}
if (isset($page_hero_class)) {
    $hero_class = $page_hero_class;
}

// Decode HTML entities for proper display
$hero_title = decodeHtmlEntities($hero_title);
$hero_description = decodeHtmlEntities($hero_description);
?>
<section class="<?= $hero_class ?>">
    <div class="hero-content">
        <h1><?= $hero_title ?></h1>
        <p><?= $hero_description ?></p>
    </div>
</section>