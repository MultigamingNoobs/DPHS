<?php
	include "config/config.php";
	include "config/lang/lang.php";
	include "functions/variables.php";
	include "functions/query.php";
	include "functions/stime.php";
?>
<html>
<head>
	<title><? echo $webname; ?></title>
	<meta name="author" content="Kater" />
	<meta name="copyright" content="Kater" />
	<link rel="stylesheet" type="text/css" href="styles/design.css" />
	<link rel="stylesheet" type="text/css" href="styles/constat.css" />
	<link rel="stylesheet" type="text/css" href="styles/elements.css" />
</head>
<body>
	<div align="left" id="head">
		<table width="100%">
			<tr>
				<td><img src="images/<? echo $titlebanner; ?>" alt="<? echo $webname; ?>" border="0" /></td>
			</tr>
		</table>
	</div>