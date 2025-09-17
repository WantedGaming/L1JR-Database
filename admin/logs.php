<?php
// admin/logs.php - Admin Logs Viewer
require_once 'includes/functions.php';
include_once 'includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Check if admin_log table exists
$tableExists = false;
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_log'");
    $tableExists = $stmt->rowCount() > 0;
} catch (PDOException $e) {
    displayMessage('Error checking for admin log table: ' . $e->getMessage(), 'danger');
}

// If table doesn't exist, create it
if (!$tableExists) {
    try {
        $createLogTable = "CREATE TABLE admin_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            action VARCHAR(255) NOT NULL,
            details TEXT,
            ip_address VARCHAR(45),
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($createLogTable);
        displayMessage('Admin log table created successfully.', 'success');
        $tableExists = true;
    } catch (PDOException $e) {
        displayMessage('Error creating admin log table: ' . $e->getMessage(), 'danger');
    }
}

// Get logs if table exists
$logs = [];
$totalLogs = 0;

if ($tableExists) {
    try {
        // Apply filters if provided
        $whereClause = '';
        $params = [];
        
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $whereClause .= "action LIKE :action";
            $params[':action'] = '%' . $_GET['action'] . '%';
        }
        
        if (isset($_GET['from_date']) && !empty($_GET['from_date'])) {
            if (!empty($whereClause)) $whereClause .= " AND ";
            $whereClause .= "timestamp >= :from_date";
            $params[':from_date'] = $_GET['from_date'] . ' 00:00:00';
        }
        
        if (isset($_GET['to_date']) && !empty($_GET['to_date'])) {
            if (!empty($whereClause)) $whereClause .= " AND ";
            $whereClause .= "timestamp <= :to_date";
            $params[':to_date'] = $_GET['to_date'] . ' 23:59:59';
        }
        
        // Count total logs for pagination
        $countSql = "SELECT COUNT(*) FROM admin_log";
        if (!empty($whereClause)) {
            $countSql .= " WHERE " . $whereClause;
        }
        
        $countStmt = $pdo->prepare($countSql);
        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value);
        }
        $countStmt->execute();
        $totalLogs = $countStmt->fetchColumn();
        
        // Get logs with pagination
        $logsSql = "SELECT * FROM admin_log";
        if (!empty($whereClause)) {
            $logsSql .= " WHERE " . $whereClause;
        }
        $logsSql .= " ORDER BY timestamp DESC LIMIT :limit OFFSET :offset";
        
        $logsStmt = $pdo->prepare($logsSql);
        foreach ($params as $key => $value) {
            $logsStmt->bindValue($key, $value);
        }
        $logsStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $logsStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $logsStmt->execute();
        $logs = $logsStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        displayMessage('Error retrieving admin logs: ' . $e->getMessage(), 'danger');
    }
}

// Calculate pagination
$totalPages = ceil($totalLogs / $limit);
?>

<div class="admin-logs">
    <h1 class="admin-section-title">Admin Activity Logs</h1>
    
    <!-- Filters -->
    <div class="admin-filters">
        <form method="get" action="logs.php">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="action" class="form-label">Action Type</label>
                    <input type="text" id="action" name="action" class="form-control" placeholder="e.g., login, edit, delete" 
                           value="<?php echo isset($_GET['action']) ? htmlspecialchars($_GET['action']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" id="from_date" name="from_date" class="form-control"
                           value="<?php echo isset($_GET['from_date']) ? htmlspecialchars($_GET['from_date']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" id="to_date" name="to_date" class="form-control"
                           value="<?php echo isset($_GET['to_date']) ? htmlspecialchars($_GET['to_date']) : ''; ?>">
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="admin-btn admin-btn-primary">Apply Filters</button>
                    <a href="logs.php" class="admin-btn admin-btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Logs Table -->
    <div class="admin-section">
        <?php if (empty($logs)): ?>
        <div class="no-results">
            <p>No activity logs found.</p>
        </div>
        <?php else: ?>
        <div class="table-preview">
            <div class="table-preview-header">
                <h3 class="table-preview-title">Activity Logs</h3>
                <div class="table-metadata">
                    <div class="metadata-item">
                        <span class="metadata-label">Total Logs:</span>
                        <span class="metadata-value"><?php echo number_format($totalLogs); ?></span>
                    </div>
                </div>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Action</th>
                        <th>Details</th>
                        <th>IP Address</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo $log['id']; ?></td>
                        <td><?php echo $log['user_id']; ?></td>
                        <td><?php echo htmlspecialchars($log['action']); ?></td>
                        <td><?php echo htmlspecialchars($log['details']); ?></td>
                        <td><?php echo htmlspecialchars($log['ip_address']); ?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($log['timestamp'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <div class="admin-pagination">
                <?php if ($page > 1): ?>
                <a href="?page=1<?php echo isset($_GET['action']) ? '&action=' . urlencode($_GET['action']) : ''; ?><?php echo isset($_GET['from_date']) ? '&from_date=' . urlencode($_GET['from_date']) : ''; ?><?php echo isset($_GET['to_date']) ? '&to_date=' . urlencode($_GET['to_date']) : ''; ?>" class="pagination-item">First</a>
                <a href="?page=<?php echo $page - 1; ?><?php echo isset($_GET['action']) ? '&action=' . urlencode($_GET['action']) : ''; ?><?php echo isset($_GET['from_date']) ? '&from_date=' . urlencode($_GET['from_date']) : ''; ?><?php echo isset($_GET['to_date']) ? '&to_date=' . urlencode($_GET['to_date']) : ''; ?>" class="pagination-item">Previous</a>
                <?php endif; ?>
                
                <?php
                // Show up to 5 page links around the current page
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                // Show ellipsis for many pages
                if ($startPage > 1) {
                    echo '<span class="pagination-ellipsis">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++): 
                ?>
                <a href="?page=<?php echo $i; ?><?php echo isset($_GET['action']) ? '&action=' . urlencode($_GET['action']) : ''; ?><?php echo isset($_GET['from_date']) ? '&from_date=' . urlencode($_GET['from_date']) : ''; ?><?php echo isset($_GET['to_date']) ? '&to_date=' . urlencode($_GET['to_date']) : ''; ?>" class="pagination-item <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($endPage < $totalPages): ?>
                <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
                
                <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?><?php echo isset($_GET['action']) ? '&action=' . urlencode($_GET['action']) : ''; ?><?php echo isset($_GET['from_date']) ? '&from_date=' . urlencode($_GET['from_date']) : ''; ?><?php echo isset($_GET['to_date']) ? '&to_date=' . urlencode($_GET['to_date']) : ''; ?>" class="pagination-item">Next</a>
                <a href="?page=<?php echo $totalPages; ?><?php echo isset($_GET['action']) ? '&action=' . urlencode($_GET['action']) : ''; ?><?php echo isset($_GET['from_date']) ? '&from_date=' . urlencode($_GET['from_date']) : ''; ?><?php echo isset($_GET['to_date']) ? '&to_date=' . urlencode($_GET['to_date']) : ''; ?>" class="pagination-item">Last</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>