<?php // content="text/plain; charset=utf-8"
	require_once ('/usr/share/jpgraph/src/jpgraph.php');
	require_once ('/usr/share/jpgraph/src/jpgraph_line.php');
 
	$ydata = array(11,3,8,12,5,1,9,13,5,7);
	$y2data = array(354,200,265,99,111,91,198,225,293,251);
	// my data
			$db = new SQLite3('/home/pi/mojdom_db') or die('unable to open database');
			if(!$db)
				{ echo ("could not open/access db");
				}
			$data3dni = $db->query('SELECT * FROM sensors1 ORDER BY id DESC LIMIT 80') or die('query failed');
			$data = array();
			//$data_p = array();
			$i = 0;
			while ($data1 = $data3dni->fetchArray()) {	//nacitanie dat po stlpcoch do premennej
				$y2data[$i] = $data1[1]/10;
				$ydata[$i] = $data1[7];
				$xdata[$i] = $data1['cas'];					//nacitanie dat po stlpcoch do pola
				$i++;
				}
			$db->close();
// Size of the overall graph
		$width=650;
		$height=320;

// Create the graph and specify the scale for both Y-axis
	$graph = new Graph($width,$height);
	
	$graph->SetScale("textlin");
	$graph->SetY2Scale("lin");
	$graph->SetShadow();
	$graph->SetTickDensity(TICKD_NORMAL,TICKD_VERYSPARSE);
 
// Adjust the margin
$graph->SetMargin(70,20,60,80);
$graph->img->SetMargin(60,40,40,70);//okraje grafu lavy, horny, pravy

//x axis settings
		$graph->xgrid->Show();
		$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetLabelAngle(45);
		$graph->xaxis->SetTickLabels($xdata);
		$graph->xgrid->SetColor('#E3E3E3');
		$graph->xaxis->SetTextTickInterval(8,0); // intervaly a zaciatok medzi znackami "tick"
		
		// Setup titles and X-axis labels
		//$graph->xaxis->SetLabelAlign('center','top');
		
		$graph->xaxis->title->Set('cas');
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);


// Create the two linear plot
$lineplot=new LinePlot($ydata);
$lineplot2=new LinePlot($y2data);
 
// Add the plot to the graph
$graph->Add($lineplot);
$graph->AddY2($lineplot2);
$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);
 
// Adjust the axis color
$graph->y2axis->SetColor("red");
$graph->yaxis->SetColor("blue");
 
$graph->title->Set("teplota a tlak");
$graph->xaxis->title->Set("cas");
$graph->yaxis->title->Set("hodnoty");
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Set the colors for the plots 
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);
 
// Set the legends for the plots
$lineplot->SetLegend("snimac 1");
$lineplot2->SetLegend("tlak");
 
// Adjust the legend position
$graph->legend->SetLayout(LEGEND_HOR);
//$graph->legend->Pos(0.4,0.95,"center","bottom");
$graph->legend->Pos(0.72, 0.04, 'left', 'up'); 
// Display the graph
$graph->Stroke();
?>
