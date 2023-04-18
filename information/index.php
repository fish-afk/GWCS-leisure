<?php include_once "../includes/header.php" ?>
<?php include_once "../includes/navbar.php" ?>
<?php include_once "../includes/db_connect.php" ?>

<body>


    <div class="allsites">
        <?php

        /* This code is querying the database for camping sites that have been marked as "featured" and
       displaying them in a section on the webpage. It does this by first checking if there are any
       featured camping sites in the database, and if so, displaying a heading for the section and
       creating a container for the camping site information. It then loops through the results of
       the query and displays each camping site as a div with its name, image, and location
       displayed. The location is displayed using an embedded Google Maps iframe. */

        $query = "SELECT * FROM CampingSites";

        $result = $conn->query($query);

        if ($result->num_rows > 0) { ?>
            <h2>Choose from our wide variety of sites</h2>

            <div class="box">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="gallery box">
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="site">

                        <h3 class="site-name"><?php echo $row['name'] ?></h3>

                        <div class="main-stuff">
                            <img src="../assets/images/campsites/<?php echo $row['image_url'] ?>" width="70%" height="70%" />

                            <div class="menu">

                                <div class="btn"><a href="/information/sitedetails.php?siteid=<?php echo $row['id'] ?>"><button>SEE DETAILS</button></a></div>
                                <div class="btn"><a href="/information/reviews.php?siteid=<?php echo $row['id'] ?>"><button>REVIEWS</button></a></div>
                                <div class="btn"><a href="/information/features.php?siteid=<?php echo $row['id'] ?>"><button>FEATURES</button></a></div>
                                <div class="btn"><a href="/information/availability?siteid=<?php echo $row['id'] ?>"><button>SEE AVAILABILITY SLOTS</button></a></div>
                                <div class="btn"><a href="/information/booking.php?siteid=<?php echo $row['id'] ?>"><button>BOOK NOW</button></a></div>

                            </div>
                        </div>

                    </div>
            <?php
                }
            } ?>
            </div>


</body>


</html><?php include_once "../includes/footer.php" ?>