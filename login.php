<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: lightslategray;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            display: flex;
            flex-direction: column;
        }

        legend {
            margin: auto;
            font-weight: bolder;
            font-size: 24px;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <form action="autentificador.php" method="post">
        <legend>Iniciar sesion</legend>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario">
        <label for="contrasena">contraseña:</label>
        <input type="password" name="contrasena">
        <input type="submit" value="Enviar">
        <a href="registro_usuario.php">¿Eres nuevo? Registrate.</a>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['error_msg'])) {
        echo "<p style='background-color: red; padding: 10px; border-radius: 8px;color:white'>" . $_SESSION['error_msg'] . "</p>";
        unset($_SESSION['error_msg']);
    }
    ?>
</body>

</html>