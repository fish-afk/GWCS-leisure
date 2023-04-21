<?php include_once "./includes/db_connect.php" ?>

<?php
session_start();

function delete_account($username, $conn)
{
    $stmt = $conn->prepare("DELETE FROM `users` WHERE `username` = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
                        session_destroy();
                        unset($_SESSION['username']);
?> <script>
            Swal.fire(
                'Deleted!',
                'Your account has been deleted.',
                'success'
            )

            window.location.href = '/login.php';
        </script><?php
                    
                } else {
                    ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Error deleting account.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })

            window.location.href = '/account.php';
        </script>
<?php
                }
            }


            if (isset($_SESSION['username'])) {
                delete_account($_SESSION['username'], $conn);
            } else {
                die("Not logged in. please log in first");
            }

?>