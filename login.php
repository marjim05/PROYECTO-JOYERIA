<?php include 'layout/header.php'; ?>


    <header class="bg-light text-dark text-center py-5" style="margin-bottom: 50px;">
        <h1>Iniciar Sesión</h1>
        <h4>Accede a tu cuenta Winlux</h4>
    </header>
    <div class="container mt-7 p-5 bg-dark text-light rounded" style="max-width: 500px; text-align: center; align-items: center;">
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" >
                </div>
            </form>
            <a type="button" href="CRUD/views/dashboard/index.php" class="btn btn-warning">Iniciar Sesión</a>

    </div>

<?php include 'layout/footer.php'; ?>

</body>
</html>