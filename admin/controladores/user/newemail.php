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
    <title>Mensaje enviado</title>
</head>

<body>
    <h1>Enviar Mensaje</h1>
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
        echo "<h1>Mensaje Enviado</h1>";
    } else {
        echo "<h1>Mensaje No Enviado</h1>";
    }
    $conn->close();
    ?>
</body>

</html>