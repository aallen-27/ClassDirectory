<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>No Soup for You!</title>
    </head>
    <body>
        <h1>Mmmm...Soups</h1>
        <?php // Script 7.1 - soups1.php
            $soups = [ 
                'Sunday' => 'Tomato',
                'Monday' => 'Clam Chowder',
                'Tuesday' => 'White Chicken',
                'Wednesday' => 'Vegetarian',
                'Thursday' => 'Egg drop',
                'Friday' => 'Chicken Noodle',
                'Saturday' => 'Miso'
            ];
            print "<p>$soups</p>";
            print_r($soups);
        ?>
    </body>
    </html>
