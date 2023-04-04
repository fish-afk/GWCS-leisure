<?php

    // Set your database connection information
    $server = "localhost";
    $username = "root";
    $password = "Shihab786..";
    $dbname = "GWCS_Shihab_Mirza";

    // Create a connection to the database
    $conn = mysqli_connect($server, $username, $password);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed to database");
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    //Outcome to whether the database has been setup
    if ($conn->connect_error) {
        echo "Error Creating $dbname Database: " . $conn->connect_error;
        die();
    }


    $conn = new mysqli($server, $username, $password, $dbname);

?>