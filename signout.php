<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
        <?php
        session_start();
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
            <div class="signout">
                <p>Sign Out</p><br>
                <a href="./signout-output.php">Sign Out</a>
            </div>
        </main>
    </body>
</html>