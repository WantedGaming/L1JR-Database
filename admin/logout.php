<?php
// admin/logout.php
require_once 'includes/config.php';

// Check if logged in
if (isLoggedIn()) {
    // Log the logout action
    logAdminAction('logout', 'Admin logged out');
    
    // Clear session data
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
}

// Redirect to login page
header('Location: login.php');
exit;
?>