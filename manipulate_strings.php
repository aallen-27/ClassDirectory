<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Manipulate Strings</title>
    </head>
    <body>
        <?php
            $document = "This is an example text used to test various string operations to see if they are practical";
            
            // Gets a substring from the document that only includes the word 'test' and all of the words after it.
            $second_half = strstr($document, "test"); 

            //Super sketchy way to get the first half of the string by erasing the second half.
            //Avoid at all costs, due to the fact that it reads through the entire string, 
            //  can fail if the seconds half is small and repeated, 
            //  and that strstr() has an argument that can do the same thing easily. 
            //This is only to show it is possible
            $first_half = str_replace($second_half, '', $document); 

            // Compares the two halfs of the string to see which is longer
            $longer = strcmp($first_half, $second_half);

            //displays the results
            print "The first half of '$first_half' is longer than the second half '$second_half' if '$longer' is positive."
        ?>
    </body>
</html>
