<?php
require '../public/conection.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $id = $_POST["id"];
    echo "ID del registro a eliminar: " . $id;

    $query2 = "DELETE FROM entrada WHERE recital_id = $id";
    $query = "DELETE FROM recital WHERE id = $id";
    

    if (mysqli_query($conection, $query2)) {
        $query = "DELETE FROM recital WHERE id = $id";

        if (mysqli_query($conection, $query)) {
            echo "Registro eliminado exitosamente.";
        } else {
            echo "Error al eliminar el registro: " . mysqli_error($conection);
        }
    } else {
        echo "Error al eliminar registros relacionados: " . mysqli_error($conection);
    }
}


header("Location: ../private/admin.php");
?>