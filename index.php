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

session_start();

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
            $gender = $_POST['gender'];
            $_SESSION['gender'] = $gender;
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

            // check if premium is set
            if (isset($_POST['premium'])) {
                // instantiate a PremiumMember obj
                $premium = new PremiumMember($fname, $lname, $age, $gender, $phone);
                $_SESSION['memberType'] = $premium;
            } else {
                // instantiate a Member obj
                $member = new Member($fname, $lname, $age, $gender, $phone);
                $_SESSION['memberType'] = $member;
            }
            $f3->reroute("/sign-up/profile");
        }
    }

    $template = new Template();
    echo $template->render('views/info.html');
});

// define a route to sign up (profile)
$f3->route('GET|POST /sign-up/profile', function($f3) {

    $f3->set("title", "Profile - Sign Up");

    $isValid = true;

    // retrieve member object from session
    $memberType = $_SESSION['memberType'];

    // validate that the email was not left empty
    if (!empty($_POST)) {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            if (!empty($email)) {
                $_SESSION['email'] = $email;
                $memberType->setEmail($email);
            } else {
                $f3->set("errors['email']", "Please enter your email address");
                $isValid = false;
            }
        }

        if (isset($_POST['state'])) {
            $state = $_POST['state'];
            if ($state != "- Select -") {
                $_SESSION['state'] = $state;
                $memberType->setState($state);
            } else {
                $f3->set("errors['state']", "Please select a state");
                $isValid = false;
            }
        }

        if (isset($_POST['seeking'])) {
            $seeking = $_POST['seeking'];
            if (!empty($seeking)) {
                $_SESSION['seeking'] = $seeking;
                $memberType->setSeeking($seeking);
            }
        }

        if (isset($_POST['bio'])) {
            $bio = $_POST['bio'];
            if (!empty($bio)) {
                $_SESSION['bio'] = $bio;
                $memberType->setBio($bio);
            }
        }

        if ($isValid) {
            $_SESSION['memberType'] = $memberType;

            // if premium, go to interests
            if (get_class($memberType) == "PremiumMember") {
                $f3->reroute("/sign-up/interests");
            } else {
                $f3->reroute("/sign-up/summary");
            }
        }
    }

    $template = new Template();
    echo $template->render('views/profile.html');
});

// define a route to sign up (interests)
$f3->route('GET|POST /sign-up/interests', function($f3) {

    $f3->set("title", "Summary - Sign Up");

    // retrieve member object from session
    $memberType = $_SESSION['memberType'];

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
            $f3->set("indoorString", implode(" ", $_SESSION['indoor']));
            $memberType->setIndoorInterests($f3->get("indoorString"));
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
            $f3->set("outdoorString", implode(" ", $_SESSION['outdoor']));
            $memberType->setOutdoorInterests($f3->get("outdoorString"));
        }
        $_SESSION['memberType'] = $memberType;
        $f3->reroute("summary");
    }

    $template = new Template();
    echo $template->render('views/interests.html');
});

// define a route to sign up (summary)
$f3->route('GET /sign-up/summary', function($f3) {

    $f3->set("title", "User Summary");

    // retrieve member object
    $memberType = $_SESSION['memberType'];

    // get fields from object and set variables
    $f3->set("fname", $memberType->getFname());
    $f3->set("lname", $memberType->getLname());
    $f3->set("gender", $memberType->getGender());
    $f3->set("age", $memberType->getAge());
    $f3->set("phone", $memberType->getPhone());
    $f3->set("email", $memberType->getEmail());
    $f3->set("state", $memberType->getState());
    $f3->set("seeking", $memberType->getSeeking());
    $f3->set("bio", $memberType->getBio());

    // for premium members
    if (get_class($memberType) == "PremiumMember") {
        $f3->set("premium", true);
        $f3->set("indoor", $memberType->getIndoorInterests());
        $f3->set("outdoor", $memberType->getOutdoorInterests());
    }

    $template = new Template();
    echo $template->render('views/summary.html');
});

// run fat free
$f3->run();