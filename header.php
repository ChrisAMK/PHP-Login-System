<?php
    session_start()
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">

    <title>Best part about your day?</title>
</head>

<body>
<header>
    <nav class="nav-bar">
        <a href="index.php">
            <img src="img/ckclogo.png" alt="logo" class="logo">
        </a>
        <div class="nav-bar-left-container">
            <ul class="nav-bar-left">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="login">
            <?php
                if (isset($_SESSION['userId'])) {

                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">logout</button>
                </form>';
                

                }
                else {
                    echo '<form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/E-Mail...">
                    <input type="password" name="pwd" placeholder="Password..">
                    <button type="submit" name="login-submit">Log-In</button>
                </form>
                <a href="signup.php">Sign up</a>';
                }
            ?>

        </div>
    </nav>
</header>
</body>