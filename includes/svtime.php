<?php
	if ($langselect == 'de') {
		function svtime($min) {
				$i = sprintf('%d Tag%s %02d Std%s %02d Min%s',
				$min / 1440,
				floor($min / 1440) != 1 ? 'e':'',
				$min / 60 % 24,
				floor($min / 60 % 24) != 1 ? '.':'.',
				$min % 60,
				floor($min % 60) != 1 ? '.':'.'
			);
			return $i;
		}
 	}
	elseif ($langselect == 'en') {
		function svtime($min) {
				$i = sprintf('%d day%s %02d hr%s %02d min%s',
				$min / 1440,
				floor($min / 1440) != 1 ? 's':'',
				$min / 60 % 24,
				floor($min / 60 % 24) != 1 ? 's':'.',
				$min % 60,
				floor($min % 60) != 1 ? 's':'.'
			);
			return $i;
		}
	}
	else {
		function svtime($min) {
				$i = sprintf('%d d% %02d h% %02d m%',
				$min / 1440,
				floor($min / 1440) != 1 ? '':'',
				$min / 60 % 24,
				floor($min / 60 % 24) != 1 ? '':'',
				$min % 60,
				floor($min % 60) != 1 ? '':''
			);
			return $i;
		}
	}
?>