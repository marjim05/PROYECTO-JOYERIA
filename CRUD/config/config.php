<?php
// Configuración general del sistema
class Config {
    // Configuración de la base de datos
    const DB_HOST = 'localhost';
    const DB_NAME = 'joyeria_winlux';
    const DB_USER = 'root';
    const DB_PASS = '';
    
    // Configuración de la aplicación
    const APP_NAME = 'Joyería Winlux';
    const APP_VERSION = '1.0.0';
    const APP_URL = 'http://localhost/joyeria';
    
    // Configuración de seguridad
    const SESSION_TIMEOUT = 3600; // 1 hora en segundos
    const MAX_LOGIN_ATTEMPTS = 5;
    
    // Configuración de archivos
    const UPLOAD_PATH = 'uploads/';
    const MAX_FILE_SIZE = 5242880; // 5MB en bytes
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    // Configuración de paginación
    const ITEMS_PER_PAGE = 10;
    
    // Configuración de moneda
    const CURRENCY_SYMBOL = '$';
    const CURRENCY_CODE = 'COP';
    
    // Configuración de email (para futuras funcionalidades)
    const SMTP_HOST = 'smtp.gmail.com';
    const SMTP_PORT = 587;
    const SMTP_USER = '';
    const SMTP_PASS = '';
    
    // Configuración de logs
    const LOG_PATH = 'logs/';
    const LOG_LEVEL = 'INFO'; // DEBUG, INFO, WARNING, ERROR
    
    // Método para obtener configuración de la base de datos
    public static function getDatabaseConfig() {
        return [
            'host' => self::DB_HOST,
            'dbname' => self::DB_NAME,
            'username' => self::DB_USER,
            'password' => self::DB_PASS
        ];
    }
    
    // Método para validar configuración
    public static function validateConfig() {
        $errors = [];
        
        // Validar conexión a la base de datos
        try {
            $config = self::getDatabaseConfig();
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
            $pdo = new PDO($dsn, $config['username'], $config['password']);
        } catch (PDOException $e) {
            $errors[] = "Error de conexión a la base de datos: " . $e->getMessage();
        }
        
        // Validar directorios necesarios
        $directories = [self::UPLOAD_PATH, self::LOG_PATH];
        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                if (!mkdir($dir, 0755, true)) {
                    $errors[] = "No se puede crear el directorio: $dir";
                }
            }
        }
        
        return $errors;
    }
    
    // Método para logging
    public static function log($message, $level = 'INFO') {
        $logFile = self::LOG_PATH . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$level] $message" . PHP_EOL;
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}
?>
