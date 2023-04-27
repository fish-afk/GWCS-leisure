<?php
include_once "../includes/header.php";
include_once "../includes/navbar.php";
include_once "../includes/db_connect.php";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = "";
}

$query = "SELECT * FROM CampingSites WHERE name LIKE '%" . $search . "%'";

$result = $conn->query($query);
?>

<body>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div id='recaptcha' class="g-recaptcha" data-sitekey="6LdjmMElAAAAABfEmkPagcUOBmCcuYlUkVYVyVHO" data-callback="onSubmit" data-size="invisible"></div>

    <div class="allsites">

        <h2>Discover nature</h2>

        <div class="box">
            <form action="/information/index.php" class="box" method="get">
                <div class="search">
                    <input type="text" class="searchTerm" name="search" placeholder="What are you looking for?" value="<?php echo $search; ?>">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="gallery box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="site">

                        <h3 class="site-name"><?php echo $row['name'] ?></h3>

                        <div class="main-stuff">
                            <img src="../assets/images/campsites/<?php echo $row['image_url'] ?>" width="70%" height="70%" />

                            <div class="menu">

                                <div class="btn"><a href="/information/features.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"><button>DETAILS & FEATURES</button></a></div>
                                <div class="btn"><a href="/information/sitereviews.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"> <button>REVIEWS</button></a></div>
                                <div class="btn"><a href="/information/availability.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"><button>AVAILABILITY</button></a></div>
                                <div class="btn"><a href="/information/localattractions.php?siteid=<?php echo $row['id'] ?>&sitename=<?php echo $row['name'] ?>"><button>LOCAL ATTRACTIONS</button></a></div>


                            </div>
                        </div>

                    </div>
                <?php
                }
            } else { ?>
                <div class="box">
                    <h1 class="warn">No search results found</h1>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

<?php include_once "../includes/footer.php" ?>