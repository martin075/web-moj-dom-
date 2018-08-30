<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="300">
	<title>vycitavanie hodnot a graf</title>
	<link rel="stylesheet" type="text/css" href="css/styl.css">
	<style>
	#datum {position: absolute; width: 250px; top: 10px; left: 252px; background-color:darkkhaki; color:black}
	#hlavicka {position: absolute; width: 250px; top: 30px; left: 10px}
	#lavy {position: absolute; width: 250px; height:320px; top: 70px; left: 10px; background-color:darkkhaki; color:black}
	#pravy{position: absolute; width: 250px; height:320px; top: 70px; left: 252px; background-color:darkkhaki; color:black}
	#graf{position: absolute; width: 650px; height:320px; top: 70px; left: 502px; background-color:snow; color:black}
	#info{position: absolute; top: 400px; left: 12px;}
	</style>
<script src="jquery.min.js"></script>
</head>

<body>
	<div id="datum">
	<?php echo "dnes je: ".date("D")." ".date("j.n.Y").",  ".date("G.i")." hod";?>
	</div>
	<div id="hlavicka">vyčítavanie hodnôt zo snímačov</div>
		<div id="lavy">
			<div id="sens1"></div>
			
			<div id="er"></div>
		</div>
	
	<div id="pravy">
		<h3>pivnica a studňa</h3>
		<div id="sens2"></div>
	</div>
	
	<div id="graf">
		<img src="liniovy_graf.php">
	</div>
	
	<div id="info">
		<?php print "<br> verzia PHP ".phpversion(); ?>
	</div>
	
	<script>
	$("#sens1").load("vypis_hodnot_akt.php", function( response, status, xhr ) {
		if (status == "error") {
			var msg = "sorry error";
			$("#er").html( msg + xhr.status + " " + xhr.statusText );
			}
		});
	</script>
	
	<script>
	$("#sens2").load("vypis_hodnot_akt2.php", function( response, status, xhr ) {
		if (status == "error") {
			var msg = "sorry error";
			$("#er").html( msg + xhr.status + " " + xhr.statusText );
			}
		});
	</script>
	
</body>

</html>
