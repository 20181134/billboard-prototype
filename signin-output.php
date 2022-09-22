<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
        <?php session_start(); ?>
    </head>
    <body>
        <?php
        unset ($_SESSION['user']);
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8', 'admin', 'password');
        $stmt = $pdo->prepare('SELECT * FROM userdata where username=? and password=?');
        if ($stmt->execute([$_REQUEST['username'], $_REQUEST['password']])) {
            foreach ($stmt as $row) {
                $_SESSION['user']=[
                    'username'=>$row['username'],
                    'profilepic'=>$row['avatar'],
                    'id'=>$row['userid'],
                    'profilelink'=>$row['profilepage']
                ];
            }
            header('Location:./index.php');
            exit();
        } /*else {
            echo 'Username or password is incorrect.<br>';
            echo '<a href="./index.php">Back to home</a>';
        }*/
        ?>
    </body>
</html>