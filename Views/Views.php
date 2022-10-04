<?php

namespace App\Views;

use App\Core\Render;

class Views
{
        /*
    * @var $view, $data
    * return view
    */
    public function view($view, $data = [])
    {
        new Render($view, $data);
    }
}