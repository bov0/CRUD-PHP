<?php
session_start();
if (isset($_SESSION['usuario'])) {
    if (isset($_POST['nombre'], $_POST['director'], $_POST['genero'], $_POST['productora'], $_POST['sinopsis'], $_POST['anioEstreno'])) {
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $genero = $_POST['genero'];
        $productora = $_POST['productora'];
        $sinopsis = $_POST['sinopsis'];
        $anioEstreno = $_POST['anioEstreno'];

        if (!empty($nombre) && !empty($director) && !empty($genero) && !empty($productora) && !empty($sinopsis) && !empty($anioEstreno)) {
            if (isset($_FILES['cartel']) && $_FILES['cartel']['tmp_name']) {
//Comprobamos que el tamaño sea menor a este ya que blob solo acepta hasta 65535 bytes
                if ($_FILES['cartel']['size'] < 65535) {
                    $nombreDirectorio = "./imagenes/";
                    $nombreFichero = str_replace(' ', '', $_FILES['cartel']['name']);
                    $tipo = $_FILES['cartel']['type'];
// Comprobamos que el tipo de imagen introducido sea valido, tambien sirve para otro tipo de ficheros distintos a estos como pdf,doc,etc...
                    if ($tipo != 'image/png' && $tipo != 'image/jpeg' && $tipo != 'image/jpg') {
                        $_SESSION['err'] = "Archivo " . $_FILES['cartel']['name'] . " no es una imagen";
                        header("Location: catalogo.php");
                        exit;
                    } else {
//Is dir indica si la variable directorio que tenemos es un directorio, en este caso si lo es creamos un string junto al nombre del fichero.
                        if (is_dir($nombreDirectorio)) {
                            $nombreCompleto = $nombreDirectorio . $nombreFichero;
//Cambiamos el nombre de la imagen temporal a su nombreCompleto gracias a move_uploaded_file que funciona parecido a mv en linux.
                            if (move_uploaded_file($_FILES['cartel']['tmp_name'], $nombreCompleto)) {
                                require_once 'conexion_BD.php';
                                $config = new Conexion_BD();
                                $conexion = $config->getConexion();
//Abrimos en este caso la url de la imagen gracias a haber juntado nombreDirectorio con nombreFichero.
                                $imagen = fopen($nombreCompleto, 'rb');
                                $stmt = $conexion->prepare('INSERT INTO peliculas (Nombre_Pelicula, Categoria, Productora, Director, Sinopsis, Nombre_Imagen, Imagen, AnioEstreno) VALUES (:nombre, :genero, :productora, :director, :sinopsis, :nombre_imagen, :imagen, :anioEstreno)');
                                $stmt->bindParam(':nombre', $nombre);
                                $stmt->bindParam(':genero', $genero);
                                $stmt->bindParam(':productora', $productora);
                                $stmt->bindParam(':director', $director);
                                $stmt->bindParam(':sinopsis', $sinopsis);
                                $stmt->bindParam(':nombre_imagen', $nombreFichero);
                                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                                $stmt->bindParam(':anioEstreno', $anioEstreno);
                                $stmt->execute();
//Cerramos la imagen.
                                fclose($imagen);
                                header("Location: catalogo.php");
                                exit;
                            }
                        }
                    }
//Mensajes de error para que sepa el usuario que falla con su formulario.
                } else {
                    $_SESSION['error_msg'] = "La imagen es demasiado grande";
                    header("Location: alta_pelicula.php");
                    exit;
                }
            } else {
                $_SESSION['error_msg'] = "No se ha podido subir la imagen o no se seleccionó ninguna";
                header("Location: alta_pelicula.php");
                exit;
            }
        } else {
            $_SESSION['error_msg'] = "Faltan parámetros";
            header("Location: alta_pelicula.php");
            exit;
        }
    }
} else {
    header("Location: cerrar_sesion.php");
    exit;
}
