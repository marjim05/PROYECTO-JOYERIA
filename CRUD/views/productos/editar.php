<?php
include_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Editar Producto</h2>
                <a href="index.php?action=productos" class="btn btn-secondary">
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
                    <form method="POST" action="index.php?action=productos&method=editar&id=<?php echo $producto['id_producto']; ?> " enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre_producto" class="form-label">Nombre del Producto *</label>
                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                                           value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tipo_producto" class="form-label">Tipo de Producto *</label>
                                    <select class="form-select" id="tipo_producto" name="tipo_producto" required>
                                        <option value="">Seleccione un tipo</option>
                                        <?php foreach ($tipos as $tipo): ?>
                                            <option value="<?php echo $tipo['id_tipo']; ?>"
                                                    <?php echo ($producto['tipo_producto'] == $tipo['id_tipo']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($tipo['nombre_tipo']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="material" class="form-label">Material *</label>
                                    <select class="form-select" id="material" name="material" required>
                                        <option value="">Seleccione un material</option>
                                        <?php foreach ($opciones_material as $material): ?>
                                            <option value="<?php echo htmlspecialchars($material); ?>"
                                                    <?php echo ($producto['material'] == $material) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($material); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio" name="precio"
                                               value="<?php echo htmlspecialchars($producto['precio']); ?>"
                                               min="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                           value="<?php echo htmlspecialchars($producto['stock']); ?>"
                                           min="0">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php?action=productos" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'views/layout/footer.php';
?>

