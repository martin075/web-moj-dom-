<?php
	$db = new SQLite3('/home/pi/mojdom_db') or die('unable to open database');
			if(!$db)
				{ echo ("could not open/access db");
				}
			//else echo ("the db is opened<br>\n");		
			$result = $db->query('SELECT * FROM sensors2 ORDER BY id DESC LIMIT 1') or die('query failed');
			while($row = $result->fetchArray())
			{	echo ( " id = {$row['id']} <br>\n");		
				echo ( " snimac21 = {$row['temp1']}°C <br>\n");
				echo ( " snimac22 = {$row['temp2']}°C <br>\n");
				echo ( " snimac23 = {$row['temp3']}°C <br>\n");
				echo ( " snimac24 = {$row['temp4']}°C <br>\n");
				echo ( " snimac25 = {$row['temp5']}°C <br>\n");
				echo ( " snimac26 = {$row['temp6']}°C <br>\n");
				echo ( " <br>\n");
				echo ( " <br>\n");
				echo ( " <br>\n");
				echo ( " cas zápisu = {$row['cas']} <br>\n");
				}
				$db->close();
?>
