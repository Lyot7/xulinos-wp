<?php
/**
 * WordPress configuration for production environment
 * This file uses environment variables for configuration
 */

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Database settings
define('DB_NAME', $_ENV['DB_NAME'] ?? 'wordpress');
define('DB_USER', $_ENV['DB_USER'] ?? 'wordpress');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? '');
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Security keys
define('AUTH_KEY', $_ENV['AUTH_KEY'] ?? 'put your unique phrase here');
define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY'] ?? 'put your unique phrase here');
define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY'] ?? 'put your unique phrase here');
define('NONCE_KEY', $_ENV['NONCE_KEY'] ?? 'put your unique phrase here');
define('AUTH_SALT', $_ENV['AUTH_SALT'] ?? 'put your unique phrase here');
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] ?? 'put your unique phrase here');
define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT'] ?? 'put your unique phrase here');
define('NONCE_SALT', $_ENV['NONCE_SALT'] ?? 'put your unique phrase here');

// WordPress URLs
if (isset($_ENV['WP_HOME'])) {
    define('WP_HOME', $_ENV['WP_HOME']);
}
if (isset($_ENV['WP_SITEURL'])) {
    define('WP_SITEURL', $_ENV['WP_SITEURL']);
}

// Table prefix
$table_prefix = $_ENV['TABLE_PREFIX'] ?? 'wp_';

// Debug settings
define('WP_DEBUG', filter_var($_ENV['WP_DEBUG'] ?? 'false', FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_LOG', filter_var($_ENV['WP_DEBUG_LOG'] ?? 'false', FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_DISPLAY', filter_var($_ENV['WP_DEBUG_DISPLAY'] ?? 'false', FILTER_VALIDATE_BOOLEAN));

// Security settings for production
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);
define('FORCE_SSL_ADMIN', true);

// Memory limit
define('WP_MEMORY_LIMIT', '256M');

// Absolute path to the WordPress directory
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Sets up WordPress vars and included files
require_once ABSPATH . 'wp-settings.php';
