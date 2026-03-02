<?php // Script 9.6 - login.php #3
    define('TITLE', 'Login');
    include('templates/header.html');

    print '<h2>Login Form</h2>
        <p>Users who are logged in can take advantage of certain features like this,
        that, and the other thing. </p>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ( (!empty($_POST['email'])) && (!empty($_POST['password'])) ) {
            if ( (strtolower($_POST['email']) == 'me@example.com') 
                    && ($_POST['password'] == 'testpass') ) {

                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['loggedin'] = time();

                ob_end_clean();
                header ('Location: welcome.php');
                exit();
            print '<p class="text--error">The submitted email address and password
                        do not match those on file!<br>Go back and try again.</p>';
            }
        } else { // Forgot a field.
            print '<p class="text--error">Please make sure you enter both an email address
                and a password!<br>Go back and try again.</p>';
        }
    } else { // Display the form.
        print '<form action="login.php" method="post" class="form--inline">
                <p>
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" size="20">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" size="20">
                </p>
                <p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
                </form>';
    }
    include('templates/footer.html');
?>
