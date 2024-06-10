<?php

function view($page, $data = [])
{
    extract($data);
    include 'resources/views/' . $page . '.php';
}

class Router
{
    public static $urls = [];

    function __construct()
    {
        $url = implode(
            "/",
            array_filter(
                explode(
                    "/",
                    str_replace(
                        $_ENV['BASEDIR'],
                        "",
                        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                    )
                ),
                'strlen'
            )
        );

        if (!in_array($url, self::$urls['routes'])) {
            header('Location: ' . BASEURL);
        }

        $call = self::$urls[$_SERVER['REQUEST_METHOD']][$url];
        $call();
    }
    public static function url($url, $method, $callback)
    {
        if ($url == '/') {
            $url = '';
        }
        self::$urls[strtoupper($method)][$url] = $callback;
        self::$urls['routes'][] = $url;
        self::$urls['routes'] = array_unique(self::$urls['routes']);
    }
}

function urlpath($path)
{
    require_once 'app/config/static.php';
    return BASEURL . $path;
}

function setFlashMessage($type, $pesan)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'pesan' => $pesan
    ];

    return $_SESSION['flash'];
}

function displayFlashSuccess($message)
{
    echo '<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">';
    echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
    echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
    echo '</svg>';
    echo '<span class="sr-only">Info</span>';
    echo '<div class="ms-3 text-sm font-medium">';
    echo $message;
    echo '</div>';
    echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">';
    echo '<span class="sr-only">Close</span>';
    echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
    unset($_SESSION['flash']);
}

function displayFlashError($message)
{
    echo '<div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">';
    echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
    echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
    echo '</svg>';
    echo '<span class="sr-only">Info</span>';
    echo '<div class="ms-3 text-sm font-medium">';
    echo $message;
    echo '</div>';
    echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">';
    echo '<span class="sr-only">Close</span>';
    echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
    unset($_SESSION['flash']);
}

// function compressToWebP($source, $destination, $quality = 20)
// {
//     $info = getimagesize($source);
//     if ($info['mime'] == 'image/jpeg') {
//         $image = imagecreatefromjpeg($source);
//     } elseif ($info['mime'] == 'image/png') {
//         $image = imagecreatefrompng($source);
//     } else {
//         return false;
//     }
//     imagepalettetotruecolor($image);
//     return imagewebp($image, $destination, $quality);
// }

function isCurrentPage($page)
{
    return strpos($_SERVER['REQUEST_URI'], '/' . $page) !== false ? 'active' : '';
}
