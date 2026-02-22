<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
    </head>
    <body>
        <h1>Registration Results</h1>
        <?php // Script 6.2 - handle_reg.php
            /* This script recieves seven values from register.html: 
             email, password, confirm, year, terms, color, submit */
            
            ini_set('display_errors', 1);

            //Flag variable to track success:
            $okay = true;

            // If there were no errors, print a success message:
            if ($okay) {
                print '<p> you have been successfully registered (but not really)</p>';
            }
        ?>
    </body>
</html>
