<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            unset ($_SESSION['user']);
            header('Location: ./index.php');
            exit();
        } else {
            echo 'You have already signed out.<br>';
            echo '<a href="./index.php">Back to home</a>';
        }
        ?>
    </body>
</html>