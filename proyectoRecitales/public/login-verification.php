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
            $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];
            $_SESSION["loggedIn"] = $usuario[true];  

            // if($usuario["categoria"] == "Administrador")
            // {
            //     Header("Location: panelMOC.php");
            // }
            // else
            // {
            include("../public/index.php");       
            //}
        }
        else
        {
            include("../public/login.php");
        }
    }
    else
    {
        include("../public/login.php");
        ?>
            <h1 style="color:red;text-align:center;margin-top:12px">Este mail no esta registrado</h1>
        <?php
    }

    mysqli_free_result($resultado);
    mysqli_close($conection);
?>