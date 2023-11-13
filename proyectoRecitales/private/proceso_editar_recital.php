<?php

require("../public/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artista = $_POST['artista'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombre_estadio = $_POST['estadio'];
    $precio = $_POST['precio'];
    $id = $_POST["id"];
    
    $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE nombre = '$nombre_estadio'");
    
    if ($consultaEstadio) {
        $estadio = mysqli_fetch_assoc($consultaEstadio);
        $estadio_id = $estadio['id'];


        $platea = $estadio['platea'];
        $campo = $estadio['campo'];
        $vip = $estadio['vip'];


        // Manejar la subida de la imagen
        $imagen_publicidad = $_FILES['imagen_publicidad']['name'];
        $imagen_temporal = $_FILES['imagen_publicidad']['tmp_name'];
        $carpeta_destino = '../images/' . $imagen_publicidad;
        
        
            
            

        $consulta = mysqli_query($conection, "UPDATE recital SET artista = '$artista', fecha = '$fecha' , hora = '$hora', estadio_id = $estadio_id, precio = '$precio', platea = '$platea' , campo = '$campo' , vip = '$vip' WHERE id = $id");


            
        if ($consulta) {
                Header("Location: ../private/admin.php ");
        }else{
                echo "Error al insertar recital: " . mysqli_error($conection);
            }
        
    } else {
        echo "Error al consultar la base de datos.";
    }

    mysqli_close($conection);
}
?>