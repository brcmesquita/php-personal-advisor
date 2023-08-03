<?php

namespace App\Controllers;

class Controller
{
  protected function view($view, $data = [])
  {
    extract($data);
    require_once "../views/{$view}.php";
  }
}