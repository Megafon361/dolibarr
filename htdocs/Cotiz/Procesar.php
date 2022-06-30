<?php

$httpheader =  ['DOLAPIKEY: mAgnV8S8vehYX2Pm3NQ56o46bgXPQu47'];
//$Root = "http://localhost/dolibarr/api/index.php/";
$Root = "http://fontv.ar/htdocs/api/index.php/";
$curl = curl_init();
$url = $Root."cotizacionesapi/cotizacions";

$entrega = array();
$Usuario = $_POST['Usuario'];
$entrega['mes']	= $_POST['q4_entregames'];//entrega
$entrega['dia']	= $_POST['q4_entregadia'];//
$entrega['año']	= $_POST['q4_entregaaño'];//
$entregastring = $entrega['mes'].$entrega['dia'].$entrega['año'];
$cliente		= $_POST['clientex'];
$etiqueta		= $_POST['q19_etiqueta'];  //label
$trabajo		= $_POST['q8_trabajo'];
$descripcion	= $_POST['q11_descripcion'];
$_typeA			= $_POST['q27_typeA'];
$_typeAOther	= $_POST['q27_typeAOther'];
$gastos		= $_POST['q25_gastos25'];
$megafon		= $_POST['q28_megafon'];
$subtotal		= $_POST['q30_subtotal'];
$iva		= $_POST['q26_iva26'];
$total		= $_POST['q29_total29'];
$Acotizar = Array();
$Acotizar[0]['Rol']=$_POST['q3_cotizacion0Rol'];
$Acotizar[0]['Precio']=$_POST['q3_cotizacion0Precio'];
$Acotizar[0]['Cant']=$_POST['q3_cotizacion0Cant'];
$Acotizar[0]['Asign']=$_POST['q3_cotizacion0Asign'];
$Acotizar[0]['Pago']=$_POST['q3_cotizacion0Pago'];
$Acotizar[1]['Rol']=$_POST['q3_cotizacion1Rol'];
$Acotizar[1]['Precio']=$_POST['q3_cotizacion1Precio'];
$Acotizar[1]['Cant']=$_POST['q3_cotizacion1Cant'];
$Acotizar[1]['Asign']=$_POST['q3_cotizacion1Asign'];
$Acotizar[1]['Pago']=$_POST['q3_cotizacion1Pago'];
$Acotizar[2]['Rol']=$_POST['q3_cotizacion2Rol'];
$Acotizar[2]['Precio']=$_POST['q3_cotizacion2Precio'];
$Acotizar[2]['Cant']=$_POST['q3_cotizacion2Cant'];
$Acotizar[2]['Asign']=$_POST['q3_cotizacion2Asign'];
$Acotizar[2]['Pago']=$_POST['q3_cotizacion2Pago'];
$Acotizar[3]['Rol']=$_POST['q3_cotizacion3Rol'];
$Acotizar[3]['Precio']=$_POST['q3_cotizacion3Precio'];
$Acotizar[3]['Cant']=$_POST['q3_cotizacion3Cant'];
$Acotizar[3]['Asign']=$_POST['q3_cotizacion3Asign'];
$Acotizar[3]['Pago']=$_POST['q3_cotizacion3Pago'];
$Acotizar[4]['Rol']=$_POST['q3_cotizacion4Rol'];
$Acotizar[4]['Precio']=$_POST['q3_cotizacion4Precio'];
$Acotizar[4]['Cant']=$_POST['q3_cotizacion4Cant'];
$Acotizar[4]['Asign']=$_POST['q3_cotizacion4Asign'];
$Acotizar[4]['Pago']=$_POST['q3_cotizacion4Pago'];
$Acotizar[5]['Rol']=$_POST['q3_cotizacion5Rol'];
$Acotizar[5]['Precio']=$_POST['q3_cotizacion5Precio'];
$Acotizar[5]['Cant']=$_POST['q3_cotizacion5Cant'];
$Acotizar[5]['Asign']=$_POST['q3_cotizacion5Asign'];
$Acotizar[5]['Pago']=$_POST['q3_cotizacion5Pago'];
$Acotizar[6]['Rol']=$_POST['q3_cotizacion6Rol'];
$Acotizar[6]['Precio']=$_POST['q3_cotizacion6Precio'];
$Acotizar[6]['Cant']=$_POST['q3_cotizacion6Cant'];
$Acotizar[6]['Asign']=$_POST['q3_cotizacion6Asign'];
$Acotizar[6]['Pago']=$_POST['q3_cotizacion6Pago'];
$Acotizar[7]['Rol']=$_POST['q3_cotizacion7Rol'];
$Acotizar[7]['Precio']=$_POST['q3_cotizacion7Precio'];
$Acotizar[7]['Cant']=$_POST['q3_cotizacion7Cant'];
$Acotizar[7]['Asign']=$_POST['q3_cotizacion7Asign'];
$Acotizar[7]['Pago']=$_POST['q3_cotizacion7Pago'];
$Acotizar[8]['Rol']=$_POST['q3_cotizacion8Rol'];
$Acotizar[8]['Precio']=$_POST['q3_cotizacion8Precio'];
$Acotizar[8]['Cant']=$_POST['q3_cotizacion8Cant'];
$Acotizar[8]['Asign']=$_POST['q3_cotizacion8Asign'];
$Acotizar[8]['Pago']=$_POST['q3_cotizacion8Pago'];
$Acotizar[9]['Rol']=$_POST['q3_cotizacion9Rol'];
$Acotizar[9]['Precio']=$_POST['q3_cotizacion9Precio'];
$Acotizar[9]['Cant']=$_POST['q3_cotizacion9Cant'];
$Acotizar[9]['Asign']=$_POST['q3_cotizacion9Asign'];
$Acotizar[9]['Pago']=$_POST['q3_cotizacion9Pago'];
$Acotizar[10]['Rol']=$_POST['q3_cotizacion10Rol'];
$Acotizar[10]['Precio']=$_POST['q3_cotizacion10Precio'];
$Acotizar[10]['Cant']=$_POST['q3_cotizacion10Cant'];
$Acotizar[10]['Asign']=$_POST['q3_cotizacion10Asign'];
$Acotizar[10]['Pago']=$_POST['q3_cotizacion10Pago'];
$Acotizar[11]['Rol']=$_POST['q3_cotizacion11Rol'];
$Acotizar[11]['Precio']=$_POST['q3_cotizacion11Precio'];
$Acotizar[11]['Cant']=$_POST['q3_cotizacion11Cant'];
$Acotizar[11]['Asign']=$_POST['q3_cotizacion11Asign'];
$Acotizar[11]['Pago']=$_POST['q3_cotizacion11Pago'];
$Acotizar[12]['Rol']=$_POST['q3_cotizacion12Rol'];
$Acotizar[12]['Precio']=$_POST['q3_cotizacion12Precio'];
$Acotizar[12]['Cant']=$_POST['q3_cotizacion12Cant'];
$Acotizar[12]['Asign']=$_POST['q3_cotizacion12Asign'];
$Acotizar[12]['Pago']=$_POST['q3_cotizacion12Pago'];
$Acotizar[13]['Rol']=$_POST['q3_cotizacion13Rol'];
$Acotizar[13]['Precio']=$_POST['q3_cotizacion13Precio'];
$Acotizar[13]['Cant']=$_POST['q3_cotizacion13Cant'];
$Acotizar[13]['Asign']=$_POST['q3_cotizacion13Asign'];
$Acotizar[13]['Pago']=$_POST['q3_cotizacion13Pago'];
$Acotizar[14]['Rol']=$_POST['q3_cotizacion14Rol'];
$Acotizar[14]['Precio']=$_POST['q3_cotizacion14Precio'];
$Acotizar[14]['Cant']=$_POST['q3_cotizacion14Cant'];
$Acotizar[14]['Asign']=$_POST['q3_cotizacion14Asign'];
$Acotizar[14]['Pago']=$_POST['q3_cotizacion14Pago'];
$Acotizar[15]['Rol']=$_POST['q3_cotizacion15Rol'];
$Acotizar[15]['Precio']=$_POST['q3_cotizacion15Precio'];
$Acotizar[15]['Cant']=$_POST['q3_cotizacion15Cant'];
$Acotizar[15]['Asign']=$_POST['q3_cotizacion15Asign'];
$Acotizar[15]['Pago']=$_POST['q3_cotizacion15Pago'];



$data = array();

$data["entrega"]=$entregastring;
$data["ref"]="referencia";
$data["label"]=$etiqueta;
$data['Usuario']=$Usuario;
$data["C0Pa"]=$Acotizar[0]['Pago'];
$data["C0As"]=$Acotizar[0]['Asign'];
$data["C0Pr"]=$Acotizar[0]['Precio'];
$data["C0Ro"]=$Acotizar[0]['Rol'];
$data["C0Ca"]=$Acotizar[0]['Cant'];
$data["C1Pa"]=$Acotizar[1]['Pago'];
$data["C1As"]=$Acotizar[1]['Asign'];
$data["C1Pr"]=$Acotizar[1]['Precio'];
$data["C1Ro"]=$Acotizar[1]['Rol'];
$data["C1Ca"]=$Acotizar[1]['Cant'];
$data["C2Pa"]=$Acotizar[2]['Pago'];
$data["C2As"]=$Acotizar[2]['Asign'];
$data["C2Pr"]=$Acotizar[2]['Precio'];
$data["C2Ro"]=$Acotizar[2]['Rol'];
$data["C2Ca"]=$Acotizar[2]['Cant'];
$data["C3Pa"]=$Acotizar[3]['Pago'];
$data["C3As"]=$Acotizar[3]['Asign'];
$data["C3Pr"]=$Acotizar[3]['Precio'];
$data["C3Ro"]=$Acotizar[3]['Rol'];
$data["C3Ca"]=$Acotizar[3]['Cant'];
$data["C4Pa"]=$Acotizar[4]['Pago'];
$data["C4As"]=$Acotizar[4]['Asign'];
$data["C4Pr"]=$Acotizar[4]['Precio'];
$data["C4Ro"]=$Acotizar[4]['Rol'];
$data["C4Ca"]=$Acotizar[4]['Cant'];
$data["C5Pa"]=$Acotizar[5]['Pago'];
$data["C5As"]=$Acotizar[5]['Asign'];
$data["C5Pr"]=$Acotizar[5]['Precio'];
$data["C5Ro"]=$Acotizar[5]['Rol'];
$data["C5Ca"]=$Acotizar[5]['Cant'];
$data["C6Pa"]=$Acotizar[6]['Pago'];
$data["C6As"]=$Acotizar[6]['Asign'];
$data["C6Pr"]=$Acotizar[6]['Precio'];
$data["C6Ro"]=$Acotizar[6]['Rol'];
$data["C6Ca"]=$Acotizar[6]['Cant'];
$data["C7Pa"]=$Acotizar[7]['Pago'];
$data["C7As"]=$Acotizar[7]['Asign'];
$data["C7Pr"]=$Acotizar[7]['Precio'];
$data["C7Ro"]=$Acotizar[7]['Rol'];
$data["C7Ca"]=$Acotizar[7]['Cant'];
$data["C8Pa"]=$Acotizar[8]['Pago'];
$data["C8As"]=$Acotizar[8]['Asign'];
$data["C8Pr"]=$Acotizar[8]['Precio'];
$data["C8Ro"]=$Acotizar[8]['Rol'];
$data["C8Ca"]=$Acotizar[8]['Cant'];
$data["C9Pa"]=$Acotizar[9]['Pago'];
$data["C9As"]=$Acotizar[9]['Asign'];
$data["C9Pr"]=$Acotizar[9]['Precio'];
$data["C9Ro"]=$Acotizar[9]['Rol'];
$data["C9Ca"]=$Acotizar[9]['Cant'];
$data["C10Pa"]=$Acotizar[10]['Pago'];
$data["C10As"]=$Acotizar[10]['Asign'];
$data["C10Pr"]=$Acotizar[10]['Precio'];
$data["C10Ro"]=$Acotizar[10]['Rol'];
$data["C10Ca"]=$Acotizar[10]['Cant'];
$data["C11Pa"]=$Acotizar[11]['Pago'];
$data["C11As"]=$Acotizar[11]['Asign'];
$data["C11Pr"]=$Acotizar[11]['Precio'];
$data["C11Ro"]=$Acotizar[11]['Rol'];
$data["C11Ca"]=$Acotizar[11]['Cant'];
$data["C12Pa"]=$Acotizar[12]['Pago'];
$data["C12As"]=$Acotizar[12]['Asign'];
$data["C12Pr"]=$Acotizar[12]['Precio'];
$data["C12Ro"]=$Acotizar[12]['Rol'];
$data["C12Ca"]=$Acotizar[12]['Cant'];
$data["C13Pa"]=$Acotizar[13]['Pago'];
$data["C13As"]=$Acotizar[13]['Asign'];
$data["C13Pr"]=$Acotizar[13]['Precio'];
$data["C13Ro"]=$Acotizar[13]['Rol'];
$data["C13Ca"]=$Acotizar[13]['Cant'];
$data["C14Pa"]=$Acotizar[14]['Pago'];
$data["C14As"]=$Acotizar[14]['Asign'];
$data["C14Pr"]=$Acotizar[14]['Precio'];
$data["C14Ro"]=$Acotizar[14]['Rol'];
$data["C14Ca"]=$Acotizar[14]['Cant'];
$data["C15Pa"]=$Acotizar[15]['Pago'];
$data["C15As"]=$Acotizar[15]['Asign'];
$data["C15Pr"]=$Acotizar[15]['Precio'];
$data["C15Ro"]=$Acotizar[15]['Rol'];
$data["C15Ca"]=$Acotizar[15]['Cant'];

$data["gastos"]=$gastos;
$data["total"]=$total;
$data["iva"]=$iva;
$data["subtotal"]=$subtotal;
$data["megafon"]=$megafon;
$data["cliente"]=$cliente;;
$data["trabajo"]=$trabajo;
$data["description"]="Descripcion";
$data["note_public"]="nota publica";
$data["note_private"]=$descripcion;
$data["status"]="0";
$data["fk_soc"]=$cliente;
	







	//print(json_encode($data));
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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

echo "final";
?>