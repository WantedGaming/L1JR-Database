<?php
// includes/header.php

// Calculate base URL - robust method for XAMPP
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];

// Method 1: Try to detect project root automatically
$script_path = $_SERVER['SCRIPT_NAME'];
$project_root = '/l1jdb_database/';

// Find the position of the project root in the path
$root_pos = strpos($script_path, $project_root);
if ($root_pos !== false) {
    // Extract everything up to and including the project root
    $base_path = substr($script_path, 0, $root_pos + strlen($project_root));
    $base_url = $protocol . $host . $base_path;
} else {
    // Method 2: Fallback - check common XAMPP patterns
    if ($host === 'localhost' || strpos($host, '127.0.0.1') !== false) {
        $base_url = $protocol . $host . '/l1jdb_database/';
    } else {
        // Method 3: Last resort - use document root calculation
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $current_dir = __DIR__; // This file's directory
        $relative_path = str_replace($document_root, '', dirname($current_dir));
        $base_url = $protocol . $host . $relative_path . '/';
    }
}

// Clean up the URL
$base_url = rtrim($base_url, '/') . '/';
$base_url = preg_replace('#(?<!:)//+#', '/', $base_url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L1J Database</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
    <link rel="icon" href="<?php echo $base_url; ?>assets/img/favicon/favicon.png" type="image/png">
    <script src="<?php echo $base_url; ?>assets/js/navigation.js" defer></script>
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="<?php echo $base_url; ?>index.php" class="logo">L1J Database</a>
            <nav>
                <div class="menu-toggle" id="menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo $base_url; ?>index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Equipment</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url; ?>categories/weapon/weapon_list.php">Weapons</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/armor/armor_list.php">Armor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Game Data</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url; ?>categories/items/item_list.php">Items</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/dolls/doll_list.php">Dolls</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">World</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url; ?>categories/monsters/monster_list.php">Monsters</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/npcs/npc_list.php">NPCs</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/maps/maps_list.php">Maps</a></li>
                        </ul>
                    </li>
                    <!-- Add more navigation items as needed -->
                </ul>
            </nav>
        </div>
    </header>