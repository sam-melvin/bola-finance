<?php
date_default_timezone_set('Asia/Manila');
/**
 * Define Application paths and constants here
 *
 */

/*
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('APP')) {
    define('APP', getcwd());
}

/*
 * The full path to the directory which holds "src", WITHOUT a trailing DS.
 */
define('ROOT', dirname(__DIR__));

/**
 * Page location constants
 */
define('PAGE_LOCATION_INDEX', 'index');
define('PAGE_LOCATION_LOGIN', 'login');


/**
 * SESSION constants
 */
define('SESSION_UID', 'uid');
define('SESSION_CODE', 'code');
define('SESSION_TYPE', 'type');
define('SESSION_UNAME', 'uname');
define('SESSION_PASS', 'pass');
// define('SESSION_COMMISSIONT_RATE', 'com_rate');

/**
 * User types
 */
define('USER_ADMIN', '1');
define('USER_STAFF', '2');
define('USER_LOADER', '3');
define('USER_INVESTOR', '4');
define('USER_FINANCE', '5');
define('USER_BPO', '6');
define('USER_SUPERADMIN', '7');

/**
 * date today
 */
define('DATE_TODAY', date("Y-m-d"));
