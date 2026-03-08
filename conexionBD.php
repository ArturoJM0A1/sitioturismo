<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Innovacion');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if ($conexion->connect_error) {
    echo '
        <div class="errormensaje">
            <div class="scalemap">   
                <i class="fa-solid fa-triangle-exclamation"></i>
                <p></p>        
                <i class="fa-solid fa-wrench"></i>
            </div>
        </div>';
    die();
}
/*
define('DB_HOST', 'direccion_IP_o_nombre_de_host_del_servidor_de_base_de_datos');
define('DB_USER', 'c0Programación1');
define('DB_PASS', 'SECTURH+Dato1');
define('DB_NAME', 'Innovacion');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    echo '
        <div class="errormensaje">
            <div class="scalemap">   
                <i class="fa-solid fa-triangle-exclamation"></i>
                <p></p>        
                <i class="fa-solid fa-wrench"></i>
            </div>
        </div>';
    die();
}
*/
?>