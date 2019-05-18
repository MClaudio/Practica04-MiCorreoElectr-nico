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
    <link rel="stylesheet" href="../../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <title>Modificar Contrasña</title>
</head>

<body>
    <header>
        <header>
            <?php
            include('../../../php/headerUser.php');
            ?>
        </header>
    </header>
    <section>
        <div class="formulario login">
            <h2>Cambiar contraseña</h2>
            <form action="../../controladores/user/updatePass.php" method="post">
                <input type="hidden" name="cod" value="<?php echo ($_GET["usu_cod"]); ?>">
                <input type="password" name="epass" id="epass" required placeholder="Contraseña existente">
                <input type="password" name="pass" id="pass" required placeholder="Nueva contraseña">
                <input type="password" name="cpass" id="cpass" required placeholder="Reapetir contraseña">
                <input type="submit" value="Cambiar">
            </form>
        </div>
    </section>
    <footer>
        <?php
        include('../../../php/footer.php');
        ?>
    </footer>
</body>

</html>