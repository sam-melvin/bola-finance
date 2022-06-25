<?php
/**
 * Load composer auto-loading
 */
require_once 'vendor/autoload.php';

/**
 * Set error reporting
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');


/**
 * Start the session
 */
session_start();


/**
 * Load application paths here
 */
require 'paths.php';

/**
 * Helpers
 */
require 'helpers.php';

/**
 * Load application database configurations for backward compatibility and grab
 * the set database configurations
 *
 * Then lets prepare the Eloquent library
 */
$dbConfig = (require('dbConfig.php'))['DataSources']['default'];

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    'driver' => $dbConfig['driver'],
    'host' => $dbConfig['host'],
    'database' => $dbConfig['database'],
    'username' => $dbConfig['username'],
    'password' => $dbConfig['password'],
]);

/**
 * make this capsule instance available globally
 * and setup the Eloquent ORM
 */
$capsule->setAsGlobal();
$capsule->bootEloquent();


/**
 * Set the default timezone
 */
date_default_timezone_set('Asia/Manila');
