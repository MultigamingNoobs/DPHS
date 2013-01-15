<?php
	include "config.php";
?>
<html>
<head>
	<title>DBHL installation</title>
	<meta name="author" content="Kater" />
	<meta name="copyright" content="Kater" />
	<link rel="stylesheet" type="text/css" href="../styles/design.css" />
	<link rel="stylesheet" type="text/css" href="../styles/constat.css" />
	<link rel="stylesheet" type="text/css" href="../styles/elements.css" />
</head>
<body>
	<div align="left" id="head">
		<table width="100%">
			<tr>
				<td><img src="../images/<? echo $titlebanner; ?>" alt="<? echo $webname; ?>" border="0" /></td>
			</tr>
		</table>
	</div>
	
	<form enctype="multipart/form-data" method="post" action="instexec.php">
	<table align="center">
	<tr>
		<td><p align="right">Websitetitle:</p></td><td><p align="left"><input type="text" name="title" value="<? echo $webname; ?>"></p></td>
	</tr><tr>
		<td><p align="right">Websitebanner:</p></td><td><p align="left"><input type="file" name="banner"></p></td>
	</tr><tr>
		<td><p align="right">Sprache:</p></td><td><p align="left"><input type="radio" name="lang" value="de" checked>german<br /><input type="radio" name="lang" value="en">english<br /><input type="radio" name="lang" value="own">own languagetemplate</p></td>
	</tr><tr>
		<td><p align="right">MySQL Hostname:</p></td><td><p align="left"><input type="text" name="host" value="<? echo $host; ?>"></p></td>
	</tr><tr>	
		<td><p align="right">MySQL Database:</p></td><td><p align="left"><input type="text" name="db" value="<? echo $db; ?>"></p></td>
	</tr><tr>	
		<td><p align="right">MySQL Username:</p></td><td><p align="left"><input type="text" name="user" value="<? echo $user; ?>"></p></td>
	</tr><tr>	
		<td><p align="right">MySQL Userpassword:</p></td><td><p align="left"><input type="password" name="pass" value="<? echo $pass; ?>"></p></td>
	</tr>
	</table>
	<input type="submit" name="" value="create config.php">
	</form>
		
		<div align="left" id="foot">
		<table width="100%" align="center">
			<tr>
				<td class="nav1"><p style="font-size:11px"><abbr title="DayZ Bliss Hive Stats Version <? echo $ver; ?>">DBHS v<? echo $ver; ?></abbr> by Kater @ 2013</p></td>
			</tr>
		</table>
	</div>
	<br />
</body>
</html>