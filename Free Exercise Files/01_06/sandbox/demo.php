<?php
/**
 * @file
 * Sandbox for demonstration.
 */

// Set error reporting.
error_reporting(E_ALL | E_STRICT);
// Display errors.
ini_set('display_errors', 1);
// Log errors.
ini_set('log_errors', 1);
// No error log message max.
ini_set('log_errors_max_len', 0);
// Specify log file.
ini_set('error_log', '/media/sf_sandbox/php_errors.log');

register_shutdown_function('shutdown_notify');

/**
 * Send a notification on a shutdown caused by an error.
 */
function shutdown_notify() {
    $error = error_get_last();
    if (!empty($error) && in_array($error['type'], array(E_ERROR, E_USER_ERROR))) {
        echo '<h1>Sorry, something went horribly wrong; the team has been notified.</h1>';
        $to = 'user@example.com';
        $subject = "[{$_SERVER['SERVER_NAME']}] Fatal error in {$error['file']} on line {$error['line']}";
        $message = var_export($error, TRUE) . PHP_EOL;
        $message .= var_export($_SERVER, TRUE) . PHP_EOL;
        //mail($to, $subject, $message);
    }
}

trigger_error('Custom notice', E_USER_NOTICE);
trigger_error('Custom warning', E_USER_WARNING);
trigger_error('Custom error', E_USER_ERROR);
echo 'will not execute';