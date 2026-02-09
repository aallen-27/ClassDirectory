<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Forum Posting</title>
    </head>
    <body>
        <!-- Script 5.2 - handle_post.php -->
        <?php
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $posting = nl2br(htmlentities($_POST['posting'], false));

            $name = htmlentities($first_name . ' ' . $last_name);

            print "<div>Thank you, $name, for your posting: 
                <p>$posting</p></div>";
            
            // Make a link to another page:
        $name = urlencode($name);
        $email = urlencode($_POST['email']);
        print "<p>Click <a href=\"thanks.php?name=$name&email=$email\">here</a> to continue.</p>";
        ?>
    </body>
</html>
