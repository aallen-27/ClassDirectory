<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add an Event</title>
    </head>
    <body>
        <?php // Script 7.9 - event.php
            print "<p>You want to add an event called <b>{$_POST['name']} </b> which takes place on: <br>";

            if (isset($_POST['days']) AND is_array($_POST['days'])) {
                foreach ($_POST['days'] as $day) {
                    print "$day<br>\n";
                }
            } else {
                print 'Please select at least one weekday for this event!';
            }

            print '</p>';
        ?>
    </body>
</html>
