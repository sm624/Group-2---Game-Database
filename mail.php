<?php include "db_conn.php";?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Thank You!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
</html>

<h1>Thank you for adding your information</h1>
<?php
    $commentsSQL = "SELECT * FROM Comments";
    $table = mysqli_query($conn, $commentsSQL);
    $numrows = mysqli_num_rows($table);
    $sql = "INSERT INTO `Comments`(`firstName`, `lastName`, `email`, `subject`, `comments`, `commentID`) VALUES ('".
        $_POST['fname']."', '".
        $_POST['lname']."', '".
        $_POST['email']."', '".
        $_POST['subject']."', '".
        $_POST['comments']."', '".
        $numrows . "')";

    echo "<br>".$sql."<br>";
        
    mysqli_query($conn, $sql) or die (" Insert did not work");
    mysqli_close($conn);
    header("Location: contact.php?=Thank you for your comment");
?>