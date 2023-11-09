<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
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
<body>
<form action="registrar_usuario.php" method="post">
    <legend>Registrar Usuario</legend>
        <label for="usuario">Nombre de usuario:</label>
        <input type="text" name="usuario">
        <label for="contrasena">contraseña:</label>
        <input type="password" name="contrasena">
        <input type="submit" value="Enviar">
    </form>
    <?php
    //Si existe mensaje de error lo mostramos
        session_start();
        if (isset($_SESSION['error_msg'])) {
            echo "<p style='background-color: red; padding: 10px; border-radius: 8px;color:white'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
    ?>
</body>
</html>