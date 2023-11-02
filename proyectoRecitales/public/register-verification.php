<?php
    include("../public/conection.php"); 
    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    $consulta = mysqli_query($conection, "SELECT * from usuarios where email = '$email'");
    
    if(mysqli_num_rows($consulta) > 0)
    {
        Header("Location: ../public/register.php ");
    }
    else
    {
        $consulta = mysqli_query($conection, "INSERT INTO usuarios (nombre, apellido, email, username, password, membresia) 
                                            VALUES('$name','$surname','$email', '$username', '$password', 'Suscriptor')");
        
        Header("Location: ../public/login.php ");
    }
    mysqli_close($conection);
?>