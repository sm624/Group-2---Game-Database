<?php 
    session_start();
    if(isset($_SESSION["username"])){
?>
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
	
	<?php
		include "nav.php";
		?>
        <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	        	<li class="nav-item dropdown"></li>
	        	<li class="nav-item"><a href="games.php" class="nav-link">Games</a></li>
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
            <?php
				include "db_conn.php";
				
				if(isset($_GET)){
					$ID = $_GET['editGame'];
				}
				$query = "SELECT * FROM Game WHERE gameID='$ID'";
				$games = mysqli_query($conn, $query);
				$game = mysqli_fetch_array($games);
		  	?>
		<div class="admin">
		<h2>Update Game</h2>
            <?php
                echo var_dump($game);
            ?>
			<form>
                
            </form>
		
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
<?php
}
else{
    header("Location: index.php?erro=You do not have access to this page");
    exit();
}
?>