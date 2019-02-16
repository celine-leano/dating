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

// array for indoor interests
$f3->set("indoor", array("tv", "movies", "cooking", "boardgames",
    "puzzles", "reading", "playing cards", "video games"));

// array for outdoor interests
$f3->set("outdoor", array("hiking", "biking", "swimming", "collecting",
    "walking", "climbing"));

// validation
require_once("model/signup-validation.php");

// define a default route
$f3->route('GET /', function($f3) {
    $f3->set("title", "My Dating Website");
    $template = new Template();
    echo $template->render('views/home.html');
});

// define a route to sign up (personal info)
$f3->route('GET|POST /sign-up/info', function($f3) {
    session_start();

    $f3->set("title", "Personal Info - Sign Up");

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
                $f3->set("errors['age']", "Please enter your age (Must be 18 or older)");
                $isValid = false;
            }
        }

        // saves gender if set
        if (isset($_POST['gender'])) {
            $_SESSION['gender'] = $_POST['gender'];
        }

        // validate phone number
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            if (validPhone($phone)) {
                $_SESSION['phone'] = $phone;
            } else {
                $f3->set("errors['phone']", "Please enter full 10-digit number");
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
$f3->route('GET|POST /sign-up/profile', function($f3) {
    session_start();

    $f3->set("title", "Profile - Sign Up");

    $isValid = true;

    // validate that the email was not left empty
    if (!empty($_POST)) {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            if (!empty($email)) {
                $_SESSION['email'] = $email;
            } else {
                $f3->set("errors['email']", "Please enter your email address");
                $isValid = false;
            }
        }

        if (isset($_POST['state'])) {
            $state = $_POST['state'];
            if ($state != "- Select -") {
                $_SESSION['state'] = $state;
            } else {
                $f3->set("errors['state']", "Please select a state");
                $isValid = false;
            }
        }

        if (isset($_POST['seeking'])) {
            $seeking = $_POST['seeking'];
            if (!empty($seeking)) {
                $_SESSION['seeking'] = $seeking;
            }
        }

        if (isset($_POST['bio'])) {
            $bio = $_POST['bio'];
            if (!empty($bio)) {
                $_SESSION['bio'] = $bio;
            }
        }

        if ($isValid) {
            $f3->reroute("/sign-up/interests");
        }
    }

    $template = new Template();
    echo $template->render('views/profile.html');
});

// define a route to sign up (interests)
$f3->route('GET|POST /sign-up/interests', function($f3) {
    session_start();

    $f3->set("title", "Summary - Sign Up");

    if (isset($_POST['submit'])) {
        // check if checkboxes are checked
        if (!empty($_POST['indoorInterests'])) {
            // check if valid
            $indoorInterests = $_POST['indoorInterests'];

            $_SESSION['indoor'] = array();
            foreach ($indoorInterests as $interest) {
                if (validIndoor($interest)) {
                    array_push($_SESSION['indoor'], $interest);
                } else {
                    $f3->reroute("home");
                }
            }
        }

        if (!empty($_POST['outdoorInterests'])) {
            $outdoorInterests = $_POST['outdoorInterests'];

            $_SESSION['outdoor'] = array();
            foreach ($outdoorInterests as $interest) {
                if (validOutdoor($interest)) {
                    array_push($_SESSION['outdoor'], $interest);
                } else {
                    $f3->reroute("home");
                }
            }
        }
        $f3->reroute("summary");
    }

    $template = new Template();
    echo $template->render('views/interests.html');
});

// define a route to sign up (summary)
$f3->route('GET /sign-up/summary', function($f3) {
    session_start();

    $f3->set("title", "User Summary");

    if (isset($_SESSION['indoor'])) {
        $f3->set("indoorString", implode(" ", $_SESSION['indoor']));
    }

    if (isset($_SESSION['outdoor'])) {
        $f3->set("outdoorString", implode(" ", $_SESSION['outdoor']));
    }

    $template = new Template();
    echo $template->render('views/summary.html');
});

// run fat free
$f3->run();