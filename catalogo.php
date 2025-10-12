<?php
include 'layout/header.php';
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "joyeria_winlux");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los productos
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>


     <!-- CONTENIDO -->
  <div class="container py-5">
    <h2 class="container text-center fw-bold mb-4">Nuestra Colección</h2>
    <div class="row g-4">
      <?php
      if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          // Generar ruta de imagen simple
          $rutaImagen = "img/anillo" . (($fila["id_producto"] % 3) + 1) . ".jpg";
          
          echo '
          <div class="col-md-4" style="display: flex; justify-content: center;">
            <div class="card shadow-sm border-0">
              <img src="' . $rutaImagen . '" 
                   class="card-img-top" 
                   alt="' . $fila["nombre_producto"] . '" 
                   style="height: 250px; object-fit: cover;"
                   onerror="this.src=\'img/anillo1.jpg\';">
              <div class="card-body">
                <h5 class="card-title">' . $fila["nombre_producto"] . '</h5>
                <p class="card-text text-muted">' . $fila["descripcion"] . '</p>
                <p><strong>Material:</strong> ' . $fila["material"] . '</p>
                <p class="text-warning fw-bold">$' . number_format($fila["precio"], 0, ',', '.') . '</p>
                <a href="#" class="btn btn-outline-dark btn-sm">Ver Detalles</a>
              </div>
            </div>
          </div>';
        }
      } else {
        echo "<p class='text-center'>No hay productos registrados.</p>";
      }
      ?>
    </div>
  </div>

<?php include 'layout/footer.php'; ?>
</body>
</html>