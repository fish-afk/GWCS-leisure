<?php include_once './includes/db_connect.php' ?>
<?php include_once './includes/header.php' ?>
<?php include_once './includes/navbar.php' ?>

<?php


function login($username, $password)
{
    global $pdo;
    global $conn;

    // to prevent sql injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = 'SELECT * FROM Users WHERE (username = :name)';
    $values = [':name' => $username];

    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* Query error. */
        echo 'Query error.';
        die();
    }

    $row = $res->fetch(PDO::FETCH_ASSOC);

    if (CheckIsLocked($_SERVER['REMOTE_ADDR'], $pdo) === true) {
?> <script>
            Swal.fire({
                title: 'Warning!',
                text: 'You have exceeded the maximum number of login attempts. Please try again later.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        </script>
    <?php
    } else {
        // Check if the username exists in the database and the entered password matches the hashed password
        if (is_array($row)) {
            if (password_verify($password, $row['password'])) {
                // Set the session variable for the logged-in user
                session_start();

                $_SESSION['username'] = $row['username'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['surname'];
                $_SESSION['dob'] = $row['DOB'];
                $_SESSION['email'] = $row['email'];

                header("Location: account.php");
            } else {
                LoginAttemptsTrigger($pdo);
            }
        } else {
            LoginAttemptsTrigger($pdo);
        }
    }
}

function CheckIsLocked($ip, $pdo)
{

    // Get the number of failed login attempts for this IP address
    $query = 'SELECT COUNT(*) as count FROM loginattempts WHERE ip_address = :ip AND time_count > :time';
    $time_limit = time() - 600; // 10 minutes
    $values = [':ip' => $ip, ':time' => $time_limit];

    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* Query error. */
        echo 'Query error.';
        die();
    }

    $row = $res->fetch(PDO::FETCH_ASSOC);

    // If there have been 3 or more failed attempts within the last 10 minutes, display an error message
    if ($row['count'] >= 3) {
        return true;
    } else {
        return false;
    }
}


function LoginAttemptsTrigger($pdo)
{

    // Get the IP address of the user
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Get the number of failed login attempts for this IP address
    $query = 'SELECT COUNT(*) as count FROM loginattempts WHERE ip_address = :ip AND time_count > :time';
    $time_limit = time() - 600; // 10 minutes
    $values = [':ip' => $ip_address, ':time' => $time_limit];

    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* Query error. */
        echo 'Query error.';
        die();
    }

    $row = $res->fetch(PDO::FETCH_ASSOC);

    // If there have been 3 or more failed attempts within the last 10 minutes, display an error message
    if ($row['count'] >= 3) {
    ?>
        <script>
            Swal.fire({
                title: 'Warning!',
                text: 'You have exceeded the maximum number of login attempts. Please try again later.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        </script>
    <?php

    } else {
        // Insert a new record into the LogInAttempts table to record the failed login attempt
        $query = 'INSERT INTO loginattempts (ip_address, time_count) VALUES (:ip, :time)';
        $values = [':ip' => $ip_address, ':time' => time()];

        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* Query error. */
            echo 'Query error.';
            die();
        }

    ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Incorrect Credentials',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
<?php
    }
}


if (isset($_POST['username']) && isset($_POST['password'])) {
    login($_POST['username'], $_POST['password']);
}


?>



<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />

<body>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div id='recaptcha' class="g-recaptcha" data-sitekey="6LdjmMElAAAAABfEmkPagcUOBmCcuYlUkVYVyVHO" data-callback="onSubmit" data-size="invisible"></div>

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

                    <button type="submit">Log In</button>
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