<?php
// admin/login.php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Check if already logged in
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Default credentials (in a real application, use a database)
$adminUsername = 'admin';
$adminPassword = 'admin123'; // Should be hashed in production

// Process login form
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Validate login credentials (in a real application, check against database)
    if ($username === $adminUsername && $password === $adminPassword) {
        // Set session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_user_id'] = 1; // Default admin ID
        
        // Log the login action
        logAdminAction('login', 'Admin logged in');
        
        // Redirect to admin dashboard
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
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
    <title>Admin Login - L1J Database</title>
    <!-- Admin-specific CSS -->
    <link rel="stylesheet" href="<?php echo $admin_base_url; ?>/assets/css/admin.css">
    <!-- Common CSS from main site -->
    <link rel="stylesheet" href="<?php echo $protocol . $host; ?>/L1JR-Database/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" href="<?php echo $protocol . $host; ?>/L1JR-Database/assets/img/favicon/favicon.png" type="image/png">
</head>
<body class="admin-body">
    <div class="admin-container">
        <div class="login-container">
            <div class="login-logo">
                <a href="<?php echo $protocol . $host; ?>/L1JR-Database/index.php">
                    <h1 class="logo">L1J Database <span class="admin-tag">Admin</span></h1>
                </a>
            </div>
            
            <h2 class="login-title">Administrator Login</h2>
            
            <?php if (!empty($error)): ?>
            <div class="admin-message admin-message-danger">
                <?php echo $error; ?>
                <span class="close-message">&times;</span>
            </div>
            <?php endif; ?>
            
            <form class="login-form" method="post" action="login.php">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="login-btn">Log In</button>
            </form>
            
            <div class="back-to-site" style="margin-top: 2rem; text-align: center;">
                <a href="<?php echo $protocol . $host; ?>/L1JR-Database/index.php">
                    Back to Main Site
                </a>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for message dismissal -->
    <script>
        // Message dismissal
        document.addEventListener('DOMContentLoaded', function() {
            var closeButtons = document.querySelectorAll('.close-message');
            closeButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    this.parentNode.style.display = 'none';
                });
            });
            
            // Auto-hide messages after 5 seconds
            setTimeout(function() {
                var messages = document.querySelectorAll('.admin-message');
                messages.forEach(function(msg) {
                    msg.style.display = 'none';
                });
            }, 5000);
        });
    </script>
</body>
</html>