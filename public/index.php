<?php
use MVC\Router;
use Controller\LoginController;
use Controller\PropiedadController;
use Controller\VendedorController;
use Controller\PaginasController;

//*este es el archivo principal vamos a regitrar url y mandar a llamar funciones

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/app.php';

//*este codigo identifica el namespace que deseamos utilizar para localiazar en que clase se encuentra la funcion 
//debuguear(PropiedadController::class);


$router = new Router();
//buscamos la url /admin buscamos la namespace y la clase y por ultimo la funcion que vamos a utilizar
$router->get('/admin', [PropiedadController::class, 'index']);
//!zona privada
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);
//!zona privada
$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);
//!zona púlica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
 $router->get('/contacto', [PaginasController::class, 'contacto']);
 $router->post('/contacto', [PaginasController::class, 'contacto']);

//!login y autenticacion

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);



$router->comprobarRutas();