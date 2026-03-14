<?php
include('./header.html');
include('./sql_management.php');

session_start();

// Check if currently signing in or loging out
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['logout'])) { // Currently logging out
        // Notify the user of the logout
        print '<p>Logged out of ' . $_SESSION['username'] . ' Successfully</p>';

        // Update the session
        $_SESSION['username'] = '';
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) { // Currently logging in
        if ($_POST['username'] == 'Admin'){ // Check for admin signin without SQL
            // DO NOT DO IF DEPLOYED
            if ($_POST['password'] == 'Admin') {
                $_SESSION['username'] = $_POST['username'];
                print '<p>Logged in as \'Admin\' Successfully</p>';
            } else {
                    print '<p>Incorrect Password</p>';
            }
        } elseif (is_db_real()){
            // Check if user already exists
            $password_found = sql_query("SELECT password FROM users WHERE username = '{$_POST['username']}'");

            if (empty($password_found)) { // User does not exist. Sign up.
                // enter the session
                $_SESSION['username'] = $_POST['username'];

                // Store the username and password to sql
                run_sql("INSERT INTO users (username, password) 
                    VALUES ('{$_POST['username']}', '{$_POST['password']}')");

                // Inform user of signin
                print '<p>Successfully signed up as ' . $_POST['username'] . ' </p>';
            } else { // User does exist. Signing in
                if ($password_found[0][0] == $_POST['password']){
                    // Update the session
                    $_SESSION['username'] = $_POST['username'];

                    // Inform the user of the successfull login
                    print '<p>Logged in as ' . $_POST['username'] . ' Successfully</p>';
                } else {
                    // Inform the user of their incorrect password
                    print '<p>Incorrect Password</p>';
                }
            }
        } else { // Attempted to sign in despite there being no database
            print '<p>Can not create an account until admin creates the database</p>';
        }
    } else {
        print '<p class="err">Please fill in your username and password!</p>';
    }
} 

// If not logged in, give login form. Otherwise, allow for a logout
if($_SESSION['username'] != '') {
    print '
        <h1>Login Page</h1>
        <p>Currently logged in as '. $_SESSION['username'] .' </p>
        <form action="login.php" method="post">
            <input type="hidden" name="logout" value="Logout">
            <input type="submit" name="submit" value="LogOut">
        </form>
        ';
} else {
    print '
        <h1>Login Page</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input name="username" size="32">
            <label for="password">Password:</label>
            <input type="password" name="password" size="32">
            
            <input type="submit" name="submit" value="Log In!">
        </form>
    ';

}


include('./footer.html');
?>
