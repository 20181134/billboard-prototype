<html>
    <head>
        <meta charset="utf-8">
        <title>Prototype</title>
        <link rel="stylesheet" href="stylesheet.css">
        <?php
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
        ?>
    </head>
    <body>
        <header>
            <div class="logo">
                <h2>Prototype</h2>
                <a class="headerlinks" href="./index.php">Home</a>
                <a class="headerlinks" href="./profile.php">Profile</a>
                <a class="headerlinks" href="">Private Messages</a>
            </div>
            <div class="search">
                <?php
                if (isset($_SESSION['user'])) {
                    echo 'Signed in as <a href="./signout.php">', $_SESSION['user']['username'], '</a>';
                } else {
                    echo '<a href="./signin.php">Sign In</a>';
                }
                ?>
                <!-- Signed in as <a href="">Example</a> -->
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="Search">
            </div>
        </header>
        <main>
            <div class="contents">
                <div class="information">
                    <p class="titletext">Your Account</p>
                    <div class="account-info">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<img src="', $_SESSION['user']['profilepic'], '" class="prof">';
                            echo '<p class="user">', $_SESSION['user']['username'], '</p>';
                        } else {
                            echo '<a href="./signin.php">Sign In</a> or <a href="createaccount.php">Create a new account</a> and tweet now!';
                        }
                        ?>
                        <!--
                        <img src="./img25.jpg" class="prof">
                        <p class="user">Example</p>
                        -->
                    </div>
                    <div class="moreinfo">
                        <?php
                        if (isset($_SESSION['user'])) {
                            $sql = 'SELECT COUNT(*) as cnt FROM userdata';
                            $rs = mysql_query($sql);
                            $row = mysql_fetch_assoc($rs);
                            $count = $row['cnt'];
                            echo '<p class="desc">Tweets: ', $count;
                        }
                        ?>
                        <!-- 
                        <p class="desc">Tweets: 5</p>
                        <p class="desc">Bio: Hello World</p>
                        -->
                    </div>
                </div>
                <div class="tl">
                    <p class="title2">What's Happening?</p>
                    <form action="" method="post">
                        <textarea name="new-tweet"></textarea>
                        <input type="submit" value="tweet"><hr class="division">
                    </form>
                        <div class="timeline">
                            <?php
                            $timeline = $pdo->query('SELECT * FROM tweets');
                            foreach ($timeline as $row) {
                                echo '<div class="tweet">';
                                echo '<img src="', $row['avatar'], '" class="avatar1">';
                                echo '<div class="cont">';
                                echo '<b class="username">', $row['uploader'], '</b>';
                                echo '<p class="contents1">', $row['contents'], '</p>';
                                echo '<p class="time">', $row['time'], '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr class="division">';
                            }
                            ?>
                            <!--
                            <div class="tweet">
                                <img src="avatar1.jpg" class="avatar1">
                                <div class="cont">
                                    <b class="username">Example2</b>
                                    <p class="contents1">Hello, World!</p>
                                    <p class="time">13:48:38 9/6/2022</p>
                                </div>
                            </div>
                            <hr class="division">
                            <div class="tweet">
                                <img src="avatar1.jpg" class="avatar1">
                                <div class="cont">
                                    <b class="username">Example2</b>
                                    <p class="contents1">Hello, World!</p>
                                    <p class="time">13:48:38 9/6/2022</p>
                                </div>
                            </div>
                            -->
                            <?php
                            // if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            //    date_default_timezone_set('Asia/Tokyo');
                            //    $stmt = $pdo->prepare('INSERT INTO tweets values(?, ?, ?, ?, ?)');
                            //    if ($stmt->execute($_SESSION['user']['id'], $_REQUEST['new-tweet'], $_SESSION['user']['username'], $_SESSION['user']['profilepic'], date('Y-m-d H:i:s'))) {
                            //        header('Location: ./index.php');
                            //        exit();
                            //    } else {
                            //        echo 'Something went wrong';
                            //    }
                            // }
                            ?>
                        </div>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>