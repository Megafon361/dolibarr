
function var_dump(array){

console.log(JSON.stringify(array));

    //alert(JSON.stringify(array));

}





   $( document ).ready(function() {
    console.log( "ready! cotizacard.css.php" );
	
    // PONER En algun elemento onkeyup="sumar();"
    
    /*
	$("[tipo=\'Cant\']").removeClass("minwidth400 flat --success");
	$("[tipo=\'Cant\']").addClass("Cant");
	$("[tipo=\'Cant\']").removeAttr("maxlength");
	$("[tipo=\'Cant\']").attr("maxlength","2");


	$("[tipo=\'Precio\']").removeClass("flat minwidth400 --success");
	$("[tipo=\'Precio\']").addClass("Precio");
	$("[tipo=\'Precio\']").removeAttr("maxlength");
	$("[tipo=\'Precio\']").attr("maxlength","12");

	$("[tipo=\'Pago\']").removeClass("flat minwidth400 --success");
	$("[tipo=\'Pago\']").addClass("Pago");
	$("[tipo=\'Pago\']").removeAttr("maxlength");
	$("[tipo=\'Pago\']").attr("maxlength","12");
*/
});

var gastos = 0
 function sumar() {

   var suma =    0;
      for (let i = 0; i < 5; i++)
       {
        var cantidad = document.getElementsByClassName("Cant")[i].value;
        var precio = document.getElementsByClassName("Precio")[i].value;
        
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



        suma += parseFloat(cantidad * precio);
       // console.log ( 'gastosparciales ' + gastosparciales)

        

       }
       document.getElementById("gastos").value = suma;
       megafon = suma * 0.15;
       document.getElementById("megafon").value = megafon;
       subtotal = megafon + suma;
       document.getElementById("subtotal").value = subtotal;
       var_dump(suma);
        
        var iva = 0.21;
        var ganancias = 0.15;
        var iibb = 0.025

        var conIVA = iva + iibb + ganancias; 
        var sinIVA  = iibb + ganancias;
        var contado = 0;
        
        choco = document.getElementById("check1")[0];
        if(document.getElementById("check1").checked){
            var total =  subtotal * conIVA;
        }
        if(document.getElementById("check2").checked){
            var total =  subtotal * sinIVA;
        }
        if(document.getElementById("check3").checked){
            var total =  subtotal;
        }
        if(document.getElementById("check4").checked){
            console.log("se cheo el 4");
        }

        document.getElementById("iva").value = subtotal - total;

        document.getElementById("total").value = total;
        suma =  0;
   
    
}

 