<?php include_once "./includes/db_connect.php" ?>
<?php include_once "./includes/header.php" ?>

<?php

session_start();

function delete_account($username, $conn)
{
    $stmt = $conn->prepare("DELETE FROM `users` WHERE `username` = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    try {
        $stmt->execute();
        // The statement executed successfully
        session_destroy();
        unset($_SESSION['username']);
?> <script>
            alert("Deleted account successfully")

            window.location.href = '/login.php';
        </script><?php
                } catch (PDOException $e) {
                    // There was an error executing the statement

                    ?> <script>
            Swal.fire({
                title: 'Error!',
                text: 'Error deleting account.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })

            window.location.href = '/account.php';
        </script><?php
                }
            }


            if (isset($_SESSION['username'])) {
                delete_account($_SESSION['username'], $conn);
            } else {
                die("<h1>Not logged in. please <a href='/login.php'>log in</a> first</h1>");
            }

                    ?>