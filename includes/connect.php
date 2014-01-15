<?
if(!defined('indexloaded')){die('Direct access not premitted');} 
$db_connect = mysql_connect($host, $user, $pass);
if (!$db_connect) {
    die('Keine Verbindung möglich: ' . mysql_error());
}    
mysql_select_db($db)
    or die("Datenbankfehler: " . mysql_error());
?>