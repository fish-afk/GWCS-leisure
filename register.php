<?php include_once './includes/header.php' ?>
<?php include_once './includes/navbar.php' ?>
<?php include_once './includes/db_connect.php' ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />

<?php

function register($username, $password, $email, $firstname, $surname, $dob)
{

    global $conn;
    global $pdo;

    // Prepare the SQL query to check if the username already exists in the database
    // Prepare the SQL statement
    $sql = 'SELECT * FROM users WHERE username = :username';
    $stmt = $pdo->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':username', $username);

    // Execute the statement
    $stmt->execute();

    // Check if any rows are returned
    if ($stmt->rowCount() > 0) {

?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Username already exists!',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
    <?php
    } else {
        // Hash the password using password_hash()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the new user into the database
        $insert_sql = "INSERT INTO Users (username, password, email, firstname, surname, DOB) VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);

        // Bind the input parameters to the prepared statement using mysqli_stmt_bind_param()
        mysqli_stmt_bind_param($insert_stmt, "ssssss", $username, $hashed_password, $email, $firstname, $surname, $dob);

        // Execute the prepared statement using mysqli_stmt_execute()
        mysqli_stmt_execute($insert_stmt);
    ?>
        <script>
            Swal.fire({
                title: 'Success',
                text: 'Registered Successfully. You may now log in.',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/login.php"
                }
            })
        </script>
<?php
        mysqli_stmt_close($insert_stmt);
    }

    // Close the statements and the connection using mysqli_stmt_close() and mysqli_close()

    mysqli_close($conn);
}

if (
    isset($_POST['username']) && isset($_POST['password']) &&
    isset($_POST['firstname']) && isset($_POST['lastname']) &&
    isset($_POST['email']) && isset($_POST['dob'])
) {

    register(
        htmlspecialchars($_POST['username']),  // htmlspecialchars to prevent stored xss attacks. 
        htmlspecialchars($_POST['password']),
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['firstname']),
        htmlspecialchars($_POST['lastname']),
        htmlspecialchars($_POST['dob'])
    );
}
?>

<body style="background-color: black;">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div id='recaptcha' class="g-recaptcha" data-sitekey="6LeUa7QfAAAAAA3yNTLw0b2G5c2NFQHIDjvKbqhM" data-callback="onSubmit" data-size="invisible"></div>

    <div class="box gradient">

        <div class="register-card-container">
            <div class="register-card">

                <div class="register-card-header">
                    <h1>Register</h1>
                    <div>Signup for an account.</div>
                </div>
                <form class="register-card-form" action="/register.php" method="POST">
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">person</span>
                        <input type="text" placeholder="First Name" name="firstname" id="emailForm" autofocus required>
                    </div>


                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">person</span>
                        <input type="text" placeholder="Last Name" name="lastname" id="emailForm" autofocus required>
                    </div>

                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">person</span>
                        <input type="text" placeholder="Username" name="username" id="emailForm" autofocus required>
                    </div>

                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">date_range</span>
                        <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Date of birth" name="dob" id="passwordForm" autofocus required>
                    </div>

                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">mail</span>
                        <input type="email" placeholder="Email" name="email" id="passwordForm" autofocus required>
                    </div>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Password" name="password" id="emailForm" autofocus required>
                    </div>


                    <button type="submit">Register</button>
                </form>
                <div class="register-card-footer">
                    Already have an account? <a href="/login.php">Log In.</a>
                </div>
            </div>

        </div>
    </div>

</body>

<?php include_once './includes/footer.php' ?>


</html>