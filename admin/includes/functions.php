<?php
// admin/includes/functions.php - Admin-specific functions

// Include config file
require_once 'config.php';

// Check if $pdo is available from main config, if not, create a connection
if (!isset($pdo)) {
    // Define database connection parameters
    $host = 'localhost';
    $dbname = 'l1j_remastered';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Import normalization functions if not already available
if (!function_exists('normalizeGrade')) {
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
}

if (!function_exists('normalizeType')) {
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
}

if (!function_exists('normalizeArmorType')) {
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
}

if (!function_exists('normalizeItemType')) {
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
}

if (!function_exists('normalizeItemUseType')) {
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
}

if (!function_exists('removeNamePrefix')) {
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
}

if (!function_exists('getDisplayName')) {
    /**
     * Get a clean display name by applying all normalizations
     */
    function getDisplayName($name) {
        return removeNamePrefix($name);
    }
}

// Get the categories (same as main site)
function getCategories() {
    return [
        'Weapons', 'Armor', 'Items', 'Monsters', 
        'Maps', 'NPCs', 'Skills', 'Dolls', 'Polymorph', 'Crafting'
    ];
}

// Get database tables based on the SQL files in database_files folder
function getDatabaseTables() {
    $tables = [];
    $sqlDir = dirname(dirname(__DIR__)) . '/database_files';
    $files = scandir($sqlDir);
    
    foreach ($files as $file) {
        if (strpos($file, 'l1j_remastered_table_') === 0) {
            // Extract table name from file name
            $tableName = str_replace(['l1j_remastered_table_', '.sql'], '', $file);
            $tables[] = $tableName;
        }
    }
    
    // Sort tables alphabetically
    sort($tables);
    return $tables;
}

// Get table structure from database
function getTableColumns($tableName) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("DESCRIBE $tableName");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}

// Count records in a table
function countRecords($tableName) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM $tableName");
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        return 0;
    }
}

// Get table data with pagination
function getTableData($tableName, $page = 1, $limit = 20, $where = null, $orderBy = null) {
    global $pdo;
    
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM $tableName";
    
    if ($where) {
        $sql .= " WHERE $where";
    }
    
    if ($orderBy) {
        $sql .= " ORDER BY $orderBy";
    }
    
    $sql .= " LIMIT :limit OFFSET :offset";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

// Insert a new record
function insertRecord($tableName, $data) {
    global $pdo;
    
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    
    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    
    try {
        $stmt = $pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

// Update an existing record
function updateRecord($tableName, $data, $primaryKey, $primaryKeyValue) {
    global $pdo;
    
    $setClause = [];
    foreach (array_keys($data) as $column) {
        $setClause[] = "$column = :$column";
    }
    $setClause = implode(', ', $setClause);
    
    $sql = "UPDATE $tableName SET $setClause WHERE $primaryKey = :primaryKeyValue";
    
    try {
        $stmt = $pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':primaryKeyValue', $primaryKeyValue);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

// Delete a record
function deleteRecord($tableName, $primaryKey, $primaryKeyValue) {
    global $pdo;
    
    $sql = "DELETE FROM $tableName WHERE $primaryKey = :primaryKeyValue";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':primaryKeyValue', $primaryKeyValue);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

// Get primary key for a table
function getPrimaryKey($tableName) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['Column_name'] : null;
    } catch (PDOException $e) {
        return null;
    }
}

// Get a single record by primary key
function getRecordByPrimaryKey($tableName, $primaryKey, $primaryKeyValue) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM $tableName WHERE $primaryKey = :primaryKeyValue");
        $stmt->bindValue(':primaryKeyValue', $primaryKeyValue);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}

// Get related tables (tables with foreign keys to this table)
function getRelatedTables($tableName) {
    global $pdo;
    
    try {
        $sql = "SELECT 
                    TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
                FROM
                    INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                WHERE
                    REFERENCED_TABLE_SCHEMA = DATABASE()
                        AND REFERENCED_TABLE_NAME = :tableName";
                        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tableName', $tableName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

// Get database statistics
function getDatabaseStats() {
    global $pdo;
    
    $stats = [];
    
    try {
        // Total tables
        $stmt = $pdo->query("SHOW TABLES");
        $stats['total_tables'] = $stmt->rowCount();
        
        // Database size
        $stmt = $pdo->query("SELECT 
                            SUM(data_length + index_length) AS size 
                        FROM 
                            information_schema.TABLES 
                        WHERE 
                            table_schema = DATABASE()");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['db_size'] = $result['size'];
        
        // Get some key table counts
        $keyTables = ['weapon', 'armor', 'etcitem', 'npc', 'spawnlist', 'skills'];
        foreach ($keyTables as $table) {
            $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
            $stats[$table . '_count'] = $stmt->fetchColumn();
        }
        
        return $stats;
    } catch (PDOException $e) {
        return [];
    }
}

// Format file size
function formatFileSize($bytes) {
    if ($bytes > 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes > 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes > 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    }
    
    return $bytes . ' bytes';
}

// Log admin action
function logAdminAction($action, $details = '', $userId = null) {
    global $pdo;
    
    if (!$userId && isset($_SESSION['admin_user_id'])) {
        $userId = $_SESSION['admin_user_id'];
    }
    
    // If no log table exists, create it
    try {
        $createLogTable = "CREATE TABLE IF NOT EXISTS admin_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            action VARCHAR(255) NOT NULL,
            details TEXT,
            ip_address VARCHAR(45),
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($createLogTable);
        
        // Insert log entry
        $stmt = $pdo->prepare("INSERT INTO admin_log (user_id, action, details, ip_address) VALUES (:userId, :action, :details, :ip)");
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':action', $action);
        $stmt->bindValue(':details', $details);
        $stmt->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
        $stmt->execute();
        
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
?>