<?php
    include "db_conn.php";
    $ID = $_POST["ID"];
    $query = "SELECT * FROM Game WHERE gameID='$ID'";
    $games = mysqli_query($conn, $query);
    $game = mysqli_fetch_array($games);
    $url = 'edit.php?editGame=' . $game["gameID"];
    header('Refresh:5; url=' . $url);
    $sql = "UPDATE `Game` SET `gameID`= '" . $game["gameID"] 
                            ."', `name`= '" . $_POST['name']  
                            ."', `picture`= '" . $game['picture'] 
                            ."', `video`= '" . $game['video'] 
                            ."', `description`= '" . $_POST['description'] 
                            ."', `date`= '" . $_POST['date'] 
                            ."', `developer`= '" . $_POST['developer'] . "'"
                            ." WHERE `gameID` = " . "'" . $game['gameID'] . "'";
    mysqli_query($conn, $sql);   
    echo "Updating database, please wait...";
?>