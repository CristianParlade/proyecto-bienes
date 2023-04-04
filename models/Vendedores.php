<?php

namespace Model;
class Vendedores extends activeRecord{

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        
    }
    
    public function validar(){
        
        if(!$this->nombre){
            self::$errores[] = "El nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$errores[] = "El apellido es obligatorio";
        }
        
        if(!$this->telefono){
            self::$errores[] = "el telefono tienen que especificarse";
        }

        //!esto de preg_match es una espresion regular 
        //se encarga de encontrar un patron en un texto
        //toma dos parametros dentro de parentesis, comillas y dos barras
        //los parametros estan especificados en corchetes y llaves 
        //el primero es que es lo que acepta en este caso numeros de
        //0 al 9
        //y el segundo cuantos caracteres ceptamos en este caso 10
        if(!preg_match('/[0-9]{12}/', $this->telefono)){
            self::$errores[] = "El fomato del Telefono no es valido";
        }
    
        return self::$errores;
       
        }
}