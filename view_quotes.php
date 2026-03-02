<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>View A Quotation</title>
    </head>
    <body>
        <h1>Random Quotation</h1>
        <?php // Script 11.3 - view_quote.php
            $data = file('/opt/lampp/htdocs/quotes.txt');

            $n = count($data);

            $rand = rand(0, ($n - 1));
            print '<p>' . trim($data[$rand]) . '</p>';

        ?>
    </body>
</html>
