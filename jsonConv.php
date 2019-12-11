<?php

$postdata = http_build_query(
    array(
        'filter_province_ids' => '12',
        'filter_layout' => 'default',
        'filter_start_date' => '02-11-2018',
        'filter_end_date' => '03-11-2018',
        'filter_commodity_id' => 'cat-1'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$htmlContent = file_get_contents('https://hargapangan.id/tabel-harga/pasar-tradisional/komoditas', false, $context);

// = file_get_contents("http://teskusman.esy.es/index.html");
		
	$DOM = new DOMDocument();
	libxml_use_internal_errors(true);
	$DOM->loadHTML($htmlContent);
	
	
	$Header = $DOM->getElementsByTagName('th');
	$Detail = $DOM->getElementsByTagName('td');

    //#Get header name of the table
	foreach($Header as $NodeHeader)
	{
		$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
	}
	//print_r($aDataTableHeaderHTML); die();

	//#Get row data/detail table without header name as key
	$i = 0;
	$j = 0;
	foreach($Detail as $sNodeDetail) 
	{
		$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
		$i = $i + 1;
		$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;

	}
	//echo count($aDataTableHeaderHTML);
//	$x = 0;
//	foreach($aDataTableDetailHTML as $anu)
//	{
//		echo $anu[$x][2];
//		$x = $x+1;
//	}

	echo json_encode($aDataTableDetailHTML);
	die();

?>
