<?php

define('DB_USUARIO', 'b31_23021376');
define('DB_PASSWORD', '6479250*Jd');
define('DB_HOST', 'sql212.byethost31.com');
define('DB_NOMBRE', 'b31_23021376_facturas');
//define('DB_PUERTO', '8889');

$conn = new mysqli(DB_HOST, DB_USUARIO, DB_PASSWORD, DB_NOMBRE);

if ($conn->connect_errno) {
    printf("Falló la conexión: %s\n", $conn->connect_error);
    exit();
}


// $user = 'root';
// $password = 'root';
// $db = 'facturas';
// $host = 'localhost';
// $port = 8889;

// $link = mysqli_init();
// $conn = mysqli_real_connect(
//    $link, 
//    $host, 
//    $user, 
//    $password, 
//    $db,
//    $port
// );
// echo $conn->ping();
?>