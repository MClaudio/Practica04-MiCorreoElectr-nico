<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/vista/login.php");
} elseif ($_SESSION['rol'] == 'user') {
    header("Location: ../usuario/index.php");
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
    <title>Administrar Usuarios</title>
</head>

<body>
    <header>
        <?php
        include('../../../php/headerAdmin.php');
        ?>
    </header>
    <div id="contenedor">
        <h2>Mensajes Electronicos</h2>
        <section>
            <table>
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Remitente</td>
                        <td>Destino</td>
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
                    <?php
                    include '../../../config/conexionBD.php';
                    //$sql = "SELECT * FROM usuario usu, mensaje msj WHERE usu.usu_codigo=msj.usu_remitente AND 
                    //msj.usu_destino=" . $_SESSION['codigo'] . ";";

                    $sql = "SELECT * FROM mensaje INNER JOIN usuario ON mensaje.usu_destino = usuario.usu_codigo ORDER BY 1;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["mail_fecha"] . "</td>";
                            $sqlRemitente = "SELECT usu_correo FROM usuario WHERE usu_codigo=" . $row["usu_remitente"] . ";";
                            $resultRemitente = $conn->query($sqlRemitente);
                            $rowRemitente = $resultRemitente->fetch_assoc();
                            echo "<td>" . $rowRemitente["usu_correo"] . "</td>";

                            $sqlDestino = "SELECT usu_correo FROM usuario WHERE usu_codigo=" . $row["usu_destino"] . ";";
                            $sqlDestino = $conn->query($sqlDestino);
                            $rowDestino = $sqlDestino->fetch_assoc();
                            echo "<td>" . $rowDestino["usu_correo"] . "</td>";

                            echo "<td>" . $row["mail_asunto"] . "</td>";
                            echo '<td><a href="../../controladores/admin/deleteMSJ.php?usu_cod=' . $row["mail_codigo"] . '">Eliminar</a></td>';
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
    <footer class="red">
        <?php
        include('../../../php/footer.php');
        ?>
    </footer>
</body>

</html>