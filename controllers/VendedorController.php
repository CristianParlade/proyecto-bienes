<?php 
namespace Controller;

use MVC\Router;
use Model\Vendedores;

class VendedorController{
    public static function crear(Router $router)
    {  
        $vendedores = new Vendedores;
        $errores = Vendedores::getErrores();


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            //crear una nueva instancia
            $vendedores = new Vendedores($_POST['vendedores']);
        
           
            //validar que no hayan campos vacios
        
            $errores = $vendedores->validar();
            
            //si no hay errores
        
            if(empty($errores)){
                $vendedores->guardar();
            }
           
        }


        $router->render('vendedores/crear', [
            'vendedores' => $vendedores,
            'errores' => $errores

        ]);

    } 
    public static function actualizar(Router $router){
     
        $errores = Vendedores::getErrores();
            
        $id = validarORedireccionar('/admin');

        $vendedores = Vendedores::find($id);
                
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                 

            //asiginar los valores 
            $args = $_POST['vendedores'];
            //sincronisar lo que esta escrito con lo que le usuario agraga 
            $vendedores->sincronizar($args);
            //validar
            $errores = $vendedores->validar();

            if(empty($errores)){
            $vendedores->guardar();
            }

        }

        $router->render('vendedores/actualizar', [
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);


    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $from = $_POST['from'];
        
                if(validarTipoContenido($from)){
                    $vendedores = Vendedores::find($id);
                    $vendedores->eliminar();
                }
                
            }
        }
    }
}