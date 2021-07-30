<?php
require 'vendor/autoload.php';
use src\geth\newAccount;

$obj = new newAccount();
$obj->newAddress();