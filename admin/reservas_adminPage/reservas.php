<?php

    session_start();

    if (!isset($_SESSION["usuario"])) {
       
        header("location: ../Home/index.php");
        session_destroy();
        die();
    };

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
        // Si no tiene el rol requerido, destruir la sesión y redirigir

        echo '
            <script>
                alert("Usted no tiene los permisos necesarios para ingresar a esta página");
                window.location.href = "../Home/index.php";
            </script>
        ';

        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pagina de ususarios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../../global/style.css?php echo time(); ?>">
    <link rel="stylesheet" href="reservas.css?php echo time(); ?>">

</head>
<body>

    <header class="header">

        <div class="menu">
            <img src="../../Pictures/Logo Fisi.png" class="logo-fisi" alt="">
        </div>
    </header>
    <div class="contenedor_effect glass-efect">
        <aside class="sidebar">
            <header class="sidebar-header">
                <a href="#" class="header-logo">
                   <img src="../../Pictures/gato_fisi-removebg-preview.png" class="gato_fisi" alt="">
                </a>
                <button class="toggler slidebar-toggler">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </button>
            </header>
    
            <nav class="sidebar-nav">
                <ul class="nav-list primary-nav">
    
                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">dashboard</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <span class="nav-tooltip">Dashboard</span>
                   </li> 

                   <li class="nav-item">
                    <a href="../calendario_adminPage/adminH_index.php" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">calendar_today</span>
                        <span class="nav-label">Calendario</span>
                    </a>
                    <span class="nav-tooltip">Calendario</span>
                   </li> 
    
                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">notifications</span>
                        <span class="nav-label">Notificaciones</span>
                    </a>
                    <span class="nav-tooltip">Notificaciones</span>
                   </li>

                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">analytics</span>
                        <span class="nav-label">Reservas</span>
                    </a>
                    <span class="nav-tooltip">Reservas</span>
                   </li>
    
                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">group</span>
                        <span class="nav-label">Contáctanos</span>
                    </a>
                    <span class="nav-tooltip">Contáctanos</span>
                   </li>
    
                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">star</span>
                        <span class="nav-label">Bookmarks</span>
                    </a>
                    <span class="nav-tooltip">Bookmarks</span>
                   </li>

                   <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">settings</span>
                        <span class="nav-label">Configuración</span>
                    </a>
                    <span class="nav-tooltip">Configuración</span>
                   </li>
                </ul>
    
                <ul class="nav-list secondary-nav">
    
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <span class="nav-icon material-symbols-rounded">account_circle</span>
                            <span class="nav-label">Administrador</span>
                        </a>
                        <span class="nav-tooltip">Administrador</span>
                       </li> 
        
                       <li class="nav-item">
                        <a href="../../Home/php/logout_usuario.php" class="nav-link">
                            <span class="nav-icon material-symbols-rounded">logout</span>
                            <span class="nav-label">Logout</span>
                        </a>
                        <span class="nav-tooltip">Logout</span>
                       </li>
    
                </ul>
            </nav>
    
        </aside>
    </div>

    

    <div class="container-reservas">
        <?php include("crud/index.php")?>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="reservas.js"></script>

</body>
</html>