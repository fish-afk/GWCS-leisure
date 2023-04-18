<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<?php
$siteid;
if (isset($_GET['siteid'])) {
    $siteid = addslashes($_GET['siteid']);
}else{
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

                
             } else { ?>

                <h1>Campsite with this id not found</h1>

           <?php }
            
            ?>
        </div>

        <div class="right">

        </div>

        </div>


</body>

<?php include_once "../includes/footer.php" ?>

</html>