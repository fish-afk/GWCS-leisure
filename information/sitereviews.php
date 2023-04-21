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

    <div class="reviews-main">


        <?php
        $query = "SELECT * FROM Reviews WHERE site_id = $siteid";

        $result = $conn->query($query);

        if ($result->num_rows < 1) { ?>
            <h1>This site has no reviews</h1>
        <?php } else { ?>

            <h1>The following are the reviews for <?php echo $sitename ?></h1>

            <?php
            while ($row = $result->fetch_assoc()) { ?>


                <div class="review">
                    <h2>User: <?php echo $row['username']; ?></h2>
                    <br>
                    <br>
                    Review: <?php echo $row['reviewText']; ?>
                    <br>
                    <br>

                    <div class="rating">Rating:

                    <?php for ($i = 0; $i < $row['rating']; $i++) {

                    ?> <span class="fa fa-star"></span> <?php

                                                        } ?></div>
                    


                </div>



        <?php }
        } ?>
    </div>

</body>

<?php include_once "../includes/footer.php" ?>

</html>