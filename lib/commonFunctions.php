<?php

function getPage() {
    return isset($_GET['page']) ? $_GET['page'] : config('default_page');
}

function write($key) {
    switch ($key) {
        case 'siteName':
            echo config('site_name');
            break;
        case 'title':
            echo ucwords(str_replace('-', ' ',  htmlspecialchars(getPage())));;
            break;
    }
}

function pageContent() {
    $path = getcwd().'/'.config('content_path').'/'.getPage().'.php';
    if (file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
        include $path;
    } else {
        include config('content_path').'/404.php';
    }
}

function notificate($message) {
    echo $message . PHP_EOL;
}

function run() {
    include config('template_path').'/template.php';
}

function d($array = []) {
    print("<pre>".print_r($array,true)."</pre>");
}
