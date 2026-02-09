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

            // Get a word count
            $words = str_word_count($posting);

            // Trim the posting to a snippet
            $posting = substr($posting, 0, 50);

            print "<div>Thank you, $name, for your posting: 
                <p>$posting...</p>
                <p>($words words)</p></div>";
        ?>
    </body>
</html>
