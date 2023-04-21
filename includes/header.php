<!DOCTYPE html>
<html lang="en">

<?php
$connected = @fsockopen("www.google.com", 80);
if ($connected) {
    fclose($connected);
} else {
    die("<h1>Please connect to wifi or internet for this site to function properly</h1>\n 
    <h2>If you dont have internet, remove this check in the header.php file found in the includes folder.</h2>");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='icon' href='/assets/images/logo.png' />

    <link rel='stylesheet' href="/css/navbar.css" />
    <link rel='stylesheet' href="/css/footer.css" />
    <link rel='stylesheet' href="/css/index.css" />
    <link rel='stylesheet' href="/vendor/fontawesome/css/all.css" />

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/email.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert2.all.min.js"></script>


    <title>Global Wild Camping and Swimming</title>

</head>