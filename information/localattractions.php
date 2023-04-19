<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<?php
$siteid;
if (isset($_GET['siteid'])) {
    $siteid = addslashes($_GET['siteid']);
} else {
    die("<h1>site id needed</h1>");
}
?>

<body>

 <div class="main">
    <h1>
        
    </h1>
 </div>

</body>

<?php include_once "../includes/footer.php" ?>

</html>