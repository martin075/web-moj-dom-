<?php
	$db = new SQLite3('/home/pi/mojdom_db') or die('unable to open database');
			if(!$db)
				{ echo ("could not open/access db");
				}
			//else echo ("the db is opened<br>\n");		
			$result = $db->query('SELECT * FROM sensors1 ORDER BY id DESC LIMIT 1') or die('query failed');
			while($row = $result->fetchArray())
			{	echo ( " id = {$row['id']} <br>\n");		
				echo ( " snimac1 = {$row['temp1']}°C <br>\n");
				echo ( " snimac2 = {$row['temp2']}°C <br>\n");
				echo ( " snimac3 = {$row['temp3']}°C <br>\n");
				echo ( " snimac4 = {$row['temp4']}°C <br>\n");
				echo ( " snimac5 = {$row['temp5']}°C <br>\n");
				echo ( " snimac6 = {$row['temp6']}°C <br>\n");
				echo ( " snimac7 = {$row['temp7']}hPa <br>\n");
				echo ( " snimac8 = {$row['temp8']}°C <br>\n");
				echo ( " <br>\n");
				echo ( " čas zápisu = {$row['cas']} <br>\n");
				}
				$db->close();
?>
