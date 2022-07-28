<?php
include '../src/Afip.php'; 

$afip = new Afip(array('CUIT' => 20321189173));

//$last= $afip->ElectronicBilling->GetLastVoucher($data['CbteTipo'], $data['PtoVta']);

//$last = GetSalesPoints();
$sales_points = $afip->ElectronicBilling->GetSalesPoints(); 
var_dump($sales_points);
echo 'FIN';
//echo $data['CbteTipo'];
//echo $data['PtoVta'];

?>