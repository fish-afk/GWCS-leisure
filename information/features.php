<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<?php
$siteid;
$sitename;
if (isset($_GET['siteid']) && isset($_GET['sitename'])) {
    $siteid = addslashes($_GET['siteid']);
    $sitename = addslashes($_GET['sitename']);
} else {
    die("<h1>site id and name needed</h1>");
}

// Define the query parameter with a variable;
$query_param = "query=" . urlencode($sitename);

// Define the API endpoint URL with the query parameter and limit results to 5
$url = "https://api.unsplash.com/search/photos?" . $query_param . "&client_id=HlsapAQSZM-HEy-ojfTeD_JDQK_gh4YZPoWMcf4ng5w&width=1920&height=1080&content_filter=high";

// Initialize a cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


// Execute the cURL request
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Store the JSON response in a variable
$results = json_decode($response, true);

// Get the array of photos from the results
$photos = $results["results"];

// Randomly select 5 photos from the array
$random_photos = array_rand($photos, 5);


?>

<body>

    <div class="sitedetails">

        <div class="left">
            <?php

            $query = "SELECT * FROM CampingSites WHERE id = $siteid";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
                <h1><?php echo $row['name'] ?></h1>
                <img src="/assets/images/campsites/<?php echo $row['image_url'] ?>" width="100%" height="40%" />

                <?php
                $location = $row['location'];
                list($latitude, $longitude) = explode(",", $location);
                $latitude = (float) $latitude;
                $longitude = (float) $longitude;

                $src = "https://maps.google.com/maps?q=$latitude,$longitude&hl=en&z=14&amp;output=embed";
                ?>

                <iframe width="100%" height="300px" frameborder="0" scrolling="yes" src=<?php echo $src; ?>>
                </iframe>
            <?php
            } else { ?>

                <h1>Campsite with this id not found</h1>

            <?php }

            ?>
        </div>

        <div class="right">
            <h2>
                Description:
            </h2>

            <p><?php echo $row['description'] ?></p>

            <?php
            $items = explode(", ", $row['Features']);
            ?>

            <h2>
                Features:
            </h2>

            <ul>
                <?php foreach ($items as $item) : ?>
                    <li><?php echo $item; ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="btngroup">
                <a href="/information/sitereviews.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"> <button class="guide-btn">See reviews </button></a>
                <a href="/information/localattractions.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"> <button class="guide-btn">See local attractions</button></a>
                <a href="/information/availability.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"> <button class="guide-btn">Check availability </button></a>
            </div>
        </div>

    </div>

    <div class="gallery-main">
        <h1><?php echo $sitename; ?> image gallery</h1>
        <?php // Loop through the selected photos and create img tags with their URLs
        foreach ($random_photos as $index) {
            $photo = $photos[$index];
            $photo_url = $photo["urls"]["regular"];
        ?> <div class="img"><img width="100%" src='<?php echo $photo_url; ?>'></div> <?php
                                                                                                }
                                                                                                    ?>
    </div>


</body>

<?php include_once "../includes/footer.php" ?>

</html>