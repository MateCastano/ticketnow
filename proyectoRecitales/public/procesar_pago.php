<?php
    include("../public/conection.php"); 
   

    echo "Compra realizada con exito!";


    $payment = $_GET['payment_id'];
    $status = $_GET['status'];
    $payment_type = $_GET['payment_type'];
    $order_id = $_GET['merchant_order_id'];

    echo $payment . '<br>';
    echo $status .'<br>';
    echo $payment_type . '<br>';
    echo $order_id .'<br>';


    /* ($_SERVER["REQUEST_METHOD"] == "POST") {
        $metodo_pago = $_POST["metodo_pago"];
        $tipo_entrada = $_POST["tipo_entrada"];
        $cantidad_entradas = $_POST["cantidad_entradas"];
        $precio = $_POST["precio"];
        $estadio_id = $_POST['estadio_id'];
        
        
        $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE id = '" . $estadio_id . "'");
        $estadio = mysqli_fetch_assoc($consultaEstadio);
   

        
        if ($estadio[$tipo_entrada] >= $cantidad_entradas) {
            
            $nueva_capacidad = $estadio[$tipo_entrada] - $cantidad_entradas;

            
            mysqli_query($conection, "UPDATE estadio SET $tipo_entrada = $nueva_capacidad WHERE id = '" . $estadio['id'] . "'");

            echo "Compra realizada con exito!";

        } 
    }*/
?>