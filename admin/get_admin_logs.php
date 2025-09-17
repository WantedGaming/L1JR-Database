<?php
// admin/get_admin_logs.php - AJAX endpoint for fetching admin logs
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Ensure user is logged in
if (!isLoggedIn()) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Get filter type if provided
$filterType = isset($_GET['type']) ? $_GET['type'] : '';

// Validate filter type
$validFilters = ['login', 'add', 'edit', 'delete'];
if (!empty($filterType) && !in_array($filterType, $validFilters)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid filter type']);
    exit;
}

// Check if admin_log table exists
$tableExists = false;
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_log'");
    $tableExists = $stmt->rowCount() > 0;
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database error']);
    exit;
}

// If table doesn't exist, create it
if (!$tableExists) {
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
        $tableExists = true;
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to create log table']);
        exit;
    }
}

// Get logs
$logs = [];
if ($tableExists) {
    try {
        $whereClause = '';
        $params = [];
        
        // Apply filter if specified
        if (!empty($filterType)) {
            $whereClause = "action LIKE :filter";
            $params[':filter'] = '%' . $filterType . '%';
        }
        
        // Build query
        $sql = "SELECT * FROM admin_log";
        if (!empty($whereClause)) {
            $sql .= " WHERE $whereClause";
        }
        $sql .= " ORDER BY timestamp DESC LIMIT 50";
        
        $stmt = $pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error retrieving logs']);
        exit;
    }
}

// Return logs as JSON
header('Content-Type: application/json');
echo json_encode($logs);
?>