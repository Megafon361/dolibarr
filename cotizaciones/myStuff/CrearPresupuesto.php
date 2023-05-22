<?php
include "doliclass.php";

//Recibir numero de cotizacion con get 
$NumCotiz = $_POST['nroCotiz1'];
//var_dump($NumCotiz);

echo "<br>";
$cotizacion = getCotizacion($NumCotiz);
//var_dump($cotizacion);




if (!isset($NumCotiz)) {
    echo "fuck, la variable  numcotiz no esta seteada";
    # code...
} 


?>