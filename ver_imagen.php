<?php
//Comprobamos que se haya enviado la imagen, si es asi la descodificamos y la mostramos.
if (isset($_POST['imagen'])) {
    header('Content-Type: image/jpeg');
    echo base64_decode($_POST['imagen']);
} else {
    header("Location: ../catalogo.php");
    exit;
}
?>