
<?php
include "doliclass.php";

$curl = curl_init();
$url = $Root."cotizacionesapi/cotizacions?sortfield=t.rowid&sortorder=DEC&limit=100";


  curl_setopt($curl, CURLOPT_URL, $url);
  //curl_setopt($curl, CURLOPT_POST, 1);
  //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $cotizaciones = curl_exec($curl);
  curl_close($curl);
  
;





$cotizaciones = json_decode($cotizaciones,"1");
var_dump($cotizaciones)
?>
