<?php

    require_once 'scripts/php/db_login.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <title>Login</title>
    </head>

    <body>

        <form action="login.php" method="post">
        
            <div><input type="text" name="login" required/><label>Login</label></div>
            <div><input type="password" name="senha" required/><label>Senha</label></div>
            <div><input type="submit" value="entrar"/></div>

        </form>

    </body>
</html>