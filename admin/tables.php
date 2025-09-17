<?php
// admin/tables.php - Database Tables Management
require_once 'includes/functions.php';
include_once 'includes/header.php';

// Get the list of tables
$tables = getDatabaseTables();

// Group tables by type for easier navigation
$tableGroups = [];
foreach ($tables as $table) {
    // Extract the first part of the table name for grouping
    $parts = explode('_', $table);
    $group = $parts[0];
    
    if (!isset($tableGroups[$group])) {
        $tableGroups[$group] = [];
    }
    
    $tableGroups[$group][] = $table;
}

// Sort table groups alphabetically
ksort($tableGroups);
?>

<div class="admin-tables">
    <h1 class="admin-section-title">Database Tables</h1>
    
    <!-- Search and Filter Form -->
    <div class="admin-filters">
        <form method="get" action="tables.php">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="search" class="form-label">Search Tables</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Table name..." 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="group" class="form-label">Filter by Group</label>
                    <select id="group" name="group" class="form-control">
                        <option value="">All Groups</option>
                        <?php foreach (array_keys($tableGroups) as $group): ?>
                        <option value="<?php echo $group; ?>" <?php echo isset($_GET['group']) && $_GET['group'] === $group ? 'selected' : ''; ?>>
                            <?php echo ucfirst($group); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="sort" class="form-label">Sort By</label>
                    <select id="sort" name="sort" class="form-control">
                        <option value="name_asc" <?php echo (!isset($_GET['sort']) || $_GET['sort'] === 'name_asc') ? 'selected' : ''; ?>>Name (A-Z)</option>
                        <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'name_desc') ? 'selected' : ''; ?>>Name (Z-A)</option>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="admin-btn admin-btn-primary">Apply Filters</button>
                    <a href="tables.php" class="admin-btn admin-btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Tables List -->
    <div class="admin-section">
        <?php
        // Apply search filter
        $searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
        $groupFilter = isset($_GET['group']) ? trim($_GET['group']) : '';
        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
        
        // Filter the table groups based on search and group
        $filteredGroups = [];
        
        foreach ($tableGroups as $group => $groupTables) {
            // Skip if group filter is set and doesn't match
            if (!empty($groupFilter) && $group !== $groupFilter) {
                continue;
            }
            
            // Filter tables by search term
            $filteredTables = [];
            foreach ($groupTables as $table) {
                if (empty($searchTerm) || strpos(strtolower($table), $searchTerm) !== false) {
                    $filteredTables[] = $table;
                }
            }
            
            // Only add the group if it has tables after filtering
            if (!empty($filteredTables)) {
                $filteredGroups[$group] = $filteredTables;
            }
        }
        
        // Sort the filtered tables based on sort order
        if ($sortOrder === 'name_desc') {
            // Sort each group's tables in descending order
            foreach ($filteredGroups as $group => $tables) {
                rsort($filteredGroups[$group]);
            }
            // Sort the groups in descending order
            krsort($filteredGroups);
        } else {
            // Sort each group's tables in ascending order
            foreach ($filteredGroups as $group => $tables) {
                sort($filteredGroups[$group]);
            }
            // Sort the groups in ascending order
            ksort($filteredGroups);
        }
        
        if (empty($filteredGroups)): 
        ?>
        <div class="no-results">
            <p>No tables found matching your search criteria.</p>
        </div>
        <?php else: ?>
        
        <?php foreach ($filteredGroups as $group => $groupTables): ?>
        <div class="collapse-section">
            <div class="collapse-header">
                <h3 class="collapse-title"><?php echo ucfirst($group); ?> Tables (<?php echo count($groupTables); ?>)</h3>
                <span class="collapse-icon">▼</span>
            </div>
            <div class="collapse-content">
                <div class="table-preview">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Table Name</th>
                                <th>Record Count</th>
                                <th class="action-col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($groupTables as $table): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($table); ?></td>
                                <td><?php echo number_format(countRecords($table)); ?></td>
                                <td class="action-col">
                                    <div class="action-buttons">
                                        <a href="view_table.php?table=<?php echo urlencode($table); ?>" class="action-btn action-btn-view">View</a>
                                        <a href="edit_table.php?table=<?php echo urlencode($table); ?>" class="action-btn action-btn-edit">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php endif; ?>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>