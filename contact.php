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
	        	<li class="nav-item"><a href="games.php" class="nav-link">Games</a></li>
	            <li class="nav-item active"><a href="contact.php" class="nav-link">Contact</a></li>
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
	
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>


		<h1 style="text-align: center; ">Contact Us</h1>
		<form style="text-align: center;" action ="mail.php" method="post">
		First Name: <input type="text" name="fname" id="fname"><br><br>
		Last Name: <input type="text" name="lname" id="lname"><br><br>
		e-mail: <input type="text" name="email" id="email" required><br><br>
		Subject: <input type="text" name="subject" id="subject" required><br><br>
		Comments:<br>
		<textarea name="comments" id="comments" rows="4" cols="40"></textarea><br><br>
		<input type="submit" value="Contact"> <input type="reset">
		</form>


		<?php
		include "footer.php";
		?>
		</body>
</html>

