<?php

    require_once('../funciones/bd.php');

    

    try {
        $conn->set_charset("utf8");
        $result = $conn->query("SELECT id_f, id_c, total FROM factura_cliente f1, factura f2 WHERE f1.id_f=f2.id_factura");
        $array = array();

        if($result){
            
            while($row = mysqli_fetch_array($result)){
                array_push($array,$row);
            }
            echo json_encode($array);
        }
        $conn->close();
             
   } catch(Exception $e) {
        $row = array(
             'error' => $e->getMessage()
        );
   }