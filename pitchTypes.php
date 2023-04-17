<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<body>

    <div class="pitchtypes-main">

        <div class="box">
            <h1>The following are the pitch types we offer and requirements to set them up.</h1>
        </div>

        <div>
            <?php
            $query = "SELECT * FROM PitchTypes";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="pitchtype">

                    <div class="img">
                        <h2><?php echo $row['type_name'] ?></h2>
                        <img src="./assets/images/pitch_types/<?php echo $row['image'] ?>" width="100%" />
                    </div>

                    <div class="box">
                        <?php echo $row['description'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>





</body>

</html>

<?php include_once "./includes/footer.php" ?>