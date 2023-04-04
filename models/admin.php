<?php 

namespace Model;
//aqui vamos a crear toda la funcionalidad vamos a enviar datos en este caso la nombre de la tabla lo tenemos dinamico en active record por que hya tenemos definido el query por ejempl //!INSERT INTO self::$tabla
//entonces de esa manera ya podemos utilizar ese query en todas los modeles e interactuar con la bese de datos la conexion es una sola definida en active record
class Admin extends ActiveRecord{

    protected static $tabla = 'usuarios';

    protected static $columnasDB = ['id', 'email', 'password'];


    public $id;
    public $email;
    public $password;

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';

        
    }
    public function validar(){
        if(!$this->email){
            self::$errores[] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }
        return self::$errores;
    }
    public function validarUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" .$this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El usuario no existe';
            return;
         }  
            return $resultado;
     
        
    }

    public function validarPassword($resultado){
        $usuario = $resultado->fetch_object();
    
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = 'El password no es correcto';
            return self::$errores;
        }else{
            return true;
        }
    
    }

    public function iniciarSession(){
        session_start();

        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
     }
}

//!me quede en que tengo que darle proteccion a las paginas de admin.

   
