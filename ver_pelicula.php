<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        if (isset($_POST['id'])) {
            $pelicula_id = $_POST['id'];
            require_once 'conexion_BD.php';
            $config = new Conexion_BD();
            $conexion = $config->getConexion();
            $stmt = $conexion->prepare('SELECT * FROM peliculas WHERE id = :ID');
            $stmt->bindParam(':ID', $pelicula_id);
            $stmt->execute();
            while ($fila = $stmt->fetch()) {
                $cartel = $fila['Imagen'];
                $nombre = $fila['Nombre_Pelicula'];
                $director = $fila['Director'];
                $genero = $fila['Categoria'];
                $productora = $fila['Productora'];
                $sinopsis = $fila['Sinopsis'];
                $anioEstreno = $fila['AnioEstreno'];
            }
            //Aqui lo que hago es que el titulo de la pagina sea el nombre de la pelicula en concreto.
            echo "<title>" . $nombre . "</title>";
        }
    } else {
        header("Location: login.php");
    }
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightslategray;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .pelicula-container {
            width: 40%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: justify;
        }

        .pelicula-container img {
            width: 50%;
            border-radius: 5px;
            margin-bottom: 20px;
            margin: auto;
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .etiqueta {
            font-weight: bold;
        }

        .info {
            margin-bottom: 15px;
        }

        .sinopsis {
            font-size: 18px;
            line-height: 1.6;
        }

        a:link,
        a:visited,
        a:active {
            text-decoration: none;
            font-variant: normal;
            border: 1px solid lightslategray;
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
    </style>
</head>

<body>
    <div class="pelicula-container">
        <?php
        echo '<img src="data:image/jpeg' . ';base64,' . base64_encode($cartel) . '" alt="' . $nombre . '">';
        ?>
        <div class="info">
            <div class="titulo"><?php echo $nombre ?></div>
            <div><span class="etiqueta">Director:</span> <?php echo $director ?></div>
            <div><span class="etiqueta">Género:</span> <?php echo $genero ?></div>
            <div><span class="etiqueta">Productora:</span> <?php echo $productora ?></div>
            <div><span class="etiqueta">Año de estreno:</span> <?php echo $anioEstreno ?></div>
        </div>
        <div class="sinopsis">
            <div class="etiqueta">Sinopsis:</div>
            <?php echo $sinopsis ?>
        </div>
    </div>
    <a href="/tr1-pr1-FernandezIvan/catalogo.php">Volver</a>
</body>

</html>