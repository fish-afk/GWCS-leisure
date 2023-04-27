<?php include_once "./includes/header.php" ?>
<?php include_once "./includes/navbar.php" ?>
<?php include_once "./includes/db_connect.php" ?>


<?php
session_start();

function saveMessage($message, $topic, $username, $pdo)
{

    $prepared_message = $topic . "\n" . $message;
    // Use prepared statements to prevent SQL injection attacks
    $stmt = $pdo->prepare("INSERT INTO Messages (username, Message) VALUES (:username, :message)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":message", $prepared_message);

    $email = $_SESSION['email'];

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        // Handle any potential database errors here
        echo "Error saving message: " . $e->getMessage();
?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Error saving message, Make sure your network is strong',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
    <?php
    }
    ?>
    <script>
        (function() {
            emailjs.init("user_uBwPjYzKVYr2jLKE17pNV");
        })();

        var templateParams = {
            topic: '<?php echo $topic ?>',
            message: '<?php echo $message ?>',
            from_name: '<?php echo $username ?>',
            reply_back_email: '<?php echo $email ?>'
        };

        emailjs.send('service_57pavgu', 'template_x926d15', templateParams)
            .then(function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Message recieved. We will get back as soon as possible',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            }, function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error saving message, Make sure your network is strong',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            });
    </script>
<?php
}


if (isset($_POST['message']) && isset($_POST['topic']) && isset($_SESSION['username'])) {
    saveMessage(
        htmlspecialchars($_POST['message']),
        htmlspecialchars($_POST['topic']),
        $_SESSION['username'],
        $pdo
    );
}

?>

<body>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div id='recaptcha' class="g-recaptcha" data-sitekey="6LdjmMElAAAAABfEmkPagcUOBmCcuYlUkVYVyVHO" data-callback="onSubmit" data-size="invisible"></div>

    <?php

    if (isset($_SESSION['username'])) {
    ?>
        <section id="section-wrapper">
            <div class="box-wrapper">
                <div class="info-wrap">
                    <h2 class="info-title">Contact Information</h2>
                    <h3 class="info-sub-title">Fill up the form and our Team will get back to you within 24 hours</h3>
                    <ul class="info-details">
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>Phone:</span> <a href="tel:+ 1234 5678 90">+ 1234 5678 90</a>
                        </li>
                        <li>
                            <i class="fas fa-paper-plane"></i>
                            <span>Email:</span> <a href="mailto:gwcs@gmail.com">gwcs@gmail.com</a>
                        </li>

                    </ul>
                    <ul class="social-icons">
                        <li><a target="_blank" href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>


                    <div class="box"><a class="privacy-policy-link" href="/PrivacyPolicy.php">Privacy Policy</a></div>

                </div>
                <div class="form-wrap">
                    <form action="/contact.php" method="POST">
                        <h2 class="form-title">Send us a message</h2>
                        <div class="form-fields">
                            <div class="form-group">
                                <input type="text" name="topic" class="topic" placeholder="Topic" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Write your message" required></textarea>
                            </div>
                        </div>
                        <input type="submit" value="Send Message" class="submit-button">
                    </form>
                </div>
            </div>
        </section><?php } else { ?>

        <div class='box contact-auth'>

            <div>
                <h1>You need to be logged in to send a message.</h1>

                <div>
                    <a type="button" href="/login.php" class=""><button class="auth-btns">Log in</button></a>
                </div>

            </div>

        </div>

    <?php } ?>



</body>

<?php include_once "./includes/footer.php" ?>

</html>