<?php
session_start();

//Comprobamos que tenga todos los campos rellenos

if (isset($_POST['usuario']) && isset($_POST['contrasena']) && !empty($_POST['usuario']) && !empty($_POST['contrasena'])) {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    require_once 'conexion_BD.php';
    $config = new Conexion_BD();
    $conexion = $config->getConexion();

//Comprobamos que en la base de datos exista el usuario y que su contraseña sea esa, si es asi accedemos a consulta.

    $stmt = $conexion->prepare('SELECT * FROM Usuarios WHERE NombreUsuario = :usuario AND Contrasena = :contrasena');
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['Rol'] = $usuario['Rol'];
        header("Location: catalogo.php");
        exit;
    } else {
        $_SESSION['error_msg'] = "Nombre de usuario o contraseña incorrectos";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error_msg'] = "Por favor complete todos los campos";
    header("Location: login.php");
    exit;
}
?>
