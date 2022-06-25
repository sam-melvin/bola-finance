<?php
/**
 * Application Helpers can be added here
 *
 *
 */

/**
 * Validate CSRF token from forms
 * @param string $token
 * @param App\Models\User $user
 * @return bool
 */
function verifyToken($token, $user, $options =[])
{
    $salt = 'bluesClues09';
    $items = [
        $salt,
        $user->user_id_code,
        $user->full_name
    ];
    
    if (!empty($options)) {
        $items = array_merge($items, $options);
    }

    $key = implode('-', $items);

    return password_verify($key, $token);
}


/**
 * Generate CSRF token for forms
 * @param App\Models\User $user
 * @return string
 */
function generateToken($user, $options = [])
{
    $salt = 'bluesClues09';
    $items = [
        $salt,
        $user->user_id_code,
        $user->full_name
    ];

    if (!empty($options)) {
        $items = array_merge($items, $options);
    }

    $key = implode('-', $items);

    return password_hash($key, PASSWORD_BCRYPT);
}


/**
 * Sanitize a given string
 * @param string $value
 * @param type $stripSlashes
 * @return string
 */
function sanitize(string $value, $stripSlashes = false): string
{
    if ($stripSlashes) {
        $value = stripslashes($value);
    }

    return htmlentities($value, ENT_QUOTES, 'UTF-8');
}


/**
 * Check if key is in session then redirect to location according to the location
 * key
 *
 * @param string $key
 * @param string $locKey
 * @return void
 */
function checkSessionRedirect(string $key, string $locKey):void
{
    $location = getPageLocation($locKey);

    if (!isset($_SESSION[$key])) {
        header($location);
        exit;
    }
}


function checkCurUserIsAllow(string $pagenum, string $userKey):void
{
   
    if ($pagenum != $userKey) {
        exit(header('Location: func/logout.php'));
    }
}

/**
 * Checks if a user is logged-in currently in a session
 * @return void
 */
function checkIfUserLoggedIn(): void
{
    $location = '';
    if(isset($_SESSION[SESSION_UID])) {
        
        $location = getPageLocation(PAGE_LOCATION_INDEX);
        header($location);
        exit;
    }
    
    

    // if (isset($_SESSION[SESSION_UID])) {
        
    // }
}


/**
 * get page location according to key
 * @param string $location
 * @return string
 */
function getPageLocation($location): string
{
    $loc = '';
    switch ($location) {
        case PAGE_LOCATION_INDEX:
            $loc = 'Location: ./';
            break;
        case PAGE_LOCATION_LOGIN:
            $loc = 'Location: login.php';
            break;
    }

    return $loc;
}

/**
 * Die debug
 * @param mixed $value
 */
function dd($content): void
{
    echo '<pre>';
    print_r($content);
    echo '</pre>';
    exit;
}


/**
 * Dump values
 * @param mixed $content
 * @return void
 */
function dump($content): void
{
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}