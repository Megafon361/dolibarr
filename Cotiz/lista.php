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
  

function getname($number){
  $httpheader =  ['DOLAPIKEY: mAgnV8S8vehYX2Pm3NQ56o46bgXPQu47'];
  $Root = "http://fontv.ar/htdocs/api/index.php/thirdparties/";
  $curl = curl_init();
  $url = $Root.$number;

  curl_setopt($curl, CURLOPT_URL, $url);
  //curl_setopt($curl, CURLOPT_POST, 1);
  //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($curl);
  curl_close($curl);
  $json = json_decode($result,"1");
  return($json['name']);
  }



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

echo ('<div class="table-responsive"><table class="ui sortable celled selectable table"><thead><tr><th> N</th><th> Etiqueta</th><th> Cliente</th><th> Fecha</th><th> Trabajo</th><th> Total</th><th> Estado</th></tr></thead>
  <tbody>');
$n=1;
  foreach ($result as $key => $value) {
    


    $nombre = getname($value["fk_soc"]);
    echo '<tr><td data-label="N">';
    echo $n;
    echo("</td><td data-label='etiqueta'>");
    echo($value["label"]);
    echo("</td><td data-label='cliente'>");
    echo($nombre); echo("<br>");
    echo("</td><td data-label='fecha'>");
    echo($value["date_creation"]); echo("<br>");
    echo("</td><td data-label='trabajo'>");
    echo($value["trabajo"]); echo("<br>");
    echo("</td><td data-label='total'>");
    echo($value["total"]); echo("<br>");
    echo("</td><td data-label='estado'>");
    echo($value["status"]); echo("<br>");
    echo("</td>");
    $n+=1;

  }
  echo"</tr></tbody>
  <tfoot>
    <tr></tr>
  </tfoot></table></div>";

  echo '</div>';
?>