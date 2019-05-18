<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/vista/login.php");
} elseif ($_SESSION['rol'] == 'admin') {
    header("Location: ../admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/admin_style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Nuevo Mensaje</title>
</head>

<body>
    <header>
        <?php
        include('../../../php/headerUser.php');
        ?>
    </header>
    <section>
        <div class="formulario mensaje">
            <h2>Nuevo mensaje</h2>
            <form action="../../controladores/user/newemail.php" method="POST">
                <input type="hidden" name="codigoRemitente" value="<?php echo ($_SESSION['codigo']) ?>">
                <input type="mail" name="emailDestino" id="emailDestino" required placeholder="Correo de destino"
                    required>
                <input type="text" name="asunto" id="asunto" placeholder="Asunto" required>
                <textarea name="mensaje" id="mensaje" cols="50" rows="20" placeholder="Mensaje" required></textarea>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </section>
    <footer class="mail">
        <?php
        include('../../../php/footer.php');
        ?>
    </footer>
</body>

</html>