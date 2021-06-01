<?php
include('../config/database.php');

global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

if(isset($_POST['login'])) {
    $email_signin = $_POST['email_signin'];
    $password_signin = $_POST['password_signin'];

    $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
    $pswd = mysqli_real_escape_string($connection, $password_signin);

    $sql = "SELECT * FROM users WHERE email = '{$email_signin}' ";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    if(!$query) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if(!empty($email_signin) && !empty($password_signin)) {
        if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
            $wrongPwdErr = '<div class=alert alert-danger>
                                Password should be between 6 to 20 characters long, contains atleast one special characte, lowercase, uppercase, and a digit. </div>';
        }

        if($rowCount <= 0) {
            $accountNotExistErr = '<div class="alert alert-danger">User account does not exist.</div>';
        } else {
            while($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $username = $row['username'];
                $password = $row['password'];
                $token = $row['token'];
                $is_activate = $row['is_activate'];
            }

            $password = password_verify($password_signin, $password);

            if($is_activate == '1') {
                if($email_signin == $email && $password_signin == $password) {
                    header("Location: ./dashboard.php");

                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;
                    $_SESSION['token'] = $token;
                } else {
                    $emailPwdErr = '<div class="alert alert-danger">Either email or password is incorrect.</div>';
                }
            } else {
                $verificationRequiredErr = '<div class="alert alert-danger">Account vcerification is requried for login.</div>';
            }
        }
    } else {
        if(empty($email_signin)) {
            $email_empty_err = '<div class="alert alert-danger">Email not provided.</div>';
        }

        if(empty($password_signin)) {
            $pass_empty_err = '<div class="alert alert-danger">Password not provided.</div>';
        }
    }
}