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
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8', 'admin', 'password');
        $stmt = $pdo->prepare('INSERT INTO userdata values(?, ?, ?, ?)');
        // profilepageの値は現在nullに設定　createaccount.phpにアバター欄を作成する - Done
        // ここにアバターの写真をディレクトリに移す機能を設置
        
        $stmt->execute(null, $_REQUEST['username'], $_REQUEST['password'], null);
        $sql = $pdo->prepare('SELECT * FROM userdata where userid=?');
        $sql->execute($_REQUEST['username']);
        foreach ($sql as $row) {
            $_SESSION['user']=[
                'username'=>$row['username'],
                'profilepic'=>$row['profilepic'],
                'id'=>$row['userid']
            ];
        }
        ?>
    </body>
</html>