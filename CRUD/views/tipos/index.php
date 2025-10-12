<?php include 'views/layout/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Gestión de Tipos de Productos</h2>
                <a href="index.php?action=tipos&method=crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Tipo
                </a>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($tipos)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No hay tipos de productos registrados</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($tipos as $tipo): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($tipo['id_tipo']); ?></td>
                                            <td><?php echo htmlspecialchars($tipo['nombre_tipo']); ?></td>
                                            <td>
                                                <a href="index.php?action=tipos&method=editar&id=<?php echo $tipo['id_tipo']; ?>" 
                                                   class="btn btn-sm btn-warning me-2">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="index.php?action=tipos&method=eliminar&id=<?php echo $tipo['id_tipo']; ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('¿Estás seguro de que quieres eliminar este tipo de producto?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>
