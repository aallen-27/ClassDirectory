<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Create a Table</title>
    </head>
    <body>
        <?php
            // SQL seems finicky, so this might be necessary until the book goes over better solutions.
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            // Store the password in a file so that it is not available in GitHub
            $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
            $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));
            
            // connect to the database
            if ($dbc = @mysqli_connect('localhost', 'root', "$password", 'myblog')) {

                // Create a query
                $query = 'CREATE TABLE entries (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            title VARCHAR(100) NOT NULL, entry TEXT NOT NULL, 
                            date_entered DATETIME NOT NULL ) CHARACTER SET utf8';

                // Run the query
                if (@mysqli_query($dbc, $query)) {
                    print '<p> The table has been created!</p>';
                } else {
                    print '<p style="color: red;">Could not create the table because:<br>' .
                        mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                }

                // Close the connection
                mysqli_close($dbc);
            } else {
                print '<p style="color: red;">Could not connect to the database.<br>' . 
                    mysqli_connect_error() .'</p>';
            } 
        ?>
    </body>
</html>
