<?php
include "doliclass.php";
$resultado = json_decode(getMegafriends(),1);

#sacala($resultado);
foreach ($resultado as $key) {
     if ($key["array_options"]["options_megafriend"]=='1') {
        print '<option value="'.$key["id"].'">'.$key["name_alias"].'</option>';
    } 
   # 
    #print("<br>");    # code...
   #print $key["array_options"]["options_megafriend"];
}

?>