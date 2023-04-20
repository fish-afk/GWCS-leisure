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
    <div class="availability-main">

        <?php
        $query = "SELECT * FROM pitches WHERE site_id = $siteid";
        $query2 = "SELECT * FROM swimmingsessions WHERE site_id = $siteid";
        $result2 = $conn->query($query2);

        $tent_pitch_count = 0;
        $motorhome_pitch_count = 0;
        $touring_caravan_pitch_count = 0;

        $result = $conn->query($query);

        if ($result->num_rows < 1) { ?>
            <h1 class="warns">No pitches available at the moment for the campsite. Check back later.</h1>
        <?php
        } else {
            while ($row = $result->fetch_assoc()) {

                if ($row['Pitch_Type'] == 1) {
                    $tent_pitch_count++;
                }

                if ($row['Pitch_Type'] == 2) {
                    $touring_caravan_pitch_count++;
                }

                if ($row['Pitch_Type'] == 3) {
                    $motorhome_pitch_count++;
                }
            }
        ?>

            <div class="pitches">
                <h1>The following are the pitch types available at <?php echo $sitename; ?>
                    <h2>number of <a href="/pitchTypes.php">Tent pitches </a> available: <?php echo $tent_pitch_count ?> </h2>
                    <h2>number of <a href="/pitchTypes.php">Touring caravan pitches </a> available: <?php echo $touring_caravan_pitch_count ?> </h2>
                    <h2>number of <a href="/pitchTypes.php">Motorhome pitches: </a> available: <?php echo $motorhome_pitch_count ?> </h2>
                <?php } ?>

                <?php


                if ($result2->num_rows < 1) { ?>
                    <h1 class="warns">No swimming sessions available at the moment for the campsite. Check back later.</h1>
                <?php
                } else { ?>
                    <div class="swimming-sessions">
                        <h1>The following are the swimming sessions that run at <?php echo $sitename; ?>
                            <?php while ($row2 = $result2->fetch_assoc()) {

                            ?> <h2><?php echo $row2['Start'] ?>hrs to <?php echo $row2['End'] ?>hrs</h2>
                                <h3>Price: $<?php echo $row2['price'] ?></h3>

                            <?php }  ?>
                        <?php } ?>
                    </div>
            </div>

    </div>

</body>

<?php include_once "../includes/footer.php" ?>

</html>