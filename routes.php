<?php
require_once '../vendor/autoload.php';
$router->map('GET|POST', '/', 'home', 'home');
$router->map('GET|POST', '/contact', 'contact', 'contact');
$router->map('GET|POST', '/a_propos', 'a_propos', 'a_propos');
$router->map('GET|POST', '/le_jeu', 'le_jeu', 'le_jeu');
$router->map('GET|POST', '/leaderboard', 'leaderboard', 'leaderboard');
$router->map('GET|POST', '/calendrier', 'calendrier', 'calendrier');
$router->map('GET|POST', '/livre_dor', 'livre_dor', 'livre_dor');
$router->map('GET|POST', '/signin', 'signin', 'signin');
$router->map('GET|POST', '/login', 'login', 'login');
$match = $router->match();
if ($match != null) {
  require "templates/{$match['target']}.php";
}
