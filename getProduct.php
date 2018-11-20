<?php
    
    include("connectionDB.php");
    // get the q parameter from URL
    $hint;

    //conexion base de datos

    //consulta en la base de datos
    $db = new mysql;
    $conexion1 =  $db->Connect('mysql:host='.$myhost.';dbname='.$mynamedb, $myuserdb, $mypassdb);
    if(!$conexion1){
        //debug_to_console('No se puede Conectar la Base de Datos!!!!');
        exit();
    }
    else{
        $sql = $db->Execute("SELECT `*` FROM `articulo`");
        $totalregistros = $db->numrows();
        if($totalregistros > 0){
            $hint= $db->GetArray();
        }
    }

    // echo $hint;
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($hint, JSON_FORCE_OBJECT);
    exit();

?>