<?php

namespace Controllers;
use Exception;
use Model\Cliente;
use MVC\Router;

class ClienteController{
    public static function index(Router $router){


        $clientes = Cliente::all();
        
        

        $router->render('clientes/index', [
            'clientes' => $clientes,
        ]); 
    }

    
//!Funcion Guardar
    public static function guardarAPI(){
        try {
            $cliente = new Cliente($_POST);
            $resultado = $cliente->crear();
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
            $cliente_id = $_POST['cliente_id'];
            $cliente = Cliente::find($cliente_id);
            $cliente->cliente_situacion = 0;
            $resultado = $cliente->actualizar();

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
        $cliente_nombre = $_GET['cliente_nombre'];


        $sql = "SELECT * FROM clientes WHERE cliente_situacion = 1 ";
        if($cliente_nombre != ''){
            $sql .= "AND cliente_nombre LIKE '%$cliente_nombre%' ";
        }


        try {
            $clientes = Cliente::fetchArray($sql);
            echo json_encode($clientes);
            
        } catch (exception $e) {
                echo json_encode([
                    'detalle' => $e->getMessage(),
                    'mensaje'=> 'Ocurrio un Error',
                    'codigo' => 0
            ]);
        }

    }


}
