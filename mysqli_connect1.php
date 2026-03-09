<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Connect to MySQL</title>
    </head>
    <body>
        <?php // Script 12.1 mysqli_connect.php
            // Store the password in a file so that it is not available in GitHub
            $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
            $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));

            // connect to the database
            if ($dbc = mysqli_connect('localhost', 'root', "$password", 'myblog')) {
                print '<p>Successfully connected to the database!</p>';
                mysqli_close($dbc);
            } else {
                print '<p style="color: red;">Could not connect to the database.</p>';
            }
        ?>
    </body>
</html>
