<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>View my Blog</title>
    </head>
    <body>
        <?php // Script 12.6 view_entries.php
            // SQL seems finicky, so this might be necessary until the book goes over better solutions.
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            // Store the password in a file so that it is not available in GitHub
            $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
            $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));
            
            // connect to the database
            $dbc = mysqli_connect('localhost', 'root', "$password", 'myblog');

            // Create a query
            $query = 'SELECT * FROM entries ORDER BY date_entered DESC';

            // Run the query
            if ($r = @mysqli_query($dbc, $query)) {
                //Retrieve and print every record:
                while ($row = mysqli_fetch_array($r)) {
                    print "<p><h3>{$row['title']}</h3>
                        {$row['entry']}<br>
                        <a href=\"edit_entry.php?id={$row['id']}\">Edit</a>
                        <a href=\"delete_entry.php?id={$row['id']}\">Delete</a>
                        </p><hr>\n";
                }
            } else {
                print '<p style="color: red;">Could not retrieve the data because because:<br>' .
                    mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
            }

            // Close the connection
            mysqli_close($dbc);
        ?>
    </body>
</html>
