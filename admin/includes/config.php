<?php
// admin/includes/config.php - Configuration file for admin section

// Include the main config file
// Use absolute path to avoid path issues
$mainConfigPath = dirname(dirname(__DIR__)) . '/includes/config.php';
if (file_exists($mainConfigPath)) {
    include_once $mainConfigPath;
} else {
    die('Error: Main configuration file not found at ' . $mainConfigPath);
}

// Define admin-specific constants
define('ADMIN_PATH', dirname(__DIR__));
define('ADMIN_URL', '/L1JR-Database/admin');

// Session management
session_start();

// Simple authentication check function
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . ADMIN_URL . '/login.php');
        exit;
    }
}

// Protect against CSRF attacks
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}

// Sanitize input function
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Helper function to display admin messages
function displayMessage($message, $type = 'info') {
    $_SESSION['admin_message'] = [
        'text' => $message,
        'type' => $type
    ];
}

// Function to get the message and clear it from session
function getAndClearMessage() {
    $message = isset($_SESSION['admin_message']) ? $_SESSION['admin_message'] : null;
    unset($_SESSION['admin_message']);
    return $message;
}
?>