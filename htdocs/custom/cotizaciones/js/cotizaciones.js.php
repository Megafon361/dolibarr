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
	
	$("[tipo=\'Cant\']").removeClass("minwidth400 flat --success");
	$("[tipo=\'Cant\']").addClass("Cant");
	$("[tipo=\'Cant\']").removeAttr("maxlength");
	$("[tipo=\'Cant\']").attr("maxlength","2");


	$("[tipo=\'Precio\']").removeClass("flat minwidth400 --success");
	$("[tipo=\'Precio\']").addClass("Precio");
	$("[tipo=\'Precio\']").removeAttr("maxlength");
	$("[tipo=\'Precio\']").attr("maxlength","12");

	$("[tipo=\'Pago\']").removeClass("flat minwidth400 --success");
	$("[tipo=\'Pago\']").addClass("Pago");
	$("[tipo=\'Pago\']").removeAttr("maxlength");
	$("[tipo=\'Pago\']").attr("maxlength","12");



	 




}); 


function sumar() {

	var total = 0;
  
	$(".Precio").each(function() {
  
	  if (isNaN(parseFloat($(this).val()))) {
  
		total += 0;
  
	  } else {
  
		total += parseFloat($(this).val());
  
	  }
  
	});
  
	
	document.getElementById("spTotal").innerHTML = total;
  
  }


 


';


?>
