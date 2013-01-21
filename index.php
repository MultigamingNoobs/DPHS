<?php
	define('indexloaded', TRUE);
	include "includes/header.html";
	if (file_exists("includes/install.php")) {
		include "includes/install.php"; 
	}
	else {
		include 'includes/stats.php';
	}
	include "includes/footer.html";
?>