<?php include "parts/header.php"?>

</head>
<body>
<div class="ui celled grid container">
  <h2 class="ui header">Cotizaciones</h2>
  <div class="ui grid container">
    <div >
      <form action="https://fontv.ar/dev_789/Cotiz/Cargar.html" method="post" accept-charset="utf-8" >
        <button type="submit" id="input_3"  class="ui button" >
          Cargar Cotizacion
        </button>
     
      </form>
    </div>


    <div>
      <form action="https://fontv.ar/dev_789/Cotiz/CrearPresupuesto.php" method="post" accept-charset="utf-8" >
        <button id="input_3"  class="ui button" >
          Crear Presupuesto
        </button>
        <div class="ui input"> 
          <input type="text" name="nroCotiz1" size="2" maxlength="5"  placeholder="Nro." >
        </div>
      </form>
    </div>


    <div>
      <form action="https://fontv.ar/dev_789/Cotiz/CrearFactura.php" method="post" accept-charset="utf-8">
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
    


<div class="ui calendar" id="custom_format_calendar">
  <div class="ui input left icon">
    <i class="calendar icon"></i>
    <input type="text" placeholder="Date">
  </div>
</div>





<script type="text/javascript">$('#date_calendar')
  .calendar({
    type: 'date'
  })
;
</script>


  </div>
  </div>
      

      <script type="text/javascript"> window.addEventListener('DOMContentLoaded', (event) => {
      $( document ).ready($('table').tablesort());
      });
    </script>

</body>
</html>


