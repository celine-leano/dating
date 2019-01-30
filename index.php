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

// array to hold valid genders
$f3->set("genders", array("Male"=>"male", "Female"=>"female"));

// validation
require_once("model/info-validation.php");

// define a default route
$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('views/home.html');
});

// define a route to sign up (personal info)
$f3->route('GET|POST /sign-up/info', function($f3) {
    session_start();

    // always start with empty session here
    $_SESSION = array();

    // flag
    $isValid = true;

    // validate first name
    if (!empty($_POST)) {
        if (isset($_POST['fname'])) {
            $fname = $_POST['fname'];
            if (validName($fname)) {
                $_SESSION['fname'] = $fname;
            } else {
                $f3->set("errors['fname']", "Please enter your first name");
                $isValid = false;
            }
        }

        // validate last name
        if (isset($_POST['lname'])) {
            $lname = $_POST['lname'];
            if (validName($lname)) {
                $_SESSION['lname'] = $lname;
            } else {
                $f3->set("errors['lname']", "Please enter your last name");
                $isValid = false;
            }
        }

        // validate age
        if (isset($_POST['age'])) {
            $age = $_POST['age'];
            if (validAge($age)) {
                $_SESSION['age'] = $age;
            } else {
                $f3->set("errors['age']", "Please enter your age");
                $isValid = false;
            }
        }

        // validate gender
        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
            print_r($_POST);
            if (validGender($gender)) {
                $_SESSION['gender'] = $gender;
            } else {
                $f3->set("errors['gender']", "Please select a gender");
                $isValid = false;
            }
        }

        if ($isValid) {
            $f3->reroute("/sign-up/profile");
        }
    }

    $template = new Template();
    echo $template->render('views/info.html');
});

// define a route to sign up (profile)
$f3->route('GET|POST /sign-up/profile', function() {
    session_start();

    $template = new Template();
    echo $template->render('views/profile.html');
});

// define a route to sign up (interests)
$f3->route('GET /sign-up/interests', function() {
    $template = new Template();
    echo $template->render('views/interests.html');
});

// define a route to sign up (summary)
$f3->route('GET /sign-up/summary', function() {
    $template = new Template();
    echo $template->render('views/summary.html');
});

// run fat free
$f3->run();