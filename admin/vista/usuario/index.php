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
    <title>Administrar Usuario</title>
</head>

<body>
    <header>
        <?php
        include('../../../php/headerUser.php');
        ?>
    </header>
    <div id="contenedor">
        <h2>Mensajes Recibidos</h2>
        <section>
            <div class="buscar">
                <input type="search" placeholder="Buscar">
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Remitente</td>
                        <td>Asunto</td>
                        <td></td>
                    </tr>
                </thead>
                <!--
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <div class="links">
                                    <a href="#">&laquo;</a>
                                    <a class="active" href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#">4</a>
                                    <a href="#">&raquo;</a>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                    -->
                <tbody>
                    <tr>
                        <td>Prueba</td>
                        <td>Prueba</td>
                        <td>Prueba</td>
                        <td><a href="#">Leer</a></td>

                    </tr>

                </tbody>
            </table>

        </section>
    </div>
    <footer>
        <?php
        include('../../../php/footer.php');
        ?>
    </footer>
</body>

</html>