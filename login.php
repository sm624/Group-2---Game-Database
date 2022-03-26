<?php
    session_start();
    include "db_conn.php";
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
        header("Location: index.php?erro=User Name is required");
        exit();
    } //if password is empty
    else if(empty($password)){
        header("Location: index.php?erro=Password is required");
        exit();
    }
    //the query i will be sending the database
    $sql = "SELECT * FROM Admin WHERE username='$username' AND password='$password'";
    
    $result = mysqli_query($conn, $sql);
    //if the database returns a result, aka it found that the username and the password are correct
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if($row["username"] == $username && $row["password"] == $password){
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
        }
        else{
            header("Location: index.php?error=Incorrect Username or Password 2");
            exit();
        }
    }
    else{
        header("Location: index.php?error=Incorrect Username or Password 1");
        exit();
    }
?>