<?php
	if ($_POST) {
		$dateiname = "config.php";
		$webname = $_POST[title];
		if($_FILES[banner][size] <= 0) {
			$titlebanner = "title_banner.png";
		}
		else
		{
			move_uploaded_file($_FILES[banner][tmp_name], "../images/".$_FILES[banner][name]);
			$titlebanner = $_FILES[banner][name];
		}
		$lang = $_POST[lang]; 
		$host = $_POST[host]; 
		$db = $_POST[db]; 
		$user = $_POST[user]; 
		$pass = $_POST[pass]; 
		$file = fOpen($dateiname, "w+");
		fWrite($file, '<?
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
		echo "created config.php";
		unlink("install.php");
		unlink("instexec.php");
	} 
	else echo "ERROR";
?>
<html>
<head>
<meta http-equiv="refresh" content="0;URL=../" />
</head>
<body></body>
</html>