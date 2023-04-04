<?php
namespace MVC;
use Controller\PropiedadController;
use Controller\VendedorController;
use Controller\PaginasController;

require_once __DIR__ . '/includes/app.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#[\AllowDynamicProperties]
//*aca en este archivo vamos a registrar rutas que vamos a soportar por ejemplo si el usuario escribe una ruta que no esta puesta aca en e router no funcionara


 class Router{
//?las ponemos como arreglo por que vamos a utilizarlos en una funcion donde se requieren como areglos
    public $rustasGET = [];
    public $rustasPOST = [];
//en esta funcion lo que hacems es asignar dos parametros el primero va a ser la url que vas a colocar posteriormente donde mandemos a llamar el metodo (funcion) en este caso en public/index.php
    public function get($url, $fn){

        $this->rutasGET[$url] = $fn;
//esto es como key y value esto quiere decir que el valor de $url es la $fn 
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }




    public function comprobarRutas(){
        session_start();

        $auth = $_SESSION['login'] ?? null;

        $rutasPrivadas = ['/admin','propiedades/crear','propiedades/actualizar','propiedades/eliminar','vendedores/crear', 'vendedores/actualizar', 'vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
//$urlActual es para poder asignar a la varibale $rutasGET[] la ruta del archivo actual parque luego podamos anidar una validacion
        if($metodo === 'GET'){
//aqui en este $this->rutasGET van a estar todas las rutas que coloquems en el index con su valor pero al agregar $urlActual solo va a tomar los valores de la ruta en la que estemos en el navegador
            $fn = $this->rutasGET[$urlActual] ?? null; 
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        if(in_array($urlActual, $rutasPrivadas) && !$auth){
            header('Location: /');
        }
       
// esta funcion call_user_func nos permite llamar una funcion cuando no sabemos como se llama una funcion.
//interactua de forma dinamica por que anterior mente hemos colocado que la funcion
        if($fn){
            call_user_func($fn, $this);
        }else{
            echo 'pagina no encontrada';         
        }

    }
//render es normalmente utilizado para mostrar una vista
//!siempre colocar la ruta con comillas dobles.
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
//este doble signo de dolar siginifa variable de variable le podemos pasar un strig como valor y lo convierte en variable 
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";
//*ob_start Esta función activará el almacenamiento en búfer de la salida. Mientras dicho almacenamiento esté activo, no se enviará ninguna salida en su lugar la salida se almacenará en un búfer interno.

//*El contenido de este búfer interno se puede copiar a una variable de tipo string usando ob_get_contents(). Para producir la salida de lo almacenado en el búfer interno se ha de usar ob_end_flush(). De forma alternativa, ob_end_clean() desechará de manera silenciosa el contenido del búfer.
        $contenido = ob_get_clean();
        include __DIR__ . '/views/layout.php';
    }
}