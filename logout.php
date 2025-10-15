<?php
require_once 'CRUD/config/auth.php';

// Cerrar sesión
cerrarSesion();

// Redirigir al login
header('Location: login.php');
exit();
?>
