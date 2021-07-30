<?php
require 'vendor/autoload.php';
use src\geth\newAccount;


$nodeUrl = "http://103.39.233.125:8643";
$keyPath = "/data/geth/keystore";
$num = 1000;
$obj = new newAccount($nodeUrl);
$obj->newAddress($keyPath,$num);