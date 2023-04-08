<?php


// THIS SCRIPT DOES NOT NEED TO BE RUN MANUALLY | TABLES WILL BE AUTO CREATED ON ACCESSING THE HOME PAGE OF THE WEBSITE.

// this script will initialize database tables //

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
if (mysqli_query($conn, $sql) === false) {
    echo "Error Creating $dbname Database: " . $conn->connect_error;
}


$conn = new mysqli($server, $username, $password, $dbname);

$dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;

$pdo = new PDO($dsn, $username, $password);


// persistent check table to see if tables are already created.
$DB_CREATED = "CREATE TABLE IF NOT EXISTS `Done` (
        `isdone` BIGINT NOT NULL DEFAULT 0
    )";

if ($conn->query($DB_CREATED) === false) {
    echo "<h3>error initiating database properly</h3>";
    die();
}

$result = mysqli_query($conn, "SELECT COUNT(*) AS num_records FROM Done");

$row = mysqli_fetch_assoc($result);
$num_records = $row['num_records'];

if ($num_records == 0) {

    $sql = "CREATE TABLE IF NOT EXISTS `SwimmingSessions`(
            `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `site_id` BIGINT NOT NULL,
            `Start` TIME NOT NULL,
            `End` TIME NOT NULL,
            `price` DOUBLE NOT NULL
            )
            ";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `Reviews`(
            `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `site_id` BIGINT NOT NULL,
            `username` VARCHAR(255) NOT NULL,
            `reviewText` TEXT NOT NULL,
            `rating` BIGINT NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `Users`(
            `username` VARCHAR(255) NOT NULL PRIMARY KEY,
            `password` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `firstname` VARCHAR(255) NOT NULL,
            `surname` VARCHAR(255) NOT NULL,
            `DOB` DATE NOT NULL,
            `usertype` VARCHAR(255) NOT NULL DEFAULT 'user'
            )";


    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }


    $sql = "CREATE TABLE IF NOT EXISTS `LocalAttractions`(
            `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `attraction_name` VARCHAR(255) NOT NULL,
            `description` VARCHAR(255) NOT NULL,
            `milesFromSite` DOUBLE NOT NULL,
            `site_id` BIGINT NOT NULL,
            `image_url` VARCHAR(255) NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `PitchBookings`(
                `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `Pitch_id` BIGINT NOT NULL,
                `username` VARCHAR(255) NOT NULL,
                `checkIn` DATETIME NOT NULL,
                `checkOut` DATETIME NOT NULL,
                `bookingDate` DATE NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }


    $sql = "CREATE TABLE IF NOT EXISTS `SwimmingBookings`(
                `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `swimming_session_id` BIGINT NOT NULL,
                `username` VARCHAR(255) NOT NULL,
                `bookingDate` DATE NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }


    $sql = "CREATE TABLE IF NOT EXISTS `CampingSites`(
                `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `location` VARCHAR(255) NOT NULL,
                `description` BIGINT NOT NULL,
                `image_url` VARCHAR(255) NOT NULL
            )
            ";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `PitchTypes`(
    `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `type_name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,        
    `image` TEXT NOT NULL
)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }



    $sql = "CREATE TABLE IF NOT EXISTS `Pitches`(
                `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `site_id` BIGINT NOT NULL,
                `Pitch_Type` VARCHAR(255) NOT NULL,
                `price` DOUBLE NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `Messages`(
                `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `username` VARCHAR(255) NOT NULL,
                `Message` TEXT NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS `LogInAttempts`(
                `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `ip_address` VARCHAR(255) NOT NULL,
                `time_count` BIGINT NOT NULL
            )";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }


    $sql = "ALTER TABLE `SwimmingBookings` ADD CONSTRAINT `swimmingbookings_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `Pitches` ADD CONSTRAINT `pitches_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `Reviews` ADD CONSTRAINT `reviews_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `PitchBookings` ADD CONSTRAINT `pitchbookings_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `Reviews` ADD CONSTRAINT `reviews_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `PitchBookings` ADD CONSTRAINT `pitchbookings_pitch_id_foreign` FOREIGN KEY(`Pitch_id`) REFERENCES `Pitches`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `SwimmingBookings` ADD CONSTRAINT `swimmingbookings_swimming_session_id_foreign` FOREIGN KEY(`swimming_session_id`) REFERENCES `SwimmingSessions`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `SwimmingSessions` ADD CONSTRAINT `swimmingsessions_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `LocalAttractions` ADD CONSTRAINT `localattractions_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `Messages` ADD CONSTRAINT `username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);";
    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "ALTER TABLE
     `Pitches` ADD CONSTRAINT `pitch_type_foreign` FOREIGN KEY(`Pitch_Type`) REFERENCES `PitchTypes`(`id`)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }


    $sql = "INSERT INTO Done (isdone) VALUES (1)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
}
