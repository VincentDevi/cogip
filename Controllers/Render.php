<?php

namespace App\Controllers;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Render
{
    public function __construct($page, $data)
    {
        $loader = new FilesystemLoader('./templates');
//        $twig = new Environment($loader, [
//            'cache' => './cache',
//        ]);

        $twig = new Environment($loader);

        echo $twig->render($page, $data);

//        echo $twig->render('test.html.twig', ['name' => 'Toto']);
    }
}

