<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add a Blog Entry</title>
    </head>
    <body>
        <h1>Add a blog Entry</h1>
        <?php // Script 12.4 add_entry.php
            // SQL seems finicky, so this might be necessary until the book goes over better solutions.
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Store the password in a file so that it is not available in GitHub
                $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
                $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));
                $dbc = mysqli_connect('localhost', 'root', "$password", 'myblog');
                mysqli_set_charset($dbc, 'utf8');

                // Validate the form data:
                $problem = false;
                if (!empty($_POST['title']) && !empty($_POST['entry'])) {
                    $title_txt = trim(strip_tags($_POST['title']));
                    $title = mysqli_real_escape_string($dbc, $title_txt);

                    $entry_txt = trim(strip_tags($_POST['entry']));
                    $entry = mysqli_real_escape_string($dbc, $entry_txt);
                } else {
                    print '<p style="color: red;">Please submit both a title and an entry.</p>';
                    $problem = true;
                }
                
                if (!$problem) {
            
                    // Create a query
                    $query = "INSERT INTO entries (id, title, entry, date_entered)
                        VALUES (0, '$title', '$entry', NOW())";

                    // Run the query
                    if (@mysqli_query($dbc, $query)) {
                        print '<p>Blog entry has been added!</p>';
                    } else {
                        print '<p style="color: red;">Could not add the entry because:<br>' .
                            mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                    }
                } // End of problem check

                mysqli_close($dbc);
            } // End of form submission IF.
        ?>
        <form action="add_entry.php" method="post">
            <p>Entry Title: <input type="text" name="title" size="40" maxsize="100"></p>
            <p>Entry Text: <textarea name="entry" cols="40" rows="5"></textarea></p>
            <input type="submit" name="submit" value="Post This Entry!">
        </form>
    </body>
</html>
