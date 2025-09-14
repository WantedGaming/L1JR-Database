<?php
// Include configuration and header
require_once '../includes/config.php';
require_once '../includes/header.php';

// Get filter parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$access_level = isset($_GET['access_level']) ? $_GET['access_level'] : 'all';

// Build SQL query with filters
$sql = "SELECT * FROM commands WHERE 1=1";
$params = array();
$types = "";

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $search_term = "%" . $search . "%";
    $params[] = $search_term;
    $params[] = $search_term;
    $types .= "ss";
}

if ($access_level !== 'all') {
    $sql .= " AND access_level = ?";
    $params[] = $access_level;
    $types .= "i";
}

// Get total count for pagination
$count_sql = "SELECT COUNT(*) FROM commands WHERE 1=1";
$count_params = array();
$count_types = "";

if (!empty($search)) {
    $count_sql .= " AND (name LIKE ? OR description LIKE ?)";
    $count_params[] = "%" . $search . "%";
    $count_params[] = "%" . $search . "%";
    $count_types .= "ss";
}

if ($access_level !== 'all') {
    $count_sql .= " AND access_level = ?";
    $count_params[] = $access_level;
    $count_types .= "i";
}

$count_stmt = $pdo->prepare($count_sql);
if (!empty($count_params)) {
    $count_stmt->execute($count_params);
} else {
    $count_stmt->execute();
}
$total_commands = $count_stmt->fetchColumn();

// Pagination settings
$commands_per_page = 15;
$total_pages = ceil($total_commands / $commands_per_page);
$current_page = isset($_GET['page']) ? max(1, min($total_pages, intval($_GET['page']))) : 1;
$offset = ($current_page - 1) * $commands_per_page;

// Apply pagination to the query (without adding to params array)
$sql .= " LIMIT $commands_per_page OFFSET $offset";

// Prepare and execute the query
$stmt = $pdo->prepare($sql);

if (!empty($params)) {
    $stmt->execute($params);
} else {
    $stmt->execute();
}

// Fetch paginated commands
$commands = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <div class="hero-content">
        <h1>Game Commands</h1>
        <p>Complete list of available in-game commands and their access levels</p>
    </div>
</section>

<section class="detail-container">
    <div class="container">
        <!-- Filter Form -->
        <div class="filters-section">
            <form class="filter-form" method="GET" action="">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="searchCommand">Search Command</label>
                        <input type="text" id="searchCommand" name="search" placeholder="Type command name or description..." 
                               value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="filter-group">
                        <label for="accessLevel">Access Level</label>
                        <select id="accessLevel" name="access_level">
                            <option value="all" <?php echo $access_level === 'all' ? 'selected' : ''; ?>>All Levels</option>
                            <option value="0" <?php echo $access_level === '0' ? 'selected' : ''; ?>>GM Level 0</option>
                            <option value="1" <?php echo $access_level === '1' ? 'selected' : ''; ?>>GM Level 1</option>
                            <option value="2" <?php echo $access_level === '2' ? 'selected' : ''; ?>>GM Level 2</option>
                            <option value="3" <?php echo $access_level === '3' ? 'selected' : ''; ?>>GM Level 3</option>
                            <option value="4" <?php echo $access_level === '4' ? 'selected' : ''; ?>>GM Level 4</option>
                            <option value="5" <?php echo $access_level === '5' ? 'selected' : ''; ?>>GM Level 5</option>
                            <option value="9999" <?php echo $access_level === '9999' ? 'selected' : ''; ?>>Player Commands</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="filter-btn">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                        <a href="commands.php" class="filter-btn reset-btn">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Info -->
        <div style="margin-bottom: 1rem; color: #ccc;">
            <?php 
            $start_result = ($current_page - 1) * $commands_per_page + 1;
            $end_result = min($current_page * $commands_per_page, $total_commands);
            echo "Showing $start_result - $end_result of $total_commands commands";
            ?>
        </div>

        <!-- Commands Table -->
        <div class="commands-list-container">
            <table class="weapons-table clickable-rows">
                <thead>
                    <tr>
                        <th>Command</th>
                        <th>Access Level</th>
                        <th>Class Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($commands) > 0): ?>
                        <?php foreach ($commands as $command): ?>
                            <tr class="clickable">
                                <td class="command-name"><?php echo htmlspecialchars($command['name']); ?></td>
                                <td>
                                    <?php
                                    $cmd_access_level = $command['access_level'];
                                    $level_class = 'player';
                                    $level_text = 'Player';
                                    
                                    if ($cmd_access_level < 9999) {
                                        $level_class = 'gm' . $cmd_access_level;
                                        $level_text = 'GM Level ' . $cmd_access_level;
                                    }
                                    ?>
                                    <span class="access-level <?php echo $level_class; ?>"><?php echo $level_text; ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($command['class_name']); ?></td>
                                <td><?php echo htmlspecialchars($command['description']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem;">
                                No commands found matching your criteria.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?page=1<?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $access_level !== 'all' ? '&access_level=' . $access_level : ''; ?>" 
                       class="pagination-link">First</a>
                    <a href="?page=<?php echo $current_page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $access_level !== 'all' ? '&access_level=' . $access_level : ''; ?>" 
                       class="pagination-link">Previous</a>
                <?php endif; ?>

                <?php
                // Show page numbers
                $start_page = max(1, $current_page - 2);
                $end_page = min($total_pages, $start_page + 4);
                
                if ($end_page - $start_page < 4) {
                    $start_page = max(1, $end_page - 4);
                }
                
                for ($i = $start_page; $i <= $end_page; $i++):
                ?>
                    <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $access_level !== 'all' ? '&access_level=' . $access_level : ''; ?>" 
                       class="pagination-link <?php echo $i == $current_page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $access_level !== 'all' ? '&access_level=' . $access_level : ''; ?>" 
                       class="pagination-link">Next</a>
                    <a href="?page=<?php echo $total_pages; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $access_level !== 'all' ? '&access_level=' . $access_level : ''; ?>" 
                       class="pagination-link">Last</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.access-level {
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
    font-weight: bold;
    font-size: 0.85rem;
}

.access-level.player {
    background-color: #4ecdc4;
    color: #000;
}

.access-level.gm0 {
    background-color: #ff6b6b;
    color: #fff;
}

.access-level.gm1 {
    background-color: #ff9e6b;
    color: #000;
}

.access-level.gm2 {
    background-color: #ffca6b;
    color: #000;
}

.access-level.gm3 {
    background-color: #f7ff6b;
    color: #000;
}

.access-level.gm4 {
    background-color: #b6ff6b;
    color: #000;
}

.access-level.gm5 {
    background-color: #6bff8d;
    color: #000;
}

.command-name {
    font-weight: bold;
    color: var(--accent);
}
</style>

<script>
// JavaScript for filtering and interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Make rows clickable (for potential future detail views)
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', () => {
            const command = row.querySelector('.command-name').textContent;
            alert(`Details for command: ${command}\nThis could open a detailed view in the future.`);
        });
    });
    
    // Add some interactivity to the filter form
    const filterForm = document.querySelector('.filter-form');
    const searchInput = document.getElementById('searchCommand');
    const accessLevelSelect = document.getElementById('accessLevel');
    
    // Auto-submit when access level changes
    accessLevelSelect.addEventListener('change', function() {
        filterForm.submit();
    });
    
    // Debounced search
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterForm.submit();
        }, 500);
    });
});
</script>

<?php
// Include footer
require_once '../includes/footer.php';
?>