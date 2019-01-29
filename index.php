<?php
/**
 * Celine Leano
 * 1/16/2019
 * 328/dating/index.php
 * Page that uses fat-free routing
 */
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload
require_once('vendor/autoload.php');

// create an instance of the Base class
$f3 = Base::instance();

// turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// define a default route
$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('views/home.html');
});

// define a route to sign up (personal info)
$f3->route('GET /sign-up', function() {
    $template = new Template();
    echo $template->render('views/info.html');
});

// define a route to sign up (profile)
$f3->route('GET /sign-up2', function() {
    $template = new Template();
    echo $template->render('views/profile.html');
});

// run fat free
$f3->run();