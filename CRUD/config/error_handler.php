<?php
// Clase para manejo de errores y validaciones
class ErrorHandler {
    
    // Manejar errores de PHP
    public static function handleError($errno, $errstr, $errfile, $errline) {
        $errorTypes = [
            E_ERROR => 'ERROR',
            E_WARNING => 'WARNING',
            E_PARSE => 'PARSE',
            E_NOTICE => 'NOTICE',
            E_CORE_ERROR => 'CORE_ERROR',
            E_CORE_WARNING => 'CORE_WARNING',
            E_COMPILE_ERROR => 'COMPILE_ERROR',
            E_COMPILE_WARNING => 'COMPILE_WARNING',
            E_USER_ERROR => 'USER_ERROR',
            E_USER_WARNING => 'USER_WARNING',
            E_USER_NOTICE => 'USER_NOTICE',
            E_STRICT => 'STRICT',
            E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
            E_DEPRECATED => 'DEPRECATED',
            E_USER_DEPRECATED => 'USER_DEPRECATED'
        ];
        
        $errorType = isset($errorTypes[$errno]) ? $errorTypes[$errno] : 'UNKNOWN';
        $message = "[$errorType] $errstr in $errfile on line $errline";
        
        Config::log($message, 'ERROR');
        
        // En producción, no mostrar errores al usuario
        if (Config::LOG_LEVEL === 'DEBUG') {
            echo "<div class='alert alert-danger'>$message</div>";
        }
        
        return true;
    }
    
    // Manejar excepciones no capturadas
    public static function handleException($exception) {
        $message = "Uncaught exception: " . $exception->getMessage() . 
                   " in " . $exception->getFile() . " on line " . $exception->getLine();
        
        Config::log($message, 'ERROR');
        
        // Mostrar error amigable al usuario
        echo "<div class='alert alert-danger'>
                <h5>Error del Sistema</h5>
                <p>Ha ocurrido un error inesperado. Por favor, contacte al administrador.</p>
              </div>";
    }
    
    // Validar datos de entrada
    public static function validateInput($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            
            // Validación requerida
            if (isset($rule['required']) && $rule['required'] && empty($value)) {
                $errors[$field] = "El campo $field es requerido";
                continue;
            }
            
            // Validación de longitud mínima
            if (isset($rule['min_length']) && strlen($value) < $rule['min_length']) {
                $errors[$field] = "El campo $field debe tener al menos {$rule['min_length']} caracteres";
            }
            
            // Validación de longitud máxima
            if (isset($rule['max_length']) && strlen($value) > $rule['max_length']) {
                $errors[$field] = "El campo $field no puede tener más de {$rule['max_length']} caracteres";
            }
            
            // Validación de email
            if (isset($rule['email']) && $rule['email'] && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "El campo $field debe ser un email válido";
            }
            
            // Validación de número
            if (isset($rule['numeric']) && $rule['numeric'] && !is_numeric($value)) {
                $errors[$field] = "El campo $field debe ser un número válido";
            }
            
            // Validación de número mínimo
            if (isset($rule['min']) && is_numeric($value) && $value < $rule['min']) {
                $errors[$field] = "El campo $field debe ser mayor o igual a {$rule['min']}";
            }
            
            // Validación de número máximo
            if (isset($rule['max']) && is_numeric($value) && $value > $rule['max']) {
                $errors[$field] = "El campo $field debe ser menor o igual a {$rule['max']}";
            }
            
            // Validación de URL
            if (isset($rule['url']) && $rule['url'] && !filter_var($value, FILTER_VALIDATE_URL)) {
                $errors[$field] = "El campo $field debe ser una URL válida";
            }
        }
        
        return $errors;
    }
    
    // Sanitizar datos de entrada
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    // Mostrar errores de validación
    public static function displayErrors($errors) {
        if (empty($errors)) {
            return '';
        }
        
        $html = '<div class="alert alert-danger"><ul class="mb-0">';
        foreach ($errors as $error) {
            $html .= '<li>' . htmlspecialchars($error) . '</li>';
        }
        $html .= '</ul></div>';
        
        return $html;
    }
}

// Configurar manejo de errores
set_error_handler([ErrorHandler::class, 'handleError']);
set_exception_handler([ErrorHandler::class, 'handleException']);
?>
