<?php 
//* este es el controlador este es el encargado de llamar a las vistas 
namespace Controller;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;

use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    //*en esta funcion lo pasamos dos parametros Router que hace referencia a la instancia router que es una instancia y $router ya es la instancia con funciones en este caso la funcion de get
    //*se hace de esta forma para no perder la forma que ya le damos en el archivo de index.php
    //*Router hace referencia a la clase y $router a la variable que esta dentro de la clase
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();
        $resultado = $_GET['resultado'] ?? null;



        $router->render("propiedades/admin", [
             'propiedades' => $propiedades,
             'resultado' => $resultado,
             'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedores::all();
        $errores = Propiedad::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
            //generar un nombre unico

            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            //Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                $propiedad->setImagen($nombreImagen);
            }


            //validamos
            $errores = $propiedad->validar();

            if (empty($errores)) {
                //crear la carpeta Y NO si no existe

                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                //guardar la imagen en el servidor

                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores'=> $vendedores,
            'errores'=> $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = $propiedad::getErrores();
        $vendedores = Vendedores::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $args = $_POST['propiedad'];
        
            $propiedad->sincronizar($args);
        
            $errores = $propiedad->validar();
        
            //subida de archivos
            
            
            $nombreImagen = md5(uniqid( rand(), true)) . '.jpg';
        
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
            if(empty($errores)){
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);    
                }
                
                /*subida de archivos*/
                $propiedad ->guardar();
               
        
        
            }
           
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
        
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $from = $_POST['from'];
        
                if(validarTipoContenido($from)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
                
            }
        }
    }
}