<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<body>
    <div class='box'>

        <div class="full-space"><?php
                                session_start();
                                if (isset($_SESSION['username'])) {
                                ?>

                <h1>Account</h1>

                <a href='/logout.php'>Log Out</a>

            <?php } else { ?>

                <h1>You are not logged in</h1>
                <a type="button" href="/login.php" class=""><button class="auth-btns">Log in</button></a>
                <a type="button" href="/register.php" class=""><button class="auth-btns">Register</button></a>


            <?php } ?>
        </div>

    </div>


</body>

<?php include_once "./includes/footer.php"; ?>

</html>