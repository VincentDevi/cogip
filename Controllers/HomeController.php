<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        new Render('welcome.html.twig', ['name' => 'Jean-Christian']);
    }
}