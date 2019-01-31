<?php
/**
 * Celine Leano
 * 1/29/2019
 * 328/dating/model/signup-validation.php
 * Validation for sign-up (info) page
 */

// first name validation
function validName($name) {
    return (!empty($name)) && ctype_alpha($name);
}

// age validation
function validAge($age) {
    return is_numeric($age) && $age >= 18;
}

// phone number validation
function validPhone($phone) {
    // strip phone to just numbers if user uses parentheses, dashes,
    // or spaces
    $phone = str_replace("(", "", $phone);
    $phone = str_replace(")", "", $phone);
    $phone = str_replace("-", "", $phone);
    $phone = str_replace(" ", "", $phone);

    return (is_numeric($phone)) && (strlen($phone) == 10);
}