<?php
// force redirect!
// server should keep session data for AT LEAST 1 hour
// ini_set('session.gc_maxlifetime', 3600);

// // each client should remember their session id for EXACTLY 1 hour
// session_set_cookie_params(3600);



if (!isset($_POST['user_name']) and !isset($_POST['man_pass'])) {
    header('Location: ./');
}

use App\Models\User;
use App\Models\UsersAccess;

require 'bootstrap.php';

$requestData = [
    'code' => sanitize($_POST['user_name'], true),
    'passwd' => sanitize($_POST['man_pass'], true)
];

$user = User::where('username', $requestData['code'])
    // ->where('password', $requestData['passwd'])
    ->where(function ($query) {
        $query->where('type', USER_FINANCE);
    })
    ->first();
/**
 * check if valid user dddd
 */
$pass = password_verify($requestData['passwd'],$user->password);
$path = '';

if ($user && $pass == 1) {
    $_SESSION = [
        'uid' => $user->id,
        'code' => $user->code,
        'fname' => $user->full_name,
        'uname' => $user->username,
        'pass' => $requestData['passwd'], // temporarily disable tis field from session
        'email' => $user->email,
        'phone_no' => $user->phone_no,
        'gcash_no' => $user->gcash_no,
        'type' => $user->type,
        'loc' => $user->assign_location,

    ];

    /**
     * save user access information
     */
    $userAccess = UsersAccess::create([
        'user_id' => $user->id,
        'username' => $user->username,
        'full_name' => $user->full_name,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'agent' => $_SERVER['HTTP_USER_AGENT'],
        'type' => 'signin',
        'page' => 'signin page'
    ]);

    $userOnline = User::where('id', $user->id)->update(array('isOnline' => '1'));

    echo 'success';
} else {
    echo 'error';
}
