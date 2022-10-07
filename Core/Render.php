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

        $twig = new Environment($loader, [
            'debug' => true,
        ]);

        $twig->addExtension(new DebugExtension());

//        $data['root'] = $this->getRoot();

        $data['root'] = getRoot();
        $data['user'] = getCurrentUser();

        echo $twig->render($templateFile, $data);
    }

//    /**
//     * Return the root of the project provided in dbSettings.php.
//     * It's the local path of public folder.
//     *
//     * @return string
//     */
//    private function getRoot(): string
//    {
//        // If it's a 404 page, dbSettings are not already loaded,
//        // and is not defined, so we require it.
//        if (!defined("HOST_SITE")) {
//            require_once '../models/dbSettings.php';
//        }
//
//        return HOST_SITE;
//    }
}