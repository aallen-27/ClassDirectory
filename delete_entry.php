<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Delete a Blog Entry</title>
    </head>
    <body>
        <?php // Script 12.7 delete_entry
            // SQL seems finicky, so this might be necessary until the book goes over better solutions.
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            // Store the password in a file so that it is not available in GitHub
            $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
            $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));
            
            // connect to the database
            $dbc = mysqli_connect('localhost', 'root', "$password", 'myblog');
            
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {

                // Create a query
                $query = "SELECT title, entry FROM entries WHERE id={$_GET['id']}";

                // Run the query
                if ($r = mysqli_query($dbc, $query)) {
                    $row = mysqli_fetch_array($r); // Retrieve the information.

                    // Make the form:
                    print '<form action="delete_entry.php" method="post">
                            <p>Are you sure you want to delete this entry?</p>
                            <p><h3>' . $row['title'] . '</h3>' .
                            $row['entry'] . '<br>
                            <input type="hidden" name="id" value="' . $_GET['id'] . '">
                            <input type="submit" name="submit" value="Delete this Entry!"></p>
                            </form>';
                } else {
                    print '<p style="color: red;">Could not retrieve the blog entry because:<br>' .
                        mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                }
            } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
                // Define the query:
                $query = "DELETE FROM entries WHERE id={$_POST['id']} LIMIT 1";
                $r = mysqli_query($dbc, $query);

                // Report on the result:
                if (mysqli_affected_rows($dbc) == 1) {
                    print '<p>The blog entry has been deleted.</p>';
                } else {
                    print '<p style="color: red;">Could not delete the blog entry because:<br>' .
                        mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                }

            } else { // No ID received.
                print '<p style="color: red;">This page has been accessed in error.</p>';
            } // End of main IF.

            // Close the connection
            mysqli_close($dbc);
        ?>
    </body>
</html>
