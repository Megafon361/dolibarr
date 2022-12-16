<?php
header('Content-Type: text/javascript');
echo '
<script type="text/javascript">
console.log("WOOOOOOOOOOOOOOOOW2!");



//alert("total");

  $( document ).ready(function() {
    console.log( "ready! cotizacard.css.php" );

	$("*[tipo=\'Precio\']").removeClass();
	$("[tipo=\'Cant\']").attr("maxlength","2");
	//

$("#C0Pr").addClass("C0Pr");
$("#C0Ca").addClass("C0Ca");
$("#C1Pr").addClass("Precio");
$("#C1Ca").addClass("Cant");
$("#C2Pr").addClass("Precio");
$("#C2Ca").addClass("Cant");
$("#C3Pr").addClass("Precio");
$("#C3Ca").addClass("Cant");
$("#C4Pr").addClass("Precio");
$("#C4Ca").addClass("Cant");
$("#C5Pr").addClass("Precio");
$("#C5Ca").addClass("Cant");
$("#C6Pr").addClass("Precio");
$("#C6Ca").addClass("Cant");
$("#C7Pr").addClass("Precio");
$("#C7Ca").addClass("Cant");
$("#C8Pr").addClass("Precio");
$("#C8Ca").addClass("Cant");
$("#C9Pr").addClass("Precio");
$("#C9Ca").addClass("Cant");

$("#C5Ca").addClass("Cant");
$("#C5Pr").addClass("Precio");
$("#C6Ca").addClass("Cant");
$("#C6Pr").addClass("Precio");
$("#C7Ca").addClass("Cant");
$("#C7Pr").addClass("Precio");
$("#C8Ca").addClass("Cant");
$("#C8Pr").addClass("Precio");
$("#C9Ca").addClass("Cant");
$("#C9Pr").addClass("Precio");


//$("#C0Pr").removeClass();


//$("[tipo=\'Cant\']").removeClass("minwidth400 flat --success");
//$("input [tipo=\'Cant\']").addClass("Cant");
//$("[tipo=\'Cant\']").removeAttr("maxlength");
//$("[tipo=\'Cant\']").attr("maxlength","2");
		
	
	//$("td.Precio").removeClass();	
	//$("td.Cant").removeClass();	


	//$("*[tipo=\'Precio\']").removeClass("flat minwidth400 --success");
	
	
	//$("input [tipo=\'Precio\']").addClass("Precio");
	//$("[tipo=\'Precio\']").removeAttr("maxlength");
	//$("[tipo=\'Precio\']").attr("maxlength","12");
	//$("[tipo=\'Precio\']").attr("with","2px");

	//$("[tipo=\'Pago\']").removeClass("flat minwidth400 --success");
	//$("[tipo=\'Pago\']").addClass("Pago");
	//$("[tipo=\'Pago\']").removeAttr("maxlength");
	//$("[tipo=\'Pago\']").attr("maxlength","12");



	
	//$("form *").removeClass();	
	

	
	


}); 

function var_dump(array){	
	};

var gastos = 0

function sumar() {

	var gastos =    0;
	for (let i = 0; i < 9; i++)
	 {
	  var cantidad = document.getElementsByClassName("Cant")[i].value;
	  var precio = document.getElementsByClassName("Precio")[i].value;
	  //console.log(cantidad);
	  //console.log(precio);

	  if (isNaN(parseFloat(cantidad))) {  	 
		  cantidad = 0;
		} else {	
		  cantidad = parseFloat(cantidad);
		}

		if (isNaN(parseFloat(precio))) {
		precio = 0;
  		} else {
		  precio = parseFloat(precio);
		}  



	  gastos += parseFloat(cantidad * precio);

 	 }
	 
	var Civa = 0.21;
	var Cganancias = 0.15;
	var Ciibb = 0.025;
	var Cproduccion = 0.15;
	var Cmegafon = 0.15;
	var megafon;
	var produccion;

	megafon = gastos * Cmegafon;
	produccion = gastos*(Cproduccion);
	gastos += produccion;

	 document.getElementById("gastos").value = gastos.toFixed(2);
	
	 document.getElementById("megafon").value = megafon.toFixed(2);
	 subtotal = megafon + gastos;
	 document.getElementById("subtotal").value = subtotal.toFixed(2);
	 document.getElementById("subtotal2").value = subtotal.toFixed(2);
	 var_dump(gastos);
	  
	
	  var conIVA = Civa + Ciibb + Cganancias; 
	  var sinIVA  = Ciibb + Cganancias;
	  var contado = 0;
	  
	  
	  choco = document.getElementById("check1")[0];
	  if(document.getElementById("check1").checked){
		  var total =  subtotal * (1 + conIVA);
	  }
	  if(document.getElementById("check2").checked){
		  var total =  subtotal * (1 + sinIVA);
	  }
	  if(document.getElementById("check3").checked){
		  var total =  subtotal ;
	  }
	  document.getElementById("total").value = total.toFixed(2);
	  gastos =  0;
 

	  document.getElementById("iva").value = (total - subtotal).toFixed(2);
	  document.getElementById("C0Pr").value = produccion.toFixed(2);

	  
};





</script>';

?>
