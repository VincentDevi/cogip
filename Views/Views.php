<?php

namespace App\Views;

use App\Core\Render;

class Views
{
    /**
     * Render the provided view with the given parameters.
     *
     * @var $view, $data
     * return view
    */
    public function view($view, $data = [])
    {
        new Render($view, $data);
    }
}