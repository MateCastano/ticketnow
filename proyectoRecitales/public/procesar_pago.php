<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">

    <title>TicketNow</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>


</head>

<body>
   

    <header class="header">
            <a class="header-logo" href="../public/index.php">
                <img href="../public/index.php" src="../images/logo.png" alt="inicio">
                </a>
            
                <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/nosotros.php">Nosotros</a></li>
                    <li><a href="../public/contacto.php">Contacto</a></li>
                    <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                    
                </ul>
            </nav>       
            
    </header>
    <main>                   
    <?php
        include("../public/conection.php"); 
    
        session_start();

        


        $payment = $_GET['payment_id'];
        $status = $_GET['status'];
        $payment_type = $_GET['payment_type'];
        

        echo $payment . '<br>';
        echo $status .'<br>';
        echo $payment_type . '<br>';
       

        
        
    

        
            
            $tipo_entrada = $_SESSION['tipo_entrada'];
            $cantidad_entradas = $_SESSION['cantidad_entradas'];
            $estadio_id = $_SESSION['estadio_id'];
            $precio = $_SESSION['precioEntrada'];
            $recital_id =  $_SESSION['recital_id'];
            $usuario_id = $_SESSION['id'];
            
            
            
            $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE id = '" . $estadio_id . "'");
            $estadio = mysqli_fetch_assoc($consultaEstadio);
    

            
            if ($estadio[$tipo_entrada] >= $cantidad_entradas) {
                
                $nueva_capacidad = $estadio[$tipo_entrada] - $cantidad_entradas;

                
                mysqli_query($conection, "UPDATE estadio SET $tipo_entrada = $nueva_capacidad WHERE id = '" . $estadio['id'] . "'");

                 
                $cont = 0;
                while ($cont < $cantidad_entradas) {
                    $consulta = mysqli_query($conection, "INSERT INTO entrada (recital_id, usuario_id, precio, sector) VALUES ('$recital_id', '$usuario_id', '$precio','$tipo_entrada')");
                    $cont++;
                }
                
                echo "Compra realizada con exito!";
                

            } 

            
    
    ?>

    </main>

    <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/nosotros.php">Nosotros</a></li>
                    <li><a href="../public/contacto.php">Contacto</a></li>
                    <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                    <?php 

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                            echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';  
                        }
                        
                    ?>
                </ul>
            </nav>
        </div>

    </footer>
    
</body>
</html>