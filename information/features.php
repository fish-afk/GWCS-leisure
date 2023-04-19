<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<?php
$siteid;
if (isset($_GET['siteid'])) {
    $siteid = addslashes($_GET['siteid']);
} else {
    die("<h1>site id needed</h1>");
}
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
                <a href="/information/sitereviews.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name']?>"> <button class="guide-btn">See reviews </button></a>
                <a href="/information/localattractions.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name']?>"> <button class="guide-btn">See local attractions</button></a>
                <a href="/information/availability.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name']?>"> <button class="guide-btn">Check availability </button></a>
            </div>
        </div>

    </div>


</body>

<?php include_once "../includes/footer.php" ?>

</html>