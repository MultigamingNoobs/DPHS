<?php
if(!defined('indexloaded')){die('Direct access not premitted');} 
$verbindung = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($db) or die (mysql_error());

$query = "SELECT * FROM profile p INNER JOIN survivor s ON p.unique_ID = s.unique_ID WHERE is_dead = '0' ORDER BY";
$type = "name";
$order = "asc";
$sort = "desc";

if (isset($_GET["order"])) {
	$sort = $_GET["order"];
	if ($_GET["order"] == "asc"){
		$sort = "desc";
		$order = "asc";
		$order_lng = $lang['ASC'];
	}
	else{
		$sort = "asc";
		$order = "desc";
		$order_lng = $lang['DESC'];
	}
}

if (isset($_GET["type"]))
	$type = $_GET["type"];

switch($type){
	case "name":
		$query .= " name ".$order;
		break;
	case "humanity":
		$query .= " humanity ".$order;
		break;
	case "life":
		$query .= " survival_attempts ".$order;
		break;
	case "svtime":
		$query .= " survival_time ".$order;
		break;
	case "tsvtime":
		$query .= " survival_time+total_survival_time ".$order;
		break;
	case "kills":
		$query .= " survivor_kills ".$order;
		break;
	case "tkills":
		$query .= " survivor_kills+total_survivor_kills ".$order;
		break;
	case "bkills":
		$query .= " bandit_kills ".$order;
		break;
	case "tbkills":
		$query .= " bandit_kills+total_bandit_kills ".$order;
		break;
	case "zkills":
		$query .= " zombie_kills ".$order;
		break;
	case "tzkills":
		$query .= " zombie_kills+total_zombie_kills ".$order;
		break;
	case "hs":
		$query .= " headshots ".$order;
		break;
	case "ths":
		$query .= " headshots+total_headshots ".$order;
		break;
	case "hsq":
		$query .= " 100/(survivor_kills+bandit_kills+zombie_kills)*(headshots) ".$order;
		break;
	case "thsq":
		$query .= " 100/(survivor_kills+total_survivor_kills+bandit_kills+total_bandit_kills+zombie_kills+total_zombie_kills)*(headshots+total_headshots) ".$order;
		break;
	default:
		$query .= " name asc";	
}
if (isset($_GET["srch"])) {
	$srch_var = str_replace('*', '%', $_GET["srch"]);
	$query = "SELECT * FROM profile p INNER JOIN survivor s ON p.unique_ID = s.unique_ID WHERE is_dead = '0' and name LIKE '".$srch_var."' order by name asc";
}

$stats = mysql_query($query);

$ast_="SELECT avg(survival_time) FROM survivor;";
$ast=mysql_query($ast_);
$crosssurvival=mysql_fetch_array($ast);
?>