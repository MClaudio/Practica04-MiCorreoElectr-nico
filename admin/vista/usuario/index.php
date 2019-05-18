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
    <script src="js/search.js"></script>
    <title>Inicio</title>
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
                <input type="search" id="buscarRemitente" placeholder="Buscar por remitente" onkeyup="buscar(this)">
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
                <tbody id="data">
                    <?php
                    include '../../../config/conexionBD.php';
                    $sql = "SELECT * FROM mensaje INNER JOIN usuario ON mensaje.usu_destino = usuario.usu_codigo WHERE mensaje.usu_destino=" . $_SESSION['codigo'] . ";";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["mail_fecha"] . "</td>";
                            $sqlRemitente = "SELECT usu_correo FROM usuario WHERE usu_codigo=" . $row["usu_remitente"] . ";";
                            $resultRemitente = $conn->query($sqlRemitente);
                            $rowRemitente = $resultRemitente->fetch_assoc();
                            echo "<td>" . $rowRemitente["usu_correo"] . "</td>";
                            echo "<td>" . $row["mail_asunto"] . "</td>";
                            //echo "<td>" . $row["mail_mensaje"] . "</td>";
                            echo '<td><a href="#">Leer</a></td>';
                        }
                    } else {
                        echo "<tr>";
                        echo '<td colspan="10" class="db_null"><p>No tienes mensajes recibidos</p><i class="fas fa-exclamation-circle"></i></td>';
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>


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