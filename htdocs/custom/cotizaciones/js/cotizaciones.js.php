<?php
/* Copyright (C) 2022 nicolas
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * Library javascript to enable Browser notifications
 */

if (!defined('NOREQUIREUSER')) {
	define('NOREQUIREUSER', '1');
}
if (!defined('NOREQUIREDB')) {
	define('NOREQUIREDB', '1');
}
if (!defined('NOREQUIRESOC')) {
	define('NOREQUIRESOC', '1');
}
if (!defined('NOREQUIRETRAN')) {
	define('NOREQUIRETRAN', '1');
}
if (!defined('NOCSRFCHECK')) {
	define('NOCSRFCHECK', 1);
}
if (!defined('NOTOKENRENEWAL')) {
	define('NOTOKENRENEWAL', 1);
}
if (!defined('NOLOGIN')) {
	define('NOLOGIN', 1);
}
if (!defined('NOREQUIREMENU')) {
	define('NOREQUIREMENU', 1);
}
if (!defined('NOREQUIREHTML')) {
	define('NOREQUIREHTML', 1);
}
if (!defined('NOREQUIREAJAX')) {
	define('NOREQUIREAJAX', '1');
}


/**
 * \file    cotizaciones/js/cotizaciones.js.php
 * \ingroup cotizaciones
 * \brief   JavaScript file for module Cotizaciones.
 */

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) {
	$res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php";
}
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) {
	$i--; $j--;
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/main.inc.php")) {
	$res = @include substr($tmp, 0, ($i + 1))."/main.inc.php";
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/../main.inc.php")) {
	$res = @include substr($tmp, 0, ($i + 1))."/../main.inc.php";
}
// Try main.inc.php using relative path
if (!$res && file_exists("../../main.inc.php")) {
	$res = @include "../../main.inc.php";
}
if (!$res && file_exists("../../../main.inc.php")) {
	$res = @include "../../../main.inc.php";
}
if (!$res) {
	die("Include of main fails");
}

// Define js type
header('Content-Type: application/javascript');
// Important: Following code is to cache this file to avoid page request by browser at each Dolibarr page access.
// You can use CTRL+F5 to refresh your browser cache.
if (empty($dolibarr_nocache)) {
	header('Cache-Control: max-age=3600, public, must-revalidate');
} else {
	header('Cache-Control: no-cache');
}

echo '
console.log("WOOOOOOOOOOOOOOOOOOOOOOOOOOOOW!");



//alert("total");

  $( document ).ready(function() {
    console.log( "ready! cotizacard.css.php" );
	
	/* $("[tipo=\'Cant\']").removeClass("minwidth400 flat --success");
	$("input [tipo=\'Cant\']").addClass("Cant");
	$("[tipo=\'Cant\']").removeAttr("maxlength");
	$("[tipo=\'Cant\']").attr("maxlength","2");
		
	
	$("td.Precio").removeClass();	
	$("td.Cant").removeClass();	


	$("*[tipo=\'Precio\']").removeClass("flat minwidth400 --success");
	$("input [tipo=\'Precio\']").addClass("Precio");
	$("[tipo=\'Precio\']").removeAttr("maxlength");
	$("[tipo=\'Precio\']").attr("maxlength","12");

	$("[tipo=\'Pago\']").removeClass("flat minwidth400 --success");
	$("[tipo=\'Pago\']").addClass("Pago");
	$("[tipo=\'Pago\']").removeAttr("maxlength");
	$("[tipo=\'Pago\']").attr("maxlength","12");



	*/
	//$("form *").removeClass();	
	/*
$("#C0Pr").removeClass();
$("#C1Pr").removeClass();
$("#C2Pr").removeClass();
$("#C3Pr").removeClass();
$("#C4Pr").removeClass();

$("#C0Ca").removeClass();
$("#C1Ca").removeClass();
$("#C2Ca").removeClass();
$("#C3Ca").removeClass();
$("#C4Ca").removeClass();
*/

$("#C0Pr").addClass("Precio");
$("#C1Pr").addClass("Precio");
$("#C2Pr").addClass("Precio");
$("#C3Pr").addClass("Precio");
$("#C4Pr").addClass("Precio");


$("#C0Ca").addClass("Cant");
$("#C1Ca").addClass("Cant");
$("#C2Ca").addClass("Cant");
$("#C3Ca").addClass("Cant");
$("#C4Ca").addClass("Cant");

	
	


}); 



function var_dump(array){

	console.log(JSON.stringify(array));

	
	};

var gastos = 0
function sumar() {

	var suma =    0;
	for (let i = 0; i < 5; i++)
	 {
	  var cantidad = document.getElementsByClassName("Cant")[i].value;
	  var precio = document.getElementsByClassName("Precio")[i].value;
	  
	  if (isNaN(parseFloat(cantidad))) {
		  
		  console.log("cantidad" + cantidad);
		  cantidad = 0;
		} else {
	
		  cantidad = parseFloat(cantidad);
	
		}      
		if (isNaN(parseFloat(precio))) {
			console.log("precio" + precio);
			precio = 0;
  
		} else {
	
		  precio = parseFloat(precio);
	
		}  



	  suma += parseFloat(cantidad * precio);
	 // console.log ( "gastosparciales " + gastosparciales)

	  

	 }
	 document.getElementById("gastos").value = suma.toFixed(2);
	 megafon = suma * 0.15;
	 document.getElementById("megafon").value = megafon.toFixed(2);
	 subtotal = megafon + suma;
	 document.getElementById("subtotal").value = subtotal.toFixed(2);
	 document.getElementById("subtotal2").value = subtotal.toFixed(2);
	 var_dump(suma);
	  
	  var iva = 0.21;
	  var ganancias = 0.15;
	  var iibb = 0.025

	  var conIVA = iva + iibb + ganancias; 
	  var sinIVA  = iibb + ganancias;
	  var contado = 0;
	  
	  choco = document.getElementById("check1")[0];
	  if(document.getElementById("check1").checked){
		  var total =  subtotal * (1 + conIVA);
	  }
	  if(document.getElementById("check2").checked){
		  var total =  subtotal * (1 + sinIVA);
	  }
	  if(document.getElementById("check3").checked){
		  var total =  subtotal ;
	  }


	  document.getElementById("iva").value = (total - subtotal).toFixed(2);

	  document.getElementById("total").value = total.toFixed(2);
	  suma =  0;
 
};


 


';


?>
