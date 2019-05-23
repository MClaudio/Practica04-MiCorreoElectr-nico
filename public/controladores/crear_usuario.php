<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    header("Location: ../../admin/vista/usuario/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Crear Usuario</title>
</head>

<body>
    <header>
        <h1 class="tittle">Gestion de usuarios</h1>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="../vista/crear_usuario.php">Rgistro</a></li>
                </ul>
            </nav>
        </div>
        <div class="user">
            <a href='login.php'>Iniciar Sesion</a>
        </div>
    </header>
    <section>
        <div class="formulario crear_usuario">
            <?php
            include '../../config/conexionBD.php';

            $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];

            //echo ($_FILES['foto']['name']);

            $sql = "SELECT MAX(usu_codigo)+1 AS codigo  FROM usuario;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();



            $directorio = "../../img/fotos/" . $row['codigo'] . "/";
            mkdir($directorio, 0777, true);
            move_uploaded_file($temp, "../../img/fotos/" . $row['codigo'] . "/$foto");


            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
            $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
            $apellido = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;
            $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $fechaNac = isset($_POST["fechaNac"]) ? trim($_POST["fechaNac"]) : null;
            $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
            $cpass = isset($_POST["cpass"]) ? trim($_POST["cpass"]) : null;
            $sql = "INSERT INTO usuario (usu_cedula, usu_nombres, usu_apellidos, usu_direccion, usu_telefono, usu_correo, usu_password, usu_fecha_nacimiento, usu_img) VALUES (
                    '$cedula', 
                    '$nombre', 
                    '$apellido', 
                    '$direccion', 
                    '$telefono',
                    '$email', 
                    MD5('$pass'), 
                    '$fechaNac',
                    '" . $_FILES['foto']['name'] . "'
                )";
            if ($pass == $cpass) {
                if ($conn->query($sql) == true) {
                    echo "<h2>Datos ingresados con exito</h2>";
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    if ($conn->errno == 1062) {
                        echo "<h2>Las cedula $cedula ya existe</h2>";
                        echo '<i class="fas fa-exclamation-circle"></i>';
                    } else {
                        echo "<h2>Error " . mysqli_error($conn) . "</h2>";
                        echo '<i class="fas fa-exclamation-circle"></i>';
                    }
                }
            } else {
                echo "<h2>Las contraseñas no coinciden</h2>";
                echo '<i class="fas fa-exclamation-circle"></i>';
            }
            $conn->close();
            ?>
            <a href="../vista/crear_usuario.php">Regresar</a>
        </div>
    </section>
</body>

</html>