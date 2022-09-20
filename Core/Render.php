<?php

namespace App\Core;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


/**
 * Render the provided page template with provided data's.
 * Provided template must not contain the .html.twig extension.
 */
class Render
{
    public function __construct($page, $data = [])
    {
        $templateFile = $page.'.html.twig';

        $loader = new FilesystemLoader(__ROOT__.'/templates');
//        $twig = new Environment($loader, [
//            'cache' => __ROOT__.'/cache',
//        ]);
        $twig = new Environment($loader);

        echo $twig->render($templateFile, $data);
    }
}

