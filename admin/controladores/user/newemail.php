<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/vista/login.php");
} elseif ($_SESSION['rol'] == 'admin') {
    header("Location: ../usuario/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Mensaje enviado</title>
</head>

<body>
    <header>
        <h1 class="tittle">Gestion de usuarios</h1>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="../../vista/usuario/index.php">Inicio</a></li>
                    <li><a href="../../vista/usuario/newmail.php">Nuevo Mensaje</a></li>
                    <li><a href="../../vista/usuario/sendmail.php">Mensajes Enviados</a></li>
                    <li><a href="../../vista/usuario/myaccount.php">Mi Cuenta</a></li>
                    <li><a href="../../../config/sessionEnd.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </div>
        <div class="user">
            <div class="userImg">
                <div class="imagen">
                    <img src="<?php echo ('../../../img/fotos/' . $_SESSION["codigo"] . '/' . $_SESSION["img"]) ?>"
                        alt="">
                </div>
                <p><span><?php echo ($_SESSION['nombre'] . ' ' . $_SESSION['apellido']) ?></span></p>
            </div>
        </div>
    </header>
    <section>

        <div class="formulario crear_usuario">

            <?php
            include '../../../config/conexionBD.php';
            $codigoRemitente = isset($_POST["codigoRemitente"]) ? trim($_POST["codigoRemitente"]) : null;
            $emailDestino = isset($_POST["emailDestino"]) ? trim($_POST["emailDestino"]) : null;
            $asunto = isset($_POST["asunto"]) ? trim($_POST["asunto"]) : null;
            $mensaje = isset($_POST["mensaje"]) ? trim($_POST["mensaje"]) : null;

            $sql = "SELECT usu_codigo FROM usuario WHERE usu_correo ='$emailDestino';";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $codigoDestino = $row["usu_codigo"];

            $sqlInsert = "INSERT INTO mensaje VALUES (
                0, 
                null, 
                '$asunto', 
                '$mensaje', 
                '$codigoRemitente', 
                '$codigoDestino'  
            )";

            if ($conn->query($sqlInsert) == true) {
                echo "<h2>Mensaje enviado con exito</h2>";
                echo '<i class="far fa-check-circle"></i>';
                echo '<a href="../../vista/usuario/sendmail.php">Regresar</a>';
            } else {

                echo "<h2>Error al enviar el mensaje: " . mysqli_error($conn) . "</h2>";
                echo '<i class="fas fa-exclamation-circle"></i>';
                echo '<a href="../../vista/usuario/newmail.php">Regresar</a>';
            }
            $conn->close();

            ?>

        </div>
        <footer>
            <?php
            include('../../../php/footer.php');
            ?>
        </footer>
</body>

</html>