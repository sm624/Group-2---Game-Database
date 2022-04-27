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
	  
		<div class="admin">
		<h2>New Game</h2>

		<form id="game" name="game" method="post" action="admin.php" enctype="multipart/form-data">
		<fieldset>
		<legend>Enter Game Information</legend>
			
		Name:
		<input type="text" id="name" name="name" required><br><br>
		Date:
		<input type="date" id="date" name="date"><br><br>
		Description:
		<input type="text" id="description" name="description"><br>
		Tags:<br>
		<?php
			include "db_conn.php";
			$games = mysqli_query($conn, "SELECT * FROM Game ORDER BY Name ASC") or die(mysql_error());//for later use
			$numRecords = mysqli_num_rows($games);//for later use
			$tags = mysqli_query($conn, "SELECT * FROM GameTags"); 
			$tagRecords = mysqli_num_rows($tags);
			for($i=0;$i<$tagRecords; $i++){
				$tag = mysqli_fetch_array($tags);
				echo '<input type="checkbox" id="tag" name="tags[]" value="' . $tag["tag"] .'">';
				echo '<label for="' . $tag["tag"] .'">' . '&nbsp' . $tag["tag"] .'</label><br>';
			}
		?>
		Developer:
		<input type="text" name="devs" id="devs" required>
		<?php
			/*$developers = mysqli_query($conn, "SELECT * FROM Developer"); 
			$numRows = mysqli_num_rows($developers);
			for($i=0;$i<$numRows; $i++){
				$dev = mysqli_fetch_array($developers);
				echo '<option value="'. $dev["firstName"] . '">' . $dev["firstName"] . '</option>';
			}*/
		?>
		</select>
		
		<br><br>
		<legend>Game Picture and Video</legend><br/>
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
		if(isset($_POST["submit"])){
			$target_dir =  '/pictures/';
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$name = basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".<br>";
				$uploadOk = 1;
			} else {
				echo "File is not an image.<br>";
				$uploadOk = 0;
			}
			
			if (file_exists($target_file)) {
				echo "Sorry, picture already exists.<br>";
				$uploadOk = 0;
			}
			if ($_FILES["fileToUpload"]["size"] > 500000000) {
				echo "Sorry, your picture is too large.<br>";
				$uploadOk = 0;
			}
			if($uploadOk == 0) {
				echo "Your picture was not uploaded.<br>";
			} else {
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
					$picUpload = true;
				}else{
					echo $target_file."<br>";
					echo $_FILES["fileToUpload"]["tmp_name"] . "<br>";
					echo "Sorry, there was an error uploading your picture." . "<br>";
				}
			}
		
			$target_video = $target_dir . basename($_FILES["videoToUpload"]["name"]);
			$name = basename($_FILES["videoToUpload"]["name"]);
			$uploadOk = 1;
			$videoFileType = pathinfo($target_video,PATHINFO_EXTENSION);
			
			if (file_exists($target_video)) {
				echo "Sorry, video already exists.<br>";
				$uploadOk = 0;
			}
			if ($_FILES["videoToUpload"]["size"] > 500000000) {
				echo "Sorry, your video is too large.<br>";
				$uploadOk = 0;
			}
			if($videoFileType !== "mp4") {
				echo "Sorry, only mp4 files are allowed.<br>";
				$uploadOk = 0;
			}
			if($uploadOk == 0) {
				echo "Your video was not uploaded.<br>";
			} else {
				if(move_uploaded_file($_FILES["videoToUpload"]["tmp_name"], $target_video) && $picUpload === true) {
					//sql to upload game + picture + video
					echo "The video ". basename($_FILES["videoToUpload"]["name"]). " has been uploaded.<br>";
					$pic=basename($_FILES["fileToUpload"]["name"]);
					$vid=basename($_FILES["videoToUpload"]["name"]);
					$sql = "INSERT INTO `Game`(`gameID`, `name`, `picture`, `video`, `description`, `date`, `developer`)"
					. " VALUES(" . 
					$numRecords . ", '" . //game ID
					$_POST['name'] . "', '" . //game name
					$pic . "', '" . //picture
					$vid . "', '" . //video
					$_POST['description'] . "', '" . //description
					$_POST['date'] . "', '" . //date
					$_POST['developer'] . "'," . //developer
					")";
					echo $sql;
					mysqli_query($conn, $sql) or die(mysql_error());

					//sql to add tags to game
					$postTags = $_POST["tags"];
					$count = count($postTags);
					if(!empty($postTags)){//if enduser selected tags
						for($i=0; $i<$count; $i++){//for each tag selected
							$tag = $tags[$i];
							$sql = "INSERT INTO `Tag`(`gameID`, `tag`) VALUES ('". $numRecords ."','" . $tag . "')";//INSERT Tag GameID into Tag table
							mysqli_query($conn, $sql) or die(mysql_error());
							echo "<br>" . $sql;
						}
					}

					//sql to add developer to developer table
					
					//INSERT DevID, GameID, firstName, lastName 
					//$sql = "INSERT INTO `Developer`(`developerID`, `firstName`, `lastName`, `bio`) VALUES ('" . $numRows . "','[value-2]','[value-3]','[value-4]')";

				}else{
					print_r($_FILES);
					echo $target_video."<br>";
					echo $_FILES["videoToUpload"]["tmp_name"] . "<br>";
					echo "Sorry, there was an error uploading your video." . "<br>";
				}
			}
		}
		echo "<br><br>";
		echo "<table>";
		echo "<tr>
		<th>Name</th>
		<th>Tags</th>
		<th>Size</th>
		</tr>";
		for ($i = 0; $i < $numRecords; $i++){
			$row = mysqli_fetch_array($games);
			echo "<tr>";
			echo "<td width='15%'>".$row["name"] . "</td>";
			echo "<td width='10%'>";
			$sql = 'SELECT * FROM Tags WHERE gameID = "' . $row["gameID"] . '"';
			
			/*$tags = mysqli_query($conn, $sql) or die(mysql_error()); 
			$tagRecords = mysqli_num_rows($tags);
			echo $tagRecords;
			for($i=0;$i<$tagRecords; $i++){
				$tag = mysqli_fetch_array($tags);
				if($i != $tagRecords-1){
					$gameTags = $gameTags . $tag . ', ';
				}else{
					$gameTags = $gameTags . $tag;
				}
			}
			echo $gameTags;*/
			echo "</td>";
			$file = str_replace(' ', '', $row["name"]);
			$file = $file . ".zip";
			$path = "Games/";
			$path = realpath($path);
			//is this O(n^2)? yes, yes it is. do i have time to find a better way? no, no i dont.
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
				if($object->getFileName()==$file){
					$bytes = $object->getSize();
					break;
				}
			}			
			$bytes /= pow(1024, 2);
			$bytes = round($bytes, 2);
			echo "<td width='10%'>". $bytes . " MB</td>";
			echo '<td width="10%"><a href="http://games.cs.edinboro.edu/edit.php?editGame=' . $row["gameID"] . '"<button type="button" class="btn btn-lg sign-in btn-block">Update</button></a>';
			echo "</tr>";
		}
		echo "</table>";
		
		$sql = "SELECT * FROM Comments";
		$comments = mysqli_query($conn, $sql);
		$numRecords = mysqli_num_rows($comments);
		echo "<br><br>";
		echo "<table>";
		echo "<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>E-Mail</th>
		<th>Subject</th>
		<th>Comments</th>
		</tr>";
		for ($i = 0; $i < $numRecords; $i++){
			$row = mysqli_fetch_array($comments);
			echo "<tr>";
			echo "<td width='10%'>".$row["firstName"] . "</td>";
			echo "<td width='10%'>".$row["lastName"] . "</td>";
			echo "<td width='10%'>".$row["email"] . "</td>";
			echo "<td width='10%'>".$row["subject"] . "</td>";
			echo "<td width='30%'>".$row["comments"] . "</td>";
			echo "<td width='10%'>". '<button type="button" class="btn btn-danger btn-lg btn-block">Delete</button></a>'. "</td>";
			echo "</tr>";
		}
		echo "</table>";
		?>

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