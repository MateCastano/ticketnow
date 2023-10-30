<?php session_start();

    if(($_SESSION['loggedIn']) == true)
    {
        header("Location: ../public/account.php");
    }
    else
    {
        header("Location: ../public/login.php");
    }
    ?>
</body>
</html>