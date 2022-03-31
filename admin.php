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
	        	<li class="nav-item"><a href="creators.php" class="nav-link">Creators</a></li>
	            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <?php
					session_start();

					if(isset($_SESSION["username"])){
						echo '<li class="nav-item active"><a href="admin.php" class="nav-link">Admin</a></li>';
					}
                ?>
            </ul>
	      </div>
	    </div>
	  	</nav>
		<div class="admin">
		<h2>New Game</h2>

		<form id="game" name="game" method="post" action="addgame.php" enctype="multipart/form-data">
		<fieldset>
		<legend>Enter Game Information</legend>
			
		Name:
		<input type="text" id="name" name="name"><br><br>
		Date:
		<input type="date" id="date" name="date"><br><br>
		Description:
		<input type="text" id="description" name="description"><br><br>
		Manual:
		<input type="file" id="manual" name="manual"><br><br>
		Tag:
		<select name="tag" id="tag" required>
		<option value="multiplayer">Multiplayer</option>
		<option value="action">Action</option>
		<option value="vr">VR</option>
		</select>
		Developer:
		<select name="developer" id="developer" required>
		<option value="multiplayer">Ryan</option>
		<option value="action">Adam</option>
		<option value="vr">Nate</option>
		<option value="vr">Maya</option>
		</select>
		<br><br>
		<legend>Game Pictures and Videos</legend><br/>
		Picture:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<br><br>
		Video:
		<input type="file" name="videoToUpload" id="videoToUpload">
		<br><br>
		<input type="submit" class="btn btn-outline-danger" value="Submit" name="submit"><br>

		</fieldset>
		</form>
		<?php
		include "db_conn.php";
		$target_dir =  '/html';//fix later
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$name = basename($_FILES["fileToUpload"]["name"]);
		echo $name . "<br>";
		echo "<br>" . $target_file."<br>";
		echo "<br>" . $_FILES["fileToUpload"]["name"] . "<br>";
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		if ($_FILES["fileToUpload"]["size"] > 500000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		if($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
			}else{
				echo $target_file."<br>";
				echo $_FILES["fileToUpload"]["tmp_name"];
				echo "Sorry, there was an error uploading your file.";
			}
		}

		$sql = "INSERT INTO `Game`(`gameID`, `name`, `pictures`, `videos`, `tags`, `decription`, `manual`, `date`, `developers`, `upVotes`)"
		. "VALUES ('', '" . //game ID
		$_POST['name'] . "', " . //game name
		$_POST['picture'] . "''" . //picture
		", '". //videos
		"', '". //tags
		"', '". //description
		"', '". //manual
		"', '". //requirements
		"', '', '". //download
		"', '". //date
		"', '". //developers
		"', '". //upVotes
		"')";

		echo $sql;
		if ($_POST['name'] != "" ){
			mysqli_query($conn, $sql) or die(mysql_error());
		}


		$games = mysqli_query($conn, "SELECT * FROM Game ORDER BY Name ASC") or die(mysql_error());
		$numRecords = mysqli_num_rows($games);

		echo "<table>";
		echo "<tr>
		<th>Name</th>
		<th>Tags</th>
		<th>Up Votes</th>
		<th>Size</th>
		</tr>";
		for ($i = 0; $i < $numRecords; $i++){
			$row = mysqli_fetch_array($games);
			echo "<tr>";
			echo "<td width='15%'>".$row["name"]."</td>";
			echo "<td width='10%'>".$row["tags"]."</td>";
			echo "<td width='10%'>".$row["upVotes"]."</td>";
			echo "<td width='10%'>".filesize($row["name"] + ".zip")."</td>";
			echo "</tr>";
		}
		echo "</table>";

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

