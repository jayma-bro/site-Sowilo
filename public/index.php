<?php
require_once '../vendor/autoload.php';
session_start();
$router = new AltoRouter();
$sidebar = false;
$_SESSION['id'] = false;
require '../routes.php';
