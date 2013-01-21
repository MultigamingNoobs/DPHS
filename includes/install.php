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
		$svrname = $_POST["svrname"]; 
		$svrip = $_POST["svrip"]; 
		$svrport = $_POST["svrport"]; 
		$langsel = $_POST["lang"]; 
		$host = $_POST["host"]; 
		$db = $_POST["db"]; 
		$user = $_POST["user"]; 
		$pass = $_POST["pass"]; 
		$file = fOpen($dateiname, "w+");
		fWrite($file, '<?php
		');
		fwrite($file, "  if(!defined('indexloaded')){die('Direct access not premitted');}
	");
		fWrite($file, '	$webname = "'.$webname.'";
		');	
		fWrite($file, '	$titlebanner = "'.$titlebanner.'";
		');		
		fWrite($file, '	$svr_name = "'.$svrname.'";
		');		
		fWrite($file, '	$svr_ip = "'.$svrip.'";
		');		
		fWrite($file, '	$svr_port = "'.$svrport.'";
		');				
		fWrite($file, ' $langselect = '.$langsel.'";
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
						<td><p align="right">Websitetitle:</p></td><td><p align="left"><input type="text" name="title"></p></td>
					</tr><tr>
						<td><p align="right">Websitebanner:</p></td><td><p align="left"><input type="file" name="banner"></p></td>
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
?>
