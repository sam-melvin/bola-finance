<?php
// force redirect!

use App\Models\User;
use App\Models\Wallet;

require 'bootstrap.php';

$wallet = new Wallet();

$balance = $wallet->getBalanceById($_POST['ids']);




echo $balance;

