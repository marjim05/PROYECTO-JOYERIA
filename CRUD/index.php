<?php
session_start();

// Incluir controladores
require_once 'controllers/TipoController.php';
require_once 'controllers/ProductoController.php';

// Obtener acción y método de la URL
$action = $_GET['action'] ?? 'dashboard';
$method = $_GET['method'] ?? 'index';

// Inicializar controladores
$tipoController = new TipoController();
$productoController = new ProductoController();

// Router simple
switch ($action) {
    case 'tipos':
        switch ($method) {
            case 'crear':
                $tipoController->crear();
                break;
            case 'editar':
                $tipoController->editar();
                break;
            case 'eliminar':
                $tipoController->eliminar();
                break;
            default:
                $tipoController->index();
                break;
        }
        break;
    
    case 'productos':
        switch ($method) {
            case 'crear':
                $productoController->crear();
                break;
            case 'editar':
                $productoController->editar();
                break;
            case 'eliminar':
                $productoController->eliminar();
                break;
            case 'buscar':
                $productoController->buscar();
                break;
            default:
                $productoController->index();
                break;
        }
        break;
    
    case 'dashboard':
    default:
        // Mostrar dashboard principal
        require_once 'models/Producto.php';
        require_once 'models/TipoProducto.php';
        
        $productoModel = new Producto();
        $tipoModel = new TipoProducto();
        

        
        include 'views/dashboard/index.php';
        break;
}
?>
