<?php
include('./header.html');
include('./sql_management.php');

// Make sure that the user is an admin
session_start();
if( $_SESSION['username'] != 'Admin') {
    print '<p>Please login as the user "Admin" in order to access this page. Ps, the password is hardcoded as "Admin"</p>';
    include('./footer.html');
    exit();
}

// Perform actions if requested
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['method'] == 'CreateDB') { 
        // Create the database
        run_sql('CREATE DATABASE IF NOT EXISTS chat', false);
        // Create the users table
        run_sql('
            CREATE TABLE IF NOT EXISTS users (
                username VARCHAR(32) NOT NULL,
                password VARCHAR(32) NOT NULL,
                fname VARCHAR(32),
                lname VARCHAR(32),
                address VARCHAR(32),
                city VARCHAR(32),
                state VARCHAR(2),
                phone VARCHAR(10),
                email VARCHAR(32),
                PRIMARY KEY (username)
            )
        ');
        // Create a table for the chat data
        run_sql('
            CREATE TABLE IF NOT EXISTS chat_data (
                postID INT NOT NULL AUTO_INCREMENT,
                text VARCHAR(256) NOT NULL,
                poster VARCHAR(32) NOT NULL,
                FOREIGN KEY (poster) REFERENCES users(username) ON DELETE CASCADE,
                PRIMARY KEY (postID)
            )
        ');
    } elseif ($_POST['method'] == 'DeleteDB') {
        // Destroys everything
        run_sql('DROP DATABASE chat', false);
    } elseif ($_POST['method'] == 'DeleteUser') {
        // Deletes the user (chat data should cascade)
        run_sql("DELETE FROM users WHERE username = '{$_POST['target']}'");
    } elseif ($_POST['method'] == 'DeleteHist') {
        // Deletes all texts with the specific user
        run_sql("DELETE FROM chat_data WHERE poster = '{$_POST['target']}'");
    } elseif ($_POST['method'] == 'English') { 
        // Apparently, this app still doesn't have any math despite being massive
        // This is a fun feature that searches through every post and checks if it's not English
        // It probably wont catch that much, and will have a horrible false positive rate.

        // Create a frequency dictionary
        $frequency = array('E' => 12.0, 'T' => 9.10, 'A' => 8.12, 'O' => 7.68, 'I' => 7.31, 'N' => 6.95,
            'S' => 6.28, 'R' => 6.02, 'H' => 5.92, 'D' => 4.32, 'L' => 3.98, 'U' => 2.88, 'C' => 2.71,
            'M' => 2.61, 'F' => 2.30, 'Y' => 2.11, 'W' => 2.09, 'G' => 2.03, 'P' => 1.82, 'B' => 1.49,
            'V' => 1.11, 'K' => 0.69, 'X' => 0.17, 'Q' => 0.11, 'J' => 0.10, 'Z' => 0.07);

        // Itterates through every post
        $posts = sql_query("SELECT * FROM chat_data");
        for ($i = 0; $i < count($posts); $i++) {

            // Converts the post to uppercase letters
            $post = strtoupper($posts[$i][1]);

            $count = 0;
            $total = 0;
            // Loop through every letter, and adds it's frequency to the total if english.
            // It also counts the number of letters, to perform an average latter.
            foreach (str_split($post) as $char){
                if (array_key_exists($char, $frequency)){
                    $count += 1;
                    $total += $frequency[$char];
                }
            }

            // Finally perform the checks
            if ($count > 10) { // Only check if there are enough letters to do so
                // The average rarity of the sentence.
                $lang_rate = $total / $count;
                // English tends to fall in this frequency average range
                // Higher could be someone spamming high frequency letters. Lower might be another language
                if ($lang_rate > 7 || $lang_rate < 4.9) {
                    print "<p>Post '{$posts[$i][0]}' by '{$posts[$i][2]}' saying '{$posts[$i][1]}' is probably not english.<p>";
                }
            }
            elseif (strlen($post) > 20) { // Over 20 characters, but less than 10 English ones. Possibly a different writing system like Japanese or Arabic.
                print "<p>Post '{$posts[$i][0]}' by '{$posts[$i][2]}' saying '{$posts[$i][1]}' is probably not english.<p>";
            }
        }
    }
    
    print 'Task successful.';
}

// Create the admin action form
print '
    <h1>Welcome to the Sketchily Insecure Admin Panel!!!</h1>
    <form action="admin.php" method="post">
        <p>Target User(if delete user): 
            <select name="target">';

// Create a list of all users from php
if (is_db_real()) {
    $res = sql_query('SELECT username FROM users;');
    foreach ($res as $uname) {
        print "<option value=\"{$uname[0]}\">{$uname[0]}</option>";
    }
}

print '     </select>
        </p>
        <select name="method">
            <option value="CreateDB">Create Database</option>
            <option value="DeleteDB">Delete Database</option>
            <option value="DeleteUser">Delete User</option>
            <option value="DeleteHist">Delete User History</option>
            <option value="English">Search for Non-english posts</option>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
    ';

include('./footer.html');
?>
