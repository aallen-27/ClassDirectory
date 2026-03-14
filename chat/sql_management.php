<?php

function run_sql($query, $indb = true) {
    // Store the password in a file so that it is not available in GitHub
    $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
    $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));

    $dbc = $indb ? mysqli_connect('localhost', 'root', "$password", 'chat') : 
            mysqli_connect('localhost', 'root', "$password");

    if ($dbc) {
        // Run the query
        if (mysqli_query($dbc, $query)) {
            //print '<p>Successful execution of query ' . $query . '</p>';
        } else {
            print '<p class="err">Could not create the database because:<br>' .
                mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
        }

        // Close the connection
        mysqli_close($dbc);
    } else {
        print'<p class="err">Could not connect to the database.<br>' . 
            mysqli_connect_error() .'</p>';
    }
}

function sql_query($query) {
    // Store the password in a file so that it is not available in GitHub
    $passfile = fopen('/opt/lampp/data/sql_pass.txt', 'r');
    $password = trim(fread($passfile, filesize('/opt/lampp/data/sql_pass.txt')));

    $dbc = mysqli_connect('localhost', 'root', "$password", 'chat');

    $retval = null;
    if ($dbc) {
        // Run the query
        if ($ret = mysqli_query($dbc, $query)) {
            $retval = mysqli_fetch_all($ret);
        } else {
            '<p class="err">Could not create the database because:<br>' .
                mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
        }

        // Close the connection
        mysqli_close($dbc);
    } else {
        print '<p class="err">Could not connect to the database.<br>' . 
            mysqli_connect_error() .'</p>';
    }
    return $retval;
}

?>
