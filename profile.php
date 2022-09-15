<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location:./user/'.$_SESSION['user']['username'].'.php');
        } else {
            header('Location:./signin.php');
        }
        ?>
    </body>
</html>