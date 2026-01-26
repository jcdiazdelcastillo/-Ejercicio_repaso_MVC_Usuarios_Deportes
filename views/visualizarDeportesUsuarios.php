<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>DATOS</h3>
    <?php
        foreach ($datos as $dato) {
            echo $dato["nombreUsuario"] . " -- " .$dato["apeNombre"] . " -- " .$dato["nombreDep"] . "<br>";
        }
    ?>
    <div><a href="index.php?controller=Usuarios&action=iniciarSesion">Volver atrás</a></div>
</body>
</html>