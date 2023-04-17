<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<body>

    <div class="allsites">
        <?php

        /* This code is querying the database for camping sites that have been marked as "featured" and
       displaying them in a section on the webpage. It does this by first checking if there are any
       featured camping sites in the database, and if so, displaying a heading for the section and
       creating a container for the camping site information. It then loops through the results of
       the query and displays each camping site as a div with its name, image, and location
       displayed. The location is displayed using an embedded Google Maps iframe. */

        $query = "SELECT * FROM CampingSites";

        $result = $conn->query($query);

        if ($result->num_rows > 0) { ?>
            <h2>Our camping sites</h2>
            <div class="gallery box">
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="site">

                        <h3 class="site-name"><?php echo $row['name'] ?></h3>
                        <img src="./assets/images/campsites/<?php echo $row['image_url'] ?>" width="100%" height="70%" />

                        <div class="location-map">

                            <?php
                            $location = $row['location'];
                            list($latitude, $longitude) = explode(",", $location);
                            $latitude = (float) $latitude;
                            $longitude = (float) $longitude;

                            $src = "https://maps.google.com/maps?q=$latitude,$longitude&hl=en&z=14&amp;output=embed";
                            ?>

                            <iframe width="100%" height="100%" frameborder="0" scrolling="yes" src=<?php echo $src; ?>>
                            </iframe>
                        </div>
                    </div>
            <?php
                }
            } ?>
            </div>


</body>

<?php include_once "../includes/footer.php" ?>

</html>