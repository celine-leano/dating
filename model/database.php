<?php
/* Celine Leano
 * 3/2/2019
 * 328/dating/database.php
 * Database functions
 */

require_once('/home/cleanogr/config.php');

function connect()
{
    try {
        //Instantiate a db object
        $dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        return $dbh;
    }
    catch(PDOException $ex)
    {
        echo $ex->getMessage();
        return false;
    }
}

function insertMember($fname, $lname, $age, $gender, $phone, $email, $state,
                      $seeking, $bio, $premium, $image, $interests)
{
    global $dbh;

    $sql = "INSERT INTO members VALUES(:fname, :lname, :age, :gender, :phone, 
                                       :email, :state, :seeking, :bio, :premium, 
                                       :image, :interests)";
    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':age', $age, PDO::PARAM_INT);
    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':premium', $seeking, PDO::PARAM_INT);
    $statement->bindParam(':image', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':interests', $seeking, PDO::PARAM_STR);

    //execute the statement and return true or false if it was successful
    return $statement->execute();
}

function getMember($memberId)
{
    global $dbh;

    $sql = "SELECT * FROM members WHERE member_id = '$memberId'";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}