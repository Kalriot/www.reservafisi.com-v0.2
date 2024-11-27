<?php

    session_start();

    if (isset($_SESSION['usuario'])) {
        header("location: ../usuario/usu_index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=visibility" />
    
</head>
<body>
    
    <header class="header">

        <div class="menu">
            <img src="../Pictures/Logo Fisi.png" class="logo-fisi" alt="">
            

            <nav class="navbar">
                <ul>
                    <li><a href="#contenido">Inicio 🏠</a></li>
                    <li><a href="#reserva">Reservar ⚽</a></li>
                    <li><a id="loginLink" href="#">Log in 🕵️</a></li>
                </ul>
            </nav>
        </div>

        <div id="contenido" class="header-content container">

            <h1>Fisi-Canchita</h1>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum ratione sint nesciunt 
                vel dolore enim animi dignissimos ut architecto. Voluptates consequuntur officia amet, 
                laudantium impedit dolorum eligendi atque assumenda quae.
            </p>
            <a href="#canchita" class="btn-1">+ Información</a>
        </div>

    </header>


    <section id="canchita" class="canchita">
        
        <div class="canchita-content container">
            <h2>Cancha de la fisi</h2>
            <p class="txt-p"> 
                Nuestra cancha de fútbol en la facultad de Ingeniería de Sistemas es el lugar ideal para despejar 
                la mente y disfrutar, donde cada partido refuerza la amistad y nos da la oportunidad de convivir 
                y relajarnos entre amigos.
            </p>

            <div class="canchita-group">
                <div class="Cancha-1">
                    <img src="../Pictures/hora.svg" class="time" alt="">
                    <h3>Optimización del tiempo</h3>
                    <p>
                        La plataforma de reservas en línea permite a los usuarios gestionar sus reservas de 
                        manera rápida y cómoda, sin necesidad de desplazarse a la facultad, lo que ahorra tiempo 
                        y facilita el acceso en cualquier momento y desde cualquier lugar.
                    </p>
                </div>

                <div class="Cancha-1">
                    <img src="../Pictures/person.svg" class="persona" alt="">
                    <h3>Transparencia</h3>
                    <p>
                        El sistema de reservas online ofrece una visualización clara y actualizada de los horarios 
                        ocupados y disponibles, evitando confusiones o dobles reservas y asegurando que cada usuario 
                        esté informado de las reservas ya hechas.
                    </p>
                </div>

                <div class="Cancha-1">
                    <img src="../Pictures/Calendario.svg" class="calendario" alt="">
                    <h3>Mejor accesibilidad</h3>
                    <p>
                        Al permitir la reserva digital de la cancha, el sistema se vuelve accesible para todos los 
                        estudiantes, incluyendo aquellos con horarios complicados o dificultades para acudir 
                        personalmente, haciendo que el servicio sea inclusivo y fácil de utilizar.
                    </p>
                </div>

            </div>
            <a href="#reserva" class="btn-2">Siguiente ➡️</a>
        </div>

    </section>

    <main id="reserva" class="reserva">
        
        <div class="reserva-content conteiner">
            <img src="../Pictures/Panorama canchita fisi.jpg" class="reserva_fisi" alt="">

            <div class="texto">

                  <h2>Reserva de la canchita</h2>
                 <p>
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> 
                 Deleniti, ex nihil itaque nostrum 
                 vero animi praesentium similique, perspiciatis amet vitae, ab officiis? Assumenda numquam at
                 sapiente atque esse dolore aliquid.
                 </p>
                <a id="loginLink2" href="#" class="btn-fisi">Reserva ya 👻</a>

            </div>

        </div>
    </main>
    

    <footer class="footer">

        <div class="footer-content conteiner">

            <div class="link-1">
                
                <img src="../Pictures/UNMSM_logo.svg" class="logo_sanmarcos" alt="">
                <img src="../Pictures/Logo Fisi.png" class="logo_fisi" alt="">
                <ul>
                    <li><a href="#">🔴 Universidad Nacional Mayor de San Marcos</a></li>
                    <li><a href="#">🔵 Facultad de Ingeniería de sistemas e Informática</a></li>
                    <li><a href="#">🏬 Calle Germán Amézaga s/n - Lima</a></li>
                </ul>  
            </div>

            <div class="link-2">
                <ul>
                    <li><a href="#">Teléfono: (01)9999 999</a></li>
                    <li><a href="#">Teléfono: (01)9999 999</a></li>
                </ul>  
            </div>

        </div>
    </footer>

    <div class="efect_for_login glass-efect" id="loginDiv" style="display: none;">
        
        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para poder reservar</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>

                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__register">Registrate</button>
                </div>
            </div>

            <div class="contenedor__login-register">

                <form action="php/login_usuario.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Institucional" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Entrar</button>
                </form>

                <form id="formulario_registro" action="php/registro_usuario.php" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                    <input type="text" placeholder="Correo Institucional" name="correo">
                    <input type="password" id="contrasena" placeholder="Contraseña" name="contrasena">
                    <input type="password" id="confirmar_contrasena" placeholder="Confirmar contraseña" name="confirmar">

                    <button>Registrarse</button>
                </form>

            </div>

        </div>

    </div>


   
    <script src="script.js"></script>
</body>
</html>