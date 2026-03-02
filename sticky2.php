<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sticky Text Inputs</title>
    </head>
    <body>
        <?php // Script 10.2 - sticky1.php

            function make_text_input($name, $label, $size = 20) {
                print '<p><label>' . $label . ': ';

                print '<input type="text" name="' . $name . '" size="' . $size . '" ';

                if (isset($_POST[$name])) {
                    print ' value="' . htmlspecialchars($_POST[$name]) . '"';
                }

                print '></label></p>';

            }

            print '<form action="" method="post">';

            make_text_input('first_name', 'First Name');
            make_text_input('last_name', 'Last Name', 30);
            make_text_input('email', 'Email Address', 50);

            print '<input type="submit" name="submit" value="Register!"></form>';

        ?>
    </body>
</html>
