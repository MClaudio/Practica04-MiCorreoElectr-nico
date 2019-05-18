<h1 class="tittle">Gestion de usuarios</h1>
<div class="menu">
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="myaccount.php">Mi cuenta</a></li>
            <li><a href="../../../config/sessionEnd.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</div>
<div class="user">
    <div class="userImg">
        <div class="imagen">
            <img src="<?php echo ('../../../img/fotos/' . $_SESSION["codigo"] . '/' . $_SESSION["img"]) ?>" alt="">
        </div>
        <p><span><?php echo ($_SESSION['nombre'] . ' ' . $_SESSION['apellido']) ?></span></p>
    </div>
</div>