<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Feedback Form</title>
    </head>
    <body>
        <?php // Script 3.3 handle_form.php
            
            ini_set('display_errors', 1); // Let me learn from my mistakes

            //Create shorthand versions of the variables:
            $title = $_POST['title'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $response = $_POST['response'];
            $comments = $_POST['comments'];

            //Print the recieved data:
            print "<p>Thank you, $title $fname $lname, for your comments.</p>
                <p> You stated that you found this example to be '$response' and added:<br>$comments</p>";
        ?>
    </body>

</html>
