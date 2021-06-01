<?php
include('../config/database.php');
require_once '../vendor/autoload.php';

global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $u_NameErr, $_passwordErr;
global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $uNameEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;

$_firstname = $_lastname = $_email = $_username = $_password = "";

if(isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $email_check_query = mysqli_query($connection,"SELECT * FROM users WHERE email = '{email}' ");
    $rowCount = mysqli_num_rows($email_check_query);

    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password)) {
        if($rowCount > 0) {
            $email_exist = '
                <div class="alert alert-danger" role="alert">
                    User with email already exists!
                </div>';
        } else {
            $_firstname = mysqli_real_escape_string($connection, $firstname);
            $_lastname = mysqli_real_escape_string($connection, $lastname);
            $_email = mysqli_real_escape_string($connection, $email);
            $_username = mysqli_real_escape_string($connection, $username);
            $_password = mysqli_real_escape_string($connection, $password);

            if(!preg_match("/^[a-zA-Z ]*$/", $_firstname)) {
                $f_NameErr = '<div class="alert alert-danger">
                                Only letters and white space allowed.
                              </div>';
            }
            if(!preg_match("/^[a-zA-Z ]*$/", $_lastname)) {
                $l_NameErr = '<div class="alert alert-danger">
                                Only letters and white space allowed.
                              </div>';
            }
            if(!preg_match("/^[a-zA-Z0-9]*$/", $_username)) {
                $u_NameErr = '<div class="alert alert-danger">
                                Only letters and white space allowed.
                              </div>';
            }
            if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                $_emailErr = '<div class="alert alert-danger">
                               Email format is invalid.
                              </div>';
            }
            if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!?]{6,20}$/", $_password)) {
                $_passwordErr = '<div class="alert alert-danger">
                                    Password should be between 6 and 20 characters long, contains atleast one special character, lowercase, uppercase and a digit.   
                                 </div>';
            }
            if((preg_match("/^[a-zA-Z ]*$/", $_firstname)) && (preg_match("/^[a-zA-Z ]*$/", $_lastname)) && (filter_var($_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^[a-zA-Z0-9]*$/", $_username)) &&(preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!?]{8,20}$/", $_password))) {
                $token = md5(rand().time());
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO users (firstname, lastname, email, username, password, token, is_active, date_time) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$username}', '{$password_hash}', '{$token}', '0', now())";
                $sqlQuery = mysqli_query($connection, $sql);

                if(!$sqlQuery) {
                    die("MYSQL query failed!" . mysqli_error($connection));
                }
                if($sqlQuery) {
                    $msg = 'Click on the activation link to verify your email. <br><br>
                        <a href="http://localhost:8888/LemanAndrea_sitebuilder/src/user_verificaiton.php?token='.$token.'"> Click here to verify email</a>';

                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        -> setUsername('your_email@gmail.com')
                        ->setPassword('your_email_password');

                    $mailer = new Swift_Mailer($transport);

                    $message = (new Swift_Message('Please verify email address!'))
                        ->setForm([$email => $firstname . ' ' . $lastname])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Hello User!');

                    $result = $mailer->send($message);

                    if(!$result) {
                        $email_verify_err = '<div class="alert alert-danger">
                                                Verification email could not be sent!
                                             </div>';
                    } else {
                        $email_verify_success = '<div class="alert alert-success">
                                                    Verification email has been sent!
                                                </div>';
                    }
                }
            }
        }
    } else {
        if(empty($firstname)) {
            $fNameEmptyErr = '<div class="alert alert-danger"> First name can not be blank. </div>';
        }
        if(empty($lastname)) {
            $lNameEmptyErr = '<div class="alert alert-danger"> Last name can not be blank. </div>';
        }
        if(empty($email)){
            $emailEmptyErr = '<div class="alert alert-danger"> Email can not be blank. </div>';
        }
        if(empty($password)) {
            $passwordEmptyErr = '<div class="alert alert-danger"> Password can not be blank. </div>';
        }
    }
}
