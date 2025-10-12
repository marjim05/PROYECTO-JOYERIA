<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Joyería Winlux</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <strong>Winlux</strong>
            </a>
            
            
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>Administrador
                        </a>
                        <ul class="dropdown-menu">
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../../../index.php"><i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'dashboard') ? 'active' : ''; ?>" href="index.php">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'productos') ? 'active' : ''; ?>" href="index.php?action=productos">
                                <i class="fas fa-gem me-2"></i>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'tipos') ? 'active' : ''; ?>" href="index.php?action=tipos">
                                <i class="fas fa-tags me-2"></i>
                                Tipos de Productos
                            </a>
                        </li>
                    </ul>
                    
                    <hr>
                    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Acciones</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=productos&method=crear">
                                <i class="fas fa-plus me-2"></i>
                                Nuevo Producto
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=tipos&method=crear">
                                <i class="fas fa-tag me-2"></i>
                                Nuevo Tipo
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
