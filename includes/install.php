<?php
	if (isset($_POST["submitbutton"])) {
		$dateiname = "includes/config.php";
		$webname = $_POST["title"];
		if($_FILES["banner"]["size"] <= 0) {
			$titlebanner = "title_banner.png";
		}
		else
		{
			move_uploaded_file($_FILES["banner"]["tmp_name"], "../images/".$_FILES["banner"]["name"]);
			$titlebanner = $_FILES["banner"]["name"];
		}
		$lang = $_POST["lang"]; 
		$host = $_POST["host"]; 
		$db = $_POST["db"]; 
		$user = $_POST["user"]; 
		$pass = $_POST["pass"]; 
		$file = fOpen($dateiname, "w+");
		fWrite($file, '<?php
		');
		fWrite($file, '	$webname = "'.$webname.'";
		');	
		fWrite($file, '	$titlebanner = "'.$titlebanner.'";
		');		
		fWrite($file, '	$lang = "'.$lang.'";
		');		
		fWrite($file, '	$host = "'.$host.'";
		');		
		fWrite($file, '	$db = "'.$db.'";
		');		
		fWrite($file, '	$user = "'.$user.'";
		');		
		fWrite($file, '	$pass = "'.$pass.'";
		');		
		fWrite($file, '?>');
		fClose($file);
		echo 'created config.php<head><META HTTP-EQUIV=Refresh CONTENT="2; URL='.$_SERVER['PHP_SELF'].'"></head>';
		unlink("includes/install.php");
	} 
	else {
		echo '<form enctype="multipart/form-data" method="post" action="'.$_SERVER['PHP_SELF'].'">
				<table align="center">
					<tr>
						<td><p align="right">Websitetitle:</p></td><td><p align="left"><input type="text" name="title" value="DBHS"></p></td>
					</tr><tr>
						<td><p align="right">Websitebanner:</p></td><td><p align="left"><input type="file" name="banner"></p></td>
					</tr><tr>
						<td><p align="right">Sprache:</p></td><td><p align="left"><input type="radio" name="lang" value="de" checked>german<br /><input type="radio" name="lang" value="en">english<br /><input type="radio" name="lang" value="own">own languagetemplate</p></td>
					</tr><tr>
						<td><p align="right">MySQL Hostname:</p></td><td><p align="left"><input type="text" name="host" value="localhost"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Database:</p></td><td><p align="left"><input type="text" name="db" value="chernarus_1"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Username:</p></td><td><p align="left"><input type="text" name="user" value="root"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Userpassword:</p></td><td><p align="left"><input type="password" name="pass" value="password123"></p></td>
					</tr>
				</table>
			<input type="submit" name="submitbutton" value="create config.php">
		</form>';
	}
?>
