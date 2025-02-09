<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ReporteController;
use Controllers\VentaController;
use Controllers\ProductoController;
use Controllers\ClienteController;
use Controllers\DetalleController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/pdf', [ReporteController::class,'pdf']);
$router->post('/reporte/generarPDF', [ReporteController::class, 'generarPDF']);

//!Rutas Para Ventas
$router->get('/ventas', [VentaController::class,'index']);
$router->get('/API/ventas/buscar', [VentaController::class,'buscarAPI']);
$router->post('/API/ventas/guardar', [VentaController::class,'guardarAPI']);
$router->post('/API/ventas/eliminar', [VentaController::class,'eliminarAPI']);

//!Rutas Para Productos
$router->get('/productos', [ProductoController::class,'index']);
$router->get('/API/productos/buscar', [ProductoController::class,'buscarAPI']);
$router->post('/API/productos/guardar', [ProductoController::class,'guardarAPI']);
$router->post('/API/productos/eliminar', [ProductoController::class,'eliminarAPI']);

//!Rutas Para Clientes
$router->get('/clientes', [ClienteController::class,'index']);
$router->get('/API/clientes/buscar', [ClienteController::class,'buscarAPI']);
$router->post('/API/clientes/guardar', [ClienteController::class,'guardarAPI']);
$router->post('/API/clientes/eliminar', [ClienteController::class,'eliminarAPI']);




$router->get('/detalles', [DetalleController::class,'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
