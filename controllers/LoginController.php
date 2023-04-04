<?php 
//!recuerda que el name space no hace referencia a la carpeta de los controladores sin a el nombre asignado en el autoload del composer

namespace Controller;
use MVC\Router;
use Model\admin;

class LoginController{

    public static function login(Router $router){
    
        $errores = [];
        $auth = new Admin($_POST);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $errores = $auth->validar();

      if(empty($errores)){

       $resultado = $auth->validarUsuario();

       $errores = Admin::getErrores();

        if($resultado){

           $autenticado = $auth->validarPassword($resultado);

            if($autenticado === true){
                $auth->iniciarSession();
            }else{
            $errores = Admin::getErrores();
            }

        }
    }

}

    if($_SESSION){
        header('Location: /admin');
    }

        
        $router->render('Auth/login', [
                'errores' => $errores
        ]);

    }

    //!cerrar sesion
    public static function logout(Router $router){
        session_start();
    
        $_SESSION = [];
        
        header('Location: /');

    }
}