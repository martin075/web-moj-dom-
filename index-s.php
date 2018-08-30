<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="30">
	<title>vycitanie hodnot snimacov teploty a tlaku</title>
	<link rel="stylesheet" type="text/css" href="css/styl.css">
	<style>
	#datum {position: absolute; width: 250px; top: 10px; left: 252px; background-color:darkkhaki; color:black}
	#hlavicka {position: absolute; width: 250px; top: 30px; left: 10px}
	#lavy {position: absolute; width: 250px; height:320px; top: 70px; left: 10px; background-color:darkkhaki; color:black}
	#pravy{position: absolute; width: 250px; height:320px; top: 70px; left: 252px; background-color:darkkhaki; color:black}
	#graf{position: absolute; width: 650px; height:320px; top: 70px; left: 502px; background-color:snow; color:black}
	#info{position: absolute; top: 400px; left: 12px;}
	
	</style>
	<!-- <script type="text/javascript" src="/var/www/html/jquery/jquery-3.3.1.min.js"></script> -->
	<script type="text/javascript" src="/var/www/html/ajax/1.3.0/jquery.min.js"></script>
	<script type="text/javascript"> 
		var auto_refresh = setInterval(
		function ()
		{
		$('#aktscreen').load('/var/www/html/vypis_hodnot_akt.php');
		}, 10000); // refresh every 10000 milliseconds
	</script>
		
</head>

<body>



	
	<?php //include ("device1.php"); ?>
<?php
	function vypis_akt_hodnot1()
	{
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
	}
	
	function vypis_akt_hodnot2()
	{
		$db = new SQLite3('/home/pi/mojdom_db') or die('unable to open database');
		if(!$db)
			{ echo ("could not open/access db");
			}
		//else echo ("the db is opened<br>\n");	
		$result = $db->query('SELECT * FROM sensors2 ORDER BY id DESC LIMIT 1') or die('query failed');
		while($row = $result->fetchArray())
		{	echo ( "id= {$row['id']} <br>\n");
			echo ( "snimac21= {$row['temp21']}°C <br>\n");
			echo ( "snimac22= {$row['temp22']}°C <br>\n");
			echo ( "snimac23= {$row['temp23']}°C <br>\n");
			echo ( "snimac24= {$row['temp24']}°C <br>\n");
			echo ( "snimac25= {$row['temp25']}°C <br>\n");
			echo ( "snimac26= {$row['temp26']}°C <br>\n");
			echo ( " <br>\n");
			echo ( " <br>\n");
			echo ( " <br>\n");
			echo ( "cas= {$row['cas']} <br>\n");
			//print($row[0]);
			}
	//echo ("operation fetch array done successfully\n");
	$db->close();
	}
	function vycitanie_3dni()
	{
		$db = new SQLite3('/home/pi/mojdom_db') or die('unable to open database');
		if(!$db)
			{ echo ("could not open/access db");
			}
		$data3dni = $db->query('SELECT * FROM sensors1 ORDER BY id DESC LIMIT 20') or die('query failed');
		$data = array();
		$i = 0;
		while ($data1 = $data3dni->fetchArray()) {	//nacitanie dat po stlpcoch do premennej
			$data[$i] = $data1[1];					//nacitanie dat po stlpcoch do pola
			echo ("T = ".$data[$i]."<br>\n"); 
			$i++;
			}
		$db->close();
		//echo ("Tp = ".$data1[1]."<br>\n");
		return $data;
	}
?>

<div id="datum"> 
	
	<?php echo "dnes je: ".date("D")." ".date("j.n.Y").",  ".date("G.i")." hod.";?>
	
</div>	

<div id="hlavicka">vyčítavanie hodnôt zo snímačov</div>
<div id="lavy">
	<?php echo "12";?>
	 <!-- <iframe src="vypis_hodnot_akt.php" width="230" height="320"> -->
	 
	 <div id="aktscreen"> </div>
	 <br>tvoj prehliadac nepodporuje IFRAME
	 <div id="error"></div>
	 
	<!-- <?php //vypis_akt_hodnot1(); ?> -->
	<!-- </iframe> -->
	
</div>

<div id="pravy">
	<h3>pivnica a studňa</h3>
	<?php vypis_akt_hodnot2();?>
</div>

<div id="graf">
	 <iframe src="liniovy_graf1.php" width="655" height="325" marginheight="0" marginwidth="0" frameborder="0" align="baseline" > </iframe> 
	<!-- <img src="liniovy_graf.php"> -->
</div>

<div id="info">
	<?php print "<br> verzia PHP ".phpversion(); ?>
	<!-- vypis_akt_hodnot1(); phpinfo();-->

	<div id="akt-screen"> <?php echo "dnes je: ".date("D")." ".date("j.n.Y").",  ".date("G.i")." hod.";?> </div>
	</div>
	
	
</body>
</html>


