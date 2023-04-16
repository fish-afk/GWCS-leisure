<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>
<?php
session_start();
function Update_Account_Info($username, $email, $firstname, $surname, $dob, $conn)
{

    // Prepare and execute the SQL statement to update the user record
    $stmt = $conn->prepare("UPDATE users SET email=?, firstname=?, surname=?, DOB=? WHERE username=?");
    $stmt->bind_param("sssss", $email, $firstname, $surname, $dob, $username);
    $success = $stmt->execute();

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    echo $success;
    return $success;
}

if (
    isset($_POST['firstname']) && isset($_POST['lastname']) &&
    isset($_POST['email']) && isset($_POST['dob'])
) {

    Update_Account_Info(    
        $_SESSION['username'],                        
        htmlspecialchars($_POST['email']), // htmlspecialchars to prevent stored xss attacks. 
        htmlspecialchars($_POST['firstname']),
        htmlspecialchars($_POST['lastname']),
        htmlspecialchars($_POST['dob']),
        $conn
    );
}

?>

<body>
    <div class="account-main">
        <?php
        
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

                <div id='info-editor' class="box">
                    <form method="POST" action="/account.php">
                        <label for="firstname">First Name: </label>
                        <input type="text" name="firstname" required placeholder="<?php echo $_SESSION['firstname'] ?>" />
                        <label for="lastname">Last Name: </label>
                        <input type="text" name="lastname" required placeholder="<?php echo $_SESSION['lastname'] ?>" />
                        <label for="dob">DOB: </label>
                        <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dob" required placeholder="<?php echo $_SESSION['dob'] ?>" />
                        <label for="email">Email: </label>
                        <input type="email" name="email" required placeholder="<?php echo $_SESSION['email'] ?>" />

                        <div class="box"><button type="submit">save</button></div>

                    </form>
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

        btn1.style.backgroundColor = "#000";
        btn1.style.boxShadow = "3px 3px 8px #b1b1b1, -3px -3px 8px #ffffff";
        btn2.style.background = "#173D33";


        btn1.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "block";
            document.getElementById('booking-viewer').style.display = "none";

            btn1.style.backgroundColor = "#000";
            btn1.style.boxShadow = "3px 3px 8px #b1b1b1, -3px -3px 8px #ffffff";
            btn2.style.background = "#173D33";
            btn2.style.boxShadow = "none";
        })

        btn2.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "none";
            document.getElementById('booking-viewer').style.display = "block";

            btn2.style.backgroundColor = "#000";
            btn2.style.boxShadow = "3px 3px 8px #b1b1b1, -3px -3px 8px #ffffff";
            btn1.style.background = "#173D33";
            btn1.style.boxShadow = "none";
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