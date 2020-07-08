<?php

// If the log in submit is eventually put in browser, execute following code
if (isset($_POST['login-submit'])) {

    // Reference the database connection script 
    require "dbh.inc.php";

    // Assigning variables to reference
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    // if the user hasnt filled in the required information throw an error into the URL to be picked up later by a POST function
    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        // Exit out of this function
        exit();
    }
    // if the user inputs correctly, look into the database and find the userIDs and Emails
    else {
        $sql = "SELECT * FROM users WHERE uidUsers=? or emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        // if there is a connection error, put in URL SQL error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            // Accessing the database
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            // Request is stored in result variable
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                // Verifies to see if password matches the Hashed Value in the Database, if not, wrong password is put in URL and exits function.
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                // is password is correct, the session starts on the index page.
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userId'] = $row['uidUsers'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            // If UserID does not match anything in the database, the nouser error message is put in URL
            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }





    }

}
else {
    header("Location: ../index.php");
    exit();
}