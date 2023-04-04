<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<body>
    <h2>Register</h2>
    <form method="post" action="register_handler.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>First name:</label>
        <input type="text" name="firstname" required><br>
        <label>Surname:</label>
        <input type="text" name="surname" required><br>
        <label>Date of Birth:</label>
        <input type="date" name="dob" required><br>
        <input type="submit" value="Register">
    </form>
</body>


<?php include_once "./includes/footer.php" ?>


</html>