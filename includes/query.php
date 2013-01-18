<?php
	$verbindung = mysql_connect($host, $user, $pass) or die (mysql_error());
	mysql_select_db($db) or die (mysql_error());

	$query = "SELECT * FROM profile p INNER JOIN survivor s ON p.unique_ID = s.unique_ID WHERE is_dead = '0' ORDER BY";
	$type = name;
	$order = asc;
	$sort = desc;

	if (isset($_GET["order"])) {
		$sort = $_GET["order"];
		if ($_GET["order"] == "asc") { $sort = "desc"; } else { $sort = "asc"; }
	}
	if (isset($_GET["order"])) { $order = $_GET["order"]; }	if (isset($_GET["type"])) { $type = $_GET["type"]; }
	if ($type == "name") { $query .= " name ".$order; } 
	elseif ($type == "life") { $query .= " survival_attempts ".$order; }
	elseif ($type == "svtime") { $query .= " survival_time ".$order; }
	elseif ($type == "tsvtime") { $query .= " survival_time+total_survival_time ".$order; }
	elseif ($type == "kills") {	$query .= " survivor_kills ".$order; }
	elseif ($type == "tkills") { $query .= " survivor_kills+total_survivor_kills ".$order; } 
	elseif ($type == "bkills") { $query .= " bandit_kills ".$order; }
	elseif ($type == "tbkills") { $query .= " bandit_kills+total_bandit_kills ".$order; }
	elseif ($type == "zkills") { $query .= " zombie_kills ".$order; }
	elseif ($type == "tzkills") { $query .= " zombie_kills+total_zombie_kills ".$order; }
	elseif ($type == "hs") { $query .= " headshots ".$order; }
	elseif ($type == "ths") { $query .= " headshots+total_headshots ".$order; }
	elseif ($type == "hsq") { $query .= " 100/(survivor_kills+bandit_kills+zombie_kills)*(headshots) ".$order; }
	elseif ($type == "thsq") { $query .= " 100/(survivor_kills+total_survivor_kills+bandit_kills+total_bandit_kills+zombie_kills+total_zombie_kills)*(headshots+total_headshots) ".$order; }
	else { $query .= " ".$type." ".$order; };

	$stats = mysql_query($query);
	
	$ast_="SELECT avg(survival_time) FROM survivor;";
	$ast=mysql_query($ast_);
	$crosssurvival=mysql_fetch_array($ast);
?>