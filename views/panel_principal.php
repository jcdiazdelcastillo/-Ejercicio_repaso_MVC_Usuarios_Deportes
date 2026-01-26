<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>BIENVENIDO, <?php echo $_SESSION["nombreUsuario"]?></h3>
    <h3 ><a href='index.php?controller=Usuarios&action=cerrarSesion'>Cerrar Sesion</a></h3>
    <?php
        if ($_SESSION["perfil"]=="c"){
            echo "<div><a href='index.php?controller=Usuarios&action=obtener_deportes_usuario'>Deportes Usuarios</a></div>";
            echo "<div><a href='index.php?controller=Usuarios&action=total_deportes'>Total deportes</a></div>";
            echo "<div><a href='index.php?controller=Usuarios&action=totalUsuariosDeporte'>Deportes</a></div>";
        }
    ?>

</body>
</html>