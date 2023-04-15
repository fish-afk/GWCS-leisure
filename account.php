<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<body>
    <div class="account-main">
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
        ?>
            <div class="full-space">
                <div class="notauthed">
                    <h1>You are not logged in</h1>
                    <a type="button" href="/login.php" class=""><button class="auth-btns">Log in</button></a>
                    <a type="button" href="/register.php" class=""><button class="auth-btns">Register</button></a>
                </div>
            </div>
        <?php } else { ?>

            <div class="box account-welcome">

                <h1>Welcome <?php echo $_SESSION['username']; ?> </h1>
                <button id="logout-btn">log out</button>

            </div>

            <div class="options box">
                <button id='edit-personal' class="optbtn">
                    Edit personal information
                </button>

                <button id='see-booking' class="optbtn">
                    See my bookings.
                </button>
            </div>

            <div class="menus">

                <div id='info-editor'>

                </div>

                <div id="booking-viewer">

                </div>

            </div>


        <?php } ?>


    </div>


    <script>
        // mode toggler

        const btn1 = document.getElementById("edit-personal");
        const btn2 = document.getElementById("see-booking");


        btn1.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "block";
            document.getElementById('booking-viewer').style.display = "none";

            btn1.style.backgroundColor = "#000";
            btn2.style.background = "#173D33";
        })

        btn2.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "none";
            document.getElementById('booking-viewer').style.display = "block";

            btn2.style.backgroundColor = "#000";
            btn1.style.background = "#173D33";
        })


        // logout functionality

        const logoutbtn = document.getElementById('logout-btn');

        logoutbtn.addEventListener("click", () => {
            window.location.href = "/logout.php";
            alert("Logged out successfully.");
        })
    </script>

</body>

<?php include_once "./includes/footer.php"; ?>

</html>