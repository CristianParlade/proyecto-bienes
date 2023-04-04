<?php


define('TEMPLATES',__DIR__.'/template');
define('FUNCIONES',__DIR__.'/funciones.php');
define('CARPETAS_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');


function incluirTemplates(string $nombre, bool $inicio = false){
    include TEMPLATES."/$nombre.php";   
}

function estaAuntenticado(){
    session_start();
   
if (!$_SESSION['login']) {
            header('location: /practica/index.php');
    }
}
function debuguear($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
exit;

}
//escapa el HTML la "s" es de sanitizar
function s($html){
    $s = htmlspecialchars($html);

    return $s;
}

//validar tipo de contenido 

function validarTipoContenido($from){
    $arreglos = ['vendedores', 'propiedad'];
//esta in_array te permite buscar un valor en un arreglo y toma dos valores
//el primero es lo que vamos a buscar y el segundo es el arreglo donde lo va a buscar.
    return in_array($from, $arreglos );
}

//!cuando hay muchos if y elseif se recomienda usar un switch

function mostrarNotificacion($codigo){

    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar( string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url");
    }

    return $id;
}