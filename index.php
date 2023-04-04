<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>

<?php

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div id='recaptcha' class="g-recaptcha" data-sitekey="6LeUa7QfAAAAAA3yNTLw0b2G5c2NFQHIDjvKbqhM" data-callback="onSubmit" data-size="invisible"></div>

<body>

    <div class="box intro">
        <div>
            <h1>Explore the outdoors.</h1><br>
            <h2>Discover and reserve camping sites and swimming areas at stunning natural locations around the world.</h2>
        </div>
    </div>

    <div class="box">
        <div class="search-container">
            <form action="/" method="POST">
                <input placeholder="Search Destinations" type="text" id='speechToText'>
                <i class="fa fa-microphone"></i>
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="box">

        <div class="intro-img">
            <img width="100%" src="./assets/images/camp.jpg" />
        </div>

        <div class="intro-img">
            <img width="100%" src="./assets/images/camp.jpg" />
        </div>

    </div>


    <script>
        function record() {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "en-GB";

            recognition.onresult = function(event) {
                // console.log(event);
                document.getElementById('speechToText').value = event.results[0][0].transcript;
            }
            recognition.start();

        }
    </script>


</body>


<?php include_once "./includes/footer.php" ?>

</html>