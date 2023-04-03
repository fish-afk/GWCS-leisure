<?php include_once "./include/header.php" ?>
<?php include_once "./include/navbar.php" ?>

<?php



?>


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


<?php include_once "./include/footer.php" ?>