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
	        	<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	        	<li class="nav-item dropdown">
            </li>
	        	<li class="nav-item"><a href="games.php" class="nav-link">Games</a></li>
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
		  <?php
				include "db_conn.php";
				
				$randomId = rand(0,13);
				$query = "SELECT * FROM Game WHERE gameID=" . $randomId;
				$games = mysqli_query($conn, $query);
				$game = mysqli_fetch_array($games);
		  	?>
			<div class="gameTitle">
				<?php
					echo $game['name'];
				?>
			</div>
            <div class="downloadPage">
                <div class="rightPage">
                    <div class="gameVideo">
						<?php
							echo '<video autoplay>
							<source src=' . '"' . $game['video'] . '"' .  'type="video/mp4">
						  	Your browser does not support the video tag.
						  	</video>';
						?>
                    </div>    
                    <div class="gameSlide">
                        /*Slide Reel?*/
                    </div>
                </div>
                <div class="leftPage">
                    <div class="gamePicture">
						<?php	
							echo '<img src="pictures/'. $game['picture'] .'" class="gamePicture">';
						?>
                    </div>
                    <div class="gameDescription">
						<?php
                        	echo $game['description'];
						?>
                    </div>
                    <div class="gameCorner">
                        <div class="gameUpvotes">
							Upvotes: <?php echo $game['upVotes'];?>
						</div>
						<div class="gameTags">
							Tags: 
						</div>
						<div class="gameDev">
							Developer:
						</div>
						<div class="gameDate">
							Released: <?php echo $game['date'];?>
						</div>
						<div class="downloadButton">
							<?php
							$file = str_replace(' ', '', $game["name"]); //this just removes spaces from name
							$file = $file . ".zip";
							echo "<a href=" . '"' . $file . '"' . " download>";	
							?>
							<button type="button" class="btn btn-outline-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
									<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
									<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
								</svg>
									Download</a>
							</button>
							
						</div>
                    </div>
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

