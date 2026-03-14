<?php
include('./header.html');
include('./sql_management.php');

// SQL seems finicky, so this might be necessary until the book goes over better solutions.
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if ( empty($_SESSION['username']) ) {
    print '<p>You are not logged in</p>';
} elseif( $_SESSION['username'] == 'Admin') {
    print '<p>You are logged in as \'Admin\'</p>';
    print '<p>This account is specially designed to not rely on SQL, and as such no data is available</p>';
} else {
    print "<p>You are logged in as '{$_SESSION['username']}'</p>";

    // If the user submitted more personal information, add it.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['fname'])) {
            print "<p>Updated First Name!</p>";
            run_sql("UPDATE users SET fname = '{$_POST['fname']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['lname'])) {
            print "<p>Updated Last Name!</p>";
            run_sql("UPDATE users SET lname = '{$_POST['lname']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['address'])) {
            print "<p>Updated Address!</p>";
            run_sql("UPDATE users SET address = '{$_POST['address']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['address'])) {
            print "<p>Updated Address!</p>";
            run_sql("UPDATE users SET address = '{$_POST['address']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['city'])) {
            print "<p>Updated City!</p>";
            run_sql("UPDATE users SET city = '{$_POST['city']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['state'])) {
            print "<p>Updated State!</p>";
            run_sql("UPDATE users SET state = '{$_POST['state']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['phone'])) {
            print "<p>Updated Phone Number!</p>";
            run_sql("UPDATE users SET phone = '{$_POST['phone']}' WHERE username = '{$_SESSION['username']}'");
        }
        if (!empty($_POST['email'])) {
            print "<p>Updated Email!</p>";
            run_sql("UPDATE users SET email = '{$_POST['email']}' WHERE username = '{$_SESSION['username']}'");
        }
    }

    // Get personal details
    $dat = sql_query("SELECT fname, lname, address, city, state, phone, email FROM users WHERE username = '{$_SESSION['username']}'")[0];
    print "
        <form action=\"account.php\" method=\"post\">
            <p>First Name: {$dat[0]}</p>
            <label for=\"fname\">New: </label>
            <input name=\"fname\" size=\"32\">

            <p>Last Name: {$dat[1]}</p>
            <label for=\"lname\">New: </label>
            <input name=\"lname\" size=\"32\">

            <p>Address: {$dat[2]}</p>
            <label for=\"address\">New: </label>
            <input name=\"address\" size=\"32\">

            <p>City: {$dat[3]}</p>
            <label for=\"city\">New: </label>
            <input name=\"city\" size=\"32\">

            <p>State: {$dat[4]}</p>
            <label for=\"state\">New: </label>
            <input name=\"state\" size=\"2\">

            <p>phone: {$dat[5]}</p>
            <label for=\"phone\">New: </label>
            <input name=\"phone\" size=\"10\">

            <p>email: {$dat[6]}</p>
            <label for=\"email\">New: </label>
            <input type=\"email\" name=\"email\" size=\"32\">
            
            <p>When done editing, be sure to save!</p>
            <input type=\"submit\" name=\"submit\" value=\"Update account!\">
        </form>
    ";
}

include('./footer.html');
?>
