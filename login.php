<?php include_once './includes/header.php' ?>
<?php include_once './includes/navbar.php' ?>
<?php include_once './includes/db_connect.php' ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />

<?php

    $attempt = 0;

    function login($username, $password){
        global $conn;
        // Query the database for the user with the matching username and password
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        // Check if the query returned a row
        if (mysqli_num_rows($result) === 1) {
            // Set the session variable
            $_SESSION['username'] = $username;

            // Redirect to the account page
            header('Location: account.php');
            exit();
        } else {
            // Display an error message if the login failed
            header('Location: index.php');
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        login($_POST['username'], $_POST['password']);
    }
?>

<body style="background-color: black;">

    <div class="box gradient">
        
        <div class="login-card-container">
            <div class="login-card">

                <div class="login-card-header">
                    <h1>Log In</h1>
                    <div>Please login to use the platform</div>
                </div>
                <form class="login-card-form" action="/login.php" method="POST">
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">person</span>
                        <input type="text" placeholder="Enter Username" name="username" id="emailForm" autofocus required>
                    </div>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Enter Password" name="password" id="passwordForm" required>
                    </div>

                    <button type="submit">Sign In</button>
                </form>
                <div class="login-card-footer">
                    Don't have an account? <a href="/register.php">Register.</a>
                </div>
            </div>

        </div>
    </div>

</body>

<?php include_once './includes/footer.php' ?>


</html>