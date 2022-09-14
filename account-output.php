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
        // profilepageの値は現在nullに設定　createaccount.phpにアバター欄を作成する - Done
        // ここにアバターの写真をディレクトリに移す機能を設置 - done
        if (is_uploaded_file['avatar']['tmp_name']) {
            if (!file_exists('avatar')) {
                mkdir('avatar');
            }
            $file = 'avatar/'.basename($_FILES['avatar']['tmp_name']).'.png';
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file)) {
                // 個人ページを作成 profilepageの値は現在nullに設定
                $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8', 'admin', 'password');
                $stmt = $pdo->prepare('INSERT INTO userdata values(?, ?, ?, ?, ?)');
                if ($stmt->execute([null, $_REQUEST['username'], $_REQUEST['password'], $file, null])) {
                echo 'データを追加';
                } else {
                    print_r ($stmt -> errorInfo());
                }
                $sql = $pdo->prepare('SELECT * FROM userdata where username=? and password=?');
                if ($sql->execute([$_REQUEST['username'], $_REQUEST['password']])) {
                    foreach ($sql as $row) {
                        $_SESSION['user']=[
                            'username'=>$row['username'],
                            'profilepic'=>$row['avatar'],
                            'id'=>$row['userid'],
                            'profilelink'=>$row['profilepage']
                        ];
                    }
                    echo 'SQL success!';
                    // ここからテスト
                    if (!file_exists('user')) {
                        mkdir('user');
                    }
                    $user = file_get_contents('./profile.txt');
                    $user = str_replace('insert_avatar_here', '../'.$_SESSION['user']['profilepic'], $user);
                    $user = str_replace('insert_username_here', $_SESSION['user']['username'], $user);
                    file_put_contents('./user/'.$_SESSION['user']['username'].'.php', $user);
                    // ここまで
                } else {
                    print_r ($sql -> errorInfo());
                }
                header('Location: ./index.php');
                exit();
            } else {
                echo 'Something went wrong';
            }
        } else {
            echo 'Select an avatar';
        }
        ?>
    </body>
</html>