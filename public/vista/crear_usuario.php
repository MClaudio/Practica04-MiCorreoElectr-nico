<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <title>Crear usuario</title>
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
        <div class="formulario registro">
            <h2>Registro</h2>
            <form action="../controladores/crear_usuario.php" method="post">
                <label for="cedula">Cedula</label>
                <input type="text" name="cedula" id="cedula" required>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" required>
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" required>
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" required>
                <label for="fechaNac">Fecha de nacimiento</label>
                <input type="date" name="fechaNac" id="fechaNac" required>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass" required>
                <label for="cpass">Confirmar Contraseña</label>
                <input type="password" name="cpass" id="cpass" required>
                <label for="foto">Foto de perfil</label>
                <input type="file" name="foto" id="foto">
                <input type="submit" value="Crear">
            </form>
        </div>
    </section>
    <footer class="public registro">
        <?php
        include('../../php/footer.php');
        ?>
    </footer>
</body>

</html>