<?php

require_once '../app/controllers/Controller.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/models/Database.php';

$controller = new \App\Controllers\HomeController();

// Handle routing here

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if ($_SERVER['REQUEST_URI'] === '/login') {
    $authController = new \App\Controllers\AuthController();
    $authController->showLogin();
  } elseif ($_SERVER['REQUEST_URI'] === '/register') {
    $authController = new \App\Controllers\AuthController();
    $authController->showRegister();
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_SERVER['REQUEST_URI'] === '/register') {
    $authController = new \App\Controllers\AuthController();
    $authController->register();
  } elseif ($_SERVER['REQUEST_URI'] === '/create-tables') {
    $database = new \App\Models\Database();
    $database->createTables();
    echo 'Tables created successfully.';
  }
}