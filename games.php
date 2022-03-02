<!doctype html>
<html lang="en">
  	<head>
		<title>Game Repo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="repo.css">
	</head>
	
	<body>
		<?php
		include "nav.php";
		?>
        <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	        	<li class="nav-item dropdown">
            </li>
	        	<li class="nav-item active"><a href="games.php" class="nav-link">Games</a></li>
	        	<li class="nav-item"><a href="creators.php" class="nav-link">Creators</a></li>
	            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>


		<div class="game-grid">
		<?php
			include "db_conn.php";

			$game = mysqli_query($conn, "SELECT * FROM Game"); //this could also be pictures instead of games
			$numRecords = mysqli_num_rows($game);

			for($i=0;$i<$numRecords; $i++){
				$row = mysqli_fetch_array($game);
				echo "<tr>";
				echo "<td>" . "<a href=" . $row["pictures"] . "download=" . "'" . $row["gameID"] . "'" 
				. "> <img src=" . $row["pictures"] . " class='" . "game" . "'>"."</td>";
			}

		?>
		</div>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
    
    <?php
    include "footer.php";
    ?>
	</body>
</html>

