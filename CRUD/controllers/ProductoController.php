<?php
require_once 'config/auth.php';
require_once 'models/Producto.php';
require_once 'models/TipoProducto.php';

class ProductoController {
    private $productoModel;
    private $tipoModel;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->tipoModel = new TipoProducto();
    }

    public function index() {
        $productos = $this->productoModel->leerTodos();
        $tipos = $this->tipoModel->leerTodos();
        include 'views/productos/index.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre_producto' => $_POST['nombre_producto'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'material' => $_POST['material'] ?? '',
                'precio' => $_POST['precio'] ?? 0,
                'tipo_producto' => $_POST['tipo_producto'] ?? '',
                'stock' => $_POST['stock'] ?? 0
            ];
            
            // Validaciones básicas
            if (empty($data['nombre_producto']) || empty($data['descripcion']) || 
                empty($data['material']) || empty($data['tipo_producto'])) {
                $_SESSION['error'] = 'Todos los campos son requeridos';
            } elseif ($data['precio'] <= 0) {
                $_SESSION['error'] = 'El precio debe ser mayor a 0';
            } elseif ($data['stock'] < 0) {
                $_SESSION['error'] = 'El stock no puede ser negativo';
            } else {
                // Debug: Log de datos antes de crear
                error_log("Datos para crear producto: " . print_r($data, true));
                
                if ($this->productoModel->crear($data)) {
                    $_SESSION['success'] = 'Producto creado exitosamente';
                    header('Location: index.php?action=productos');
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al crear el producto. Revisa los logs para más detalles.';
                    error_log("Error al crear producto con datos: " . print_r($data, true));
                }
            }
        }
        
        $tipos = $this->tipoModel->leerTodos();
        $opciones_material = $this->productoModel->getOpcionesMaterial();
        include 'views/productos/crear.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('Location: index.php?action=productos');
            exit;
        }

        $producto = $this->productoModel->leerPorId($id);
        
        if (!$producto) {
            $_SESSION['error'] = 'Producto no encontrado';
            header('Location: index.php?action=productos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre_producto' => $_POST['nombre_producto'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'material' => $_POST['material'] ?? '',
                'precio' => $_POST['precio'] ?? 0,
                'tipo_producto' => $_POST['tipo_producto'] ?? '',
                'stock' => $_POST['stock'] ?? 0
            ];
            
            // Validaciones básicas
            if (empty($data['nombre_producto']) || empty($data['descripcion']) || 
                empty($data['material']) || empty($data['tipo_producto'])) {
                $_SESSION['error'] = 'Todos los campos son requeridos';
            } elseif ($data['precio'] <= 0) {
                $_SESSION['error'] = 'El precio debe ser mayor a 0';
            } elseif ($data['stock'] < 0) {
                $_SESSION['error'] = 'El stock no puede ser negativo';
            } else {
                // Debug: Log de datos antes de actualizar
                error_log("Datos para actualizar producto ID $id: " . print_r($data, true));
                
                if ($this->productoModel->actualizar($id, $data)) {
                    $_SESSION['success'] = 'Producto actualizado exitosamente';
                    header('Location: index.php?action=productos');
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al actualizar el producto. Revisa los logs para más detalles.';
                    error_log("Error al actualizar producto ID $id con datos: " . print_r($data, true));
                }
            }
        }
        
        $tipos = $this->tipoModel->leerTodos();
        $opciones_material = $this->productoModel->getOpcionesMaterial();
        include 'views/productos/editar.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('Location: index.php?action=productos');
            exit;
        }

        if ($this->productoModel->eliminar($id)) {
            $_SESSION['success'] = 'Producto eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el producto';
        }
        
        header('Location: index.php?action=productos');
        exit;
    }

    public function buscar() {
        $termino = $_GET['q'] ?? '';
        $productos = [];
        
        if (!empty($termino)) {
            $productos = $this->productoModel->buscar($termino);
        } else {
            $productos = $this->productoModel->leerTodos();
        }
        
        $tipos = $this->tipoModel->leerTodos();
        include 'views/productos/index.php';
    }
}
?>
