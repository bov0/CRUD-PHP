<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta pelicula</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightslategray;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 400px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="float"],
        input[type="text"],
        select,
        textarea,
        input[type="file"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            width: 97%;
            background-color: white;
        }

        textarea {
            width: 92%;
            resize: none;
        }

        #botones {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            gap: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        a:link,
        a:visited,
        a:active {
            text-decoration: none;
            margin: 10px;
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        a:hover {
            opacity: 80%;
        }

        #foto {
            width: 300px;
            margin-left: 20px;
        }

        #error_msg {
            background-color: red;
            padding: 10px;
            border-radius: 8px;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        if (isset($_SESSION['error_msg'])) {
            echo "<p style='background-color: red; padding: 10px; border-radius: 8px;color:white'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
    } else {
        header("Location: cerrar_sesion.php");
    }
    ?>
    <form action="guardar_pelicula.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre">
        <label for="director">Director:</label>
        <input type="text" name="director">
        <label for="genero">Categoría:</label>
        <select name="genero">
            <?php
            require_once 'conexion_BD.php';
            $config = new Conexion_BD();
            $conexion = $config->getConexion();
// Mostramos todas las productoras que hay en nuestra base de datos.
            $stmt = $conexion->prepare('SELECT DISTINCT Categoria FROM peliculas');
            $stmt->execute();
            while ($fila = $stmt->fetch()) {
                echo "<option>" . $fila['Categoria'] . "</option>";
            }
            ?>
        </select>
        <label for="productora">Productora:</label>
        <select name="productora">
            <?php
            require_once 'conexion_BD.php';
            $config = new Conexion_BD();
            $conexion = $config->getConexion();
// Mostramos todas las productoras que hay en nuestra base de datos.
            $stmt = $conexion->prepare('SELECT DISTINCT Productora FROM peliculas');
            $stmt->execute();
            while ($fila = $stmt->fetch()) {
                echo "<option>" . $fila['Productora'] . "</option>";
            }
            ?>
        </select>
        <label for="sinopsis">Sinopsis</label>
        <textarea name="sinopsis" id="sinopsis" cols="30" rows="10"></textarea>
        <label for="cartel">Imagen cartel</label>
        <input type="file" name="cartel" id="cartel">
        <label for="anioEstreno">Año de estreno</label>
        <input type="number" name="anioEstreno" minlength="4" maxlength="4">
        <div id="botones">
            <input type="submit" value="Guardar">
            <input type="reset" value="Limpiar">
        </div>
    </form>

    <a href="catalogo.php">Volver</a>

    <img src="" alt="" id="foto">

    <script>
        document.getElementById('cartel').onchange = function() {
            var reader = new FileReader();
            document.getElementById("foto").style.width = "300px";
            reader.onload = function(e) {
                document.getElementById("foto").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>

</html>