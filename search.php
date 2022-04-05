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
				<?php
				session_start();
                if(isset($_SESSION["username"])){
                    echo '<li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>';
				}
				?>
	        </ul>
	      </div>
	    </div>
	  </nav>

	<div class="game-grid">
		<?php
			include "db_conn.php";
			if(isset($_GET['searchGame'])){
				$terms = $_GET['searchGame'];
			}			
			$searchString = "SELECT * FROM Game WHERE ";//string to be sent to db\
			$keywords = explode(' ', $terms);//separates string by spaces, keywords is an array of strings			
			foreach ($keywords as $word){
				$searchString .= "tags LIKE '%" . $word . "%' OR ";
				$searchString .= "name LIKE '%" . $word . "%' OR ";
			}
			$searchString = substr($searchString, 0, strlen($searchString)-4); //gets rid of last OR
			$query = mysqli_query($conn, $searchString); //the actual query being returned			
			
			$numRecords = mysqli_num_rows($query);
			
			for($i=0;$i<$numRecords; $i++){
				$row = mysqli_fetch_array($query);
				echo "<tr>";
				echo '<form action="download.php" method="GET" name="downloadGame">
				<a href="http://games.cs.edinboro.edu/download.php?downloadGame=' . $row["name"] . '" onclick="document.someForm.submit();">';
				echo "<td>" . "<img src=" . "pictures/" . $row["picture"] . " class='" . "game" . 
				"' alt='" . $row["name"] . "'" . ">" . "</td>";
				echo "<div class=" . "'game-title'" . ">" . $row["name"] . "</div>";
				echo '</a></form>';
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

