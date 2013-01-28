<?php
	if(!defined('indexloaded')){die('Direct access not premitted');}
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$svrcon = "udp://" . $svr_ip .":". $svr_port;
	$sock = fsockopen($svrcon);
	fwrite($sock, "\xFE\xFD\x09\xFF\xFF\xFF\x01");
	$challenge_packet = fread($sock, 4096);
	if (!$challenge_packet)
	{
		return false;
	}
	$challenge_code = substr($challenge_packet, 5, -1);
	$challenge_code = $challenge_code ? chr($challenge_code >> 24) . chr($challenge_code >> 16) . chr($challenge_code >> 8) . chr($challenge_code >> 0) : "";
	fwrite($sock, "\xFE\xFD\x00\x10\x20\x30\x40{$challenge_code}\xFF\xFF\xFF\x01");
	
	/**
	 * cut_string()
	 * 
	 * @param mixed $buffer
	 * @param integer $start_byte
	 * @param string $end_marker
	 * @return
	 */
	function cut_string(&$buffer, $start_byte = 0, $end_marker = "\x00")
	{
		$buffer = substr($buffer, $start_byte);
		$length = strpos($buffer, $end_marker);
		if ($length === false)
		{
			$length = strlen($buffer);
		}
		$string = substr($buffer, 0, $length);
		$buffer = substr($buffer, $length + strlen($end_marker));
		return $string;
	}
	/**
	 * cut_byte()
	 * 
	 * @param mixed $buffer
	 * @param mixed $length
	 * @return
	 */
	function cut_byte(&$buffer, $length)
	{
		$string = substr($buffer, 0, $length);
		$buffer = substr($buffer, $length);
		return $string;
	}
	$buffer = array();
	$packet_count = 0;
	$packet_total = 4;
	do
	{
		$packet_count++;
		$packet = fread($sock, 4096);
		if (!$packet)
		{
			return false;
		}
		$packet = substr($packet, 14);
		$packet_order = ord(cut_byte($packet, 1));
		if ($packet_order >= 128)
		{
			$packet_order -= 128;
			$packet_total = $packet_order + 1;
		}
		$buffer[$packet_order] = $packet;
	} while ($packet_count < $packet_total);
	foreach ($buffer as $key => $packet)
	{
		$packet = substr($packet, 0, -1);
		if (substr($packet, -1) != "\x00")
		{
			$part = explode("\x00", $packet);
			array_pop($part);
			$packet = implode("\x00", $part) . "\x00";
		}
		if ($packet[0] != "\x00")
		{
			$pos = strpos($packet, "\x00") + 1;
			if (isset($packet[$pos]) && $packet[$pos] != "\x00")
			{
				$packet = substr($packet, $pos + 1);
			} else
			{
				$packet = "\x00" . $packet;
			}
		}
		$buffer[$key] = $packet;
	}
	ksort($buffer);
	$buffer = implode("", $buffer);
	//  SERVER SETTINGS
	$buffer = substr($buffer, 1);
	while ($key = strtolower(cut_string($buffer)))
	{
		$svrqry['e'][$key] = cut_string($buffer);
	}
	$lgsl_conversion = array("name" => "hostname", "game" => "gamename", "map" => "mapname", "players" => "numplayers", "playersmax" => "maxplayers", "password" => "password");
	foreach ($lgsl_conversion as $s => $e)
	{
		if (isset($svrqry['e'][$e]))
		{
			$svrqry['s'][$s] = $svrqry['e'][$e];
			unset($svrqry['e'][$e]);
		}
	}
	if ($svrqry['s']['players'] == "0")
	{
		return true;
	}
	//  PLAYER DETAILS
	$buffer = substr($buffer, 1);
	$playercount = $svrqry['s']['players'];
	$playerdata = explode("\x00",$buffer);
	$playersout = 1;
	for ($i = 2; $i <= ($svrqry['s']['players'] + 1) ; $i++)
	{
	   $playersout++;
	   $svrqry['p'][$playersout]['name'] = $playerdata[$i];
	   $svrqry['p'][$playersout]['team'] = $playerdata[($playercount + $i) + 3];
	   $svrqry['p'][$playersout]['score'] = $playerdata[($playercount + $playercount + $i) + 6];
	   $svrqry['p'][$playersout]['deaths'] = $playerdata[($playercount + $playercount + $playercount + $i) + 9];
	}
	
	if (isset($svrqry['s'])) { $svr_name = $svrqry['s']['name'].'<br />'.$svr_ip.':'.$svr_port; }
	else { $svr_name = $svr_ip.':'.$svr_port; }
	
	function svqonline($plr_name, $array)
	{
		if (isset($array)) {
				foreach($array as $key => $values)
				{
					if(in_array($plr_name, $values)) { return '<img src="images/on.png" title="ONLINE" />'; } else { return '<img src="images/off.png" title="OFFLINE" />'; }
				}
			}
		else { return '<img src="images/off.png" title="OFFLINE" />'; }
	}
?>
