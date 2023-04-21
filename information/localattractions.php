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
?>

<body>

    <div class="localattractions-main">



        <?php
        $query = "SELECT * FROM LocalAttractions WHERE site_id = $siteid";



        $result = $conn->query($query);

        if ($result->num_rows < 1) { ?>
            <h1>This site has no local attractions</h1>
        <?php } else {
        ?> <div class="box">
                <h1>The following are the localattractions near <?php echo $sitename; ?></h1>
            </div><?php
                    while ($row = $result->fetch_assoc()) {

                        // Define the query parameter with a variable;
                        $query_param = "query=" . urlencode($row['attraction_name']);

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

                        // Randomly select 1 from the array
                        $random_index = array_rand($photos, 1);
                        $photo = $photos[$random_index];

                        $photo_url = $photo["urls"]["regular"];
                        $photo_alt = $photo["alt_description"];


                    ?>
                <div class="attraction">

                    <h1><?php echo $row['attraction_name'] ?></h1>
                    <p><?php echo $row['description'] ?></p>
                    <p class="special-info">Miles from site: <?php echo $row['milesFromSite'] ?></p>
                    <p class="special-info">Price per person: $<?php echo $row['price'] ?></p>
                    <img src='<?php echo $photo_url ?>' width="100%" />
                </div>

        <?php

                    }
                }
        ?>
        <h1>

        </h1>
    </div>

</body>

<?php include_once "../includes/footer.php" ?>

</html>