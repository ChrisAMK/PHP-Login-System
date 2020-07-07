<?php
    require "header.php"
?>

<main>
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 signup-container">
            <h1>Sign up</h1>
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p>Fill in all the fields!</p>';
                    }
                    else if ($_GET['error'] == "invalidmailuid") {
                        echo '<p>Invalid Email and Username</p>';
                    }
                    else if ($_GET['error'] == "invaliduid") {
                        echo '<p>Invalid Email</p>';
                    }
                    else if ($_GET['error'] == "invalidmail") {
                        echo '<p>Invalid Email</p>';
                    }
                    else if ($_GET['error'] == "passwordcheck") {
                        echo '<p>Your Passwords do not match!</p>';
                    }
                    else if ($_GET['error'] == "usertaken") {
                        echo '<p>Username is already Taken!</p>';
                    }
                    else if ($_GET['error'] == "nouser") {
                        echo '<p>User does not exist!</p>';
                    }
                    else if ($_GET['error'] == "wrongpwd") {
                        echo '<p>Incorrect Password!</p>';
                    }
                }  
                else if (isset($_GET['signup']) == "success") {
                    echo '<p>Sign up Successful!</p>';
                    }

           
            ?>
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username"><br>
                    <input type="text" name="mail" placeholder="E-mail"><br>
                    <input type="password" name="pwd" placeholder="Password"><br>
                    <input type="password" name="pwd-repeat" placeholder="Repeat Password"><br>
                    <button type="submit" name="signup-submit">Sign up</button>
                </form>
        </div>
    </div>

</main>




<?php
    require "footer.php"
?>