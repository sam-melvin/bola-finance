<?php
// force redirect!

use App\Models\User;
use App\Models\UserCash;

require 'bootstrap.php';

$usercash = new UserCash();

$balance = $usercash->getBalanceById($_POST['ids']);




echo $balance;

