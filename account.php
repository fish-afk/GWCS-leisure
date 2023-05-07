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


    if ($success == 1) { ?>
        <script>
            Swal.fire({
                title: 'Success',
                text: 'Details updated successfully',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>
    <?php } else { ?>

        <script>
            Swal.fire({
                title: 'Error',
                text: 'Error updating details.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
        <?php }
}

function change_password($current_pass, $new_pass, $username, $conn)
{
    // Hash the new password using sha256
    $new_pass_hash = hash('sha256', $new_pass);

    // Retrieve the user's hashed password from the database
    $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `username` = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (password_verify($current_pass, $result['password'])) {
        // Update the user's password with the new one
        $new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ?");
        $stmt->bind_param('ss', $new_pass_hash, $username);

        try {
            $stmt->execute();
            // The statement executed successfully

        ?> <script>
                Swal.fire({
                    title: 'Success',
                    text: 'Password updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login.php"
                    }
                })
            </script><?php
                    } catch (PDOException $e) {

                        ?><script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating password',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            </script> <?php
                        // There was an error executing the statement
                    }
                } else { ?> <script>
            Swal.fire({
                title: 'Error!',
                text: 'Incorrect current password',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
<?php
                }
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

            if (
                isset($_POST['currentpass']) && isset($_POST['newpass'])
            ) {
                change_password($_POST['currentpass'], $_POST['newpass'], $_SESSION['username'], $conn);
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
                <button id="delete-btn">Delete account</button>
            </div>

            <div class="options box">
                <button id='edit-personal' class="optbtn">
                    Edit personal information
                </button>

                <button id='change-password' class="optbtn">
                    Change Password
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

                <div id="change-pass">
                    <form method="POST" action="/account.php">
                        <label for="firstname">Current password: </label>
                        <input type="text" name="currentpass" required placeholder="Current password" />
                        <label for="lastname">New password: </label>
                        <input type="text" name="newpass" required placeholder="New password" />
                        <div class="box"><button type="submit">Change</button></div>
                    </form>
                </div>

            </div>


        <?php } ?>


    </div>


    <script>
        // mode toggler

        const btn1 = document.getElementById("edit-personal");
        const btn2 = document.getElementById("change-password");

        document.getElementById('info-editor').style.display = "block";
        document.getElementById('change-pass').style.display = "none";
        
        btn1.style.backgroundColor = "#000";
        btn1.style.boxShadow = "3px 3px 8px #b1b1b1, -3px -3px 8px #ffffff";
        btn2.style.background = "#173D33";


        btn1.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "block";
            document.getElementById('change-pass').style.display = "none";

            btn1.style.backgroundColor = "#000";
            btn1.style.boxShadow = "3px 3px 8px #b1b1b1, -3px -3px 8px #ffffff";
            btn2.style.background = "#173D33";
            btn2.style.boxShadow = "none";
        })

        btn2.addEventListener('click', () => {
            document.getElementById('info-editor').style.display = "none";
            document.getElementById('change-pass').style.display = "block";

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

        const deletebtn = document.getElementById('delete-btn');

        deletebtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    window.location.href = "/deleteAccount.php";
                }
            })
        })
    </script>

</body>

<?php include_once "./includes/footer.php"; ?>

</html>