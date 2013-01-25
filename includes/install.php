<?php
echo '<div id="install">';
	if (isset($_POST["submitbutton"])) {
		$dateiname = "includes/config.php";
		$webname = $_POST["title"];
		if($_FILES["banner"]["size"] <= 0) {
			$titlebanner = "title_banner.png";
		}
		else
		{
			move_uploaded_file($_FILES["banner"]["tmp_name"], "./images/".$_FILES["banner"]["name"]);
			$titlebanner = $_FILES["banner"]["name"];
		}
		$fp = fopen("includes/config.sample.php","r");
		if ($fp){ 
			$file = array();
			while(!feof($fp))
			{  $zeile = fgets($fp,100);
			   $file[] = $zeile;  } 
		fclose($fp); 
		} 
		else 
		{ 
		echo "Datei wurde nicht gefunden";
		}
		$file[2] = str_replace('""', '"'.$_POST["title"].'"', $file[2]);
		$file[3] = str_replace('""', '"'.$titlebanner.'"', $file[3]);
		$file[4] = str_replace('""', '"'.$_POST["svrname"].'"', $file[4]);
		$file[5] = str_replace('""', '"'.$_POST["svrip"].'"', $file[5]);
		$file[6] = str_replace('""', '"'.$_POST["svrport"].'"', $file[6]);
		$file[7] = str_replace('""', '"'.$_POST["host"].'"', $file[7]);
		$file[8] = str_replace('""', '"'.$_POST["db"].'"', $file[8]);
		$file[9] = str_replace('""', '"'.$_POST["user"].'"', $file[9]);
		$file[10] = str_replace('""', '"'.$_POST["pass"].'"', $file[10]);
		$file[11] = str_replace('""', '"'.$_POST["lang"].'"', $file[11]);
		$datei = fOpen($dateiname, "w+");
		foreach ($file as $value) {
			fwrite($datei, $value);
		}
		fClose($datei);
		unset($file[0]);
		echo '<p>created config.php</p><head><META HTTP-EQUIV=Refresh CONTENT="2; URL='.$_SERVER['PHP_SELF'].'"></head>';
		unlink("includes/install.php");
	} else {
		echo '<form enctype="multipart/form-data" method="post" action="'.$_SERVER['PHP_SELF'].'">
				<table align="center">
					<tr>
						<td><p align="right">Websitetitle:</p></td><td><p align="left"><input type="text" name="title"></p></td>
					</tr><tr>
						<td><p align="right">Websitebanner:</p></td><td><p align="left"><input type="file" name="banner" accept="image/png,image/jpg,image/jpeg"></p></td>
					</tr><tr>
						<td><p align="right">Servername:</p></td><td><p align="left"><input type="text" name="svrname"></p></td>
					</tr><tr>
						<td><p align="right">Serverip:port:</p></td><td><p align="left"><input type="text" name="svrip">:<input type="text" name="svrport"></p></td>
					</tr><tr>
						<td><p align="right">Sprache:</p></td><td><p align="left"><input type="radio" name="lang" value="de" checked>german<br /><input type="radio" name="lang" value="en">english<br /><input type="radio" name="lang" value="own">own languagetemplate</p></td>
					</tr><tr>
						<td><p align="right">MySQL Hostname*:</p></td><td><p align="left"><input type="text" name="host"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Database*:</p></td><td><p align="left"><input type="text" name="db"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Username*:</p></td><td><p align="left"><input type="text" name="user"></p></td>
					</tr><tr>	
						<td><p align="right">MySQL Userpassword*:</p></td><td><p align="left"><input type="password" name="pass"></p></td>
					</tr>
				</table>
			<input type="submit" name="submitbutton" value="create config.php">
		</form><br />* are mandatory | * sind Pflicht';
	}
echo '</div>';
?>
