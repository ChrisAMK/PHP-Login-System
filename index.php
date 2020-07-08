<?php
    require "header.php";
?>

<main>
            <?php
                echo '<p style="text-align: center"><br><br>Welcome to this site<br> I am Demonstrating a PHP log in System with MySQLi, give it a shot</p>';
                // If the user is logged in the is IF statement is triggered
                if (isset($_SESSION['userId'])) {
                    echo '<p class="loggedin">You are logged in!</p>';
                    echo '<iframe class="login-status" width="560" height="315" src="https://www.youtube.com/embed/NVhmq-pB_cs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }
                else {
                    echo '<p class="login-status">You are logged out!</p>';
                    echo '<p class="login-status">Click on Sign up to (guess what) sign up :0</p>';
                }
                // If there is an error in the log-in a error will be displayed.
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "nouser") {
                        echo '<p class="login-status">User does not exist!</p>';
                        exit();
                    }
                    else if ($_GET['error'] == "wrongpwd") {
                        echo '<p class="login-status">Password does not match!</p>';
                        exit();
                    }
                }
            ?>
            
</main>


<?php 
    require "footer.php";
?>