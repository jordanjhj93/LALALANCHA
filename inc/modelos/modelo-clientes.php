<?php

if($_POST['accion'] == 'crear'){
   
   require_once('../funciones/bd.php');
   
   $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
   $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
   $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
   $cedula = filter_var($_POST['cedula'], FILTER_SANITIZE_NUMBER_INT);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

   $mtotal = $_POST['mtotal'];
   $msubtotal = $_POST['msubtotal'];
   $mtaxes = $_POST['mtaxes'];
 
   
   $articulos = $_POST['articulos'];
   $caracteres = array("[", '"', "]",",");
   $indices = str_replace($caracteres, "", $articulos);
   $articulos = str_split($indices);
//    echo sizeof($articulos);
   

   
   try {
         $stmt = $conn->prepare("INSERT INTO cliente (id_cliente, nombre, apellido, telefono, email, direccion) VALUES (?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("isssss", $cedula, $nombre, $apellido, $telefono, $email, $address);
         $stmt->execute();

         if($stmt->affected_rows == 1) {

               $stmt->close();
              
               $stmt = $conn->prepare("INSERT INTO factura (subtotal, taxes, total) VALUES (?, ?, ?)");
               $stmt->bind_param("ddd", $msubtotal, $mtaxes, $mtotal);
               $stmt->execute();

               if($stmt->affected_rows == 1) {

                    $result = $conn->query("SELECT max(id_factura) as id FROM factura");
                    $row = mysqli_fetch_assoc($result);
                    $id_factura = utf8_encode($row["id"]);

                    // echo $id_factura;

                    $stmt = $conn->prepare("INSERT INTO factura_cliente (id_f, id_c) VALUES (?, ?)");
                    $stmt->bind_param("ii", $id_factura, $cedula);
                    $stmt->execute();


                         if($stmt->affected_rows == 1) {
                              

                              for($i = 0; $i < sizeof($articulos);$i++){

                                    $indice = intval($articulos[$i]);
                                    $stmt = $conn->prepare("INSERT INTO factura_tiene_articulos (id_f, id_a) VALUES (?, ?)");
                                    $stmt->bind_param("ii", $id_factura, $indice);
                                    $stmt->execute();
                                    
                                    
                              }
                              
                              
                               
               
               
                              $respuesta = array(
                              'respuesta' => 'correcto',
                              'datos' => array(
                                   'cedula' => $cedula,
                                   'nombre' => $nombre,
                                   'apellido' => $apellido,
                                   'telefono' => $telefono,
                                   'email' => $email,
                                   'address' => $address,
                                   'Subtotal' => $msubtotal,
                                   'taxes' => $mtaxes,
                                   'total' => $mtotal,
                                   'id_factura' => $id_factura
                              )
                         );
                    }
          }
         }
         $stmt->close();
         $conn->close();
       
    } catch(Exception $e) {
         $respuesta = array(
              'error' => $e->getMessage()
         );
    }

     echo json_encode($respuesta);
}

