<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/styles/styles.css">
    <title>Inicio de sesión</title>
</head>
<body id="form_inicio_sesion">
    <form action="index.php?controller=Usuarios&action=iniciarSesion" method="POST">
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="ACCEDER">
    </form>
    <?php
        if($mensajeError!=null){
            echo $mensajeError;
        }
    ?>
</body>
</html>