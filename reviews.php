<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<body>

    <div class="reviews-main">


        <?php
        $query = "SELECT * FROM Reviews WHERE rating = 5 or rating = 4";

        $result = $conn->query($query);

    ?>
            <h1>Some of our satisfied clients</h1>

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
        ?>
    </div>

</body>

<?php include_once "./includes/footer.php" ?>

</html>