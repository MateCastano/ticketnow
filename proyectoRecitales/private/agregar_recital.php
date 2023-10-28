<?php

require("../public/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artista = $_POST['artista'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombre_estadio = $_POST['estadio'];

    
    $consultaEstadio = mysqli_query($conection, "SELECT id FROM estadio WHERE nombre = '$nombre_estadio'");
    
    if ($consultaEstadio) {
        $estadio = mysqli_fetch_assoc($consultaEstadio);
        $estadio_id = $estadio['id'];

        // Manejar la subida de la imagen
        $imagen_publicidad = $_FILES['imagen_publicidad']['name'];
        $imagen_temporal = $_FILES['imagen_publicidad']['tmp_name'];
        $carpeta_destino = '../images/' . $imagen_publicidad;
        
        if (move_uploaded_file($imagen_temporal, $carpeta_destino)) {
            
            // Insertar datos en la tabla recital
            $consulta = mysqli_query($conection, "INSERT INTO recital (artista, fecha, hora, estadio_id, imagen_publicidad) VALUES ('$artista', '$fecha', '$hora', $estadio_id, '$imagen_publicidad')");


            
            if ($consulta) {
                Header("Location: ../private/admin.php ");
            } else {
                echo "Error al insertar recital: " . mysqli_error($conection);
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Error al consultar la base de datos.";
    }

    mysqli_close($conection);
}
?>