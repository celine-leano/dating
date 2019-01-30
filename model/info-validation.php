<?php
/**
 * Celine Leano
 * 1/29/2019
 * 328/dating/model/info-validation.php
 * Validation for sign-up (info) page
 */

// first name validation
function validName($name) {
    return ((!empty($name)) && ctype_alpha($name));
}

// age validation
function validAge($age) {
    if ($age < 18 || $age > 100) { return false; }
}

// gender validation
function validGender($gender) {
    return ($gender == "male" || $gender == "female");
}