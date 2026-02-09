<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Random Number</title>
    </head>
    <body>
        <?php
            $rand = mt_rand(10, 100);
            print "The number '$rand' was randomly generated!";
        ?>
    </body>
</html>
