<?php

    include 'conexion_be.php';


    $nombre_completo= $_POST['nombre_completo'];
    $correo= $_POST['correo'];
    $contrasena= $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);

    $query = "INSERT INTO usuarios(nombre_completo, correo, contrasena, rol) 
                VALUES('$nombre_completo','$correo', '$contrasena', 2)";

    if (!str_ends_with($correo, '@unmsm.edu.pe')) {
        echo '
            <script>
                alert("Usted debe usar su correo institucional para registrarse.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }


    //verificar que el correo no se repita
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios where correo = '$correo' ");

    if (mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion,$query);

    if($ejecutar) {
        echo '
            <script>
                alert("Usuario Registrado exitosamente :D");
                window.location = "../index.php";
            </script>
        ';
    }else {
        echo '
            <script>
            alert("Usuario no almacenado, intentalo de nuevo :(");
            window.location = "../index.php";
            </script>
        ';
    };

    mysqli_close($conexion);

?>