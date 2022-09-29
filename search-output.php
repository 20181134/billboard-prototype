<html>
    <head>
        <meta charset="utf-8">
        <title>Search - <?php echo $_REQUEST['search']; ?></title>
        <link rel="stylesheet" href="stylesheet.css">
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
                <div class="breakwater1">
                <?php
                    session_start();
                    if (isset($_SESSION['user'])) {
                        echo 'Signed in as <a href="../signout.php">', $_SESSION['user']['username'], '</a>';
                    } else {
                        echo '<a href="./signin.php">Sign In</a>';
                    }
                ?>
                </div>
                <!-- Signed in as <a href="">Example</a> -->
                <form action="search-output.php" method="post" class="headersearch">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="Search">
                </form>
            </div>
        </header>
        <main>
            <div class="contents">
                <div class="information">
                    <p class="titletext">Your Account</p>
                    <?php
                    if (!isset($_SESSION['user'])) {
                        echo '<div class="infobar1">';
                        echo '<a href="./signin.php">Sign In</a> or <a href="createaccount.php">Create a new account</a> and tweet now!';
                        echo '</div>';
                    }
                    ?>
                    <div class="account-info">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<img src="', $_SESSION['user']['profilepic'], '" class="prof">';
                            echo '<p class="user">', $_SESSION['user']['username'], '</p>';
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
                            //echo '<a href="./profile.php">Your profile</a>';
                            // CSSをあとで作成
                        }
                        // Tweet数カウント 一時非表示
                        //if (isset($_SESSION['user'])) {
                        //    $sql = 'SELECT COUNT(*) as cnt FROM userdata';
                        //    $rs = mysql_query($sql);
                        //    $row = mysql_fetch_assoc($rs);
                        //    $count = $row['cnt'];
                        //    echo '<p class="desc">Tweets: ', $count;
                        //}
                        ?>
                        <!-- 
                        <p class="desc">Tweets: 5</p>
                        <p class="desc">Bio: Hello World</p>
                        -->
                    </div>
                </div>
                <div class="tl">
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
                    -->
                    <?php
                    $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
                    $stmt = $pdo->prepare("SELECT * FROM tweets where contents like '%".$_REQUEST['search']."%' ORDER BY id DESC");
                    if ($stmt->execute()) {
                        //echo 'success';
                        foreach ($stmt as $row) {
                            echo '<div class="tweet">';
                            echo '<a href="./user/'.$row['uploader'].'.php">';
                            echo '<img src="'.$row['avatar'].'" class="avatar1">';
                            echo '<div class="cont">';
                            echo '<b class="username">'.$row['uploader'].'</b>';
                            echo '</a>';
                            echo '<p class="contents1">'.$row['contents'].'</p>';
                            echo '<p class="time">'.$row['time'].'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '<hr class="division">';
                        }
                    } else {
                        echo 'failure';
                        print_r ($stmt -> errorInfo());
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>