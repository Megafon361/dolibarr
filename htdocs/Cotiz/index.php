<?php include "parts/header.php"?>

</head>
<body>
<div class="ui celled grid container">
  <h2 class="ui header">Cotizaciones</h2>
  <div class="ui grid container">
    <div >
      <form action="Cargar.html" method="post" accept-charset="utf-8" >
        <button type="submit" id="input_3"  class="ui button" >
          Cargar Cotizacion
        </button>
     
      </form>
    </div>


    <div>
      <form action="CrearPresupuesto.php" method="post" accept-charset="utf-8" >
        <button id="input_3"  class="ui button" >
          Crear Presupuesto
        </button>
        <div class="ui input"> 
          <input type="text" name="nroCotiz1" size="2" maxlength="5"  placeholder="Nro." >
        </div>
      </form>
    </div>


    <div>
      <form action="CrearFactura.php" method="post" accept-charset="utf-8">
        <button id="input_4"  class="ui button">
          Crear Facturas
        </button>
        <div class="ui input">
          <input type="text" name="nroCotiz2" size="2" maxlength="5" placeholder="Nro." >
        </div>
      </form>
    </div>
  </div>
<div class="ui celled container" >
    <?php include "lista.php"?>
    

  </div>
  </div>
      

      <script type="text/javascript"> window.addEventListener('DOMContentLoaded', (event) => {
      $( document ).ready($('table').tablesort());
      });
    </script>

</body>
</html>


