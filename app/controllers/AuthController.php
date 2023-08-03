<?php

namespace App\Controllers;

use App\Models\User;


class AuthController extends Controller
{

  public function showRegister()
  {
    $this->view('register');
  }
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = new User();
      $user->create($name, $email, $password);

      // Redirect or show success message
      $this->view('index');
    }
  }

  public function showLogin()
  {
    $this->view('login');
  }

  public function login()
  {
    // Implement login logic
  }


}