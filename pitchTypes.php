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
            /* This is a PHP code block that retrieves data from a database table called "PitchTypes"
            and displays it on a webpage. The code uses a SQL query to select all columns and rows
            from the "PitchTypes" table, and then loops through each row using a while loop. Inside
            the loop, the code displays the pitch type name, image, and description using HTML and
            PHP echo statements. The data is displayed in a styled container with a class of
            "pitchtype". */

            $query = "SELECT * FROM PitchTypes";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="pitchtype" id="<?php echo $row['id'] ?>">

                    <div class="img">
                        <h2><?php echo $row['type_name'] ?></h2>

                        <img src="./assets/images/pitch_types/<?php echo $row['image'] ?>" width="100%" />
                    </div>

                    <div class="desc">
                        <?php echo $row['description'] ?>
                        <h3>Price: $<?php echo $row['price'] ?></h3>
                    </div>


                </div>
            <?php } ?>
        </div>

    </div>

    <script>
        let thecookie;

        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.startsWith("Selectedtype=")) {
                var value = cookie.substring("Selectedtype=".length, cookie.length);
                thecookie = value;
                break;
            }
        }

        $(window).on('load', function() {
            // Handler for .load() called.
            if (thecookie) {
                $('html, body').animate({
                    scrollTop: $('#' + thecookie).offset().top
                }, 'slow');
            }
        });
    </script>





</body>


<?php include_once "./includes/footer.php" ?>

</html>