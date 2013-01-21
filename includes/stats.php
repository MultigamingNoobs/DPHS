<?php
	include "includes/query.php";
	include "includes/svtime.php";
	
	echo '<font style="color: black;">'.$lang['AVGSURV'].': '.svtime($crosssurvival["avg(survival_time)"]).'</font>';
		
	echo '<br />
			<table border="0" align="center">
				<tr class="tr_1">
					<td>#</td>
					<td><a href="?type=name&order='.$sort.'">'.($type == "name" ? $lang['NAME'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['NAME'].'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=humanity&order='.$sort.'">'.($type == "humanity" ? $lang['HUMANITY'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['HUMANITY'].'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=life&order='.$sort.'">'.($type == "life" ? $lang['LIFE'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['LIFE'].'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=svtime&order='.$sort.'">'.($type == "svtime" ? $lang['SVTIME'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['SVTIME'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tsvtime&order='.$sort.'">'.($type == "tsvtime" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=kills&order='.$sort.'">'.($type == "kills" ? $lang['KILLS'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['KILLS'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tkills&order='.$sort.'">'.($type == "tkills" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=bkills&order='.$sort.'">'.($type == "bkills" ? $lang['BKILLS'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['BKILLS'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tbkills&order='.$sort.'">'.($type == "tbkills" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=zkills&order='.$sort.'">'.($type == "zkills" ? $lang['ZKILLS'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['ZKILLS'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tzkills&order='.$sort.'">'.($type == "tzkills" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=hs&order='.$sort.'">'.($type == "hs" ? $lang['HS'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['HS'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=ths&order='.$sort.'">'.($type == "ths" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=hsq&order='.$sort.'">'.($type == "hsq" ? $lang['HSQ'].'<img src="images/'.$order.'.png" title="'.$order_lng.'" />' : $lang['HSQ'].'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=thsq&order='.$sort.'">'.($type == "thsq" ? $lang['TOTAL'].'<img src="images/'.$order.'s.png" title="'.$order_lng.'" />' : $lang['TOTAL'].'<img src="images/noorders.png" title="" alt="">').'</a></td>
				</tr>';
	if (mysql_num_rows($stats) > 0) {
		while ($row = mysql_fetch_array($stats))
		{
			$stat_name = $row['name'];
			$stat_humanity = $row['humanity'];
			$stat_life = $row['survival_attempts'] - 1;
			$stat_svtime =  svtime($row['survival_time']);
			$stat_tsvtime = svtime($row['survival_time'] + $row['total_survival_time']);
			$stat_kills = $row['survivor_kills'];
			$stat_tkills = $row['survivor_kills'] + $row['total_survivor_kills'];
			$stat_bkills = $row['bandit_kills'];
			$stat_tbkills = $row['bandit_kills'] + $row['total_bandit_kills'];
			$stat_zkills = $row['zombie_kills'];
			$stat_tzkills = $row['zombie_kills'] + $row['total_zombie_kills'];
			$stat_hs = $row['headshots'];
			$stat_ths = $row['headshots'] + $row['total_headshots'];

			if ($row['humanity'] >= 5000) {
				$stat_humanity .= '<img src="images/hero.png" title="'.$lang['HERO'].'" alt="'.$lang['HERO'].'" />';
			} elseif ($row['humanity'] < 0) {
				$stat_humanity .= '<img src="images/bandit.png" title="'.$lang['BANDIT'].'" alt="'.$lang['BANDIT'].'" />';
			} else {
				$stat_humanity .= '<img src="images/neutral.png" title="" alt="" />';
			}

			echo '
			<tr class="'.(($nr%2) == 0 ? "tr_3" : "tr_2" ).'">
				<td>'.($nr+1).'</td>
				<td style="text-align:left;">'.$stat_name.'</td>
				<td style="text-align:left;">'.$stat_humanity.'</td>
				<td style="text-align:left;">'.$stat_life.'</td>
				<td style="text-align:left;">'.$stat_svtime.'<br /><font size="1">'.$stat_tsvtime.'</font></td>
				<td style="text-align:right;">'.$stat_kills.'<br /><font size="1">'.$stat_tkills.'</font></td>
				<td style="text-align:right;">'.$stat_bkills.'<br /><font size="1">'.$stat_tbkills.'</font></td>
				<td style="text-align:right;">'.$stat_zkills.'<br /><font size="1">'.$stat_tzkills.'</font></td>
				<td style="text-align:right;">'.$stat_hs.'<br /><font size="1">'.$stat_ths.'</font></td>
				<td style="text-align:right;">'.($stat_hs == 0 ? '0' : (round(100 / ($stat_skills + $stat_bkills + $stat_zkills) * ($stat_hs), 2))).'%<br /><font size="1">'.($stat_hs == 0 ? '0' : (round(100 / ($stat_skills + $stat_tskills + $stat_bkills + $stat_tbkills + $stat_zkills + $stat_tzkills) * ($stat_hs + $stat_ths), 2))).'%</font></td>
			</tr>';

			$nr++;
		}
	}
	else { echo '<td colspan="10" class="tr_3">'.$lang['SEARCH_ERROR'].'</td>'; }
	echo '</table>';
	if (isset($_GET['srch'])) { echo '<br /><a href="." target="_self"><font color="white"><b><--'.$lang['SEARCH_BACK'].'</b></font></a>'; }
		
	mysql_close($verbindung);
	
	echo '<div align="right" id="lgnd">
			<table>
				<tr>
					<td class="tr_1" colspan="2">'.$lang['LGND'].'</td>
				</tr><tr>
					<td class="tr_3" style="text-align:left;">'.$lang['BANDIT'].':</td><td class="tr_3"><img src="images/bandit.png" title="'.$lang['BANDIT'].'" alt="'.$lang['BANDIT'].'" /></td>
				</tr><tr>
					<td class="tr_2" style="text-align:left;">'.$lang['HERO'].':</td><td class="tr_2"><img src="images/hero.png" title="'.$lang['HERO'].'" alt="'.$lang['HERO'].'" /></td>
				</tr>
			</table>
		</div>';
		echo '<div align="right" id="srch">
			<form method="get" target="_self" action="">
				<table>
					<td  style="text-align:right;"><p align="left"><input type="text" name="srch" value="Name"><br /><input type="submit" value="'.$lang['SEARCH'].'"></td>
				</table>
			</form>
		</div>';
?>