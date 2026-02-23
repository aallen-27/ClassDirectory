<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>No Soup for You!</title>
    </head>
    <body>
        <h1>Mmmm...Soups</h1>
        <?php // Script 7.2 - soups2.php
            $soups = [ 
                'Sunday' => 'Tomato',
                'Monday' => 'Clam Chowder',
                'Tuesday' => 'White Chicken',
                'Wednesday' => 'Vegetarian',
            ];
            
            $count1 = count($soups);
            print "<p>The soups array originally had $count1 elements.</p>";

            // Add three items 
            $soups['Thursday'] = 'Egg drop';
            $soups['Friday'] = 'Chicken Noodle';
            $soups['Saturday'] = 'Cream of Broccoli';

            $count2 = count($soups);
            print "<p>After adding 3 more soups, the array now has $count2 elements</p>";

            print_r($soups);
        ?>
    </body>
    </html>
