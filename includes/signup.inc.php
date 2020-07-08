<?php
// if the user submits the forms, code is executed
if (isset($_POST['signup-submit'])) {
   // Connect to database
    require "dbh.inc.php";

    // assigns variables out of the information entered by the user in the form
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // Error handling, basically is something is empty, you'll get an error
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    // This is the check for a valid Email address and Username
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    // Checks for valid Email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
    }
    // Checks for valid username
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    // Checks to see if the password is repeated properly
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    }
    else {
        // This triggers if everything is all good
        // Initializing the connection to the database
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        // Checking to see if information entered by user has already been entered
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else {
                // If all is good, the script will now enter the users inputed data from the from into the database
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                // This will hash the password value into the database
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    // Alerts the user that the signup was succesful
                    header("Location: ../signup.php?signup=success");
                    exit();
                }

            }
        }
        
    }
    // Close the connection to the database
    mysqli_stmt_close($stmt);
        mysqli_close($conn);
}

else {
    header("Location: ../signup.php");
    exit();
}

        