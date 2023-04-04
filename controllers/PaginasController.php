<?php 

namespace Controller;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
#[\AllowDynamicProperties]
class PaginasController{
    
    public static function index(Router $router){
        $inicio = true;
        $propiedades = Propiedad::get(3);
        $router->render('paginas/index',[
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }
    public static function nosotros(Router $router){

        $router->render('/paginas/nosotros',[

        ]);
    }
    public static function propiedades(Router $router){
            $propiedades = Propiedad::all();
        $router->render('/paginas/listado',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad( Router $router){

        $id = validarORedireccionar('/listado');

        $propiedad = Propiedad::find($id);



        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad    
        ]);
        
    }
    public static function blog(Router $router){

        $router->render('/paginas/blog',[

        ]);
    }
    public static function entrada(){
        echo 'desde la vista';
    }


    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        
        $respuestas = $_POST['contacto'];
          //crear una instancia de php miler
    
        $mail = new PHPMailer();

        //configurar el SMTP este es el que se utiliza para email el ejemplo comparativo para visitar una pagina web usamos http://, SMTP es para email la configuracion que tengo a continuacion la consegui de mailtrap use la tecnologia de laravel que tiene codigo php pero como estamos codificando con POO vamos a seguir creando objetos 
        //? MAIL_MAILER=smtp
        //? MAIL_HOST=sandbox.smtp.mailtrap.io
        //? MAIL_PORT=2525
        //? MAIL_USERNAME=edb3f6853e4ece
        //? MAIL_PASSWORD=4950be646a39b9
        //? MAIL_ENCRYPTION=tls

        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io'; 
        $mail->SMTPAuth= true;
        $mail->Port = 2525;
        $mail->Username = 'edb3f6853e4ece';
        $mail->Password = '4950be646a39b9';
        $mail->SMTPSecure = 'tls';
            //configurar el contenido del mail
        $mail->addAddress('parladecristian.19972020@gmail.com');//direccion donde se van a recibir 
        $mail->setFrom('admin@bienesraices.com', 'Admin'); //esto quiere decir quien envia el email. 
        $mail->Subject = 'Tienes un nuevo mensaje';//este es el mensaje que nos avisara de una nuevo email en mailtrap

        //habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .='<p>Tienes un nuevo mensaje </p> </html>';
        $contenido.= '<p>Nombre: '. $respuestas['nombre'].'<p>';
        if($respuestas['contacto'] === 'telefono'){
            $contenido.='<p> Eligio ser contactado por telefono </p>';
            $contenido.= '<p>Teléfono: '. $respuestas['telefono'].'<p>';
            $contenido.= '<p>Fecha: '. $respuestas['fecha'].'<p>';
            $contenido.= '<p>Hora: '. $respuestas['hora'].'<p>';
        }else{
            $contenido.='<p> Eligio ser contactado por email </p>';
            $contenido.= '<p>Email: '. $respuestas['email'].'<p>';
        }
       
       
        $contenido.= '<p>Mensaje: '. $respuestas['mensaje'].'<p>';
        $contenido.= '<p>Vende o Compra: '. $respuestas['tipo'].'<p>';
        $contenido.= '<p>Precio o Presupuesto: $'. $respuestas['precio'].'<p>';
      
       
        $contenido.= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'esto es texto alternativo sin utilizar html';
    
        //enviar el mail
        //*send se encarga de enviar el mail y retorna true o false
        if($mail->send()){ 
           $mensaje = "Mensaje enviado correctamente";
        }else{
           $mensaje = "No se pudo enviar el mensaje";
        }
    

    }

        $router->render('/paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }



    public static function login(Router $router){
        $errores = [];
        
        $router->render('paginas/login',[
            'errores' => $errores
        ]);

    } 
    public static function cerrarSesion(Router $router){
        $errores = [];

        $router->render('paginas/login',[
            'errores' => $errores
        ]);

    } 
}