<?php
/* Celine Leano
 * 3/2/2019
 * 328/dating/database.php
 * Database functions
 *
 * CREATE TABLE statement:
 *
 * CREATE TABLE members (
    member_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(20),
    lname VARCHAR(20),
    age INT(3),
    gender VARCHAR(6),
    phone VARCHAR(10),
    email VARCHAR(50),
    state VARCHAR(30),
    seeking VARCHAR(6),
    bio VARCHAR(500),
    premium TINYINT(1),
    image VARCHAR(50),
    interests VARCHAR(200)
    );
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

    $sql = "INSERT INTO members (fname, lname, age, gender, phone, 
            email, state, seeking, bio, premium, image, interests)
            VALUES(:fname, :lname, :age, :gender, :phone, :email, 
            :state, :seeking, :bio, :premium, :image, :interests)";
    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':age', $age, PDO::PARAM_STR);
    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
    $statement->bindParam(':image', $image, PDO::PARAM_STR);
    $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

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

function getMembers()
{
    global $dbh;

    $sql = "SELECT * FROM members ORDER BY lname, fname";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}