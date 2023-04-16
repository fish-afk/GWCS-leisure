<?php
// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home')
{
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS 
    $base = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = array("<a href=\"$base\">$home</a>");

    // Find out the index for the last value in our path array
    $pathkeys = array_keys($path);
    $last = end($pathkeys);

    // Build the rest of the breadcrumbs
    foreach ($path as $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }

    // Build our temporary array (pieces of bread) into one big string
    return implode($separator, $breadcrumbs);
}

?>

<footer class="footer-distributed">

    <div class="footer-left">

        <nav class="breadcrumb">
            <h4>You are here:</h4>
            <p><?= breadcrumbs(' > ') ?></p>
        </nav>


        <h3>GW<span>CS</span></h3>

        <p class="footer-company-name"><strong>Copyright ©</strong>
            <?php
            $year = date("Y");
            echo $year
            ?>
            All rights reserved
        </p>


    </div>

    <div class="footer-center">
        <p class="footer-company-about">
            <span id="quick-links">Quick Links</span>
        </p>
        <ul>
            <li>• <a href="/PrivacyPolicy.php">Privacy Policy</a></li>
            <li>• <a href="/contact.php">Contact Us </a></li>
            <li>• <a href="/information.php">Information</a></li>
            <li>• <a href="/reviews.php">Reviews</a></li>
        </ul>
    </div>

    <div class="footer-right">
        <p class="footer-company-about">
            <span>About GWCS</span>
            <strong>Global Wild Camping and Swimming (GWCS)</strong> is a company that specializes in providing adventurous outdoor experiences to nature enthusiasts. We offer a variety of wild swimming and camping packages in stunning natural locations around the world.
        </p>
        <div class="footer-icons">
            <a target="_blank" href="https://facebook.com"><i class="fab fa-facebook"></i></a>
            <a target="_blank" href="https://instagram.com"><i class="fab fa-instagram"></i></a>
            <a target="_blank" href="https://linkedin.com"><i class="fab fa-linkedin"></i></a>
            <a target="_blank" href="https://twitter.com"><i class="fab fa-twitter"></i></a>
            <a target="_blank" href="https://youtube.com"><i class="fab fa-youtube"></i></a>
        </div>
    </div>

</footer>