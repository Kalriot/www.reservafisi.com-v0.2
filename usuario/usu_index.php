<?php

    session_start();

    if (!isset($_SESSION["usuario"])) {
       
        header("location: ../Home/index.php");
        session_destroy();
        die();
    };

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !=2) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <title>Pagina de ususarios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../global/style.css?php echo time(); ?>">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables para Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    </head>
    <body>

    <header class="header">

        <div class="menu">
            <img src="../Pictures/Logo Fisi.png" class="logo-fisi" alt="">
        </div>
    </header>
    <div class="contenedor_effect glass-efect">
        <aside class="sidebar">
            <header class="sidebar-header">
                <a href="#" class="header-logo">
                   <img src="../Pictures/gato_fisi-removebg-preview.png" class="gato_fisi" alt="">
                </a>
                <button class="toggler slidebar-toggler">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </button>
            </header>
    
            <nav class="sidebar-nav">
                <!--Primary top bar-->
                <ul class="nav-list primary-nav">
    
                   <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">dashboard</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <span class="nav-tooltip">Dashboard</span>
                   </li> 

                   <li class="nav-item">
                    <a href="" class="nav-link">
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
                        <span class="nav-label">Analytics</span>
                    </a>
                    <span class="nav-tooltip">Analytics</span>
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
                
                <!--Secondary top bar-->
                <ul class="nav-list secondary-nav">
    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon material-symbols-rounded">account_circle</span>
                            <span class="nav-label">Usuario</span>
                        </a>
                        <span class="nav-tooltip">Profile</span>
                    </li> 
        
                    <li class="nav-item">
                        <a href="../Home/php/logout_usuario.php" class="nav-link">
                            <span class="nav-icon material-symbols-rounded">logout</span>
                            <span class="nav-label">Logout</span>
                        </a>
                        <span class="nav-tooltip">Logout</span>
                    </li>
    
                </ul>
            </nav>
    
        </aside>
    </div>

    

    <div class="cont">
        <div class="row">
            <h2 class="mb-3">Calendario de Reservas</h2>
            <span id="msg"></span>
            <div id='calendar'></div>
        </div>

    </div>

   <!-- Modal Visualizar Reserva -->
    <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width:540px">
                <div class="modal-header bg-info" id="uwu">

                    <h1 class="modal-title fs-5" id="visualizarModalLabel">Reserva ⚽</h1>
                    <h1 class="modal-title fs-5" id="editarModalLabel" style="display:none;">Editar Reserva ⚽</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msgViewEvento"></span>

                    <div id="VisualizarEvento">

                        <dl class="row mx-auto">
                            <dt class="col-sm-3">📅 Event:</dt>
                            <dd class="col-sm-9" id="visualizar_id_reserva"></dd>

                            <dt class="col-sm-3">🕵️ User:</dt>
                            <dd class="col-sm-9" id="visualizar_usuario"></dd>

                            <dt class="col-sm-3">➡️ Title:</dt>
                            <dd class="col-sm-9" id="visualizar_title"></dd>

                            <dt class="col-sm-3">🕧 Start:</dt>
                            <dd class="col-sm-9" id="visualizar_start"></dd>

                            <dt class="col-sm-3">🕜 End:</dt>
                            <dd class="col-sm-9" id="visualizar_end"></dd>

                            <dt class="col-sm-3">📜 Info:</dt>
                            <dd class="col-sm-9" id="visualizar_obs"></dd>
                        </dl>

                        <button type="button" class="btn btn-warning" id="btnViewEditEvento">Editar</button>
                        <button type="button" class="btn btn-danger" id="btnElimtEvento">Eliminar</button>
                    </div>

                    <div id="EditarEvento" style="display:none; width: 500px;">

                        <span id="msgEditEvento"></span>
                        
                        <form method="POST" id="formEditEvento">

                            <input type="hidden" name="edit_id" id="edit_id">            

                            <div class="row mb-3" >
                                <label for="edit_title" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">➡️ Title:</label>
                                <div class="col-sm-10" style="width:370px">
                                    <input type="text" name="edit_title" class="form-control" id="edit_title" placeholder="Título de la reserva">
                                </div>
                            </div>

                            <div class="row mb-3" >
                                <label for="edit_start" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🕧 Start:</label>
                                <div class="col-sm-10" style="width:370px">
                                    <input type="datetime-local" name="edit_start" class="form-control" id="edit_start" placeholder="Título de la reserva">
                                </div>
                            </div>

                            <div class="row mb-3" >
                                <label for="edit_end" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🕜 End:</label>
                                <div class="col-sm-10" style="width:370px">
                                    <input type="datetime-local" name="edit_end" class="form-control" id="edit_end" placeholder="Título de la reserva">
                                </div>
                            </div>

                            <div class="row mb-3" >
                                <label for="edit_obs" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">📜 Info:</label>
                                <div class="col-sm-10" style="width:370px">
                                    <input type="text" name="edit_obs" class="form-control" id="edit_obs" placeholder="Información adicional">
                                </div>
                            </div>

                            <div class="row mb-3" >
                                <label for="edit_color" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🖍️ Color:</label>
                                <div class="col-sm-10" style="width:370px">
                                    <select name="edit_color" class="form-control" id="edit_color">
                                        <option value="">Seleccione</option>
                                        <option style="color: #FFD700;" value="#FFD700">Amarillo</option>
                                        <option style="color: #FF4500;" value="#FF4500">Naranja</option>
                                        <option style="color: #8B4513;" value="#8B4513">Marron</option>
                                        <option style="color: #1C1C1C;" value="#1C1C1C">Negro</option>
                                        <option style="color: #436EEE;" value="#436EEE">Azul</option>
                                        <option style="color: #A020F0;" value="#A020F0">Púrpura</option>
                                        <option style="color: #40E0D0;" value="#40E0D0">Turquesa</option>
                                        <option style="color: #228B22;" value="#228B22">Verde</option>
                                        <option style="color: #8B0000;" value="#8B0000">Rojo</option>   
                                    </select>
                                </div>
                            </div>

                            <button type="button" name="btnViewEvento" class="btn btn-danger" id="btnViewEvento">Cancelar</button>
                            <button type="submit" name="btnEditEvento" class="btn btn-warning" id="btnEditEvento">Guardar</button>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal Agendar-->
    <div class="modal fade" id="agendarModal" tabindex="-1" aria-labelledby="agendarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mx-auto" style="width:550px">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5 fw-bold" id="agendarModalLabel">Agendar 📅</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msgAgEvento"></span>
                    
                    <form method="POST" id="formCadEvento">
                        <div class="row mb-3" >
                            <label for="ag_title" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">➡️ Title:</label>
                            <div class="col-sm-10" style="width:370px">
                                <input type="text" name="ag_title" class="form-control" id="ag_title" placeholder="Título de la reserva">
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="ag_start" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🕧 Start:</label>
                            <div class="col-sm-10" style="width:370px">
                                <input type="datetime-local" name="ag_start" class="form-control" id="ag_start" placeholder="Título de la reserva">
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="ag_end" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🕜 End:</label>
                            <div class="col-sm-10" style="width:370px">
                                <input type="datetime-local" name="ag_end" class="form-control" id="ag_end" placeholder="Título de la reserva">
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="ag_obs" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">📜 Info:</label>
                            <div class="col-sm-10" style="width:370px">
                                <input type="text" name="ag_obs" class="form-control" id="ag_obs" placeholder="Información adicional">
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="ag_color" class="col-sm-2 col-form-label fs-6 fw-bold" style="width: 100px;">🖍️ Color:</label>
                            <div class="col-sm-10" style="width:370px">
                                <select name="ag_color" class="form-control" id="ag_color">
                                    <option value="">Seleccione</option>
                                    <option style="color: #FFD700;" value="#FFD700">Amarillo</option>
                                    <option style="color: #FF4500;" value="#FF4500">Naranja</option>
                                    <option style="color: #8B4513;" value="#8B4513">Marron</option>
                                    <option style="color: #1C1C1C;" value="#1C1C1C">Negro</option>
                                    <option style="color: #436EEE;" value="#436EEE">Azul</option>
                                    <option style="color: #A020F0;" value="#A020F0">Púrpura</option>
                                    <option style="color: #40E0D0;" value="#40E0D0">Turquesa</option>
                                    <option style="color: #228B22;" value="#228B22">Verde</option>
                                    <option style="color: #8B0000;" value="#8B0000">Rojo</option>   
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="btnCadEvento" class="btn btn-success" id="btnCadEvento">Enviar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src='../global/js/index.global.min.js'></script>
    <script src="../global/js/bootstrap5/index.global.min.js"></script>
    <script src="../global/js/core/locales-all.global.min.js"></script>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js"></script>

    <script src="../global/script.js"></script>
    <script src="usu_calendario.js"></script>


</body>
</html>