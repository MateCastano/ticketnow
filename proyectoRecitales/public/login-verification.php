<?php 
include("../public/conection.php"); 

    session_start();
    $email = $_POST["email"];
    $password = $_POST["password"];

    $resultado = mysqli_query($conection, "SELECT * FROM usuarios WHERE email = '$email'");

    if(mysqli_num_rows($resultado))
    {
        $usuario = mysqli_fetch_array($resultado);
        $hashPassword = $usuario["password"];

        if(password_verify($password, $hashPassword))
        {
            
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["apellido"] = $usuario["apellido"];
            $_SESSION["username"] = $usuario["username"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["membresia"] = $usuario["membresia"];
            $_SESSION["loggedIn"] = $usuario[true];
            $_SESSION["id"] = $usuario["id"];  

            if($usuario["membresia"] == "Administrador")
                {
                    Header("Location: ../private/admin.php");
                }
            else
            {
                Header("Location: ../public/index.php");     
            }
            }   
        else
        {
            header("Location: ../public/login.php?error-password=true");
        }
    }
    else
    {
        header("Location: ../public/login.php?error-mail=true");  
    }

    mysqli_free_result($resultado);
    mysqli_close($conection);
?>