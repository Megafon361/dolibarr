<?php
//cargar  apikey 

//Recibir numero de cotizacion con get

echo "hello";

$NumCotiz = $_POST['nroCotiz2'];


$httpheader =  ['DOLAPIKEY: mAgnV8S8vehYX2Pm3NQ56o46bgXPQu47'];
$Root = "http://fontv.ar/htdocs/api/index.php/";
 $cotizacion = array();
$curl = curl_init();
$url = $Root."cotizacionesapi/cotizacions/".$NumCotiz;

curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_POST, 1);
//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$cotizacion = curl_exec($curl);
$cotizacion = json_decode($cotizacion,1);
curl_close($curl);

//var_dump($cotizacion);

////////////tomar datos de cotizacion para hacer invoice 


 
$ref = $cotizacion["ref"];					
$label = $cotizacion["label"];		
$fk_soc = $cotizacion["fk_soc"];		
$fk_project = $cotizacion["fk_project"];			
$description = $cotizacion["description"];			
$note_public = $cotizacion["note_public"];			
$note_private = $cotizacion["note_private"];			
$date_creation = $cotizacion["date_creation"];				
$fk_user_creat = $cotizacion["fk_user_creat"];				
$status = $cotizacion["status"];		
$entrega = $cotizacion["entrega"];		
$trabajo = $cotizacion["trabajo"];		
$gastos = $cotizacion["gastos"];		
$megafon = $cotizacion["megafon"];		
$subtotal = $cotizacion["subtotal"];		
$iva = $cotizacion["iva"];	
$total = $cotizacion["total"];		




// CREAR INVOICE 

$cotizacion = array();
$curl = curl_init();
$url = $Root."proposals/";


$data = array();

$data["entrega"]=$entrega;
$data["ref"]=$ref;
$data["label"]=$label;
$data['Usuario']=$fk_user_creat;
$data["socid"]=$fk_soc;
$data["cliente"]=$fk_soc;
$data["trabajo"]=$trabajo;
$data["description"]=$description;
$data["note_public"]=$note_public;
$data["fk_soc"]=$fk_soc;
	





curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$facturaCreada = curl_exec($curl);
//$result = json_decode($facturaCreada,1);
curl_close($curl);

var_dump($facturaCreada);







//AGREGAR LINEAS A INVOICE 


//   /proposals/#/lines


Implementation Notes
Exemple of POST query : { 

	"desc"								"Desc", 
	"subprice"							"1.00000000", 
	"qty"								"1", 
	"tva_tx"							"20.000", 
	"localtax1_tx"						"0.000", 
	"localtax2_tx"						"0.000", 
	"fk_product"						"1", 
	"remise_percent"					"0", 
	"date_start"						"", 
	"date_end"							"", 
	"fk_code_ventilation"				0, 
	"info_bits"							"0", 
	"fk_remise_except"					null, 
	"product_type"						"1", 
	"rang"								"-1", 
	"special_code"						"0", 
	"fk_parent_line"					null, 
	"fk_fournprice"						null, 
	"pa_ht"								"0.00000000", 
	"label"								"", 
	"array_options"						[], 
	"situation_percent"					"100", 
	"fk_prev_id"						null, 
	"fk_unit"							null }




echo "FIN";







?>












?>