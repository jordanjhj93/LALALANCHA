<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>LaLaLancha</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
  
  
  <script>
      
    </script>
</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->
  
  <div class="barra">
      
      <div class="contenedor">
      
          <div class="logo clearfix">
              <a href="index.php">LaLaLancha</a>
          </div>

          <nav class="navegacion-principal clearfix">
             
             <a href="facturas.php">Facturas</a>
             <a href="">Salir</a>
              
          </nav>

          
      
      </div> <!-- contenedor-->      
      
  </div><!-- barra-->
  
  
    <div class="contenedor clearfix">  
        
        
        <div class="select-factura">
           
            <h3>Facturas Recientes:</h3>
            
            
        </div>

        <div class="facturas">

        <table id="tfacturas" >
            <thead>
                <tr>
                    <th>Factura</th>
                    <th>Usuario</th>
                    <th>Monto Total</th> 
                </tr>
            </thead>
            <tbody id="btfacturas">
            </tbody>
        </table>

        </div>
        
        
    </div>
    
    <footer class="footer clearfix">
     
        <div class="contenedor">
      
               <p class="copyright">Todos Los Derechos Reservados LALALANCHA 2018.</p>
        </div>
    </footer>
  
  
  
  
  
  
  
  
  
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <!-- <script src="js/main.js"></script> -->
  
  <script type="text/javascript">
    
    $(document).ready(function (){



        const xhr = new XMLHttpRequest();
    
        xhr.open('GET', 'inc/modelos/getFacturas.php', true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onload = function() {
            
            if(this.status === 200){

                console.log(JSON.parse(xhr.responseText)); 
                // leemos la respuesta de PHP
                const respuesta = JSON.parse(xhr.responseText);

                const listadoFacturas = document.querySelector('#btfacturas');

                

                for(var i=0; i < respuesta.length;i++){  
                    var totalfacturas = document.createElement('tr');  
                    totalfacturas.innerHTML = `
                    <td>${respuesta[i]["id_f"]}</td>
                    <td>${respuesta[i]["id_c"]}</td>
                    <td>${respuesta[i]["total"]}</td>
                    `;

                    listadoFacturas.appendChild(totalfacturas);
                }
            }
            
        }
        
        xhr.send()

    

    });
  
  
  
  </script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
