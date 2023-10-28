<?php
require '../public/conection.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $id = $_POST["id"];
    echo "ID del registro a eliminar: " . $id;

    
    $query = "DELETE FROM recital WHERE id = $id";

    if (mysqli_query($conection, $query)) { 
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conection);
    }
}


header("Location: ../private/admin.php");
?>