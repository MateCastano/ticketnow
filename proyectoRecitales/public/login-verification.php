<?php 
include("../public/conection.php"); 
session_start();

    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $resultado = mysqli_query($conection, "SELECT * FROM usuarios WHERE email = '$email'");

    if(mysqli_num_rows($resultado))
    {
        $usuario = mysqli_fetch_array($resultado);
        if(strcmp($password,$usuario["password"])===0)
        {
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["apellido"] = $usuario["apellido"];
            $_SESSION["username"] = $usuario["username"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["categoria"] = $usuario["categoria"];
            $_SESSION["loggedIn"] = $usuario[true];  

            if($usuario["categoria"] == "Administrador")
            {
                Header("Location: panelMOC.php");
            }
            else
            {
            include("../public/index.php");
                ?>
                    <h1 style="color:green;text-align:center;margin-top:12px">User login !</h1>
                <?php        
            }
        }
        else
        {
            include("../public/login.php");
            ?>
                <h1 style="color:red;text-align:center;margin-top:12px">Incorrect password !</h1>
            <?php
        }
    }
    else
    {
        include("index.php");
        ?>
            <h1 style="color:red;text-align:center;margin-top:12px">This user does not exist !</h1>
        <?php
    }

    mysqli_free_result($resultado);
    mysqli_close($conection);
?>