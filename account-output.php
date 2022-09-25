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
        // ここからテスト
        $check = $pdo->prepare('SELECT COUNT(*) AS ck FROM userdata where username=?');
        if ($check->execute([$_REQUEST['username']])) {
            if ($row['ck'] != 0) {
                echo 'Username has already taken'; 
            } else {
                if (is_uploaded_file['avatar']['tmp_name']) {
                    if (!file_exists('avatar')) {
                    mkdir('avatar');
                }
                $file = 'avatar/'.basename($_FILES['avatar']['tmp_name']).'.png';
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file)) {
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
                        if (!file_exists('user')) {
                            mkdir('user');
                        }
                        $user = file_get_contents('./profile.txt');
                        $user = str_replace('insert_avatar_here', '../'.$_SESSION['user']['profilepic'], $user);
                        $user = str_replace('insert_username_here', $_SESSION['user']['username'], $user);
                        $user = str_replace('insert_userid_here', $_SESSION['user']['id'], $user);
                        file_put_contents('./user/'.$_SESSION['user']['username'].'.php', $user);
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
            }
        }
        ?>
    </body>
</html>