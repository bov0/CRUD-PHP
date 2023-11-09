<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de peliculas</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: lightslategray;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .logo {
            font-size: 2em;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 10px;
        }

        nav ul li a {
            color: whitesmoke;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: yellow;
        }

        #contenedor {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            gap: 10%;
        }

        .pelicula {
            border: 1px solid #ddd;
            background-color: whitesmoke;
            border-radius: 5px;
            padding: 10px;
            width: 20%;
            margin-top: 3%;
            margin-bottom: 3%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 5px;
        }

        #botones {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            opacity: 80%;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Catalogo de peliculas</div>
        <nav>
            <ul>
                <?php
                session_start();
                if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
                    if ($_SESSION['Rol'] === 'administrador') {
                        echo '<li><a href="alta_pelicula.php">Añadir película</a></li>';
                    }
                    echo '<li><a href="cerrar_sesion.php">Cerrar sesión</a></li>';
                } else {
                    header("Location: login.php");
                }
                ?>
            </ul>
        </nav>
    </header>
    <div id="contenedor">
        <?php
        require_once 'conexion_BD.php';
        $config = new Conexion_BD();
        $conexion = $config->getConexion();
        $stmt = $conexion->prepare('SELECT * FROM peliculas');
        $stmt->execute();
        while ($fila = $stmt->fetch()) {
            echo '<div class="pelicula">';
            echo '<img src="data:image/jpeg' . ';base64,' . base64_encode($fila['Imagen']) . '" alt="' . $fila['Nombre_Pelicula'] . '">';
            echo '<h3>' . $fila['Nombre_Pelicula'] . '</h3>';
            echo '<p><strong>Categoría:</strong> ' . $fila['Categoria'] . '</p>';
            echo '<div id="botones">';
            echo "<form action='ver_pelicula/{$fila['ID']}' method='post'>
            <input type='hidden' name='id' value='" . $fila['ID'] . "'>
            <button type='submit' id='ver_mas' name='ver_mas'>Ver más</button>
            </form>";
            echo "<form action='ver_imagen./{$fila['ID']}' method='post'>
            <input type='hidden' name='imagen' value='" . base64_encode($fila['Imagen']) . "'>
            <button type='submit'>Ver Imagen</button>
            </form>";
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>