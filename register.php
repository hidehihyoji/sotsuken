<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>楽曲の登録</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<div id="main">
<div id="container">

<?php

$title = $_POST['title'];
$artist = $_POST['artist'];

include 'simple_html_dom.php';

//アーティスト画像をスクレイピング
$html = file_get_html('http://image.search.yahoo.co.jp/search?p='.str_replace(" ","+",$artist));
$artist_img = $html->find('img')[mt_rand(0,20)] ->src;

?>

<div id="header">

<p><?=$title?> / <?=$artist?></p>
<img src="<?=$artist_img?>" alt="<?=$artist?>">
<p><a href="http://image.search.yahoo.co.jp/search?p=<?=$artist?>">[<?=$artist?>]の検索結果 - Yahoo!検索（画像）</a></p>

</div>

<p>該当するデータを選択してください</p>

<form action="complete.php" method="post" class="register">
  <ul>

    <?php

    $music_list =simplexml_load_file("music_list.xml");
    $data = $music_list->xpath('/music/song/data');
    $data = array_unique($data); //重複削除
    shuffle($data);

    ?>

    <?php foreach($data as $key => $d): ?>

    <li>
      <input type="checkbox" id="checkbox<?=$key?>" class="checkbox" name="data[]" value="<?=$d?>">
      <label for="checkbox<?=$key?>"><?=$d?></label>
    </li>

    <?php endforeach; ?>

  </ul>

  <span></span>

  <input type="hidden" name="title" value="<?=$title?>">
  <input type="hidden" name="artist" value="<?=$artist?>">
  <input type="hidden" name="artist_img" value="<?=$artist_img?>">
  <p><button type="button" id="append" class="sm-btn">その他を追加</button></p>
  <input type="submit" value="登録する" class="bg-btn">

</form>

<script>

  $('#append').click(function(e) {
    $('.register span').append("<p><input type='text' class='sm-input' name='data[]'></p>");
  });

</script>

<a class="md-btn" href="https://sotsuken-music-app.herokuapp.com">TOP</a>

</div>
</div>

</body>
</html>