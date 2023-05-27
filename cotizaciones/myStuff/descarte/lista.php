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
  






$cotizaciones = json_decode($cotizaciones,"1");

echo '<div class="table-responsive">
        <table class="ui sortable celled selectable table">
        <thead><tr>
        <th> N</th>
        <th> Etiqueta</th>
        <th> Cliente</th>
        <th> Fecha</th>
        <th> Trabajo</th>
        <th> Total</th>
        <th> Estado</th>
        </tr></thead>
  <tbody>';
$n=1;

  foreach ($cotizaciones as $key => $value) {
    


    $nombre = getname($value["fk_soc"]);
    echo '<tr><td data-label="N">';
    echo ($value["id"]);
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

function getname($number){
  global $httpheader;
  global $Root;

  $curl = curl_init();
  $url = $Root."thirdparties/".$number;

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($curl);
  curl_close($curl);
  $result = json_decode($result,"1");

    return($result['name']);
  //if(isset($json['name'])){    return($json['name']);}
  }



?>


