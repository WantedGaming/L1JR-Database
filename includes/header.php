<?php
// includes/header.php

// Calculate base URL - robust method for XAMPP
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];

// Try multiple methods to determine the base URL correctly
$script_path = $_SERVER['SCRIPT_NAME'];
$possible_roots = ['/L1JR-Database/', '/l1jr-database/', '/L1JR-DATABASE/', '/l1jdb_database/'];
$base_url = '';

// Method 1: Try to detect project root from script path
foreach ($possible_roots as $project_root) {
    // Case insensitive search
    $root_pos = stripos($script_path, $project_root);
    if ($root_pos !== false) {
        // Extract everything up to and including the project root
        $base_path = substr($script_path, 0, $root_pos + strlen($project_root));
        $base_url = $protocol . $host . $base_path;
        break;
    }
}

// Method 2: If method 1 failed, try document root calculation
if (empty($base_url)) {
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $current_dir = __DIR__; // This file's directory
    $parent_dir = dirname($current_dir); // Parent directory of includes folder
    $relative_path = str_replace('\\', '/', str_replace($document_root, '', $parent_dir));
    $base_url = $protocol . $host . $relative_path . '/';
}

// Method 3: Fallback for localhost
if (empty($base_url) || $base_url === $protocol . $host . '/') {
    if ($host === 'localhost' || strpos($host, '127.0.0.1') !== false) {
        // Get the folder name from the current path
        $current_path = __DIR__;
        $parent_folder = basename(dirname($current_path));
        $base_url = $protocol . $host . '/' . $parent_folder . '/';
    }
}

// Clean up the URL
$base_url = rtrim($base_url, '/') . '/';
$base_url = preg_replace('#(?<!:)//+#', '/', $base_url);

// Debug information - will be visible in HTML source
echo "<!-- DEBUG: Base URL calculated as: $base_url -->";
echo "<!-- DEBUG: Script path: $script_path -->";
echo "<!-- DEBUG: Document root: " . $_SERVER['DOCUMENT_ROOT'] . " -->";
echo "<!-- DEBUG: Current dir: " . __DIR__ . " -->";
echo "<!-- DEBUG: Parent dir: " . dirname(__DIR__) . " -->";
echo "<!-- DEBUG: Host: $host -->";

// Check if CSS file exists in various locations
$css_paths = [
    dirname(__DIR__) . '/assets/css/style.css',
    $_SERVER['DOCUMENT_ROOT'] . '/L1JR-Database/assets/css/style.css',
    $_SERVER['DOCUMENT_ROOT'] . '/assets/css/style.css'
];

// Check if we're on a doll page
$is_doll_page = strpos($_SERVER['SCRIPT_NAME'], 'dolls') !== false;

foreach ($css_paths as $path) {
    echo "<!-- CSS path check: $path - " . (file_exists($path) ? "EXISTS" : "NOT FOUND") . " -->";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L1J Database</title>
    <!-- Primary CSS link using calculated base URL -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
    <!-- Backup CSS links with various possible paths in case the calculated URL fails -->
    <link rel="stylesheet" href="/L1JR-Database/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <?php if ($is_doll_page): ?>
    <!-- Doll-specific CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/doll.css">
    <link rel="stylesheet" href="/L1JR-Database/assets/css/doll.css">
    <link rel="stylesheet" href="/assets/css/doll.css">
    <link rel="stylesheet" href="../../assets/css/doll.css">
    <link rel="stylesheet" href="../assets/css/doll.css">
    <?php endif; ?>
    
    <link rel="icon" href="<?php echo $base_url; ?>assets/img/favicon/favicon.png" type="image/png">
    <script src="<?php echo $base_url; ?>assets/js/navigation.js" defer></script>
    <script src="<?php echo $base_url; ?>assets/js/clickable-rows.js" defer></script>
    <script src="<?php echo $base_url; ?>assets/js/performance.js" defer></script>
    
    <!-- Emergency inline styles in case external CSS fails to load -->
    <style>
        /* Basic emergency styling */
        body { font-family: Arial, sans-serif; background-color: #121212; color: #e0e0e0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        header { background-color: #1e1e1e; padding: 1rem 0; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .logo { color: #e0e0e0; text-decoration: none; font-size: 1.5rem; font-weight: bold; }
        nav ul { list-style: none; display: flex; margin: 0; padding: 0; }
        nav li { margin-left: 1.5rem; }
        nav a { color: #e0e0e0; text-decoration: none; }
        .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem; }
        .pagination-link { display: inline-block; padding: 0.5rem 1rem; background-color: #333; color: #e0e0e0; text-decoration: none; border-radius: 4px; }
        .pagination-link.active { background-color: #007bff; color: #fff; }
        .pagination-ellipsis { padding: 0.5rem 0.5rem; color: #e0e0e0; }
        table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
        th, td { padding: 0.75rem; border-bottom: 1px solid #333; text-align: left; }
        th { background-color: #1e1e1e; }
        tr:hover { background-color: #252525; }
    </style>
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
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Equipment</a>
                        <ul class="dropdown-menu" aria-label="Equipment submenu">
                            <li><a href="<?php echo $base_url; ?>categories/weapon/weapon_list.php">Weapons</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/armor/armor_list.php">Armor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Game Data</a>
                        <ul class="dropdown-menu" aria-label="Game Data submenu">
                            <li><a href="<?php echo $base_url; ?>categories/items/item_list.php">Items</a></li>
                            <li><a href="<?php echo $base_url; ?>categories/dolls/doll_list.php">Dolls</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">World</a>
                        <ul class="dropdown-menu" aria-label="World submenu">
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