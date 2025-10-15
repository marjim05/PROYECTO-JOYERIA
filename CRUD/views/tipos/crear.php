<?php include_once 'views/layout/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Crear Nuevo Tipo de Producto</h2>
                <a href="index.php?action=tipos" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="index.php?action=tipos&method=crear">
                        <div class="mb-3">
                            <label for="nombre_tipo" class="form-label">Nombre del Tipo *</label>
                            <input type="text" class="form-control" id="nombre_tipo" name="nombre_tipo" 
                                   value="<?php echo htmlspecialchars($_POST['nombre_tipo'] ?? ''); ?>" 
                                   placeholder="Ej: Anillos, Collares, Pulseras..." required>
                            <div class="form-text">Ingresa el nombre del nuevo tipo de producto</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php?action=tipos" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/layout/footer.php'; ?>
