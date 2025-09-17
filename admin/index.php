<?php
// admin/index.php - Admin Dashboard
require_once 'includes/functions.php';
include_once 'includes/header.php';

// Get statistics for the dashboard
$dbStats = getDatabaseStats();

// Get the database tables
$tables = getDatabaseTables();

// Get recent admin logs (if table exists)
$recentLogs = [];
try {
    $stmt = $pdo->query("SELECT * FROM admin_log ORDER BY timestamp DESC LIMIT 10");
    $recentLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Table might not exist yet, that's fine
}
?>

<div class="admin-dashboard">
    <h1 class="admin-section-title">Admin Dashboard</h1>
    
    <!-- Statistics Cards -->
    <div class="admin-cards">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/weapons.png" alt="Weapons" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Weapons</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['weapon_count']) ? number_format($dbStats['weapon_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/weapon/weapon_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/armor.png" alt="Armor" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Armor</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['armor_count']) ? number_format($dbStats['armor_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/armor/armor_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/items.png" alt="Items" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Items</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['etcitem_count']) ? number_format($dbStats['etcitem_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/items/item_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/monsters.png" alt="Monsters" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Monsters</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['npc_count']) ? number_format($dbStats['npc_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/monsters/monster_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/skills.png" alt="Skills" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Skills</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['skills_count']) ? number_format($dbStats['skills_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/skill/skill_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-icon">
                    <img src="../assets/img/placeholders/maps.png" alt="Maps" width="40" height="40">
                </div>
                <h2 class="admin-card-title">Spawns</h2>
            </div>
            <div class="admin-card-value"><?php echo isset($dbStats['spawnlist_count']) ? number_format($dbStats['spawnlist_count']) : 0; ?></div>
            <div class="admin-card-footer">
                <span class="admin-card-label">Total Records</span>
                <a href="categories/maps/maps_list.php" class="admin-card-action">Manage &rarr;</a>
            </div>
        </div>
    </div>
    
    <!-- Admin Chat Log -->
    <div class="admin-section">
        <h2 class="admin-section-title">Admin Activity Feed</h2>
        <div class="admin-chat-window">
            <div class="admin-chat-messages" id="adminChatMessages">
                <div class="chat-loading">Loading activity logs...</div>
            </div>
            <div class="admin-chat-filter">
                <label>
                    <input type="checkbox" id="autoRefresh" checked> Auto-refresh
                </label>
                <select id="logTypeFilter">
                    <option value="">All Activities</option>
                    <option value="login">Logins</option>
                    <option value="edit">Edits</option>
                    <option value="add">Additions</option>
                    <option value="delete">Deletions</option>
                </select>
                <button id="refreshChat" class="admin-btn admin-btn-sm admin-btn-primary">Refresh Now</button>
            </div>
        </div>
    </div>
    
    <!-- Quick Links -->
    <div class="admin-section">
        <h2 class="admin-section-title">Quick Links</h2>
        <div class="admin-cards">
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-card-icon">
                        <img src="../assets/img/placeholders/items.png" alt="Database Tables" width="40" height="40">
                    </div>
                    <h2 class="admin-card-title">Database Tables</h2>
                </div>
                <p style="margin-bottom: 1rem;">Browse and manage all database tables directly.</p>
                <div class="admin-card-footer">
                    <a href="tables.php" class="admin-btn admin-btn-primary">View Tables</a>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-card-icon">
                        <img src="../assets/img/placeholders/skills.png" alt="Admin Logs" width="40" height="40">
                    </div>
                    <h2 class="admin-card-title">Admin Logs</h2>
                </div>
                <p style="margin-bottom: 1rem;">View a complete history of admin actions.</p>
                <div class="admin-card-footer">
                    <a href="logs.php" class="admin-btn admin-btn-primary">View Logs</a>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-card-icon">
                        <img src="../assets/img/placeholders/maps.png" alt="Main Website" width="40" height="40">
                    </div>
                    <h2 class="admin-card-title">Main Website</h2>
                </div>
                <p style="margin-bottom: 1rem;">Return to the public-facing website.</p>
                <div class="admin-card-footer">
                    <a href="../index.php" class="admin-btn admin-btn-primary">Go to Website</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Category Shortcuts -->
    <div class="admin-section">
        <h2 class="admin-section-title">Category Management</h2>
        <div class="admin-category-cards">
            <?php
            // Define category-image mapping
            $categories = getCategories();
            
            foreach ($categories as $category) {
                $slug = strtolower($category);
                if ($slug === 'skills') $slug = 'skill';
                if ($slug === 'npcs') $slug = 'npcs';
                
                $imagePath = "../assets/img/placeholders/{$slug}.png";
                $count = isset($dbStats[$slug . '_count']) ? number_format($dbStats[$slug . '_count']) : '?';
                
                echo '<a href="categories/' . $slug . '/' . $slug . '_list.php" class="admin-category-card">';
                echo '<div class="category-icon"><img src="' . $imagePath . '" alt="' . $category . '" width="60" height="60"></div>';
                echo '<h3 class="category-title">' . $category . '</h3>';
                echo '<span class="category-count">' . $count . ' Records</span>';
                echo '</a>';
            }
            ?>
        </div>
    </div>
    
    <!-- Database Info Section -->
    <div class="admin-section">
        <h2 class="admin-section-title">Database Information</h2>
        <div class="admin-cards">
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-card-icon">
                        <img src="../assets/img/placeholders/items.png" alt="Database Size" width="40" height="40">
                    </div>
                    <h2 class="admin-card-title">Database Size</h2>
                </div>
                <div class="admin-card-value"><?php echo isset($dbStats['db_size']) ? formatFileSize($dbStats['db_size']) : '0 MB'; ?></div>
                <div class="admin-card-footer">
                    <span class="admin-card-label">Total Size</span>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-card-icon">
                        <img src="../assets/img/placeholders/skills.png" alt="Tables" width="40" height="40">
                    </div>
                    <h2 class="admin-card-title">Tables</h2>
                </div>
                <div class="admin-card-value"><?php echo isset($dbStats['total_tables']) ? number_format($dbStats['total_tables']) : 0; ?></div>
                <div class="admin-card-footer">
                    <span class="admin-card-label">Total Tables</span>
                    <a href="tables.php" class="admin-card-action">View All &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>