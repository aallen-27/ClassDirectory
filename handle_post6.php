<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Forum Posting</title>
    </head>
    <body>
        <?php
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $posting = trim($_POST['posting']);

            $name = $first_name . ' ' . $last_name;

            // Get a word count
            $words = str_word_count($posting);

            // Trim the posting to a snippet
            $posting = str_ireplace('badword', 'XXXXXXX', $posting);

            print "<div>Thank you, $name, for your posting: 
                <p>$posting...</p>
                <p>($words words)</p></div>";
        ?>
    </body>
</html>
