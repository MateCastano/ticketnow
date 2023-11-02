<?php session_start();

    if(($_SESSION['membresia']) == "Administrador" && $_SESSION['loggedIn'] == true)
    {
        
        header("Location: ../private/admin.php");
    }
    else
    {
        header("Location: ../public/login.php");
    }
    ?>
</body>
</html>