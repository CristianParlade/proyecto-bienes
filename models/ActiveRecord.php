<?php
namespace Model;
class activeRecord{
    
    protected static $db;

    //este es un arreglo de columnas que nos permite identificar las columnas de la DB 

    protected static $columnasDB = [];

    //hace referenia a las tablas que luego vamos a especificar
    protected static $tabla = '';

    protected static $errores = [];




    //definir la conexion a la DB
    public static function setDB($database){
        self::$db = $database;
    }

    

    public function guardar(){
        if(!is_null($this->id)){
          //actualizar
           $this->actualizar();
        }else{
            //crea un nuevo registro
             $this->crear();
            
        }
    }

    public function crear(){

        $atributos = $this->sanitizarAtributos();
 //el primer parametro del join toma el espaciado entre los keys en este caso
      
        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES (' ";
        $query .= join("', '",array_values($atributos));
        $query .= " ')";
        
        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        //sanitizar siempre 
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores [] = "$key='$value'";
        }

            $query = "UPDATE ". static::$tabla ." SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 ";
            
            $resultado = self::$db->query($query);
        
           if($resultado){
                header('Location: /admin?resultado=2');
            }
    }

    public function eliminar(){
        $query = "DELETE FROM " .static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }

        

    }

    //iterar en cada atriburo
    //identificar los atriburtos de la DB
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){

    //este if hace que no agregue el id a atributos de otra forma saldria el id vacio
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos ;
    }
    //subida de archivos

    public function setImagen($imagen){
        //elimina la imagen previa 

        if(!is_null($this->id)){
            
            $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }

    } 

    public function borrarImagen(){
       $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);
       if($existeArchivo){
        unlink(CARPETAS_IMAGENES . $this->imagen);
       }
   
    }
    //sanitizar los datos
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
         
        }
         return($sanitizado);
    } 
//validacion  

    public static function getErrores(){
       
        return static::$errores;
    }
    
    public function validar(){
        //definimos la variable estatica por lo tanto para hacer referencia a ella tenemos que utilizar self:: por eso es que utilizamos esa sintaxis en admin una vez llamamos el metodo de calidar por que ya tiene instaciada una variable estatica que esta no se va a reescribir 
        static::$errores = [];
        return static::$errores;
   
    }
    
    public static function all(){
        $query = 'SELECT * FROM ' . static::$tabla;

        $resultado =  self::consultarSQL($query);
        
        return $resultado;

    }
    //obtiene registros con un limite asignado
    public static function get($cantidad){
        $query = 'SELECT * FROM ' . static::$tabla . " LIMIT " . $cantidad;


        $resultado =  self::consultarSQL($query);

        
        return $resultado;

    }

    //buscar una propiedad por su id

    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";


        $resultado = self::consultarSQL($query);

       
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        
        //consularr la base de datos 
        $resultado = self::$db->query($query);

        //iterar en los resultados 
        $array = [];
        while( $registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }


        //lberar memoria

        $resultado->free();

        //retornar los resultados

        return $array;

    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach( $registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    
//sincronizar el objeo en memoria con los cambios realizados por le usuario

    public function sincronizar($args = [] ){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
   
}