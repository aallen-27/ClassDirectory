<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>No Soup for You!</title>
    </head>
    <body>
        <h1>Mmmm...Soups</h1>
        <?php // Script 7.3 - soups3.php
            $soups = [ 
                'Sunday' => 'Tomato',
                'Monday' => 'Clam Chowder',
                'Tuesday' => 'White Chicken',
                'Wednesday' => 'Vegetarian',
                'Thursday' => 'Egg drop',
                'Friday' => 'Chicken Noodle',
                'Saturday' => 'Miso'
            ];
            
            foreach ($soups as $day => $soup) {
                print "<p>$day: $soup</p>\n";
            }

        ?>
    </body>
    </html>
