<?php
include "env.php";

if ($definite !== 1) {
	echo "falta archivo env";
}


// funcion para crear items en las facturas $n Numero de facturas $Pu precio unitario $desc descripcion   $qty cantidad  


function AddLinePresupuesto($n, $pu,$desc,$qty)
	{
		
	$n=strval($n);
	$curl = curl_init();
	global $httpheader, $Root;
	$url = $Root."proposals/".$n."/line";
	
	//$url = $Root."supplierinvoices/".$n."/lines";

	$data=array();

	$data["pu_ht"]= $pu;//"21.00000000";
	$data["description"]= $desc;//"Producto que sale 21999 pesos, sin iva y son la sku sku";
	$data["qty"]= $qty;//"1";
	$data["product_type"]= "1";


	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

	$result = curl_exec($curl);
	curl_close($curl);
	//echo $result;
	//return($result);
	}
function AddInvoiceProovedores($socid,$ref,$ref_supplier,$note,$order_supplier,$date, $label="etiqueta por defecto",$note_private)
	{

	$curl = curl_init();
	global $Root, $httpheader;
	$url = $Root."supplierinvoices";

	$data = array();
	$data["socid"]=$socid;
	$data['ref_supplier']=$ref_supplier;
	$data['note']=$note;
	$data['order_supplier']=$order_supplier;
	$data["label"]=$label;
	$data["note_private"] = $note_private;

	//$data['ref']=$ref;
	//$data['date']=$date;
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


	$result = curl_exec($curl);
	//print(htmlentities($response));
	curl_close($curl);
	return($result);
	}
function AddCotizacion($n, $pu,$desc,$qty){
		$n=strval($n);
		//print($n);
	$curl = curl_init();
	global $httpheader, $Root;
	$url = $Root."cotizacionesapi/cotizacions";
	

	$data=array();

	$data["pu_ht"]= $pu;//"21.00000000";
	$data["description"]= $desc;//"Producto que sale 21999 pesos, sin iva y son la sku sku";
	$data["qty"]= $qty;//"1";
	$data["product_type"]= "1";

	// $data["pu_ht"]= "21.00000000";
	// $data["description"]= "Producto que sale 21999 pesos, sin iva y son la sku sku";
	// $data["qty"]= "1";
	// $data["product_type"]= "0";

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

	$result = curl_exec($curl);
	curl_close($curl);
	//echo $result;
	//return($result);
	}
function GetProvedores()
	{
		
	$curl = curl_init();
	global $httpheader, $Root;
	$url = $Root."thirdparties?sortfield=t.rowid&sortorder=ASC&limit=100&mode=4&category=1";
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);
	curl_close($curl);
	//echo $result;
	return($result);
	}
function GetClientes()
	{
		
	$curl = curl_init();
	global $httpheader, $Root;
	$url = $Root."thirdparties?sortfield=t.rowid&sortorder=ASC&limit=100&mode=1";
	
	curl_setopt($curl, CURLOPT_URL, $url);
	//curl_setopt($curl, CURLOPT_POST, 1);
	//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);
	curl_close($curl);
	//echo $result;
	return($result);	}
function sacala($vari="ninguna variable asignada")
	{
		echo"<br>";
		//echo $vari;
		//print $vari;
		var_dump($vari);
		// print_r $vari;
		//printf($vari;)
	}
function GetMegafriends()	{
			
		$curl = curl_init();
		global $httpheader, $Root;
		$url = $Root."thirdparties?sortfield=t.rowid&sortorder=ASC&limit=100&mode=4";
		
		curl_setopt($curl, CURLOPT_URL, $url);
		//curl_setopt($curl, CURLOPT_POST, 1);
		//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
		$result = curl_exec($curl);
		curl_close($curl);
		//echo $result;
		return($result);	}
function getCotizacion($n)	{
	if (isset($n)) {
		# code...
	
			
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
		
		}	else {
			
			echo"no se especifico N de cotizacion";
			return(false);
		}
		
	
	}

	//,","Artistica","Guion","DF","Dron"]


function getRol($n){
	$resultado = "rolcito";
	switch ($n) {
	case '0':
	# code...
	$resultado = "Stock";
	break;
	case '1':
	$resultado = "Produccion";
	break;
	case '2':
		$resultado = "Camara";
	break;
	case '3':
		$resultado = "Edicion";
	break;
	case '4':
		$resultado = "Locucion";
	break;
	case '5':
		$resultado = "Sonido";
	break;
	case '6':
		$resultado = "Color";
	break;
	case '7':
		$resultado = "Equipos";
	break;
	case '8':
		$resultado = "Asistente";
	break;
	case '9':
		$resultado = "Viaticos";
		break;
		case '10':
			$resultado = "Artistica";
			break;
		case '11':
			$resultado = "Guion";
			break;
		case '12':
			$resultado = "DF";
					break;
	case '13':
						$resultado = "Dron";
						break;
	default:
		# code...
		break;
	}
	return $resultado;
}


function addLinesProv($FacturaCreada, $pu, $desc, $qty="1",$iva="0.00", $note_private){
	$pu = strval($pu);
	//echo 'pu es : '.$pu;
	global $httpheader, $Root;
	$url = $Root."supplierinvoices/".$FacturaCreada."/lines";
	$data=array();

	$data["tva_tx"] =  "00.000";
	$data["multicurrency_subprice"] =  $pu;
	//$data["multicurrency_subprice"] =  "321.00000000";
	$data["description"]= $desc;//"Producto que sale 21999 pesos, sin iva y son la sku sku";
	$data["qty"]= $qty;//"1";
	$data["product_type"]= "0";
	$data["note_private"] = $note_private;


	##NO 
	//$data["total_ht"] =  "321.00000000";
	//$data["pu_ht"] =  "321.00000000";
	//$data["subprice"] =  "321.00000000";
	//$data["multicurrency_total_ht"] =  "321.00000000";
	//$data["pu_ht"]= $pu;//"21.00000000";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$AgregarLineas = curl_exec($curl);
	//$result = json_decode($facturaCreada,1);
	curl_close($curl);

	return($AgregarLineas);



}


      
/*     {
      "ref": null,
      "product_ref": null,
      "ref_supplier": "",
      "product_desc": null,
      "pu_ht": "321.00000000",
      "subprice": "321.00000000",
      "pu_ttc": "388.41000000",
      "fk_facture_fourn": "226",
      "label": null,
      "description": "dectripcion 3",
      "date_start": null,
      "date_end": null,
      "situation_percent": null,
      "fk_prev_id": null,
      "vat_src_code": "",
      "tva_tx": "21.000",
      "localtax1_tx": "0.000",
      "localtax2_tx": "0.000",
      "qty": "1",
      "remise_percent": "0",
      "total_ht": "321.00000000",
      "total_ttc": "388.41000000",
      "total_tva": "67.41000000",
      "total_localtax1": "0.00000000",
      "total_localtax2": "0.00000000",
      "fk_product": null,
      "product_type": "0",
      "product_label": null,
      "info_bits": "0",
      "fk_remise_except": null,
      "fk_parent_line": null,
      "special_code": "0",
      "rang": "3",
      "localtax1_type": "",
      "localtax2_type": "",
      "multicurrency_subprice": "321.00000000",
      "multicurrency_total_ht": "321.00000000",
      "multicurrency_total_tva": "67.41000000",
      "multicurrency_total_ttc": "388.41000000",
      "id": "184",
      "fk_unit": null,
      "date_debut_prevue": null,
      "date_debut_reel": null,
      "date_fin_prevue */


	  function consolog($data) {
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);
	
		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}

	function hopen($content,$notas,$tag){
		if (!isset($tag)){
			$tag = 'div';
		}
		if(isset($notas)){$print = '<-- '.$notas.'-->';}
			if (isset($content){$print .= '<'.$tag.'>'.$content;}
		}
	
?>
