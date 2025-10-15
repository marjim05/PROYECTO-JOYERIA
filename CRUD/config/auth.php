<?php
/**
 * Sistema de autenticación simple para admin
 * Credenciales hardcodeadas sin base de datos
 */

// Iniciar sesión solo una vez
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Credenciales del administrador
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');

/**
 * Verifica las credenciales del usuario
 * @param string $username
 * @param string $password
 * @return bool
 */
function verificarCredenciales($username, $password) {
    return $username === ADMIN_USERNAME && $password === ADMIN_PASSWORD;
}

/**
 * Inicia sesión del usuario
 * @param string $username
 */
function iniciarSesion($username) {
    $_SESSION['usuario_logueado'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['rol'] = 'admin';
    $_SESSION['tiempo_login'] = time();
}

/**
 * Verifica si el usuario está logueado
 * @return bool
 */
function estaLogueado() {
    return isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true;
}

/**
 * Cierra la sesión del usuario
 */
function cerrarSesion() {
    session_destroy();
    session_start(); // Reiniciar sesión limpia
}

/**
 * Redirige a login si no está autenticado
 */
function requerirAutenticacion() {
    if (!estaLogueado()) {
        header('Location: ../../login.php');
        exit();
    }
}

/**
 * Obtiene información del usuario logueado
 * @return array|null
 */
function obtenerUsuarioActual() {
    if (estaLogueado()) {
        return [
            'username' => $_SESSION['username'] ?? '',
            'rol' => $_SESSION['rol'] ?? 'admin',
            'tiempo_login' => $_SESSION['tiempo_login'] ?? time()
        ];
    }
    return null;
}
?>
