<?php
use Config\Auth;
use Models\TipoProducto;

use Views\Tipos\EditarView;
use Views\Tipos\CrearView;
use Views\Tipos\IndexView;



class TipoController {
    private $tipoModel;

    public function __construct() {
        $this->tipoModel = new TipoProducto();
    }

    public function index() {
        $tipos = $this->tipoModel->leerTodos();
        IndexView::render($tipos);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_tipo = $_POST['nombre_tipo'] ?? '';
            
            if (empty($nombre_tipo)) {
                $_SESSION['error'] = 'El nombre del tipo es requerido';
            } else {
                // Debug: Log de datos antes de crear
                error_log("Datos para crear tipo: " . $nombre_tipo);
                
                if ($this->tipoModel->crear($nombre_tipo)) {
                    $_SESSION['success'] = 'Tipo de producto creado exitosamente';
                    header('Location: index.php?action=tipos');
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al crear el tipo de producto. Revisa los logs para más detalles.';
                    error_log("Error al crear tipo con nombre: " . $nombre_tipo);
                }
        }
        
        CrearView::render();
    }
    }

    public function editar() {
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;
        
        if (!$id) {
            header('Location: index.php?action=tipos');
            exit;
        }

        $tipo = $this->tipoModel->leerPorId($id);
        
        if (!$tipo) {
            $_SESSION['error'] = 'Tipo de producto no encontrado';
            header('Location: index.php?action=tipos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_tipo = $_POST['nombre_tipo'] ?? '';
            
            if (empty($nombre_tipo)) {
                $_SESSION['error'] = 'El nombre del tipo es requerido';
            } else {
                // Debug: Log de datos antes de actualizar
                error_log("Datos para actualizar tipo ID $id: " . $nombre_tipo);
                
                if ($this->tipoModel->actualizar($id, $nombre_tipo)) {
                    $_SESSION['success'] = 'Tipo de producto actualizado exitosamente';
                    header('Location: index.php?action=tipos');
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al actualizar el tipo de producto. Revisa los logs para más detalles.';
                    error_log("Error al actualizar tipo ID $id con nombre: " . $nombre_tipo);
        }
        
        EditarView::render($tipo);
    }
    }
}

    public function eliminar() {
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;
        
        if (!$id) {
            header('Location: index.php?action=tipos');
            exit;
        }

        if ($this->tipoModel->eliminar($id)) {
            $_SESSION['success'] = 'Tipo de producto eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'No se puede eliminar el tipo de producto porque tiene productos asociados';
        }
        
        header('Location: index.php?action=tipos');
        exit;
    }
}

