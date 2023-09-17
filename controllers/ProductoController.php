<?php

namespace Controllers;
use Exception;
use Model\Producto;
use MVC\Router;

class ProductoController{
    public static function index(Router $router){


        $productos = Producto::all();
        
        

        $router->render('productos/index', [
            'productos' => $productos,
        ]); 
    }

    
//!Funcion Guardar
public static function guardarAPI(){
    try {
        $producto = new Producto($_POST);
        $resultado = $producto->crear();
        if($resultado['resultado'] == 1){
            echo json_encode([
                'mensaje' => 'Registro guardado correctamente',
                'codigo' => 1
            ]);
        }else{
            echo json_encode([
                'mensaje' => 'Ocurrio un error',
                'codigo' => 0
            ]);
        }
        // echo json_encode($resultado);
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje'=> 'Ocurrio un Error',
            'codigo' => 0
    ]);
    }
}

// //!Funcion Modificar
//     public static function modificarAPI(){
//         try{
//             $clinica = new Clinica($_POST);
//             $resultado = $clinica->actualizar();
//             // echo json_encode($clinica);
//             // exit;

//             if($resultado['resultado'] == 1){
//                 echo json_encode([
//                     'mensaje' => 'Registro guardado correctamente',
//                     'codigo' => 1
//                 ]);
//             }else{
//                 echo json_encode([
//                     'mensaje' => 'Ocurrio un error',
//                     'codigo' => 0
//                 ]);
//             }
//         }catch(Exception $e){
//             echo json_encode([
//                 'detalle' => $e->getMessage(),
//                 'mensaje'=> 'Ocurrio un Error',
//                 'codigo' => 0
//         ]);
//         }
//     }

//!Funcion Eliminar
public static function eliminarAPI(){
    try{
        $producto_id = $_POST['producto_id'];
        $producto = Producto::find($producto_id);
        $producto->producto_situacion = 0;
        $resultado = $producto->actualizar();

        if($resultado['resultado'] == 1){
            echo json_encode([
                'mensaje' => 'Registro guardado correctamente',
                'codigo' => 1
            ]);
        }else{
            echo json_encode([
                'mensaje' => 'Ocurrio un error',
                'codigo' => 0
            ]);
        }
    }catch(Exception $e){
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje'=> 'Ocurrio un Error',
            'codigo' => 0
    ]);
    }
}


//!Funcion Buscar
public static function buscarAPI(){
    $producto_nombre = $_GET['producto_nombre'];


    $sql = "SELECT * FROM productos WHERE producto_situacion = 1 ";
    if($producto_nombre != ''){
        $sql .= "AND producto_nombre LIKE '%$producto_nombre%' ";
    }


    try {
        $productos = Producto::fetchArray($sql);
        echo json_encode($productos);
        
    } catch (exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
        ]);
    }

}


}
