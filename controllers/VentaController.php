<?php

namespace Controllers;
use Exception;
use Model\Venta;
use Model\Cliente;
use MVC\Router;

class VentaController{
    public static function index(Router $router){


        $ventas = Venta::all();
        
        

        $router->render('ventas/index', [
            'ventas' => $ventas,
            'clientes' => $clientes,
        ]); 
    }

    //!--------------------------
public static function buscarClientes(){
    $sql = "SELECT * FROM clientes where cliente_situacion = 1";

    try {
        $clientes = Cliente::fetchArray($sql);

        if($clientes){
            return $clientes;
        }else{
            return 0;
        }
    } catch (Exception $e) {
        
    }
}

    
//!Funcion Guardar
public static function guardarAPI(){
    try {
        $venta = new Venta($_POST);
        $resultado = $venta->crear();
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
        $venta_id = $_POST['venta_id'];
        $venta = Venta::find($venta_id);
        $venta->venta_situacion = 0;
        $resultado = $venta->actualizar();

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
    $venta_cliente = $_GET['venta_cliente'];


    $sql = "SELECT * FROM ventas WHERE venta_situacion = 1 ";
    if($venta_cliente != ''){
        $sql .= "AND venta_cliente LIKE '%$venta_cliente%' ";
    }


    try {
        $ventas = Venta::fetchArray($sql);
        echo json_encode($ventas);
        
    } catch (exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
        ]);
    }

}


}
