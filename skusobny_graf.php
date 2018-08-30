<?php
include ('/usr/share/jpgraph/src/jpgraph.php');
include ('/usr/share/jpgraph/src/jpgraph_line.php');

$datay = array(5,3,7,2);
$datay2 = array(88,10,55,42);
$datay3 = array(255,35,745,244);
$datay4 = array(130,97,68,119);

// Setup the graph
$graph = new Graph(600,250);
$graph->SetMargin(30,200,20,20);
$graph->SetMarginColor('white');
$graph->SetColor('lightgray');

$graph->SetScale("intlin");

$graph->SetYScale(0,"lin");
$graph->SetYScale(1,"lin");
$graph->SetYScale(2,"lin");

$p1 = new LinePlot($datay);
$p1->SetColor('blue');
$graph->Add($p1);

$p2 = new LinePlot($datay2);
$p2->SetColor('darkred');
$graph->AddY(0,$p2);
$graph->ynaxis[0]->SetColor('darkred');

$p3 = new LinePlot($datay3);
$p3->SetColor('red');
$graph->AddY(1,$p3);
$graph->ynaxis[1]->SetColor('red');

$p4 = new LinePlot($datay4);
$p4->SetColor('blue');
$graph->AddY(2,$p4);
$graph->ynaxis[2]->SetColor('blue');

// Output line
$graph->Stroke(); 
