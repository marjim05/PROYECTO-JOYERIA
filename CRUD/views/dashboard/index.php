<?php include '../../views/layout/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard - Joyería Winlux</h1>
            

            <!-- Acciones rápidas -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Acciones Rápidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="../../index.php?action=productos&method=crear" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-plus"></i><br>
                                        Nuevo Producto
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="../../index.php?action=tipos&method=crear" class="btn btn-success btn-lg w-100">
                                        <i class="fas fa-tags"></i><br>
                                        Nuevo Tipo
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="../../index.php?action=productos" class="btn btn-info btn-lg w-100">
                                        <i class="fas fa-list"></i><br>
                                        Ver Productos
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="../../index.php?action=tipos" class="btn btn-warning btn-lg w-100">
                                        <i class="fas fa-cogs"></i><br>
                                        Gestionar Tipos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos recientes -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Productos Recientes</h5>
                            <a href="../../index.php?action=productos" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                        </div>
                        <div class="card-body">
                            <?php if (empty($productos_recientes)): ?>
                                <p class="text-muted">No hay productos registrados</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Tipo</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($productos_recientes as $producto): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo htmlspecialchars($producto['nombre_producto']); ?></strong>
                                                        <br>
                                                        <small class="text-muted"><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 30)) . '...'; ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info"><?php echo htmlspecialchars($producto['nombre_tipo']); ?></span>
                                                    </td>
                                                    <td>$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <span class="badge <?php echo $producto['stock'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
                                                            <?php echo $producto['stock']; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tipos de Productos</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($tipos)): ?>
                                <p class="text-muted">No hay tipos registrados</p>
                            <?php else: ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($tipos as $tipo): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo htmlspecialchars($tipo['nombre_tipo']); ?>
                                            <span class="badge bg-primary rounded-pill"><?php echo $tipo['id_tipo']; ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../views/layout/footer.php'; ?>
