<?php

    $nombre = $_GET['producto'];

    require_once('../funciones/bd.php');

    

    try {
        $conn->set_charset("utf8");
        $result = $conn->query("SELECT * FROM articulo WHERE nombre_articulo = '$nombre' LIMIT 1");
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_object($result);
            echo json_encode($row);
        }
        $conn->close();
             
   } catch(Exception $e) {
        $row = array(
             'error' => $e->getMessage()
        );
   }