<?php

    session_start();

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    
    $contrasena = hash('sha512', $contrasena);

    $validar_login = mysqli_query($conexion, "SELECT nombre_completo, correo, contrasena, rol FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'");

    // Verificar si la consulta fue exitosa y si devolvió resultados
    if ($validar_login && mysqli_num_rows($validar_login) > 0) {
        $filas = mysqli_fetch_array($validar_login);

        // Verificar si el índice 'rol' existe y redirigir según el rol
        if (isset($filas['rol'])) {
            $_SESSION['usuario'] = $correo;
            $_SESSION['nombre_completo'] = $filas['nombre_completo'];
            $_SESSION['rol'] = $filas['rol'];


            if ($filas['rol'] == 1) {
                header("location: ../../admin/calendario_adminPage/adminH_index.php");
                exit;
            } else if ($filas['rol'] == 2) {
                header("location: ../../usuario/usu_index.php");
                exit;
            } else {
                echo '
                    <script>
                        alert("Rol de usuario no reconocido.");
                        window.location = "../index.php";
                    </script>
                ';
                exit;
            }
        } else {
            echo '
                <script>
                    alert("Error en la base de datos: el campo \'rol\' no existe.");
                    window.location = "../index.php";
                </script>
            ';
            exit;
        }
    } else {
        echo '
            <script>
                alert("Usuario o contraseña incorrectos, por favor verifique los datos ingresados");
                window.location = "../index.php";
            </script>
        ';
        exit;
}
?>