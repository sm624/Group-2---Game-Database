<?php
    $db_location = "localhost";
    $username = "repoteam";
    $password = "repoteam!22";
    $db_name = "GameRepo";
    
    $conn = mysqli_connect($db_location, $username, $password, $db_name);

    $sitekey = "6LfF5IofAAAAAAPxkoQewz_xGt9j9ZtMsRKZfZf-";//throwing this in db_conn 
    $secretkey = "6LfF5IofAAAAAJHdA32rGsltsFQJKo4AyKJqsWEf";//hopefully this doesnt confuse anyone
?>