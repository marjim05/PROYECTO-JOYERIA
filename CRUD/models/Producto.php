<?php
require_once 'config/database.php';

class Producto {
    private $conn;
    private $table_name = "productos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear nuevo producto
    public function crear($data) {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (nombre_producto, descripcion, material, precio, tipo_producto, stock) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $data['nombre_producto']);
            $stmt->bindParam(2, $data['descripcion']);
            $stmt->bindParam(3, $data['material']);
            $stmt->bindParam(4, $data['precio']);
            $stmt->bindParam(5, $data['tipo_producto']);
            $stmt->bindParam(6, $data['stock']);
            
            if($stmt->execute()) {
                return true;
            } else {
                error_log("Error al ejecutar INSERT en productos: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error PDO en crear producto: " . $e->getMessage());
            return false;
        }
    }

    // Leer todos los productos con información del tipo
    public function leerTodos() {
        $query = "SELECT p.*, t.nombre_tipo 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN tipo_producto t ON p.tipo_producto = t.id_tipo 
                  ORDER BY p.fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un producto específico por ID
    public function leerPorId($id) {
        $query = "SELECT p.*, t.nombre_tipo 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN tipo_producto t ON p.tipo_producto = t.id_tipo 
                  WHERE p.id_producto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar producto
    public function actualizar($id, $data) {
        try {
            $query = "UPDATE " . $this->table_name . " 
                      SET nombre_producto = ?, descripcion = ?, material = ?, 
                          precio = ?, tipo_producto = ?, stock = ? 
                      WHERE id_producto = ?";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $data['nombre_producto']);
            $stmt->bindParam(2, $data['descripcion']);
            $stmt->bindParam(3, $data['material']);
            $stmt->bindParam(4, $data['precio']);
            $stmt->bindParam(5, $data['tipo_producto']);
            $stmt->bindParam(6, $data['stock']);
            $stmt->bindParam(7, $id);
            
            if($stmt->execute()) {
                return true;
            } else {
                error_log("Error al ejecutar UPDATE en productos: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error PDO en actualizar producto: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar producto
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_producto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener opciones válidas para el enum de material
    public function getOpcionesMaterial() {
        $query = "SHOW COLUMNS FROM " . $this->table_name . " LIKE 'material'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Extraer valores del enum
        preg_match("/enum\((.*)\)/", $result['Type'], $matches);
        $enum_values = str_replace("'", "", explode(",", $matches[1]));
        
        return $enum_values;
    }

    // Buscar productos
    public function buscar($termino) {
        try {
            $query = "SELECT p.*, t.nombre_tipo 
                      FROM " . $this->table_name . " p 
                      LEFT JOIN tipo_producto t ON p.tipo_producto = t.id_tipo 
                      WHERE p.nombre_producto LIKE ? OR p.descripcion LIKE ? OR t.nombre_tipo LIKE ?
                      ORDER BY p.fecha_creacion DESC";
            
            $stmt = $this->conn->prepare($query);
            $termino = "%$termino%";
            $stmt->bindParam(1, $termino);
            $stmt->bindParam(2, $termino);
            $stmt->bindParam(3, $termino);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error PDO en buscar productos: " . $e->getMessage());
            return [];
        }
    }


}
?>
