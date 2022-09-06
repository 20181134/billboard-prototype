<html>
    <head>
        <meta charset="utf-8">
        <title>掲示板</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <?php
            $file="board.txt";
            if (file_exists($file)) {
                $board=json_decode(file_get_contents($file));
            }
            if (!strlen($_REQUEST['user']) or !strlen($_REQUEST['content'])) {
                foreach ($board as $printer) {
                    echo '<p>', $printer, '</p><br>';
                }
            } else {
                $board[]=$_REQUEST['user'].': '.$_REQUEST['content'];
                file_put_contents($file, json_encode($board));
                foreach ($board as $printer) {
                    echo '<p>', $printer, '</p><br>';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                header('Location:');
            }
        ?>
    </body>
</html>