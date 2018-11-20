<?php

    require_once('inc/funciones/bd.php');

    $result = $conn->query("SELECT * FROM articulo");
    $array = array(
        
    );
    if($result){
        while($row = mysqli_fetch_array($result)){
            $producto = utf8_encode($row["nombre_articulo"]);
            array_push($array,$producto);
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
        
<head>
   
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>LaLaLancha</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <script src="js/vendor/jquery-3.3.1.js"></script>
  <script src="js/vendor/jquery-ui.js"></script>

  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
  
  
  <script>
      
    </script>
</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->
  
  

  <div class="barra clearfix">
      
      <div class="contenedor">
      
          <div class="logo clearfix">
              <a href="index.php">LaLaLancha</a>
          </div>

          <nav class="navegacion-principal clearfix">
             
             <a href="facturas.php">Facturas</a>
             <link rel="stylesheet" href="css/normalize.css">
             <a href="">Salir</a>
              
          </nav>

          
      
      </div> <!-- contenedor-->      
      
  </div><!-- barra-->
  
  
    <div class="contenedor clearfix"> 

            
      
            <div id="totales" class="monto-total clearfix">

                <h1></h1>
                <h2></h2>
                <h3></h3>
                
            </div>
            
            
            <div class="formulario-cliente">
                <form id="cliente" action="#">
                
                
                    <div class="campos">


                        <div class="campo">
                            <label for="id">C.I:</label>
                            <input type="text" id="id" />
                        </div>

                        <div class="campo">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" />
                        </div>

                        <div class="campo">
                            <label for="lastname">Apellido:</label>
                            <input type="text" id="lastname" />
                        </div>



                        <div class="campo">
                            <label for="phone">Telefono:</label>
                            <input type="tel" id="phone" />
                        </div>

                        <div class="campo">
                            <label for="email">Email:</label>
                            <input type="email" id="email" />
                        </div>


                        <div class="campo">

                            <label for="address">Dirección:</label>
                            <input type="text" id="address" />

                        </div>
                    
                    </div>

                    <div class="caja clearfix;">
               
                        <div id="busqueda" action="#">
                             <input type="text" name="producto" placeholder="Buscar producto..." id="producto">
                           
                         </div>
                           
                     </div><!-- section busqueda-->

                     <div class="lista-articulos clearfix">
                        <table id="Ariculos" >
                         <thead>
                              <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th> 
                                    <th>Precio</th>
                                    <th>Tax</th>
                              </tr>
                          </thead>
                          <tbody id="tablita">
                          </tbody>
                        </table>
                    </div>

                    <div class="acciones clearfix">

                        <div class="clearfix campo enviar">
                
                            
            
                            <input  type="hidden" id="accion" value="crear"  >
                            <input  type="submit" class="button procesar" value="Procesar"  >
                            
                                
                            
            
                        </div>
                        <div class="clearfix campo cancelar">

                            <input  type="submit" id="cancelar" class="button cancelar" value="Cancelar" >
                        
                        </div>

                    </div>
                </form>
            
        </div>

    </div>

      
            
         
        
        
        
        
           <!-- <form action="/action_page.php" class="lista-articulos clearfix">
                <select class="articulos" name="articulos" size="10" multiple id="articulos">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                </select>
            </form>-->
        

    
    

        <footer class="footer">

            <div class="contenedor">

                   <p class="copyright">Todos Los Derechos Reservados LALALANCHA 2018.</p>
            </div>
        </footer>
  
  
  
  
  
  
  
  
  
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script type="text/javascript">

    
    var total = 0,subtotal=0,taxes=0,arrayarticulos=[];
    $(document).ready(function (){
        var productos = <?= json_encode($array,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS)?>;
    
        
        $("#producto").autocomplete({
            source:productos,
            select: function(event,item){
                var params = {
                    producto:item.item.value
                };

                $(this).click(
                    function(){
                        $(this).val('');
                });

                $.get("inc/modelos/getProducto.php",params,function(response){
                    const respuesta = JSON.parse(response);
                    arrayarticulos.push(respuesta.id_articulo);
                    const listadoProductos = document.querySelector('#tablita');
                    var montoTotal = document.querySelector('#totales h1');
                    var montoSubtotal = document.querySelector('#totales h2');
                    var montoTaxes = document.querySelector('#totales h3');

                    
                    montoSubtotal.innerHTML = 'Subtotal' + ' = ' + `<span>${(subtotal+=parseFloat(respuesta.precio))}</span>`;
                    montoTaxes.innerHTML = 'Impuestos' + ' = '+  (taxes+=parseFloat(respuesta.tax));
                    montoTotal.innerHTML = 'Total' + ' = ' + (total=parseFloat(subtotal+taxes));
                    


                    const añadirProducto = document.createElement('tr');

                    añadirProducto.innerHTML = `
                    <td>${respuesta.id_articulo}</td>
                    <td>${respuesta.nombre_articulo}</td>
                    <td>${respuesta.descripcion}</td>
                    <td>${respuesta.precio}</td>
                    <td>${respuesta.tax}</td>
                    `;

                    

                    listadoProductos.appendChild(añadirProducto);

                    


                });
            }
    });

});
    </script>
    <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
