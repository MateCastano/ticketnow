<?php
    include("../public/conection.php");

    $name = $_POST['nombre'];
    $surname = $_POST['apellido'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $user_message = $_POST['user_message'];

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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
            $mail->addAddress('danteleivas01@gmail.com'); // MAIL DESTINATARIO
            
            $mail->isHTML(true);
            $mail->Subject = 'Mensaje desde el formulario de contacto';

            
            $mail->Body = "
                
                    <p><strong>Mensaje:</strong> $user_message</p>
                    <p><strong>Nombre:</strong> $name</p>
                    <p><strong>Apellido:</strong> $surname</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Usuario:</strong> $username</p>
                    
                
            ";

            
            $mail->AltBody = "Nombre: $name\nApellido: $surname\nEmail: $email\nUsuario: $username\nMensaje: $user_message";

            

           
            

            
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } 


    

    $consulta = mysqli_query($conection, "INSERT INTO contacto values(0,'$name','$surname','$email', '$username', '$user_message')");

    header("Location: ../public/contacto.php");
?>