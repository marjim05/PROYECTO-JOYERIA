<?php
require_once __DIR__ . '/../../config/auth.php';
$usuario = obtenerUsuarioActual();
include_once __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Gestión de Productos</h2>
                <div class="d-flex align-items-center">
                    <a href="index.php?action=productos&method=crear" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </a>
                </div>
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

            <!-- Barra de búsqueda -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="index.php" class="row g-3">
                        <input type="hidden" name="action" value="productos">
                        <input type="hidden" name="method" value="buscar">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q" 
                                   placeholder="Buscar productos por nombre, descripción o tipo..."
                                   value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary me-2">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                            <a href="index.php?action=productos" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Material</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($productos)): ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No hay productos registrados</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                                            <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 50)) . '...'; ?></td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?php echo htmlspecialchars($producto['nombre_tipo']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">
                                                    <?php echo htmlspecialchars($producto['material']); ?>
                                                </span>
                                            </td>
                                            <td>$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="badge <?php echo $producto['stock'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
                                                    <?php echo $producto['stock']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y', strtotime($producto['fecha_creacion'])); ?></td>
                                            <td>
                                                <a href="index.php?action=productos&method=editar&id=<?php echo $producto['id_producto']; ?>"
                                                   class="btn btn-sm btn-warning me-2">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="index.php?action=productos&method=eliminar&id=<?php echo $producto['id_producto']; ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
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

<?php include_once __DIR__ . '/../layout/footer.php'; ?>
