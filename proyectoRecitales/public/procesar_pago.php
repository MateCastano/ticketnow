<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../images/logo.png">

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
        

        echo '<div class="compra-realizada">';
        echo '<h3>Compra realizada con exito!</h3>';
        echo '<button class="buttom">Volver a el catalogo</button>';
        echo '</div>';
        
        
            $tipo_entrada = $_SESSION['tipo_entrada'];
            $cantidad_entradas = $_SESSION['cantidad_entradas'];
            $estadio_id = $_SESSION['estadio_id'];
            $precio = $_SESSION['precioEntrada'];
            $recital_id =  $_SESSION['recital_id'];
            $usuario_id = $_SESSION['id'];
 
            $consultaRecital = mysqli_query($conection, "SELECT * FROM recital WHERE id = '" . $recital_id . "'");
            $recital = mysqli_fetch_assoc($consultaRecital);
    

            
            if ($recital[$tipo_entrada] >= $cantidad_entradas) {
                
                $nueva_capacidad = $recital[$tipo_entrada] - $cantidad_entradas;

                
                mysqli_query($conection, "UPDATE recital SET $tipo_entrada = $nueva_capacidad WHERE id = '" . $recital['id'] . "'");

                 
                $cont = 0;
                while ($cont < $cantidad_entradas) {
                    $consulta = mysqli_query($conection, "INSERT INTO entrada (recital_id, usuario_id, precio, sector) VALUES ('$recital_id', '$usuario_id', '$precio','$tipo_entrada')");
                    $cont++;
                }

                

                /*require "../phpqrcode/qrlib.php";    
	
                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'temp/';
                
                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);
                
                    //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'test.png';

                    //Parametros de Condiguración
                
                $tamaño = 10; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 3; //Tamaño en blanco
                $contenido = $recital_id; //Texto
                
                    //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
                
                    //Mostramos la imagen generada
                echo '<img src="'.$dir.basename($filename).'" /><hr/>';  
            
                */
                
                 
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