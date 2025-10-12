<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <title>JOYERIA WINLUX</title>
    <style>
            .hero {
      background: url("img/banner.jpg") center/cover no-repeat;
      color: rgb(28, 27, 22);
      text-shadow: 0 2px 5px rgba(0,0,0,0.5);
      padding: 150px 0;
      text-align: center;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .hero p {
      font-size: 1.2rem;
      margin-top: 10px;
    }
    .card img {
      height: 250px;
      object-fit: cover;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm " style="background-color: black; ">

        <div class="container-fluid " >
            <a class="navbar-brand" href="index.html">
            <img src="img/logo.jpg" alt="Logo" style="width:100px;" class=""> 
            </a>
            <ul class="navbar-nav">
                <li class="nav-item white">
                    <a class="nav-link text-light" href="conocenos.html">Conócenos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="catalogo.html">Colección</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="login.php">Iniciar Sesión</a>
                </li>

            </ul>
        </div>
    </nav>

      <!-- HERO / PORTADA -->
  <section class="hero d-flex align-items-center justify-content-center">
    <div class="container">
      <h1>Descubre el brillo que te define</h1>
      <p>Joyas únicas que reflejan tu esencia. Hechas con pasión, elegancia y detalle.</p>
      <a href="catalogo.html" class="btn btn-warning mt-3 px-4">Ver Colección</a>
    </div>
  </section>

  <!-- GALERÍA DE PRODUCTOS -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Colección Destacada</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="img/anillo1.jpg" class="card-img-top" alt="Anillo Winlux">
            <div class="card-body">
              <h5 class="card-title">Anillo de Plata</h5>
              <p class="card-text">Elegancia y sutileza en cada detalle.</p>
              <a href="#" class="btn btn-outline-dark">Ver más</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="img/collar.jpg" class="card-img-top" alt="Collar Winlux">
            <div class="card-body">
              <h5 class="card-title">Collar Brilliance</h5>
              <p class="card-text">Refleja tu brillo interior con estilo.</p>
              <a href="#" class="btn btn-outline-dark">Ver más</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="img/chocker.jpg" class="card-img-top" alt="Chocker Winlux">
            <div class="card-body">
              <h5 class="card-title">Choker Elegance</h5>
              <p class="card-text">Diseño exclusivo con acabado perfecto.</p>
              <a href="#" class="btn btn-outline-dark">Ver más</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



    <footer class="footer bg-dark mt-5 p-5" >
      <div class="footer-contenido text-center text-light">
        <p><a href="#">Términos y condiciones</a> | <a href="#">Política de privacidad</a></p>
        <p><strong>📧 Contacto:</strong> winlux@store.com</p>
        <p>&copy; 2025 Winlux. Todos los derechos reservados.</p>
      </div>
    </footer>
</body>
</html>