<?php 
namespace Model;
class Propiedad extends activeRecord{

    protected static $tabla = 'propiedades'; 
    
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','WC','estacionamiento','creado','vendedoresId'];

 
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $WC;
    public $estacionamiento;
    public $creado;
    public $vendedoresId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->WC = $args['WC'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedoresId = $args['vendedoresId'] ?? '';
    }

    public function validar(){
        
        if(!$this->titulo){
            self::$errores[] = "El titulo es obligatorio";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if(strlen($this->descripcion) < 10){
            self::$errores[] = "El descripcion es obligatoria y debe tener menos de 5 caracteres";
        }
        
        if(!$this->habitaciones){
            self::$errores[] = "Las habitaciones tienen que especificarse";
        }
        if(!$this->WC){
            self::$errores[] = "¿Cuantos baños hay disponibles?";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "¿Cuantos estacionamientos hay disponibles?";
        }
        if(!$this->vendedoresId){
            self::$errores[] = "¿Algún vendedor?";
        }
      
        if(!$this->imagen){
             self::$errores[] = "La imagen es obligatoria";
        }
    
        return self::$errores;
       
        }
  
}






