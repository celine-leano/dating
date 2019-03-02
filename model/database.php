<?php
/* Celine Leano
 * 3/2/2019
 * 328/dating/database.php
 * Database functions
 */

function connect()
{
    // connect to DB
    require '/home/cleanogr/config.php';
    try {
        // instantiate a database object
        $dbh = new PDO("mysql:dbname=cleanogr_grc",
            "cleanogr_grcuser", "$2r7FZr.!!C=");
        echo 'Connected to database!';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}