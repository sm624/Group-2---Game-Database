<?php
    session_start();
    include "db_conn.php";
    include "captcha.php";
    require_once 'vendor/autoload.php';
    //this is the function i use to trim the username and password
    if(isset($_POST['username']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }

    $username = validate($_POST['username']); //called here
    $password = validate($_POST['password']); //and here

    //if username is empty
    if(empty($username)){
        header("Location: signin.php?erro=User Name is required");
        exit();
    } //if password is empty
    else if(empty($password)){
        header("Location: signin.php?erro=Password is required");
        exit();
    }

    /*$token = $_POST['token'];
    $action = $_POST['action'];
    // use the reCAPTCHA PHP client library for validation
    $recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
    $resp = $recaptcha->setExpectedAction($action)
                    ->setScoreThreshold(0.5)
                    ->verify($token, $_SERVER['REMOTE_ADDR']);
    
    // verify the response
    if ($resp->isSuccess()) {
        continue;// valid submission
        // go ahead and do necessary stuff
    } else {
        // collect errors and display it
        $errors = $resp->getErrorCodes();
        header("Location: signin.php?erro=Captcha Failed");
        exit();
    }*/

    //the query i will be sending the database
    $sql = "SELECT * FROM Admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    //if the database returns a result it found that the username and the password are correct
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if($row["username"] == $username && $row["password"] == $password){//double check
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
        }
        else{
            header("Location: signin.php?error=Incorrect Username or Password 2");
            exit();
        }
    }
    else{
        header("Location: signin.php?error=Incorrect Username or Password 1");
        exit();
    }
?>