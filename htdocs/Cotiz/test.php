<?php
include "doliclass.php";
$number = "5";
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

  echo($result['name']);
  //if(isset($json['name'])){    return($json['name']);}



  //var_dump($result);