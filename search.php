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
                if(isset($_SESSION["username"])){
                    echo '<li class="nav-item active"><a href="admin.php" class="nav-link">Admin</a></li>';
				}
				?>
	        </ul>
	      </div>
	    </div>
	  </nav>

	<div class="library">
		<div>
		<?php
			include "db_conn.php";
							
			$terms = isset($_GET['search']) ?? '';//uses get to get search terms from url
			//its a ternary operator, basically saying if GET is set, terms = _GET, else terms = ''
			$searchString = "SELECT * FROM Game WHERE ";//string to be sent to db
									
			$keywords = explode(' ', $terms);//separates string by spaces, keywords is an array of strings			
			foreach ($keywords as $word){
				$searchString .= "tags LIKE '%".$word."%' OR ";
				$searchString .= "name LIKE '%".$word."%' OR ";
			}
			$searchString = substr($searchString, 0, strlen($searchString)-4); //formatting for displaying back
			//not sure if ill actually use it 
			$query = mysqli_query($db_conn, $searchString); //the actual query being returned
				
			
		
			$numRecords = mysqli_num_rows($query);
			for($i=0;$i<$numRecords; $i++){
				$row = mysqli_fetch_array($query);
				echo "<tr>";
				echo "<td>" . "<a href=" . $row["pictures"] . "download=" . "'" . $row["gameID"] . "'" 
				. "> <img src=" . $row["pictures"] . " class='" . "game" . "'>"."</td>";
			}

			
		?>
		</div>
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

