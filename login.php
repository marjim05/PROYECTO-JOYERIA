<?php 
require_once 'CRUD/config/auth.php';

// Si ya está logueado, redirigir al dashboard
if (estaLogueado()) {
    header('Location: CRUD/index.php?action=dashboard');
    exit();
}

$error = '';

// Procesar formulario de login
if ($_POST) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (verificarCredenciales($username, $password)) {
        iniciarSesion($username);
        header('Location: CRUD/index.php?action=dashboard');
        exit();
    } else {
        $error = 'Credenciales incorrectas. Usuario: admin, Contraseña: admin123';
    }
}

include_once 'layout/header.php'; 
?>

    <header class="bg-light text-dark text-center py-5" style="margin-bottom: 50px;">
        <h1>Iniciar Sesión</h1>
    </header>
    <div class="container mt-7 p-5 bg-dark text-light rounded" style="max-width: 500px; text-align: center; align-items: center;">
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-warning">Iniciar Sesión</button>
        </form>
    </div>

<?php include_once 'layout/footer.php'; ?>

</body>
</html>