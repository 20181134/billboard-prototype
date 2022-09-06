<html>
    <head>
        <meta charset="utf-8">
        <title>Prototype</title>
        <link rel="stylesheet" href="stylesheet.css">
        <?php
        session_start();
        ?>
    </head>
    <body>
        <header>
            <div class="logo">
                <h2>Prototype</h2>
                <a class="headerlinks" href="./index.html">Home</a>
                <a class="headerlinks" href="">Profile</a>
                <a class="headerlinks" href="">Private Messages</a>
            </div>
            <div class="search">
                <?php
                if (isset($_SESSION['user'])) {
                    echo 'Signed in as <a href="', $_SESSION['user']['profilelink'], '">', $_SESSION['user']['username'], '</a>';
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
                        if (isset($SESSION_['user'])) {
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
                            $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
                            $sql = 'SELECT COUNT(*) as cnt FROM tweet';
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
                    <textarea></textarea>
                    <input type="submit" value="tweet"><hr class="division">
                        <div class="timeline">
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
                        </div>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>