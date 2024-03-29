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

    <script src="https://sdk.mercadopago.com/js/v2" locale="es"> </script>


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
        include("../phpqrcode/qrlib.php");
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    
        session_start();

   

        $payment = $_GET['payment_id'];
        $payment_type = $_GET['payment_type'];

        
            $tipo_entrada = $_SESSION['tipo_entrada'];
            $cantidad_entradas = $_SESSION['cantidad_entradas'];
            $estadio_id = $_SESSION['estadio_id'];
            $precio = $_SESSION['precioEntrada'];
            $recital_id =  $_SESSION['recital_id'];
            $usuario_id = $_SESSION['id'];
            
            $email = $_SESSION["email"];
            $usuario["nombre"]   = $_SESSION["nombre"];
            $usuario["apellido"] = $_SESSION["apellido"];
            $usuario["username"] = $_SESSION["username"];

            
            require '../vendor/autoload.php';
            
            
                      
                        $mail = new PHPMailer();
            
                        $mail->isSMTP();     
                        
                        $mail->Host = 'smtp.gmail.com';           
                        $mail->Port = 465;        
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->SMTPAuth = true;
            
                        
                        $mail->Username = 'webticketnow@gmail.com';
                        $mail->Password = 'ewiz kzsu aydr ntjx';
                      
                        $mail->setFrom('webticketnow@gmail.com', 'TicketNow');           
                        $mail->addAddress($email);     
                        
                        $mail->isHTML(true);
                        $mail->Subject = 'Tus eTickets!';
            
                        
                       
            
                        
                        
            
                        
            
                       
                        
            
                        
                        
            
            
            $consultaRecital = mysqli_query($conection, "SELECT * FROM recital WHERE id = '" . $recital_id . "'");
            $recital = mysqli_fetch_assoc($consultaRecital);
    

            
            if ($recital[$tipo_entrada] >= $cantidad_entradas) {
                
                $nueva_capacidad = $recital[$tipo_entrada] - $cantidad_entradas;

                
                mysqli_query($conection, "UPDATE recital SET $tipo_entrada = $nueva_capacidad WHERE id = '" . $recital['id'] . "'");

                $mail->Body = "<h2>Hola $usuario[nombre]! Acá están los detalles de tus eTickets: </h2>";

                $cont = 0;
                while ($cont < $cantidad_entradas) {
                    $consulta = mysqli_query($conection, "INSERT INTO entrada (recital_id, usuario_id, precio, sector) VALUES ('$recital_id', '$usuario_id', '$precio','$tipo_entrada')");
                
                    if (!$consulta) {
                        die("Error al insertar entrada en la base de datos: " . mysqli_error($conection));
                    }
                
                    
                    $nueva_entrada_id = mysqli_insert_id($conection);
                
                    
                    $consulta_seleccion = mysqli_query($conection, "SELECT * FROM entrada WHERE id = '$nueva_entrada_id'");
                
                    if (!$consulta_seleccion) {
                        die("Error al seleccionar entrada de la base de datos: " . mysqli_error($conection));
                    }
                
                    $entrada = mysqli_fetch_assoc($consulta_seleccion);
                
                    $nueva_entrada_id = $entrada['id'];
                    
                    
                    


                    $datos_qr = "Entrada ID: $nueva_entrada_id ";  
                    $nombre_qr = "entrada_$nueva_entrada_id.png";
                    $ruta_qr = '../images/qrs/'.$nombre_qr;
                  
                    QRcode::png($datos_qr, $ruta_qr);
                        
                    
                    mysqli_query($conection, "UPDATE entrada SET ruta_qr = '$ruta_qr' WHERE id = '$nueva_entrada_id'");



                    $mail->addAttachment($ruta_qr, "entrada_$nueva_entrada_id.png", "base64", "image/png");

                    $mail->Body .= "
                        <p><strong>Nº Ticket:</strong> # $nueva_entrada_id</p>
                        <p><strong>Artista:</strong> $recital[artista]</p>
                        <p><strong>Precio:</strong> $precio</p>
                        <p><strong>Sector:</strong> $tipo_entrada</p>
                        
                        <hr>"; 
                
                    $cont++;
                }
                
               
               
            

        
                
               
            
                

                echo '<div class="compra-realizada">';
                echo '<p>ID de la operación: <span>'.$payment.'</span></p>';
                echo '<p>Estado: <span>Aprobado</span></p>';
                echo '<h3>Compra realizada con exito! Puedes visualizar tus entradas en "Mi Cuenta".</h3>';
                echo '<a href="../public/account.php"><button class="buttom">Ir a Mi Cuenta</button></a>';
                echo '</div>';
                
                
               

                
                

         } 

         $mail->Body .= "<p>Gracias por tu compra!</p>";
         $mail->AltBody = "Gracias por confiar!";
         if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
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