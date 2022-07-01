<?php
include "doliclass.php";

//Recibir numero de cotizacion con get 
$NumCotiz = $_POST['nroCotiz1'];
$cotizacion = getCotizacion($NumCotiz);
var_dump( $cotizacion);




if (!isset($NumCotiz)) {
    echo "fuck, la variable  numcotiz no esta seteada";
    # code...
}

//var_dump($cotizacion);

////////////tomar datos de cotizacion para hacer invoice 



// CREAR COTIZACION



$presupuesto = array();
$curl = curl_init();
$url = $Root."proposals/";
$data = array();
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



$data["entrega"]='5102022';//$entregastring;
$data["ref"]=$trabajo;
$data["label"]=$label;


$data["total"]=$cotizacion['total'];
//$data["iva"]=$iva;
//$data["subtotal"]=$subtotal;
//$data["megafon"]=$megafon;
$data["cliente"]=$fk_soc;
$data["description"]="Descripcion";
$data["note_public"]="nota publica";
$data["note_private"]=$description;
$data["status"]="0";
$data["fk_soc"]=$fk_soc;
$data["ref"]=$cotizacion['ref'];
$data["label"]=$cotizacion['label'];
$data["socid"]=$cotizacion['fk_soc'];
$data["trabajo"]=$trabajo;
$data["desc"]=$description;
$data["note_public"]=$note_public;
$data["fk_soc"]=$fk_soc;
$data["datec"]="1638371778";
//$data["date_creation"]="1638371778";
$data["datev"]="1638372079";
$data["date"]="1638313200";
$data["qty"]= "1";



curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$PresupuestoCreado = curl_exec($curl);
$PresupuestoCreado= json_decode($PresupuestoCreado,1);
curl_close($curl);

//var_dump($PresupuestoCreado);






//AGREGAR LINEAS A Presup 

#$lineaAnadida = AddLinePresupuesto($PresupuestoCreado,$total ,$description,1);

var_dump($PresupuestoCreado);

?>