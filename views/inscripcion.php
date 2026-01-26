<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php?controller=Usuarios&action=inscripcionUsuarios" method="POST">
        <label for="nombreUsuario">Nombre usuario (no se puede repetir)</label>
        <input type="text" name="nombreUsuario" id="nombreUsuario"><br><br>
        <label for="nombreApellidos"> Apellidos y Nombre: </label>
        <input type="text" name="nombreApellidos" id="nombreApellidos"><br><br>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password"><br><br>
        <label for="email">Correo: </label>
        <input type="text" name="email" id="email"><br><br>
        <label for="telefono">Teléfono (si no se rellena se guarda el valor NULL): </label>
        <input type="text" name="telefono" id="telefono"><br><br>
        <label for="deportes">Deportes (un alumno puede inscribirse en más de un deporte): </label><br><br>
        <?php
            foreach($datos as $dato){
                echo "<input type='checkbox' name='deportes[]' id='" . $dato['idDeporte'] . "' value='" . $dato['idDeporte'] . "'>";
                echo "<label for='" . $dato['idDeporte'] . "'>" . $dato['nombreDep'] . "</label><br><br>";
            }
        ?>

        <label for="condiciones">Acepto las condiciones</label>
        <input type="checkbox" name="condiciones" id="condiciones" value="1"><br><br>

        <input type="submit" value="enviar">
    </form>
    <div><a href="index.php">Volver atrás</a></div>
</body>
</html>