<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total de usuarios por deporte</title>
</head>
<body>
    <h3>TOTAL USUARIOS POR DEPORTES: </h3>
    <?php
        foreach ($datos as $dato){
            echo $dato["nombreDep"]." -- ".$dato["total_usuarios"]."<br><br>";
        }
    ?>
    <div><a href="index.php?controller=Usuarios&action=iniciarSesion">Volver atrás</a></div>
</body>
</html>