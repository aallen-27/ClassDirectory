<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pass Hash</title>
    </head>
    <body>
        <?php
            $password = "helloclass";
            $hashed_password = password_hash($passwor, PASSWORD_DEFAULT);
            echo $hashed_password;
        ?>
    </body>
</html>
