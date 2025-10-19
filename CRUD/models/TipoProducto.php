<?php

require_once __DIR__ . '/../config/database.php';

class TipoProducto {
    private $conn;
    private $table_name = "tipo_producto";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear nuevo tipo de producto
    public function crear($nombre_tipo) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre_tipo) VALUES (?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $nombre_tipo);
            
            if($stmt->execute()) {
                return true;
            } else {
                error_log("Error al ejecutar INSERT en tipo_producto: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (Exception $e) {
            error_log("Error PDO en crear tipo producto: " . $e->getMessage());
            return false;
        }
    }

    // Leer todos los tipos de productos
    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un tipo específico por ID
    public function leerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_tipo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar tipo de producto
    public function actualizar($id, $nombre_tipo) {
        try {
            $query = "UPDATE " . $this->table_name . " SET nombre_tipo = ? WHERE id_tipo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $nombre_tipo);
            $stmt->bindParam(2, $id);
            
            if($stmt->execute()) {
                return true;
            } else {
                error_log("Error al ejecutar UPDATE en tipo_producto: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (Exception $e) {
            error_log("Error PDO en actualizar tipo producto: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar tipo de producto
    public function eliminar($id) {
        // Verificar si hay productos asociados
        $query_check = "SELECT COUNT(*) as count FROM productos WHERE tipo_producto = ?";
        $stmt_check = $this->conn->prepare($query_check);
        $stmt_check->bindParam(1, $id);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
        
        if($result['count'] > 0) {
            return false; // No se puede eliminar si hay productos asociados
        }
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id_tipo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener opciones válidas para el enum
    public function getOpcionesEnum() {
        $query = "SHOW COLUMNS FROM " . $this->table_name . " LIKE 'nombre_tipo'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Extraer valores del enum
        preg_match("/enum\((.*)\)/", $result['Type'], $matches);
        return str_replace("'", "", explode(",", $matches[1]));
        
    }
}
