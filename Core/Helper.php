<?php

/*
* ------------------------------------------------------------------------
* Define all the constants
*/

define('__ROOT__', dirname(dirname(__FILE__)));
/**
 * ------------------------------------------------------------------------
 * Display errors
 */

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


/**
 * ------------------------------------------------------------------------
 * redirect Helper
 * Redirect the dashboard to a given url
 */
if(! function_exists('redirect'))
{
    function redirect(string $url)
    {
        header('Location:'.$url);
    }
}

/**
 * ------------------------------------------------------------------------
 * dd Helper
 * Outputs the given variable(s) with formatting and location
 * @access    public
 * @param    mixed    - variables to be output
 */
if ( ! function_exists('dd'))
{
    function dd()
    {
        list($callee) = debug_backtrace();

        $args = func_get_args();

        $total_args = func_num_args();

        echo '<div><fieldset style="background: #fefefe !important; border:1px red solid; padding:15px">';
        echo '<legend style="background:blue; color:white; padding:5px;">'.$callee['file'].' @line: '.$callee['line'].'</legend><pre><code>';

        $i = 0;

        foreach ($args as $arg)
        {
            echo '<strong>Debug #' . ++$i . ' of ' . $total_args . '</strong>: ' . '<br>';

            var_dump($arg);
        }

        echo "</code></pre></fieldset><div><br>";
    }
}

/**
 * Return formatted today date.
 *
 * @return string
 */
if ( ! function_exists('todayDate'))
{
    function todayDate()
    {
        return date('Y-m-d');
    }
}

/**
 * Remove duplicate rows from a provided 2 dimensional array.
 * https://stackoverflow.com/questions/3598298/php-remove-duplicate-values-from-multidimensional-array
 *
 * @param $array
 * @return array
 */
function removeDuplicateRows($array)
{
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value)
    {
        if ( is_array($value) )
        {
            $result[$key] = removeDuplicateRows($value);
        }
    }

    return $result;
}

/**
 * Return the root of the project provided in dbSettings.php.
 * It's the local path of public folder.
 *
 * @return string
 */
function getRoot(): string
{
    // If it's a 404 page, dbSettings are not already loaded,
    // and is not defined, so we require it.
    if (!defined("HOST_SITE")) {
        require_once '../models/dbSettings.php';
    }

    return HOST_SITE;
}

function getUrlLastElement():string{
    $url = $_SERVER['REQUEST_URI'];
    $array = explode("/",$url);
    return $array[count($array)-1];

}

function getCurrentUser() {
    if (isset($_SESSION['firstname']) && isset($_SESSION['name'])) {
        return $_SESSION["firstname"]." ".$_SESSION["name"];
    } else {
        return "";
    }
}