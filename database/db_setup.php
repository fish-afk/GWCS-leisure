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

function CREATE_TABLES($conn)
{

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
                `image_url` VARCHAR(255) NOT NULL,
                `price` DOUBLE NOT NULL
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


        $sql = "CREATE TABLE IF NOT EXISTS `LocalAttractionBookings`(
                    `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `attraction_id` BIGINT NOT NULL,
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
                    `description` TEXT NOT NULL,
                    `image_url` VARCHAR(255) NOT NULL,
                    `Featured` TINYINT DEFAULT 0
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
        `image` TEXT NOT NULL,
        `price` DOUBLE NOT NULL
    )";

        if ($conn->query($sql) === false) {
            echo "<h3>error initiating database properly</h3>";
            die();
        }

        $sql = "CREATE TABLE IF NOT EXISTS `Pitches`(
                    `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `site_id` BIGINT NOT NULL,
                    `Pitch_Type` BIGINT NOT NULL
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

        SETUP_FOREIGN_KEYS($conn);
    }
}

function SETUP_FOREIGN_KEYS($conn)
{

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

    $sql = "ALTER TABLE `LocalAttractionBookings` ADD CONSTRAINT `attraction_foreign` FOREIGN KEY(`attraction_id`) REFERENCES `LocalAttractions`(`id`)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "ALTER TABLE `LocalAttractionBookings` ADD CONSTRAINT `username_foreign_key` FOREIGN KEY(`username`) REFERENCES `Users`(`username`)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
}


function INSERT_INITIAL_DATA($conn)
{

    // pitch types

    $result = mysqli_query($conn, "SELECT COUNT(*) AS num_records FROM Done");

    $row = mysqli_fetch_assoc($result);
    $num_records = $row['num_records'];

    if ($num_records == 0) {


        // users (note: passwords are hashed...)

        $sql = "INSERT INTO Users (username, password, email, firstname, surname, DOB, usertype) 
        VALUES 
        ('johndoe', '8fa14cdd754f91cc6554c9e71929cce7f17d3e2fcb67ea1346327c94bdfa3d3e', 'johndoe@example.com', 'John', 'Doe', '1990-05-15', 'user'),
        ('janedoe', '2a1dd59c7b8f31dfe707105aaee5a5f97411e25ee4d4d4dc4ad390af4b1c8e88', 'janedoe@example.com', 'Jane', 'Doe', '1992-02-23', 'user'),
        ('bobsmith', 'b07d5ba5a5cb5f5c5d6fc05a6d4c6b56ad6aa6480d063e62e891c7ab9f9b3451', 'bobsmith@example.com', 'Bob', 'Smith', '1985-09-10', 'user'),
        ('alicewonder', 'a8827c39dd82181a3d37a3e8e2217d6e0622b81a16f1b8c7d39e92d3d3c052b3', 'alicewonder@example.com', 'Alice', 'Wonder', '1998-11-30', 'user'),
        ('mikejones', '78f2c676b6fa01b6a28a5a5eb55655c4be83e4b4d4aaad16872f4cc4a4b1a43d', 'mikejones@example.com', 'Mike', 'Jones', '1982-08-07', 'user')
        ";


        if ($conn->query($sql) === false) {
            echo "Error inserting dummy user accounts";
        }


        //pitch types

        $sql = 'INSERT INTO PitchTypes (type_name, description, image, price) VALUES ("Tent pitch", "A tent pitch is a temporary outdoor shelter that is set up by assembling a tent and securing it to the ground. It typically involves finding a suitable location that is relatively flat and free of debris, and then unpacking and assembling the tent according to its instructions. The tent is usually supported by poles and secured to the ground using stakes and guy lines. A rainfly may be added to protect the tent from the elements. Once the tent is pitched, it provides a cozy and comfortable shelter for camping or other outdoor activities. A well-pitched tent is stable, secure, and able to withstand wind, rain, and other weather conditions.", "tent_pitch.jpg", 150), 
        ("Touring Caravan Pitch", "A touring caravan pitch is a designated area in a campsite or caravan park that is specifically designed for parking a touring caravan. It typically involves finding a level and spacious area that is suitable for the size of the caravan and has access to necessary amenities like water, electricity, and sewage disposal. Once the pitch is identified, the caravan is carefully driven into the spot and leveled using jacks or other supports to ensure that it is stable and secure. The caravan is then hooked up to the sites electricity and water supply, and any waste is disposed of through the sites sewage facilities. Once the caravan is set up, it provides a comfortable and convenient base for exploring the surrounding area or enjoying the amenities of the campsite. A well-pitched touring caravan provides a safe and enjoyable experience for travelers, with all the comforts of home while on the road.", "touring_caravan.jpg", 250),
        ("Motorhome pitch", "A motorhome pitch is a designated area in a campsite or motorhome park that is specifically designed for parking and staying in a motorhome. It typically involves finding a level and spacious area that is suitable for the size of the motorhome and has access to necessary amenities like water, electricity, and sewage disposal. Once the pitch is identified, the motorhome is carefully driven into the spot and leveled using jacks or other supports to ensure that it is stable and secure. The motorhome is then hooked up to the sites electricity and water supply, and any waste is disposed of through the sites sewage facilities. Some motorhome pitches also offer additional amenities like wifi, laundry facilities, and entertainment options. Once the motorhome is set up, it provides a comfortable and convenient base for exploring the surrounding area or enjoying the amenities of the park. A well-pitched motorhome provides a safe and enjoyable experience for travelers, with all the comforts of home while on the road.", "motorhome.jpg", 400)
        ';

        if ($conn->query($sql) === false) {
            echo "Error inserting pitch types";
        }

        // campsites


        $sql = "INSERT INTO `CampingSites` (`name`, `location`, `description`, `image_url`, `Featured`)
        VALUES
            ('Kruger National Park', '-24.9413,31.2275', 'Kruger National Park is one of the largest game reserves in Africa, home to the Big Five (lion, leopard, rhinoceros, elephant, and Cape buffalo) as well as many other species of wildlife. The park offers a range of camping options, from basic campsites to luxury tents and lodges.', 'kruger.jpg', 1),
            ('Lake Malawi National Park', '-12.0633,34.2625', 'Lake Malawi National Park is a UNESCO World Heritage Site that encompasses the southern end of Lake Malawi, the third-largest lake in Africa. The park offers camping facilities on the shore of the lake, where visitors can enjoy swimming, snorkeling, and fishing in the crystal-clear waters.', 'lake_malawi.jpg', 0),
            ('Thingvellir National Park', '64.2570,-21.1118', 'Thingvellir National Park is a UNESCO World Heritage Site located in southwestern Iceland, known for its dramatic landscapes of volcanic rock formations, deep fissures, and crystal-clear waters. The park offers camping facilities with stunning views of the surrounding mountains and valleys.', 'thingvellir.jpg', 1),
            ('South Luangwa National Park', '-13.1369,31.8313', 'South Luangwa National Park is a world-renowned wildlife sanctuary in eastern Zambia, known for its abundant wildlife and stunning natural beauty. The park offers camping facilities in a variety of settings, from remote bush camps to more developed sites with amenities like hot showers and flush toilets.', 'south_luawngwa.jpg', 0),
            ('Skaftafell National Park', '64.0159,-16.9819', 'Skaftafell National Park is a rugged wilderness area in southeastern Iceland, known for its glaciers, waterfalls, and scenic hiking trails. The park offers camping facilities with easy access to the park\'s many attractions.', 'skaftafell.jpg', 0),
            ('Tsitsikamma National Park', '-33.9630,23.8550', 'Tsitsikamma National Park is a coastal reserve in South Africa, known for its rugged coastline, indigenous forests, and dramatic landscapes. The park offers camping facilities with stunning views of the ocean and easy access to the park\'s many hiking trails.', 'tsitsikamma.jpg', 0),
            ('Blue Lagoon', '63.8816,-22.4537', 'The Blue Lagoon is a geothermal spa located in southwestern Iceland, famous for its milky-blue waters and therapeutic properties. The lagoon offers camping facilities with easy access to the spa and the surrounding area.', 'blue_lagoon.jpg', 1),
            ('Okavango Delta', '-19.3074,22.9134', 'The Okavango Delta is a vast wetland in northern Botswana, home to a diverse array of wildlife and a popular destination for safari tours. The delta offers camping facilities in remote areas, where visitors can experience the natural beauty of the region up close.', 'okavango-delta.jpg', 0),
            ('Victoria Falls', '-17.9245,25.8569', 'Victoria Falls is a natural wonder of the world located on the border of Zambia and Zimbabwe, known for its breathtaking views and powerful waterfalls. The area offers camping facilities with easy access to the falls and a range of adventure activities like bungee jumping and whitewater rafting.', 'victoria_falls.jpg', 1),
            ('Landmannalaugar', '63.9833,-19.0667', 'Landmannalaugar is a popular hiking and camping destination in the highlands of Iceland, known for its stunning landscapes of colorful mountains, hot springs, and rugged lava fields. The area offers camping facilities with easy access to the hiking trails and the natural wonders of the region.', 'landmannalaugar.jpg', 0),
            ('Table Mountain National Park', '-34.1070,18.3677', 'Table Mountain National Park is a scenic reserve in South Africa, known for its stunning views of Cape Town, its rugged coastline, and its unique flora and fauna. The park offers camping facilities in a range of settings, from coastal campsites to more remote wilderness camps.', 'table_mountain.jpg', 0)
        ";

        if ($conn->query($sql) === false) {
            echo "Error inserting campsites";
        }

        // pitches

        $sql = "INSERT INTO Pitches (site_id, Pitch_Type) 
                VALUES 
                (1, 1),
                (1, 2),
                (1, 3),
                (1, 2),
                (1, 3),
                (2, 1),
                (2, 2),
                (2, 3),
                (2, 2),
                (2, 1),
                (3, 1),
                (3, 2),
                (3, 3),
                (3, 2),
                (3, 1),
                (4, 1),
                (4, 2),
                (4, 3),
                (4, 2),
                (4, 1),
                (5, 1),
                (5, 2),
                (5, 3),
                (5, 2),
                (5, 1)
                ";


        if ($conn->query($sql) === false) {
            echo "Error inserting pitches";
        }


        // swimming sessions


        $sql = "INSERT INTO SwimmingSessions (site_id, Start, End, price)
                VALUES 
                (2, '09:00:00', '10:00:00', 15.00),
                (4, '14:00:00', '15:30:00', 20.50),
                (8, '12:00:00', '13:30:00', 18.00),
                (10, '08:30:00', '09:30:00', 12.50),
                (1, '10:00:00', '11:30:00', 22.00),
                (3, '13:00:00', '14:30:00', 17.50),
                (6, '11:00:00', '12:00:00', 10.00),
                (7, '16:00:00', '17:00:00', 12.50),
                (9, '15:00:00', '16:30:00', 21.50),
                (5, '07:30:00', '08:30:00', 8.00)
                ";

        // local attractions


        $sql = "INSERT INTO LocalAttractions(attraction_name, description, milesFromSite, site_id, image_url, price) VALUES ('Bourkes Luck Potholes', 'A scenic geological formation on the Blyde River', 20.5, 1, 'https://example.com/bourkes-luck-potholes.jpg', 12.50),
                ('Gods Window', 'A viewpoint located in Mpumalanga, South Africa', 15.2, 1, 'https://example.com/gods-window.jpg', 10.00),
                ('Kande Horse Trails', 'Horse riding trails through the beautiful Malawian countryside', 5.0, 2, 'https://example.com/kande-horse-trails.jpg', 25.00),
                ('Lake Malawi Museum', 'A museum showcasing the history and culture of the Lake Malawi region', 2.3, 2, 'https://example.com/lake-malawi-museum.jpg', 8.00),
                ('Silfra Fissure', 'A popular diving and snorkeling spot in Iceland', 2.0, 3, 'https://example.com/silfra-fissure.jpg', 50.00),
                ('Thingvellir Church', 'A historic church located in Thingvellir National Park, Iceland', 1.5, 3, 'https://example.com/thingvellir-church.jpg', 5.00),
                ('Victoria Falls Bridge', 'A historic bridge offering stunning views of Victoria Falls', 0.3, 9, 'https://example.com/victoria-falls-bridge.jpg', 15.00),
                ('Bungee Jumping in Victoria Falls', 'An adrenaline-filled experience jumping off a bridge over Victoria Falls', 0.3, 9, 'https://example.com/victoria-falls-bungee.jpg', 75.00),
                ('Robberg Nature Reserve', 'A scenic coastal nature reserve in South Africa', 2.5, 10, 'https://example.com/robberg-nature-reserve.jpg', 7.00),
                ('Cango Caves', 'A network of limestone caves in the Western Cape, South Africa', 15.0, 11, 'https://example.com/cango-caves.jpg', 20.00),
                ('Kirstenbosch National Botanical Garden', 'A beautiful botanical garden located on the slopes of Table Mountain', 5.0, 11, 'https://example.com/kirstenbosch-garden.jpg', 12.00),
                ('Lions Head Hike', 'A popular hike offering stunning views of Cape Town', 3.0, 11, 'https://example.com/lions-head-hike.jpg', 5.00),
                ('Aurora Borealis Observatory', 'An observatory offering guided tours and stunning views of the Northern Lights', 5.0, 5, 'https://example.com/aurora-borealis-observatory.jpg', 30.00),
                ('Skaftafell Glacier Hike', 'A guided hike on a glacier in Skaftafell National Park, Iceland', 1.0, 5, 'https://example.com/skaftafell-glacier.jpg', 75.00),
                ('Wildlife Photography Tour in South Luangwa National Park', 'A guided photography tour of the wildlife in South Luangwa National Park', 2.5, 4, 'https://example.com/luangwa-wildlife-tour.jpg', 40.00)";
    }
}

function SETUP_LOCK($conn)
{

    $sql = "INSERT INTO Done (isdone) VALUES (1)";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
}


// calling the functions for first time setup...

CREATE_TABLES($conn);
INSERT_INITIAL_DATA($conn);
SETUP_LOCK($conn);
