<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <title>Iniciar Sesion</title>
</head>

<body>
    <header>
        <h1 class="tittle">Gestion de usuarios</h1>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="crear_usuario.php">Rgistro</a></li>
                </ul>
            </nav>
        </div>
        <div class="user">
            <a href='login.php'>Iniciar Sesion</a>
        </div>
    </header>
    <section>
        <div class="formulario login">
            <h2>Iniciar Sesion</h2>
            <form action="../controladores/login.php" method="post">
                <input type="email" name="email" id="email" required placeholder="Correo">
                <input type="password" name="pass" id="pass" required placeholder="Contraseña">
                <input type="submit" value="Ingresar">
            </form>
        </div>
    </section>
    <footer>
        <?php
        include('../../php/footer.php');
        ?>
    </footer>
</body>

</html>