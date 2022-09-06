<html>
    <head>
        <meta charset="utf-8">
        <title>掲示板</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <div class="topbar">
            <a href="">リロード</a>
        </div>
        <hr>
        <h1>掲示板</h1>
        <form action="" method="post">
            名前: <input type="text" name="user">
            本文: <textarea name="content"></textarea>
            <input type="submit" value="投稿">
        </form>
        <div class="billboard">
            <?php
                $file="board.txt";
                if (file_exists($file)) {
                    $board=json_decode(file_get_contents($file));
                }
                if (!strlen($_REQUEST['user']) or !strlen($_REQUEST['content'])) {
                    foreach (array_reverse($board) as $printer) {
                        echo '<p>', $printer, '</p><br>';
                    }
                } else {
                    $board[]=$_REQUEST['user'].': '.$_REQUEST['content'];
                    file_put_contents($file, json_encode($board));
                    foreach (array_reverse($board) as $printer) {
                        echo '<p>', $printer, '</p><br>';
                    }
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    header('Location:');
                }
            ?>
        </div>
            <input type="button" class="sort" value="古い順に並び替える">
        <script>
            $(function(){
                $('.sort').click(function(){
                    $.ajax({
                        url: './billboard-oldest.php',
                        type: 'GET',
                        dataType: 'html'
                    }).done(function(data){
                        $('.sort').html(data);
                    }).fail(function(data){
                        alert('通信ができません。インターネット接続を確認してください');
                    });
                });
            });
            </script>