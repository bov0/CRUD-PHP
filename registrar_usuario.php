<?php

//Comprobamos que todos los campos esten rellenos 

if (isset($_POST['usuario']) && isset($_POST['contrasena']) && !empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    require_once 'conexion_BD.php';
    $config = new Conexion_BD();
    $conexion = $config->getConexion();

    $stmt = $conexion->prepare('SELECT * FROM Usuarios WHERE NombreUsuario = :usuario');
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

//Comprobamos que en la base de datos no exista usuario con ese nombre y si existe lo devolvemos con mensaje de error.

    if ($stmt-> rowCount() > 0) {
        $_SESSION['error_msg'] = "El nombre de usuario ya está en uso. Por favor, elige otro.";
        header("Location: login.php");
        exit;
    } else {
        $stmt = $conexion->prepare('INSERT INTO Usuarios (NombreUsuario, Contrasena) VALUES (:usuario, :contrasena)');
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();
        header("Location: login.php");
        exit;
    }
} else {
    if (empty($_POST['usuario']) && empty($_POST['contrasena'])) {
        $_SESSION['error_msg'] = "Por favor complete los campos de nombre de usuario y contraseña";
    } else if (empty($_POST['usuario'])) {
        $_SESSION['error_msg'] = "Por favor ingrese un nombre de usuario";
    } else {
        $_SESSION['error_msg'] = "Por favor ingrese una contraseña";
    }
    header("Location: registro_usuario.php");
    exit;
}
?>
