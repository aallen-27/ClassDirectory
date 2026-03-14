<?php
include('./header.html');
include('./sql_management.php');

session_start();
$me = $_SESSION['username'];

// If a new post was added, include it in the SQL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['chatbox']) && $me != '' && $me != 'Admin') {
        $post = $_POST['chatbox'];
        run_sql("INSERT INTO chat_data (text, poster) VALUES 
            ('{$_POST['chatbox']}', '$me')");
    }
}

// Read all posts previously made
$data = sql_query('SELECT text, poster FROM chat_data');
$last_post = '';
foreach ($data as $row) {
    $poster = $row[1];
    $post = $row[0];
    $post_style = $poster == $me ?'own_post' : 'post';

    //If the same person posts twice in a row, no need to display the header twice.
    if ($last_post == $poster) {
        $post_style = $post_style . ' second_post';
    } else {
        $last_post = $poster;
    }

    // A fun feature to follow the substrings comparison requirement
    // if the user begins their post by typing '!double', it will display twice.
    if (substr($post, 0, 7) == '!double') { 
        $post = substr($post, 7);
        // Show the post (a second time)
        print "<div class=\"$post_style\"><h3>$poster:</h3><p>$post</p></div>";
    }

    // Show the post
    print "<div class=\"$post_style\"><h3>$poster:</h3><p>$post</p></div>";
}

// If signed in, give the ability to post
if ($me != '' && $me != 'Admin') {
    print '<form action="index.php" method="post">
            <input name="chatbox" size="256">
            <input type="submit" name="submit" value="post">
        </form>
    ';
} elseif ($me == 'Admin') {
    print '<p>Admin is a no-SQL account, and thus can not post anything</p>';
} else {
    print '<p>Please login to post anything</p>';
}

include('./footer.html');
?>
