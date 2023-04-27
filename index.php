<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>
<?php include_once './includes/db_setup.php' // database setup 
?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div id='recaptcha' class="g-recaptcha" data-sitekey="6LdjmMElAAAAABfEmkPagcUOBmCcuYlUkVYVyVHO" data-callback="onSubmit" data-size="invisible"></div>

<body>

    <div class="index-top box">
        <div class='intro'>
            <h1>Explore the outdoors.</h1><br>
            <h2>Discover and reserve camping sites and swimming areas at stunning natural locations around the world.</h2>
            <button class="intro-btn">SHOW ME!<i class="arrow-right"></i></button>
        </div>


        <div class="img-slider">
            <div class="slide active">
                <img src="./assets/images/slideshow/slide1.jpg" alt="slide1">
                <div class="info">
                    <h2>Malawi</h2>

                </div>
            </div>
            <div class="slide">
                <img src="./assets/images/slideshow/slide2.jpg" alt="slide2">
                <div class="info">
                    <h2>Zambia</h2>
                </div>
            </div>
            <div class="slide">
                <img src="./assets/images/slideshow/slide3.jpg" alt="slide3">
                <div class="info">
                    <h2>Iceland</h2>

                </div>
            </div>
            <div class="slide">
                <img src="./assets/images/slideshow/slide4.jpg" alt="slide4">
                <div class="info">
                    <h2>South Africa</h2>

                </div>
            </div>

            <div class="navigation">
                <div class="btn active"></div>
                <div class="btn"></div>
                <div class="btn"></div>
                <div class="btn"></div>
            </div>
        </div>

    </div>



    <div class="index-mid">
        <h2>Pitch Types We Offer</h2>
        <div class="pitch-types box">

            <?php

            /* This code is displaying a section on the webpage that shows the different types of pitches that
        the website offers. It does this by querying the database for the different pitch types and then
        displaying them in a loop using PHP. Each pitch type is displayed as a div with an image and a
        link to see more details. The link sets a cookie with the selected pitch type so that it can be
        used later on other pages. */

            $query = "SELECT * FROM PitchTypes";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="pitch" id="<?php echo $row["type_name"]; ?>">
                    <h3>
                        <?php
                        echo $row["type_name"];
                        ?>
                    </h3>
                    <div class="detailtext">
                        <a href="/pitchTypes.php" onclick="setcookie('<?php echo $row['id']; ?>')">See details</a>
                    </div>
                    <img src="./assets/images/pitch_types/<?php echo $row['image'] ?>" width="100%" />

                </div>
            <?php } ?>

        </div>

    </div>

    <script>
        function setcookie(id) {
            document.cookie = "Selectedtype=" + id;
        }
    </script>

    <div class="index-final">
        <?php

        /* This code is querying the database for camping sites that have been marked as "featured" and
       displaying them in a section on the webpage. It does this by first checking if there are any
       featured camping sites in the database, and if so, displaying a heading for the section and
       creating a container for the camping site information. It then loops through the results of
       the query and displays each camping site as a div with its name, image, and location
       displayed. The location is displayed using an embedded Google Maps iframe. */

        $query = "SELECT * FROM CampingSites WHERE Featured = 1";

        $result = $conn->query($query);

        if ($result->num_rows > 0) { ?>
            <h2>Featured sites</h2>
            <div class="gallery box">
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="site">

                        <h3 class="site-name"><a href="/information/features.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></h3>
                        <img src="./assets/images/campsites/<?php echo $row['image_url'] ?>" width="100%" height="70%" />

                        <div class="location-map">

                            <?php
                            $location = $row['location'];
                            list($latitude, $longitude) = explode(",", $location);
                            $latitude = (float) $latitude;
                            $longitude = (float) $longitude;

                            $src = "https://maps.google.com/maps?q=$latitude,$longitude&hl=en&z=14&amp;output=embed";
                            ?>

                            <iframe width="100%" height="100%" frameborder="0" scrolling="yes" src=<?php echo $src; ?>>
                            </iframe>
                        </div>
                    </div>
            <?php
                }
            } ?>
            </div>



            <div class="rss-feed">
                <h2>Camping Rss feed</h2>
                <!-- rss feed -->
                <iframe src="https://widget.taggbox.com/128544" style="width:100%;height:900px;border:none;"></iframe>
            </div>




            <div class="viewcounter">
                <h2>Number of page views:
                    <?php
                    $SHOW_VIEWS;
                    if (!file_exists('viewcount.txt')) {
                        touch('viewcount.txt');
                        $count_views = ("viewcount.txt");
                        $fp = fopen($count_views, "w");
                        fputs($fp, "1");
                        $SHOW_VIEWS = 1;
                    } else {
                        $count_views = ("viewcount.txt");
                        $views = file($count_views);
                        $views[0]++;

                        $fp = fopen($count_views, "w");
                        fputs($fp, "$views[0]");
                        fclose($fp);
                        $SHOW_VIEWS = $views[0];
                    }
                    echo $SHOW_VIEWS;
                    ?>
            </div>

            </h2>
    </div>
    <div class="cursor"></div>
    <script>
        const showbtn = document.querySelector('.intro-btn').addEventListener('click', () => {
            window.location.href = '/information/index.php';
        })

        let cursor = document.querySelector(".cursor");
        let a = document.querySelectorAll("a");

        document.addEventListener("mousemove", function(e) {
            let x = e.clientX;
            let y = e.clientY;
            cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
        });

        document.addEventListener("mousemove", function(e) {
            let x = e.clientX;
            let y = e.clientY;
        });

        document.addEventListener("mousedown", function() {
            cursor.classList.add("click");

        });

        document.addEventListener("mouseup", function() {
            cursor.classList.remove("click");

        });

        a.forEach((item) => {
            item.addEventListener("mouseover", () => {
                cursor.classList.add("hover");
            });
            item.addEventListener("mouseleave", () => {
                cursor.classList.remove("hover");
            });
        });


        function record() {
            let recognition = new webkitSpeechRecognition();
            recognition.lang = "en-GB";

            recognition.onresult = function(event) {
                // console.log(event);
                document.getElementById('speechToText').value = event.results[0][0].transcript;
            }
            recognition.start();

        }


        let slides = document.querySelectorAll('.slide');
        let btns = document.querySelectorAll('.btn');
        let currentSlide = 1;

        // Javascript for image slider manual navigation
        let manualNav = function(manual) {
            slides.forEach((slide) => {
                slide.classList.remove('active');

                btns.forEach((btn) => {
                    btn.classList.remove('active');
                });
            });

            slides[manual].classList.add('active');
            btns[manual].classList.add('active');
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                manualNav(i);
                currentSlide = i;
            });
        });

        // Javascript for image slider autoplay navigation
        let repeat = function(activeClass) {
            let active = document.getElementsByClassName('active');
            let i = 1;

            let repeater = () => {
                setTimeout(function() {
                    [...active].forEach((activeSlide) => {
                        activeSlide.classList.remove('active');
                    });

                    slides[i].classList.add('active');
                    btns[i].classList.add('active');
                    i++;

                    if (slides.length == i) {
                        i = 0;
                    }
                    if (i >= slides.length) {
                        return;
                    }
                    repeater();
                }, 2500);
            }
            repeater();
        }
        repeat();
    </script>

</body>


<?php include_once "./includes/footer.php" ?>

</html>