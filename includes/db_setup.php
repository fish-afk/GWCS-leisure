<?php

// this script will initialize database tables //

include_once 'db_connect.php'; 

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
                `username` VARCHAR(255),
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
                `description` TEXT NOT NULL,
                `milesFromSite` DOUBLE NOT NULL,
                `site_id` BIGINT NOT NULL,
                `price` DOUBLE NOT NULL
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
                    `Features` TEXT NOT NULL,
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
                    `username` VARCHAR(255),
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

    $sql = "ALTER TABLE `Pitches` ADD CONSTRAINT `pitches_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }
    $sql = "ALTER TABLE `Reviews` ADD CONSTRAINT `reviews_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`) ON UPDATE CASCADE ON DELETE SET NULL;";

    if ($conn->query($sql) === false) {
        echo "<h3>error initiating database properly</h3>";
        die();
    }

    $sql = "ALTER TABLE `Reviews` ADD CONSTRAINT `reviews_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);";

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
    $sql = "ALTER TABLE `Messages` ADD CONSTRAINT `username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`) ON UPDATE CASCADE ON DELETE SET NULL;";

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


        $sql = "INSERT INTO `campingsites` (`id`, `name`, `location`, `description`, `image_url`, `Featured`, `Features`) VALUES (1, 'Kruger National Park', '-24.9413,31.2275', 'Kruger National Park is one of the largest game reserves in Africa, home to the Big Five (lion, leopard, rhinoceros, elephant, and Cape buffalo) as well as many other species of wildlife. The park offers a range of camping options, from basic campsites to luxury tents and lodges.', 'kruger.jpg', 1, 'car parking, showers, internet access, hiking, swimming'),
                (2, 'Lake Malawi National Park', '-12.0633,34.2625', 'Lake Malawi National Park is a UNESCO World Heritage Site that encompasses the southern end of Lake Malawi, the third-largest lake in Africa. The park offers camping facilities on the shore of the lake, where visitors can enjoy swimming, snorkeling, and fishing in the crystal-clear waters.', 'lake_malawi.jpg', 0, 'car parking, showers, internet access, hiking, swimming, game viewing'),
                (3, 'Thingvellir National Park', '64.2570,-21.1118', 'Thingvellir National Park is a UNESCO World Heritage Site located in southwestern Iceland, known for its dramatic landscapes of volcanic rock formations, deep fissures, and crystal-clear waters. The park offers camping facilities with stunning views of the surrounding mountains and valleys.', 'thingvellir.jpg', 0, 'car parking, showers, internet access, hiking'),
                (4, 'South Luangwa National Park', '-13.1369,31.8313', 'South Luangwa National Park is a world-renowned wildlife sanctuary in eastern Zambia, known for its abundant wildlife and stunning natural beauty. The park offers camping facilities in a variety of settings, from remote bush camps to more developed sites with amenities like hot showers and flush toilets.', 'south_luangwa.jpg', 0, 'showers, internet access, hiking, swimming, game viewing, cooking chef'),
                (5, 'Skaftafell National Park', '64.0159,-16.9819', 'Skaftafell National Park is a rugged wilderness area in southeastern Iceland, known for its glaciers, waterfalls, and scenic hiking trails. The park offers camping facilities with easy access to the park\'s many attractions.', 'skaftafell.jpg', 1, 'car parking, showers, internet access, hiking, swimming, game viewing, cooking chef, all meals provided, water supply'),
                (6, 'Tsitsikamma National Park', '-33.9630,23.8550', 'Tsitsikamma National Park is a coastal reserve in South Africa, known for its rugged coastline, indigenous forests, and dramatic landscapes. The park offers camping facilities with stunning views of the ocean and easy access to the park\'s many hiking trails.', 'tsitsikama.jpg', 0, 'internet access, hiking, swimming, game viewing, cooking chef, all meals provided'),
                (7, 'Blue Lagoon', '63.8816,-22.4537', 'The Blue Lagoon is a geothermal spa located in southwestern Iceland, famous for its milky-blue waters and therapeutic properties. The lagoon offers camping facilities with easy access to the spa and the surrounding area.', 'blue_lagoon.jpg', 0, 'swimming, game viewing, cooking chef, all meals provided, water supply'),
                (8, 'Okavango Delta', '-19.3074,22.9134', 'The Okavango Delta is a vast wetland in northern Botswana, home to a diverse array of wildlife and a popular destination for safari tours. The delta offers camping facilities in remote areas, where visitors can experience the natural beauty of the region up close.', 'okavango_delta.jpg', 0, 'game viewing, cooking chef, all meals provided, water supply'),
                (9, 'Victoria Falls', '-17.9245,25.8569', 'Victoria Falls is a natural wonder of the world located on the border of Zambia and Zimbabwe, known for its breathtaking views and powerful waterfalls. The area offers camping facilities with easy access to the falls and a range of adventure activities like bungee jumping and whitewater rafting.', 'victoria_falls.jpg', 1, 'car parking, showers, internet access, hiking, swimming, game viewing, cooking chef, all meals provided'),
                (10, 'Landmannalaugar', '63.9833,-19.0667', 'Landmannalaugar is a popular hiking and camping destination in the highlands of Iceland, known for its stunning landscapes of colorful mountains, hot springs, and rugged lava fields. The area offers camping facilities with easy access to the hiking trails and the natural wonders of the region.', 'landmannalaugar.jpg', 1, 'car parking, showers, internet access'),
                (11, 'Table Mountain National Park', '-34.1070,18.3677', 'Table Mountain National Park is a scenic reserve in South Africa, known for its stunning views of Cape Town, its rugged coastline, and its unique flora and fauna. The park offers camping facilities in a range of settings, from coastal campsites to more remote wilderness camps.', 'table_mountain.jpg', 0, 'car parking, showers, internet access, hiking, swimming')";

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

        if ($conn->query($sql) === false) {
            echo "Error inserting pitches";
        }

        // local attractions


        $sql = "INSERT INTO LocalAttractions(attraction_name, description, milesFromSite, site_id, price) VALUES
                ('Bourkes Luck Potholes', 'Bourkes Luck Potholes is a stunning geological formation situated on the Blyde River Canyon in South Africa. The potholes were formed over millions of years by the action of swirling water, creating a unique and beautiful landscape. Visitors can take a walk through the potholes and enjoy the beautiful scenery, with plenty of photo opportunities along the way. Admission to Bourkes Luck Potholes is affordable, making it a great attraction for families and travelers on a budget.', 20.5, 1, 12.50),
                ('Gods Window', 'Gods Window is a beautiful viewpoint located in Mpumalanga, South Africa. From the top of the viewpoint, visitors can enjoy stunning views of the surrounding landscape, including the Blyde River Canyon and the Lowveld. The site is located at an altitude of over 2,000 meters, making it a great spot for birdwatching and enjoying the fresh mountain air. Visitors can also take guided tours to learn more about the history and culture of the area. Admission to Gods Window is affordable, making it an accessible attraction for all travelers.', 15.2, 1, 10.00),
                ('Kande Horse Trails', 'Explore the beautiful Malawian countryside with Kande Horse Trails. This guided horseback riding tour takes visitors on a journey through the stunning landscapes and villages of Malawi. Along the way, visitors can enjoy beautiful views of Lake Malawi, lush forests, and rolling hills. The tour is suitable for riders of all skill levels, making it a great activity for families and groups. Admission to Kande Horse Trails is affordable, making it an accessible attraction for all visitors.', 5.0, 2, 25.00),
                ('Lake Malawi Museum', 'Learn about the rich history and culture of the Lake Malawi region with a visit to the Lake Malawi Museum. The museum features exhibits on the geology, ecology, and human history of the region, with a particular focus on the diverse fish species found in the lake. Visitors can explore the exhibits at their own pace and learn about the importance of Lake Malawi to the local communities. Admission to the Lake Malawi Museum is affordable, making it an accessible attraction for all visitors.', 2.3, 2, 8.00),
                ('Silfra Fissure', 'Experience the beauty and excitement of diving and snorkeling in Silfra Fissure, a stunning underwater fissure in Iceland. Silfra is known for its crystal-clear waters and unique underwater landscape, which includes dramatic rock formations and colorful marine life. Visitors can take guided tours to explore the fissure and learn about the geology and ecology of the area. The tours are suitable for divers and snorkelers of all skill levels, making it a great activity for families and groups. Admission to Silfra Fissure is affordable, making it an accessible attraction for all visitors.', 2.0, 3, 50.00),
                ('Thingvellir Church', 'Experience the rich history and culture of Iceland with a visit to Thingvellir Church. Located in Thingvellir National Park, the church is one of the oldest and most significant buildings in the country. It was originally built in the 11th century and has been restored several times over the years. The church is a popular destination for tourists and locals alike, and offers a peaceful and serene atmosphere for visitors to enjoy.', 1.5, 3, 5.00),
                ('Victoria Falls Bridge', 'The Victoria Falls Bridge is an iconic landmark located in Zimbabwe, offering stunning views of the majestic Victoria Falls. Built in 1905, the bridge was designed by renowned engineer Sir Ralph Freeman, and is considered a masterpiece of engineering. Visitors can take a walk along the bridge and enjoy breathtaking views of the Falls and the Zambezi River below. With its rich history and breathtaking scenery, the Victoria Falls Bridge is a must-see attraction for anyone visiting the region.', 0.3, 9, 15.00),
                ('Bungee Jumping in Victoria Falls', 'For the ultimate adrenaline rush, try bungee jumping off the Victoria Falls Bridge in Zimbabwe. With a height of 111 meters, the jump offers a thrilling and unforgettable experience, as you plummet towards the Zambezi River below. The jump is considered one of the most spectacular in the world, and is a popular activity for thrill-seekers from around the globe. Whether youre an experienced bungee jumper or a first-timer, this is an experience you wont forget.', 0.3, 9, 75.00),
                ('Robberg Nature Reserve', 'Explore the natural beauty of the South African coastline with a visit to Robberg Nature Reserve. Located near Plettenberg Bay, the reserve offers scenic hiking trails with stunning views of the ocean and surrounding landscape. Visitors can spot a variety of wildlife, including seals, dolphins, and birds, and can even take a dip in the ocean at one of the reserves many beaches. With its rugged beauty and diverse ecosystem, Robberg Nature Reserve is a must-visit destination for nature lovers.', 2.5, 10, 7.00),
                ('Cango Caves', 'Discover the otherworldly beauty of the Cango Caves, a network of limestone caves located in the Western Cape of South Africa. The caves were formed millions of years ago and offer a unique and fascinating glimpse into the regions geological history. Visitors can take guided tours of the caves and marvel at their stunning stalactites and stalagmites. With its otherworldly beauty and fascinating history, the Cango Caves are a must-see attraction for anyone visiting the region.', 15.0, 11,  20.00),
                ('Kirstenbosch National Botanical Garden', 'Located on the eastern slopes of Table Mountain, Kirstenbosch National Botanical Garden is a stunning collection of indigenous South African flora. Visitors can explore the diverse gardens and landscapes, take in the views of the city and surrounding mountains, and enjoy events and concerts held in the garden.', 5.0, 11, 12.00),
                ('Lions Head Hike', 'One of the most popular hiking trails in Cape Town, the Lions Head Hike offers breathtaking views of the city, the Atlantic Ocean, and Table Mountain. The trail is moderate in difficulty and takes about two hours to complete, including time to enjoy the views from the summit.', 3.0, 11, 5.00),
                ('Aurora Borealis Observatory', 'Located in the heart of Iceland, the Aurora Borealis Observatory is a unique and breathtaking destination for stargazing enthusiasts. Visitors can take guided tours and learn about the Northern Lights and other astronomical phenomena, while enjoying stunning views of the night sky.', 5.0, 5, 30.00),
                ('Skaftafell Glacier Hike', 'Explore the stunning beauty of Iceland with a guided hike on the Skaftafell Glacier, located in Skaftafell National Park. The hike takes visitors through an otherworldly landscape of ice formations and volcanic terrain, while providing unparalleled views of the surrounding mountains and valleys.', 1.0, 5, 75.00),
                ('Wildlife Photography Tour in South Luangwa National Park', 'Embark on a guided photography tour of the diverse and abundant wildlife of South Luangwa National Park. Visitors will have the opportunity to capture stunning images of elephants, lions, leopards, giraffes, and other wildlife, while learning about the ecology and conservation efforts of the park.', 2.5, 4, 40.00)
                ";


        if ($conn->query($sql) === false) {
            echo "Error inserting pitches";
        }


        // reviews 

        $sql = "INSERT INTO `Reviews` (`site_id`, `username`, `reviewText`, `rating`) VALUES
        (2, 'johndoe', 'I had a great time camping at Lake Malawi. The scenery was beautiful and the staff were very friendly.', 4),
        (3, 'janedoe', 'Thingvellir National Park was amazing. The views were breathtaking and there was so much to explore.', 5),
        (4, 'bobsmith', 'South Luangwa National Park is a must-visit for any wildlife enthusiast. We saw so many animals!', 4),
        (5, 'alicewonder', 'Skaftafell National Park was like nothing I had ever seen before. The glaciers were incredible.', 5),
        (6, 'mikejones', 'Tsitsikamma National Park is a hidden gem. The hiking trails were challenging but the views were worth it.', 4),
        (7, 'johndoe', 'The Blue Lagoon was very relaxing. The water was warm and the scenery was beautiful.', 3),
        (8, 'janedoe', 'The Okavango Delta was a once-in-a-lifetime experience. We saw so many different animals and the scenery was stunning.', 5),
        (9, 'bobsmith', 'Victoria Falls was absolutely breathtaking. The sheer power of the waterfalls was incredible.', 3),
        (10, 'alicewonder', 'Landmannalaugar was beautiful. The hiking trails were challenging but the views were worth it.', 4),
        (11, 'mikejones', 'Table Mountain National Park had some of the most beautiful views I have ever seen. It was definitely worth the hike up.', 5),
        (2, 'johndoe', 'I loved my stay at Lake Malawi. The campsites were clean and the staff were very helpful.', 4),
        (3, 'janedoe', 'Thingvellir National Park was the highlight of my trip to Iceland. The landscapes were incredible.', 5),
        (4, 'bobsmith', 'South Luangwa National Park was an unforgettable experience. We saw so many different animals and the guides were very knowledgeable.', 5),
        (5, 'alicewonder', 'Skaftafell National Park was one of the most beautiful places I have ever visited. The glaciers were incredible.', 5),
        (6, 'mikejones', 'Tsitsikamma National Park was a great place for hiking and exploring. The views were breathtaking.', 4),
        (7, 'johndoe', 'The Blue Lagoon was a great place to relax and unwind after a long day of hiking.', 4),
        (8, 'janedoe', 'The Okavango Delta was an amazing place to see wildlife up close. We saw so many different animals.', 3),
        (9, 'bobsmith', 'Victoria Falls was definitely a highlight of my trip to Africa. The views were stunning.', 5),
        (10, 'alicewonder', 'Landmannalaugar was a challenging but rewarding place to hike. The scenery was incredible.', 4),
        (11, 'mikejones', 'Table Mountain National Park had some of the most beautiful views I have ever seen. It was definitely worth the climb.', 5),
        (1, 'johndoe', 'Kruger National Park is an incredible place to see wildlife. We saw lions, elephants, and so much more!', 3),
        (1, 'janedoe', 'Kruger National Park was an unforgettable experience. The landscape was beautiful and the guides were very knowledgeable.', 5)";

        if ($conn->query($sql) === false) {
            echo "Error inserting pitches";
        }


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
