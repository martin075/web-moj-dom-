<?php // content="text/plain; charset=utf-8"
		require_once ('/usr/share/jpgraph/src/jpgraph.php');
		require_once ('/usr/share/jpgraph/src/jpgraph_line.php');
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
				$data[$i] = $data1[1]/10;
				//$data_p[$i] = $data1[7];
				$xdata[$i] = $data1['cas'];					//nacitanie dat po stlpcoch do pola
				$i++;
				}
			$db->close();
			
		
		 // Size of the overall graph
		$width=650;
		$height=320;
		// prevod kodovania
		$popisyosi = "teplota v °C";
		$popisxosi = "čas";
		$popisyosi = iconv("utf-8","iso-8859-2",$popisyosi);
		$popisxosi = iconv("utf-8","iso-8859-2",$popisxosi);
		
		// Create the graph. These two calls are always required
		$graph = new Graph($width,$height);
		//$graph->img->SetAntiAliasing("white");
		$graph->SetMargin(70,20,60,80);
		$graph->SetMarginColor('white');
		$graph->SetColor('lightgray');
		
		$graph->SetScale('textlin');
		//$graph->SetY2Scale('lin'); // druha os
		$graph->SetTickDensity(TICKD_NORMAL,TICKD_VERYSPARSE);
		//$graph->SetShadow();	//doplnene podla example
		//$graph->SetScale('textint');
		//$graph->SetScale('textint');
		
		//$graph->img->SetAntiAliasing(true);
		
		// Setup a title for the graph
		$graph->title->SetFont(FF_ARIAL,FS_NORMAL,16);
		$graph->title->Set('meranie');
		// Use built in font
		
		//$graph->img->SetAntiAliasing();
		
		$graph->xgrid->Show();
		$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetLabelAngle(45);
		$graph->xaxis->SetTickLabels($xdata);
		$graph->xgrid->SetColor('#E3E3E3');
		$graph->xaxis->SetTextTickInterval(8,0); // intervaly a zaciatok medzi znackami "tick"
		
		// Setup titles and X-axis labels
		//$graph->xaxis->SetLabelAlign('center','top');
		
		$graph->xaxis->title->Set($popisxosi);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		// Setup Y-axis title
		//$graph->y2axis->SetColor('red');
		
		
		$graph->yaxis->SetColor('blue');
		$graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
		$graph->yaxis->SetTitlemargin(50);// odstup popisu osi 
		$graph->yaxis->title->Set($popisyosi);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
	 
		
		// Create the linear plot
		$lineplot=new LinePlot($data);
		//$lineplot2=new LinePlot($data_p); //druha os
		$lineplot->SetColor('blue');
		$lineplot->SetLegend('teplota 1');
		//$lineplot2->SetColor('red');
		//$lineplot2->SetLegend('tlak');
		 
		//nastavenie legendy
		$graph->legend->Pos(0.72, 0.04, 'left', 'up');
		
		// Add the plot to the graph
		$graph->Add($lineplot);
		//$graph->Add($lineplot2);
		 
		//$graph->img->SetAntiAliasing(); 
		
		// Display the graph
		$graph->Stroke();
?>
