<?php include_once './includes/header.php' ?>
<?php include_once './includes/navbar.php' ?>
<?php include_once './includes/db_connect.php' ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />

<?php

    $attempt = 0;

    function login($username, $password){
        return true;
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
                    <h1>Sign In</h1>
                    <div>Please login to use the platform</div>
                </div>
                <form class="login-card-form">
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">mail</span>
                        <input type="text" placeholder="Enter Email" id="emailForm" autofocus required>
                    </div>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Enter Password" id="passwordForm" required>
                    </div>

                    <button type="submit">Sign In</button>
                </form>
                <div class="login-card-footer">
                    Don't have an account? <a href="#">Create a free account.</a>
                </div>
            </div>

        </div>
    </div>

</body>

<?php include_once './includes/footer.php' ?>


</html>