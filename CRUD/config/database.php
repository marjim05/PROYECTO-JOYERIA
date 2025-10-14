<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'joyeria_winlux';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT => 30, // Timeout de 30 segundos
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                ]
            );
            
            // Configurar timeouts adicionales
            $this->conn->exec("SET SESSION wait_timeout = 300"); // 5 minutos
            $this->conn->exec("SET SESSION interactive_timeout = 300"); // 5 minutos
            // Nota: max_allowed_packet es de solo lectura a nivel de sesión
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}
?>
