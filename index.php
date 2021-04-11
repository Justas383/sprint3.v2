<?php
ob_start();

require_once "./bootstrap.php";

$request = $_SERVER['REQUEST_URI'];

$rootDir = '/sprint3.v2';

switch ($request) {
    case $rootDir:
    case $rootDir . '/':
    case $rootDir . '/?tweetId=' . $_GET['tweetId']:
        require __DIR__ . '/src/views/homePage.php';
        break;
    case $rootDir . '/admin':
    case $rootDir . '/admin?action=logout':
        require __DIR__ . '/src/views/admin.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/src/views/404.php';
        break;
}