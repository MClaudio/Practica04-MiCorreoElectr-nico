# Practica04-MiCorreoElectr-nico
Programacion Hipermedial
1.	Se instala el servido XAMPP y se inicializa el servidor apache y la base de datos MySQL 
2.	Se crea la base de datos hipermedial y dentro de esta se crea la tabla usuario  
3.	Se crea la estructura de carpetas de la practica
 
4.	Dentro de la carpeta config se crea el archivo de conexión a la base de datos. 
 
•	¿Qué es mysqli?
La extensión mysqli (mysql mejorada) permite acceder a la funcionalidad proporcionada por MySQL 4.1 y posterior. Ofrece una interfaz dual. Soporta el paradigma de programación procedimental y el orientado a objetos.
•	¿Qué hace la función set_charset()?
Establece el conjunto de caracteres predeterminado a usar cuando se envían datos desde y hacia el servidor de la base de datos.
5.	Se crea el formulario con los campos ingresados en la base de datos para almacenar la información.

```html
		
		<form enctype="multipart/form-data" action="../controladores/crear_usuario.php" method="post">
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
                <div class="userFoto">
                    <img src="../../img/fotos/foto.png" alt="">
                    <input type="file" name="foto" id="foto">
                    <label for="foto">Foto de perfil</label>
                </div>
                <input type="submit" value="Crear">
            </form>
		
```
 
 
6.	Se verifica la conexión del formulario con el controlador que se encargara de agregar los datos en la base de datos.
 
7.	Se crea el código php para la administración de los datos recibidos por el método POST del formulario y seguido realizar la inserción de los datos en la base de datos de MySQL.
 
```php
  <?php
            include '../../config/conexionBD.php';

            $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];

            //echo ($_FILES['foto']['name']);

            $sql = "SELECT MAX(usu_codigo)+1 AS codigo  FROM usuario;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();



            $directorio = "../../img/fotos/" . $row['codigo'] . "/";
            mkdir($directorio, 0777, true);
            move_uploaded_file($temp, "../../img/fotos/" . $row['codigo'] . "/$foto");


            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
            $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
            $apellido = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;
            $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $fechaNac = isset($_POST["fechaNac"]) ? trim($_POST["fechaNac"]) : null;
            $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
            $cpass = isset($_POST["cpass"]) ? trim($_POST["cpass"]) : null;
            $sql = "INSERT INTO usuario (usu_cedula, usu_nombres, usu_apellidos, usu_direccion, usu_telefono, usu_correo,     usu_password, usu_fecha_nacimiento, usu_img) VALUES (
                    '$cedula', 
                    '$nombre', 
                    '$apellido', 
                    '$direccion', 
                    '$telefono',
                    '$email', 
                    MD5('$pass'), 
                    '$fechaNac',
                    '" . $_FILES['foto']['name'] . "'
                )";
            if ($pass == $cpass) {
                if ($conn->query($sql) == true) {
                    echo "<h2>Datos ingresados con exito</h2>";
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    if ($conn->errno == 1062) {
                        echo "<h2>Las cedula $cedula ya existe</h2>";
                        echo '<i class="fas fa-exclamation-circle"></i>';
                    } else {
                        echo "<h2>Error " . mysqli_error($conn) . "</h2>";
                        echo '<i class="fas fa-exclamation-circle"></i>';
                    }
                }
            } else {
                echo "<h2>Las contraseñas no coinciden</h2>";
                echo '<i class="fas fa-exclamation-circle"></i>';
            }
            $conn->close();
            ?>
```
      
Para verificar que todo este correcto insertaremos un registro el cual debe presenciarse en la base de datos sin ningún error.
 
Como se pude observar los datos se ingresan de manera satisfactoria ahora veremos el registro en la base de datos.
 
El código aparece en cuatro por pruebas realizadas anteriormente. 
•	¿Qué realiza la sentencia include en PHP?
Los archivos son incluidos con base en la ruta de acceso dada cuando se incluye un archivo, el código que contiene hereda el ámbito de las variables de la línea en la cual ocurre la inclusión. Cualquier variable disponible en esa línea del archivo que hace el llamado, estará disponible en el archivo llamado, desde ese punto en adelante. Sin embargo, todas las funciones y clases definidas en el archivo incluido tienen el ámbito global.

•	¿Qué es la variable $_POST?
Esta es una variable superglobal, que guarda el valor de todos los controles enviados a través de un formulario con el método POST, es un array donde su contenido será el nombre del control como índice y su respectivo contenido. en un formulario también puedes indicar el método GET y pasará los datos por URL

•	¿Qué hace la función isset()?
Determina si una variable está definida y no es NULL.

Si una variable ha sido removida con unset(), está ya no estará definida. isset() devolverá FALSE si prueba una variable que ha sido definida como NULL. También tenga en cuenta que un byte NULL ("\0") no es equivalente a la constante NULL de PHP.

Si son pasados varios parámetros, entonces isset() devolverá TRUE únicamente si todos los parámetros están definidos. La evaluación se realiza de izquierda a derecha y se detiene tan pronto como se encuentre una variable no definida.

•	¿Qué hace la función trim()?
Esta función devuelve una cadena con los espacios en blanco eliminados del inicio y final del str. sin el segundo parámetro.

•	¿Qué hace la función strtoupper()?
Devuelve el string con todos los caracteres alfabéticos convertidos a mayúsculas.

Notar que ser 'alfabético' está determinado por la configuración regional actual. Por ejemplo, en la configuración regional por defecto "C" caracteres como la diéresis-a (ä) no se convertirán.

•	¿La función MD5 es de PHP?
No el cifrado MD5 es una función de la base de datos la cual cifra la contraseña.

•	¿Por qué utilizamos la función MD5?
MD5 (Message Digest Algorithm 5) es un algoritmo que se utiliza como una función de codificación o huella digital de un archivo. De esta forma, a la hora de descargar un determinado archivo como puede ser un instalador, el código generado por el algoritmo, también llamado hash, viene “unido” al archivo. Un hash MD5 está compuesto por 32 caracteres hexadecimales y una codificación de 128 bits.

•	¿Por qué agregamos el código 0?
Para que la función de auto_increment de la base de datos se encargue de incrementar el campo en uno con cada registro introducido.

•	¿Cuál es el error 1062 en mysql?
(MySQL error - #1062 - Duplicate entry ' ' for key ' ‘) Indica que la clave a sido duplicada cuando definimos un campo como único.

•	¿Por qué los dos últimos valores de la sentencia SQL son null?
Por qué las dos últimas columnas de la base de datos son de tipo timestamp que indica que se ingresara la fecha y hora tomados del sistema.

•	La función query(), ¿para qué tipo de consultas SQL se utiliza?
Para consultas de tipo CRUD como Crear, Leer, Actualizar y Borrar.

•	¿Qué realiza la función mysqli_error()?
Devuelve una cadena descriptiva del último error.

•	¿Qué realiza la función close()?
Cierra una conexión de base de datos previamente abierta.

•	¿Se puede tener etiquetas HTML y código php en el mismo archivo? En caso de que la respuesta sea afirmativa, el archivo ¿deberá tener extensión HTML o php? ¿Porqué? En caso de que la respuesta sea negativa. ¿Por qué no?
Si se puede y el archivo tiene que ser .php para que se pueda interpretar el script de php.

•	¿La etiqueta meta en el head es necesario? ¿Qué pasa si no se pone esta etiqueta?
Si es necesario porque ayuda a definir la codificación de la página.

•	Ingresar datos con tildes o caracteres latinos. ¿Cómo se guarda en la base de datos?
Es necesario codificar bien la base de datos para que estos caracteres sean identificados en la base de datos.

Consultar información a la base de datos desde php
8.	Se crea el formulario de inicio de sesión con el método post para mandar la información al controlador.
```html
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
```
 
9.	Se crea el script PHP para el inicio de sesión el cual se encarga de buscar en la base de datos el correo y la contraseña ingresados en el formulario.
```html
<?php

            include '../../config/conexionBD.php';

            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
            $sql = "SELECT * FROM usuario WHERE usu_correo ='$email' AND usu_password = MD5('$pass')";

            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                echo "<h2>Logeo exitoso espere...</h2>";
                echo '<i class="far fa-check-circle"></i>';
                $_SESSION['isLogin'] = true;
                $_SESSION['codigo'] = $user["usu_codigo"];
                $_SESSION['nombre'] = $user["usu_nombres"];
                $_SESSION['apellido'] = $user["usu_apellidos"];
                $_SESSION['img'] = $user["usu_img"];
                $_SESSION['rol'] = $user["usu_rol"];
                if ($_SESSION['rol'] == 'admin') {
                    header("Refresh:2; url=../../admin/vista/admin/index.php");
                } else {
                    header("Refresh:2; url=../../admin/vista/usuario/index.php");
                }
            } else {
                echo "<h2>Datos de inicio incorrectos....</h2>";
                echo '<i class="fas fa-exclamation-circle"></i>';
                header("Refresh:2; url=../vista/login.php");
            }
            $conn->close();
            ?>
```
 
•	¿Qué realiza la función session_start()? 
crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
•	¿Qué se almacena en la variable $result? 
Recupera el contenido de una celda de un conjunto de resultados de MySQL.
•	¿Qué es la variable $_SESSION de php? 
Es un array asociativo que contiene variables de sesión disponibles para el script actual.
•	¿Qué realiza la función header?
Nos permite enviar encabezados sin formato al cliente. Es una manera de forzar dicho envío antes de que se lean los encabezados de la propia página.
•	¿Qué realiza el parámetro Location de la función header?
Realiza una redireccion.

Mostrar información de una consulta a la base de datos desde php.
10.	Se crea la table con la información proveniente de la base de datos para ellos se crea el script de php para recuperar los datos.
```php
<?php

                    include '../../../config/conexionBD.php';
                    $sql = "SELECT * FROM usuario";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["usu_cedula"] . "</td>";
                            echo "<td>" . $row["usu_nombres"] . "</td>";
                            echo "<td>" . $row["usu_apellidos"] . "</td>";
                            echo "<td>" . $row["usu_direccion"] . "</td>";
                            echo "<td>" . $row["usu_correo"] . "</td>";
                            echo "<td>" . $row["usu_telefono"] . "</td>";
                            echo "<td>" . $row["usu_fecha_nacimiento"] . "</td>";
                            echo '<td><img src="../../../img/fotos/' . $row["usu_codigo"] . '/' . $row["usu_img"] . '" alt=""></td>';
                            if ((string)$row["usu_eliminado"] === 'N') {
                                echo '<td><a href="../../controladores/admin/deleteUser.php?usu_cod=' . $row["usu_codigo"] . '&delete=' . true . '">Eliminar</a></td>';
                            } else {
                                echo '<td><a href="../../controladores/admin/deleteUser.php?usu_cod=' . $row["usu_codigo"] . '">Activar</a></td>';
                            }
                            $user = serialize($row);
                            $user = urlencode($user);
                            echo '<td><a href="modificar_usuario.php?user=' . $user . '">Modificar</a></td>';
                            echo '<td><a href="modificar_pass.php?usu_cod=' . $row["usu_codigo"] . '">Cambiar contraseña</a></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo '<td colspan="10" class="db_null"><p>No existen usuarios registrados en el sistema</p><i class="fas fa-exclamation-circle"></i></td>';
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <?php
            $cod = isset($_GET["delete"]) ? trim($_GET["delete"]) : null;
            if ($cod == true) {
                echo "<p>Usuario eliminado</p>";
            }
            ?>
```
 
Los datos se recuperan y se muestran en la tabla.
 

## Inicio de sesión de usuarios

11.	Para este apartado se edita los archivos para poder mantener la sesión e impedir el acceso a la administración si no se a iniciado sesión para esto se genera el código de la sesión y guardar la sesión con el nombre de usuario.

```php
<?php

            include '../../config/conexionBD.php';

            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
            $sql = "SELECT * FROM usuario WHERE usu_correo ='$email' AND usu_password = MD5('$pass')";

            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                echo "<h2>Logeo exitoso espere...</h2>";
                echo '<i class="far fa-check-circle"></i>';
                $_SESSION['isLogin'] = true;
                $_SESSION['codigo'] = $user["usu_codigo"];
                $_SESSION['nombre'] = $user["usu_nombres"];
                $_SESSION['apellido'] = $user["usu_apellidos"];
                $_SESSION['img'] = $user["usu_img"];
                $_SESSION['rol'] = $user["usu_rol"];
                if ($_SESSION['rol'] == 'admin') {
                    header("Refresh:2; url=../../admin/vista/admin/index.php");
                } else {
                    header("Refresh:2; url=../../admin/vista/usuario/index.php");
                }
            } else {
                echo "<h2>Datos de inicio incorrectos....</h2>";
                echo '<i class="fas fa-exclamation-circle"></i>';
                header("Refresh:2; url=../vista/login.php");
            }
            $conn->close();
            ?>
```
 
Al guardar la sesión en la variable super global $_SESSION[“nombre”] con el nombre de usuario se podrá hacer referencia a esta sesión el los demás archivos a continuación se indica el uso de la sesión en el archivo login.php
```html
<div class="user">
    <div class="userImg">
        <div class="imagen">
            <img src="<?php echo ('../../../img/fotos/' . $_SESSION["codigo"] . '/' . $_SESSION["img"]) ?>" alt="">
        </div>
        <p><span><?php echo ($_SESSION['nombre'] . ' ' . $_SESSION['apellido']) ?></span></p>
    </div>
</div>
```
 
Para este apartado se tubo que cambiar la extensión de .html a .php para poder escribir script de php en ese caso se inicia la sesión y se hace una condición de que si la variable $_SESSION[“nombre”] esta definida en caso de estarlo escribirá en el documento el nombre del usuario que inicio sesión y un enlace para cerrar la sesión y lo redijera automáticamente al panel de administración, en caso de no haber iniciado sesión se escribirá en el documento un enlace para iniciarlo.
 

Se sigue la misma lógica en los demás archivos veamos el código del registro en este caso no se redirige al panel por que no es necesario hacerlo.
 
 
## Sistema para eliminar usuarios

12.	Para realizar la eliminación o desactivación de un usuario implementaremos el siguiente código que realizara un update en la base de datos al campo usu_eliminado de “N” a “S” que identificara si el usuario esta eliminado o no siendo N no y S si.
En el archivo index se agrega el código en la misma columna de eliminar se imprime si el usuario esta eliminado se imprimirá Activar su el usuario esta activo se imprimirá Eliminar.
```php
if ((string)$row["usu_eliminado"] === 'N') {
                                echo '<td><a href="../../controladores/admin/deleteUser.php?usu_cod=' . $row["usu_codigo"] . '&delete=' . true . '">Eliminar</a></td>';
                            } else {
                                echo '<td><a href="../../controladores/admin/deleteUser.php?usu_cod=' . $row["usu_codigo"] . '">Activar</a></td>';
                            }
```
 
En la parte del controlador mediante la variable $_GET se captura el id del usuario y un valor buleano que indica si se tiene que eliminar o activar el valor true es eliminar y el false es activar.
```php
<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/vista/login.php");
} elseif ($_SESSION['rol'] == 'admin') {
    header("Location: ../../vista/admin/index.php");
}

include '../../../config/conexionBD.php';
$cod = isset($_GET["usu_cod"]) ? trim($_GET["usu_cod"]) : null;
$delete = isset($_GET["delete"]) ? trim($_GET["delete"]) : null;
$date = date(date("Y-m-d H:i:s"));

if ($cod != null and $delete == true) {
    $sql = "UPDATE usuario SET usu_eliminado='S', usu_fecha_modificacion='$date' WHERE usu_codigo='$cod';";
    $result = $conn->query($sql);
    header("Location: ../../vista/admin/usuarios.php");
} elseif ($cod != null and $delete == false) {
    $sql = "UPDATE usuario SET usu_eliminado='N', usu_fecha_modificacion='$date' WHERE usu_codigo='$cod';";
    $result = $conn->query($sql);
    header("Location: ../../vista/admin/usuarios.php");
} else {
    header("Location: ../../vista/admin/usuarios.php");
}
$conn->close();
``` 
 

## Sistema para modificar los datos en la base de datos.

13.	Para este paso de modificar los datos se toma los formularios y las paginas ya existentes para poder copiar los estilos de los formularios para esto se crean 2 archivos mas uno el que va a ser el formulario que es una copia del formulario de registro y el controlador el que gestiona los datos para actualizar en la base de datos, vemos el script de php del formulario de actualización que recibe por la url el array codificado de los datos para descodificar y poder tener los datos disponibles.
•	Archivo de envió de datos.
 
En este archivo también se envía el código de usuario para poder identificarlo este código se envía por el método de GET.

•	Paso del array por la url.
```php
$user = serialize($row);
                            $user = urlencode($user);
                            echo '<td><a href="modificar_usuario.php?user=' . $user . '">Modificar</a></td>';
```
 
•	Archivo que recibe los datos.
```html
 <section>
        <div class="formulario registro">
            <h2>Editar Datos</h2>
            <?php
            $data = $_GET["user"];
            $datos = stripslashes($data);
            $datos = urldecode($datos);
            $datos = unserialize($datos);
            ?>
            <form enctype="multipart/form-data" action="../../controladores/admin/updateUser.php" method="post">
                <input type="hidden" name="usu_codigo" value="<?php echo ($datos["usu_codigo"]); ?>">
                <label for="cedula">Cedula</label>
                <input type="text" name="cedula" id="cedula" value="<?php echo ($datos["usu_cedula"]); ?>" required>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo ($datos["usu_nombres"]); ?>" required>
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="<?php echo ($datos["usu_apellidos"]); ?>"
                    required>
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" value="<?php echo ($datos["usu_direccion"]); ?>"
                    required>
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" value="<?php echo ($datos["usu_telefono"]); ?>"
                    required>
                <label for="fechaNac">Fecha de nacimiento</label>
                <input type="date" name="fechaNac" id="fechaNac" value="<?php echo ($datos["usu_fecha_nacimiento"]); ?>"
                    required>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo ($datos["usu_correo"]); ?>" required>
                <div class="userFoto">
                    <img src="../../../img/fotos/<?php echo ($datos["usu_codigo"] . '/');
                                                    echo ($datos["usu_img"]); ?>" alt="">
                    <input type="file" name="foto" id="foto">
                    <label for="foto">Foto de perfil</label>
                </div>
                <input type="submit" value="Actualizar">
            </form>
        </div>
    </section>
```
Para poder recuperar los datos y mostrar en el formulario se incrusta el script de php en el valué de cada input con el valor recibido.
 
•	El archivo controlador encargado de actualizar los datos recibe los datos por el método de POST.
```php
<?php
            include '../../../config/conexionBD.php';
            $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];

            move_uploaded_file($temp, "../../../img/fotos/" . $_POST["usu_codigo"] . "/$foto");

            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
            $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
            $apellido = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;
            $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $fechaNac = isset($_POST["fechaNac"]) ? trim($_POST["fechaNac"]) : null;
            $cod = $_POST["usu_codigo"];
            $date = date(date("Y-m-d H:i:s"));
            $sql = "UPDATE usuario SET
                        usu_cedula='" . $cedula . "',
                        usu_nombres='" . $nombre . "',
                        usu_apellidos='" . $apellido . "',
                        usu_direccion='" . $direccion . "',
                        usu_telefono='" . $telefono . "',
                        usu_correo='" . $email . "',
                        usu_fecha_nacimiento='$fechaNac',
                        usu_fecha_modificacion='$date',
                        usu_img='" . $_FILES['foto']['name'] . "'
                        WHERE usu_codigo='$cod'";

            if ($conn->query($sql) == true) {
                echo "<h2>Datos actualizados con exito</h2>";
                echo '<i class="far fa-check-circle"></i>';
            } else {
                if ($conn->errno == 1062) {
                    echo "<h2>Las cedula $cedula ya existe</h2>";
                    echo '<i class="fas fa-exclamation-circle"></i>';
                } else {
                    echo "<h2>Error al actualizar losa datos " . mysqli_error($conn) . "</h2>";
                    echo '<i class="fas fa-exclamation-circle"></i>';
                }
            }
            $conn->close();
            ?>
```
 
## Cambio de contraseña

14.	Para realizar esta operación en la administración se crean los archivos a partir de los existentes para heredar estilos css y no crear mas estilos.
•	Se crea el enlace en el index con un parámetro GET de id del usuario.
```php
echo '<td><a href="modificar_pass.php?usu_cod=' . $row["usu_codigo"] . '">Cambiar contraseña</a></td>';
```

•	Se crea el archivo que recibirá el id y contendrá el formulario para el cambio de contraseña.
```html
<section>
        <div class="formulario login">
            <h2>Cambiar contraseña</h2>
            <form action="../../controladores/admin/updatePass.php" method="post">
                <input type="hidden" name="cod" value="<?php echo ($_GET["usu_cod"]); ?>">
                <input type="password" name="epass" id="epass" required placeholder="Contraseña existente">
                <input type="password" name="pass" id="pass" required placeholder="Nueva contraseña">
                <input type="password" name="cpass" id="cpass" required placeholder="Reapetir contraseña">
                <input type="submit" value="Cambiar">
            </form>
        </div>
    </section>
```
 
Este archivo enviara los datos por el método post y el ID del usuario por el método GET
 
•	Se crea el archivo updatePass.php  que administrara el cambio en la base de datos este recibirá los datos mediante el método POST y el ID mediante el método GET .

```html
<?php
            include '../../../config/conexionBD.php';
            $epass = isset($_POST["epass"]) ? trim($_POST["epass"]) : null;
            $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
            $cpass = isset($_POST["cpass"]) ? trim($_POST["cpass"]) : null;
            $cod = isset($_POST["cod"]) ? trim($_POST["cod"]) : null;

            $sql = "SELECT usu_password FROM usuario WHERE usu_codigo='$cod';";
            $result = $conn->query($sql);
            $result = $result->fetch_assoc();
            $date = date(date("Y-m-d H:i:s"));

            if (MD5($epass) === $result["usu_password"]) {
                if ($pass === $cpass) {
                    $sql = "UPDATE usuario SET usu_password = MD5('$pass'), usu_fecha_modificacion='$date' WHERE usu_codigo='$cod'";
                    if ($conn->query($sql) == true) {
                        noerro();
                    } else {
                        echo "<h2>Error al actualizar la contraseña " . mysqli_error($conn) . "</h2>";
                        error($cod);
                    }
                } else {
                    echo "<h2>Las contraseñas no coinciden</h2>";
                    error($cod);
                }
            } else {
                echo "<h2>La contraseña no existe en el sistema</h2>";
                error($cod);
            }
            $conn->close();

            function noerro()
            {
                echo "<h2>Contraseña actualizada con exito</h2>";
                echo '<i class="far fa-check-circle"></i>';
                echo '<a href="../../vista/admin/usuarios.php">Regresar</a>';
            }
            function error($cod)
            {
                echo '<i class="fas fa-exclamation-circle"></i>';
                echo '<a href="../../vista/admin/modificar_pass.php?usu_cod=' . $cod . '">Regresar</a>';
            }

            ?>

```
 
En este archivo se ejecutan 2 querys el primero para buscar la contraseña del usuario y el segundo para actualizar la contraseña así mismo contiene varias condicionales para verificar si la contraseña antigua coincide con el de la base de datos, otra condición para verificar si las contraseña nueva y la confirmación de la contraseña coinciden y una tercer condición para verificar si los datos se han introducido correctamente en la base de datos.
 
 
15.	 Roles de Usuarios
•	Para la creación de roles en la practica basada en la practica anterior se crea un nuevo campo en la tabra usuario el campo de usu_rol que determinara que rol tiene el usuario de administrador o usuario común.
 
•	El usuario común solo no tendrá acceso a la gestión de usurioas ya que esa sección es parte de la adminisrracion por lo tanto el usuario visualizara las siguientes paginas Inicio donde se mostrara sus mensajes recibidos, Nuevo mensaje para que pueda enviar un mensaje a otro usuario, Mensajes enviados donde se visualizan los mensajes que ah enviado y Mi cuenta donde podrá ver y editar sus datos a continuación se detallan la creación de cada una de estas paginas cabe recalcar que que la mayo ria de estas paginas ya fueron credas en la practica gestión de usuarios.
Enlace: https://github.com/MClaudio/SistemaDeGestion 
•	Para la administración de mensajes electrónicos se adjunta una nueva tabla a la base de datos cuya relación se pide visualizar en el siguiente diagrama entidad relación.
 
•	Una ves realizado el diagrama se procede a crear la tabla mediante código SQL
```sql
CREATE TABLE mensaje (
   mail_codigo int(11) NOT NULL AUTO_INCREMENT,
   mail_fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   mail_asunto varchar(100) NOT NULL,
   mail_mensaje varchar(255) NOT NULL,
   usu_remitente int(11) NOT NULL,
   usu_destino int(11) NOT NULL,
   PRIMARY KEY (mail_codigo),
   CONSTRAINT FK_UsuMensajeRemitente FOREIGN KEY (usu_remitente) REFERENCES usuario(usu_codigo),
  CONSTRAINT FK_UsuMensajeDestino FOREIGN KEY (usu_destino) REFERENCES usuario(usu_codigo)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; 
```
 
•	Cuando el usuario inicia sesión se tiene que guardar sus datos de sesión para posteriormente saber que foto esta usando que nombre tiene registrado en la base de datos así también como sus mensajes enviados y recibidos para ello en el inicio de sesión se captura sus datos con la variable global $_SESSION de PHP.
 
N este caso se captura el código, el nombre, apellido, su foto y el rol que tiene asignado.
Roles: 
•	Para determinar los roles de los usuarios como administrador o como usuario común se agrega un bueno campo a la base de datos como figura en el diagrama ED dicho campo contendrá el valor de admin para un usuario administrador y user para un usuario común por defecto es user.
 

## Usuario Común:

•	Para la página principal del usuario se debe visualizar los mensajes recibidos como se muestra en la demo de la guía en este caso se crea la pagina con la estructura HTML y se procede a dar estilos a la misma. Lo que realmente interesa es la relación a las tablas para recuperar estos datos. 
Con php se recupera los datos realizando una consulta a la base de datos y imprimiendo dichos resultados emitidos por la base de datos en la tabla.
```html
<?php
                    include '../../../config/conexionBD.php';
                    $sql = "SELECT * FROM usuario usu, mensaje msj WHERE usu.usu_codigo=msj.usu_remitente AND 
                    msj.usu_destino=" . $_SESSION['codigo'] . " ORDER BY msj.mail_codigo DESC;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["mail_fecha"] . "</td>";
                            echo "<td>" . $row["usu_correo"] . "</td>";
                            echo "<td>" . $row["mail_asunto"] . "</td>";
                            echo ('<div id="floatWindow" class="floatWindow"></div>');

                            echo '<td><a onclick="openWindow(' . $row["mail_codigo"] . ',\'De:\',\'usu_remitente\')">Leer</a></td>';
                        }
                    } else {
                        echo "<tr>";
                        echo '<td colspan="10" class="db_null"><p>No tienes mensajes recibidos</p><i class="fas fa-exclamation-circle"></i></td>';
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>
                    
```

•	El usuario común puede enviar mensajes a otro usuario registrado para ello se crea una página donde pueda enviar los mensajes esta página estará asociada a un controlador quien se encargara de guardar los datos en la base de datos.
 
En la imagen se aprecia que tiene un campo para introducir el correo de destino el asunto y el mensaje el cual cuyo controlador ingresara a la base de datos.
 
Como se puede apreciar el controlador realiza una consulta extra para saber el código del usuario a quien pertenece ese correo por que en la base de datos definimos usu_destino y usu_remitente como claves de relación con la tabla usuario.

•	El apartado de mensajes enviados es similar al de mensajes recibidos, pero en este casi se cambia la consulta que me devuelva todos los mensajes cuyo remitente sea el código d ella sesión.
```html
<?php
                    include '../../../config/conexionBD.php';
                    $sql = "SELECT * FROM usuario usu, mensaje msj WHERE usu.usu_codigo=msj.usu_destino AND 
                    msj.usu_remitente=" . $_SESSION['codigo'] . " ORDER BY msj.mail_codigo DESC;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["mail_fecha"] . "</td>";
                            echo "<td>" . $row["usu_correo"] . "</td>";
                            echo "<td>" . $row["mail_asunto"] . "</td>";
                            echo ('<div id="floatWindow" class="floatWindow"></div>');
                            echo '<td><a onclick="openWindow(' . $row["mail_codigo"] . ',\'Para:\',\'usu_destino\')">Leer</a></td>';
                        }
                    } else {
                        echo "<tr>";
                        echo '<td colspan="10" class="db_null"><p>No tienes mensajes recibidos</p><i class="fas fa-exclamation-circle"></i></td>';
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>
```
                    
•	El usuario conectado también pude editar su información personal para ello el apartado mi cuenta pude editar dicha información.
 
En la consulta se puede apreciar que la consulta se realiza solo para ese usuario es decir solo los datos de dicha sesión conectada los datos figuran en la tabla de resultados.
 
En esta tabla el usuario puede desactivar su cuenta editar su información y cambiar su contraseña para explicar la edición de usuario explicaremos como se agrega la foto de perfil del usuario desde que se registra.
Foto De Perfil:
•	Para poder cargar una foto de perfil del usuario se tiene que agregar un nuevo campo a la base de datos cuyo campo será de tipo varchar(255) ya que lo que vamos a guardar es el nombre de la imagen que está usando.
 
•	Revisaremos el registro ya que se ah modificado para poder subir imágenes al servidor.
•	En el formulario se tiene que agregar la line de código para que pueda transferir archivos y el controlador lo pueda recibir y manipular.
 
•	En el controlador usaremos la variable global $_FILES para tener la información del archivo.
```php
 $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];

            //echo ($_FILES['foto']['name']);

            $sql = "SELECT MAX(usu_codigo)+1 AS codigo  FROM usuario;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
```
 
El objetivo de este código es crear una carpeta para cada usuario de manera individual la carpeta entra el nombre del código del usuario, para lograr esto se realiza una consulta con el objetivo de obtener el máximo número del código como el código es auto incremental en 1 y el que me da de resultado es el último código se suma 1 para crear la carpeta y así se asocia al usuario que se está registrando.
Con la función mkdir() se crea el directorio y con el parámetro 0777 se da permisos de escritura.
Posteriormente se procede a mover el archivo con el comando move_upload_file() al directorio que acabamos de crear.
Finalmente, a la base de datos le agregamos el nombre del archivo de foto.
 
La siguiente imagen se muestra el formulario de registro actualizado.
 
Se mira el cuadro de imagen defectuoso puesto a que hay con JavaScript se pretende cargar la imagen en tiempo real para previsualizar. 
•	En la actualización de los datos el formulario contiene la información personal y se muestra la imagen.
 
La actualización de datos es similar a lo antes explicado con la diferencia que se carga la nueva imagen.
 
En este caso ya no se crea el directorio sino se mueve ya al directorio existente.
Avatar fotografía de usuario:
•	En la secion se capturo la foto es decir el nombre basta con desplazarnos entre los directorios para obtener la fotografía correspondiente al usuario.
 
 
## Mensajes lectura:

•	Para la lectura de los mensajes por parte del usuario común se realiza utilizando AJAX por el echo de que se abre en una ventana flotante como se muestra en la siguiente imagen.
```javascript
function openWindow(id, txt, code) {
    console.log(code)

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("floatWindow").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../../controladores/user/readMsj.php?id=" + id + "&dest=" + txt + "&code=" + code, true)
    xmlhttp.send()

    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "block"

}

function cluseWindow() {
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "none"
} 
```
 
En el archivo index se manda todos los parámetros necesarios para la lectura en este caso este se usará para leer los mensajes recibidos y los enviados por lo tanto se manda los parámetros para ajustar a la situación.
 
En el archivo serch.js se administra la función openWindow la que se encarga de recibir los datos de php para mostrar n pantalla y la que se encarga de abrir u cerrar la ventana flotante.
 
El archivo php encargado de responder a esta petición contiene el código que entregará de vuelta el cual será introducido en el div con id floatWindow
 
## Búsqueda empleando Ajax:

•	Se crea el código en el serch.js para buscar de acuerdo a la palabra o letra que se ingrese para ello se agrega el atributo onkeyup en el input de búsqueda esto hará que realice una petición cada ves que se pulsa una letra t este devolverá resultados.
```javascript
function buscar(input) {
    let text = input.value.trim()
    //console.log(text)
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("data").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../../controladores/user/buscar.php?key=" + text, true)
    xmlhttp.send()
}
``` 
 
El controlador php es el que gestiona esta petición por ello devolverá un echo de filas y columnas para presentar en el tbody.
```php
include '../../../config/conexionBD.php';

if ($_GET != '') {

    $sql = "SELECT * FROM usuario usu, mensaje msj WHERE usu.usu_codigo=msj.usu_remitente AND 
    msj.usu_destino=" . $_SESSION['codigo'] . " AND
    usu.usu_correo LIKE '" . $_GET['key'] . "%';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["mail_fecha"] . "</td>";
            echo "<td>" . $row["usu_correo"] . "</td>";
            echo "<td>" . $row["mail_asunto"] . "</td>";
            echo '<td><a href="#">Leer</a></td>';
        }
    } else {
        echo "<tr>";
        echo '<td colspan="10" class="db_null"><p>No hay resultados...</p><i class="fas fa-exclamation-circle"></i></td>';
        echo "</tr>";
    }
} else {
    $sql = "SELECT * FROM usuario usu, mensaje msj WHERE usu.usu_codigo=msj.usu_remitente AND 
                    msj.usu_destino=" . $_SESSION['codigo'] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["mail_fecha"] . "</td>";
            echo "<td>" . $row["usu_correo"] . "</td>";
            echo "<td>" . $row["mail_asunto"] . "</td>";
            //echo "<td>" . $row["mail_mensaje"] . "</td>";
            echo '<td><a href="#">Leer</a></td>';
        }
    } else {
        echo "<tr>";
        echo '<td colspan="10" class="db_null"><p>No tienes mensajes recibidos</p><i class="fas fa-exclamation-circle"></i></td>';
        echo "</tr>";
    }
}
$conn->close();
```
Este controlador devolverá una o varias columnas de acuerdo a la palabra que se este ingresando en el buscador.
 

16.	Rol ADMIN
•	El administrador puede ver todos los mensajes electrónicos que se han enviado los usuarios.
 ```php
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
 ```
 
También este usuario puede eliminar los mensajes que crea conveniente para ello el controlador se encargara de hacer el delete en la base de datos.
```php
<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/vista/login.php");
} elseif ($_SESSION['rol'] == 'admin') {
    header("Location: ../../vista/usuario/index.php");
}

include '../../../config/conexionBD.php';
$cod = isset($_GET["usu_cod"]) ? trim($_GET["usu_cod"]) : null;
$sql = "DELETE FROM mensaje WHERE mail_codigo='$cod';";
if ($conn->query($sql) == true) {
    echo "Mesaje eliminado";
    header("Location: ../../vista/admin/index.php");
}
$conn->close();
```
 
## Datos del trabajo:
•	Repositorio final en GitHub: https://github.com/MClaudio/Practica04-MiCorreoElectronico 
•	Usuario: MClaudio
RESULTADO(S) OBTENIDO(S):
El resultado de esta practica ah sido de gran utilidad para entender mas acerca del funcionamiento de las sesiones y administración de datos mediante php por lado del servidor y la creación de dinamismo por parte de java y AJAX que facilita la obtención de datos del servidor sin tener que recargar la pagina y sin tener que redirigir hacia otra ventana.

CONCLUSIONES:
Ah sido una practica muy productiva que ah ayudado a entender quisa conceptos que no eran del todo claros como las peticiones AJAX y las sesiones.
RECOMENDACIONES:
Practicar mas acerca de estas tecnologías ya que JavaScript es parte fundamental de la web para darle dinamismo y php es quisa uno de los lenguajes de programación por parte del servidor pioneros en la web.


