<?php
    include("../public/conection.php"); 
    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $consulta = mysqli_query($conection, "SELECT * from usuarios where email = '$email'");
    
    if(mysqli_num_rows($consulta) > 0)
    {
        include("../public/register.php");
        ?>
            <h1 style="color:red;text-align:center;margin-top:12px">Mail already registred !</h1>
        <?php
        
    }
    else
    {
        $consulta = mysqli_query($conexionMOC, "INSERT INTO usuarios (nombre, apellido, email, username, password, newsletter, categoria) VALUES('$name','$surname','$email', '$username', '$password', 'Suscriptor')");
        include("index.html");
        ?>
            <h1 style="color:green;text-align:center;margin-top:12px">User registred !</h1>
        <?php
        
    }
    mysqli_close($conexionMOC);
?>