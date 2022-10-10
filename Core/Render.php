<?php

namespace App\Core;
use Twig\Environment;
use Twig\Extension\DebugExtension;
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
        // todo: make cache working
//        $twig = new Environment($loader, [
//            'cache' => __ROOT__.'/cache',
//        ]);

        // allow dump() in Twig.
        $twig = new Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());

        // add user accessible to all TWIG templates.
        $data['user'] = getCurrentUser();

        // sanitize before render to avoid XSS attack.
        $data = sanitizeArray($data);

        $data['root'] = getRoot();

        echo $twig->render($templateFile, $data);
    }

}