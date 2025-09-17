<?php
// admin/includes/header.php
require_once 'config.php';
require_once 'functions.php';

// Ensure user is logged in for all pages except login.php
$currentScript = basename($_SERVER['SCRIPT_NAME']);
if ($currentScript !== 'login.php') {
    requireLogin();
}

// Try to get database stats, but don't fail if it doesn't work
try {
    $dbStats = getDatabaseStats();
} catch (Exception $e) {
    $dbStats = [];
}

// Calculate base URL for admin
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$admin_base_url = $protocol . $host . ADMIN_URL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L1J Database Admin</title>
    <!-- Admin-specific CSS -->
    <link rel="stylesheet" href="<?php echo $admin_base_url; ?>/assets/css/admin.css">
    <!-- Common CSS from main site -->
    <link rel="stylesheet" href="<?php echo $protocol . $host; ?>/L1JR-Database/assets/css/style.css">
    <link rel="icon" href="<?php echo $protocol . $host; ?>/L1JR-Database/assets/img/favicon/favicon.png" type="image/png">
    <!-- Admin-specific JavaScript -->
    <script src="<?php echo $admin_base_url; ?>/assets/js/admin.js" defer></script>
</head>
<body class="admin-body">
    <header class="admin-header">
        <div class="container header-content">
            <a href="<?php echo $admin_base_url; ?>/index.php" class="logo">L1J Database <span class="admin-tag">Admin</span></a>
            <nav>
                <div class="menu-toggle" id="menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo $admin_base_url; ?>/index.php">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Equipment</a>
                        <ul class="dropdown-menu" aria-label="Equipment submenu">
                            <li><a href="<?php echo $admin_base_url; ?>/categories/weapon/weapon_list.php">Weapons</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/armor/armor_list.php">Armor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Game Data</a>
                        <ul class="dropdown-menu" aria-label="Game Data submenu">
                            <li><a href="<?php echo $admin_base_url; ?>/categories/items/item_list.php">Items</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/dolls/doll_list.php">Dolls</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">World</a>
                        <ul class="dropdown-menu" aria-label="World submenu">
                            <li><a href="<?php echo $admin_base_url; ?>/categories/monsters/monster_list.php">Monsters</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/npcs/npc_list.php">NPCs</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/maps/maps_list.php">Maps</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo $admin_base_url; ?>/categories/crafting/crafting_list.php" class="dropdown-toggle">Crafting</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $admin_base_url; ?>/categories/crafting/crafting_list.php">All Recipes</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/crafting/crafting_list.php?type=weapon">Weapons</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/categories/crafting/crafting_list.php?type=armor">Armor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Admin</a>
                        <ul class="dropdown-menu" aria-label="Admin submenu">
                            <li><a href="<?php echo $admin_base_url; ?>/tables.php">Database Tables</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/logs.php">Admin Logs</a></li>
                            <li><a href="<?php echo $admin_base_url; ?>/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <!-- Back to Site Link -->
                    <li>
                        <a href="<?php echo $protocol . $host; ?>/L1JR-Database/index.php" 
                           class="back-to-site-link"
                           title="Back to main site">
                           <i class="site-icon">🏠</i> Main Site
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="admin-container">
        <?php
        // Display any messages
        $message = getAndClearMessage();
        if ($message): 
        ?>
        <div class="admin-message admin-message-<?php echo $message['type']; ?>">
            <?php echo $message['text']; ?>
            <span class="close-message">&times;</span>
        </div>
        <?php endif; ?>
