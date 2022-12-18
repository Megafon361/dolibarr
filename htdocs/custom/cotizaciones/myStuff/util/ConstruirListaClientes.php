<?php
include "doliclass.php";
$resultado = json_decode(getClientes(),1);

#sacala($resultado);
foreach ($resultado as $key) {
    print '<option value="'.$key["id"].'">'.$key["name_alias"].'</option>';
    #print("<br>");    # code...
}

?>