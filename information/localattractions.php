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
    die("<h1>site id needed</h1>");
}
?>

<body>

    <div class="localattractions-main">

        <div class="box">
            <h1>The following are the localattractions near <?php echo $sitename; ?></h1>
        </div>

        <?php
        $query = "SELECT * FROM LocalAttractions WHERE site_id = $siteid";

        $result = $conn->query($query);

        if ($result->num_rows < 1) { ?>
            <h1>This site has no local attractions</h1>
            <?php } else {
            while ($row = $result->fetch_assoc()) {

            ?>
                <div class="attraction">
                    <h1><?php echo $row['attraction_name'] ?></h1>
                    <p><?php echo $row['description'] ?></p>
                    <p class="special-info">Miles from site: <?php echo $row['milesFromSite'] ?></p>
                    <p class="special-info">Price per person: $<?php echo $row['milesFromSite'] ?></p>
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