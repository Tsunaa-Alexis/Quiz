<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdvertController
{
  public function index()
  {
    $content = "Notre propre Hello World !";

    return new Response($content);
  }
}