<?php
$httpheader =  ['DOLAPIKEY: mAgnV8S8vehYX2Pm3NQ56o46bgXPQu47'];
//$Root = "http://localhost/dolibarr/api/index.php/";
$Root = "http://fontv.ar/htdocs/api/index.php/";

// funcion para crear items en las facturas $n Numero de facturas $Pu precio unitario $desc descripcion   $qty cantidad 

function AddLines($n, $pu,$desc,$qty)
	{
		$n=strval($n);
		//print($n);
	$curl = curl_init();
	global $httpheader, $Root;
	$url = $Root."supplierinvoices/".$n."/lines";

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
function AddInvoiceProovedores($socid,$ref,$ref_supplier,$note,$order_supplier,$date, $label)
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
	//$data['ref']=$ref;
	//$data['date']=$date;
	
	//print(json_encode($data));
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


	$result = curl_exec($curl);
	print(htmlentities($response));
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
function getCotiz($n=1)	{
			
			$curl = curl_init();
			global $httpheader, $Root;
			$url = $Root."cotizacionesapi/cotizacions/".$n;
			
			curl_setopt($curl, CURLOPT_URL, $url);
			//curl_setopt($curl, CURLOPT_POST, 1);
			//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
			$result = curl_exec($curl);
			curl_close($curl);
			//echo $result;
			$result= json_decode($result,1);
			return($result);	
		}

		
?>