<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <?php
        session_start();
        unset ($_SESSION['user']);
        $pdo = new PDO('mysql:host=localhost;')
        ?>
    </body>
</html>