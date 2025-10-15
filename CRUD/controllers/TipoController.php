<?php
use Config\Auth;
use Models\TipoProducto;

use Views\Tipos\EditarView;
use Views\Tipos\CrearView;
use Views\Tipos\IndexView;

define('REDIRECT_TIPOS', 'Location: index.php?action=tipos');

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
                error_log("Datos para crear tipo");
                
                if ($this->tipoModel->crear($nombre_tipo)) {
                    $_SESSION['success'] = 'Tipo de producto creado exitosamente';
                    header(REDIRECT_TIPOS);
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al crear el tipo de producto. Revisa los logs para más detalles.';
                    error_log("Error al crear tipo");
                }
        }
        
        CrearView::render();
    }
    }

    public function editar() {
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;
        
        if (!$id) {
            header(REDIRECT_TIPOS);
            exit;
        }

        $tipo = $this->tipoModel->leerPorId($id);
        
        if (!$tipo) {
            $_SESSION['error'] = 'Tipo de producto no encontrado';
            header(REDIRECT_TIPOS);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_tipo = $_POST['nombre_tipo'] ?? '';
            
            if (empty($nombre_tipo)) {
                $_SESSION['error'] = 'El nombre del tipo es requerido';
            } else {
                
                if ($this->tipoModel->actualizar($id, $nombre_tipo)) {
                    $_SESSION['success'] = 'Tipo de producto actualizado exitosamente';
                    header(REDIRECT_TIPOS);
                    exit;
                } else {
                    $_SESSION['error'] = 'Error al actualizar el tipo de producto. Revisa los logs para más detalles.';
                    error_log("Error al actualizar tipo ID");
        }
        
        EditarView::render($tipo);
    }
    }
}

    public function eliminar() {
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;
        
        if (!$id) {
            header(REDIRECT_TIPOS);
            exit;
        }

        if ($this->tipoModel->eliminar($id)) {
            $_SESSION['success'] = 'Tipo de producto eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'No se puede eliminar el tipo de producto porque tiene productos asociados';
        }
        
        header(REDIRECT_TIPOS);
        exit;
    }
}

