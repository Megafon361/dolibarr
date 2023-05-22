<?php

$httpheader =  ['DOLAPIKEY: mAgnV8S8vehYX2Pm3NQ56o46bgXPQu47'];
//$Root = "http://localhost/dolibarr/api/index.php/";
$Root = "http://fontv.ar/htdocs/api/index.php/";
$curl = curl_init();
$url = $Root."cotizacionesapi/cotizacions";



curl_setopt($curl, CURLOPT_URL, $url);
	//curl_setopt($curl, CURLOPT_POST, 1);
	//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);
	curl_close($curl);
	

function sacala($vari="ninguna variable asignada")
	{
    echo"<br>";
    echo $vari;
    //print $vari;
    //var_dump($vari);
    // print_r $vari;
    //printf($vari;)
	}
$result = json_decode($result,"1");
$header = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="supernova">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Cotización</title>


  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    
  </head>
  <body>';

echo $header;
echo ('<div class="table-responsive"><table class="table-striped table-sm"><tr><th>n</th><th>label</th><th>cliente</th><th>fecha</th><th>trabajo</th><th>total</th><th>Estado</th></tr>');
$n=0;
	foreach ($result as $key => $value) {
		
		echo "<tr><td>";
		echo $n;
		echo("</td><td>");
		echo($value["label"]);
		echo("</td><td>");
		echo($value["fk_soc"]); echo("<br>");
		echo("</td><td>");
		echo($value["date_creation"]); echo("<br>");
		echo("</td><td>");
		echo($value["trabajo"]); echo("<br>");
		echo("</td><td>");
		echo($value["total"]); echo("<br>");
		echo("</td><td>");
		echo($value["status"]); echo("<br>");
		echo("</td>");
		$n+=1;

	}
	echo"</tr></table></div>";

	echo '</div> </body>';

	//var_dump($result);
//sacala($result);
