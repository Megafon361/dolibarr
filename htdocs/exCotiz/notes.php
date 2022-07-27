<?php
include "env.php";

function getCotizacion($n)	{


			
			$curl = curl_init();
			global $httpheader, $Root;
			$url = $Root."cotizacionesapi/cotizacions/".$n;
			
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
			$result = curl_exec($curl);
			curl_close($curl);
			$result= json_decode($result,1);
			return($result);	

		}
$var = GetCotizacion("7");
var_dump($var);



        ?>
