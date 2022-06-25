<?php

use App\Models\User;
use App\Models\UsersAccess;
require '../bootstrap.php';


$loggedUser = User::find($_SESSION[SESSION_UID]);

$userAccess = UsersAccess::create([
	'user_id' => $loggedUser->id,
	'username' => $loggedUser->username,
	'full_name' => $loggedUser->full_name,
	'ip_address' => $_SERVER['REMOTE_ADDR'],
	'agent' => $_SERVER['HTTP_USER_AGENT'],
	'type' => 'sign out',
	'page' => 'sign out page',
	'last_page' => $_SESSION['last_page']
  ]);

  $userOffline = User::where('id', $loggedUser->id)->update(array('isOnline' => '0'));

	session_unset();
	session_destroy();
?>
	<script>location.replace("../login.php");</script>