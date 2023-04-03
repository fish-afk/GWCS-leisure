<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>

<body>

    <?php
    session_start();
    if (empty($_SESSION['logged'])) {
        echo "<h1> Youre currently not logged in </h1>";
        include_once "./includes/footer.php" ;
        die();
    }

    if ($_SESSION['LOGGED'] == false) {
        echo "<h1> Youre currently not logged in </h1>";
        include_once "./includes/footer.php" ;
        die();
    }
    ?>


</body>



</html>