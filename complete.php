<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>完了しました</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="main">
<div id="container">
<h2>登録が完了しました</h2>
<div id="header">
<?php

$title = $_POST['title'];
$artist = $_POST['artist'];
$data = $_POST['data'];
$data = array_filter($data, "strlen"); //空白削除
$data = array_values($data); //添字振り直し
$artist_img = $_POST['artist_img'];

if($title =="" || $artist =="" || $artist_img ==""){
    exit();
}
?>
<p><?=$title?> / <?=$artist?></p>
<img src="<?=$artist_img?>" alt="<?=$artist?>">
<p><a href="http://image.search.yahoo.co.jp/search?p=<?=$artist?>">[<?=$artist?>]の検索結果 - Yahoo!検索（画像）</a></p>
<div class="data">
<?php foreach($data as $d) {
  echo "<span>".$d."</span>";
}?>
</div>

<?php
//regist xml
$music_list = simplexml_load_file("music_list.xml");

$chk_title = $music_list->xpath('/music/song[.//text()="'.$title.'"]');
$chk_artist = $music_list->xpath('/music/song[.//text()="'.$artist.'"]');

//重複チェック
//新規追加
if(empty($chk_title)){
  $values= $music_list->xpath('/music/song');
  $no = count($values);

  $song = $music_list->addChild('song');
  $song->addAttribute('id',$no+1);
  $song->addChild('title',$title);
  $song->addChild('artist',$artist);

  foreach($data as $d){
    $song->addChild('data',$d);
  }

  $music_list->asXML('music_list.xml');
}
//データのみ追加
else{
  //同楽曲のidを探す
  foreach ($chk_title as $value) {
    $val1[] = strval($value['id']);
  }
  foreach ($chk_artist as $value) {
    $val2[] = strval($value['id']);
  }

  $val = array_intersect($val1,$val2);
  $val = $val[0]; // id

  $value = $music_list->xpath('/music/song[@id="'.$val.'"]');
  $ex_data = $music_list->xpath('/music/song[@id="'.$val.'"]/data');

  foreach($data as $d){
    if(array_search($d, $ex_data) === FALSE){
      $value[0]->addChild('data',$d);
    }
  }

  $music_list->asXML('music_list.xml');

}
?>
</div>
<a class="md-btn" href="https://sotsuken-music-app.herokuapp.com">TOP</a>
</div>
</div>
</body>
</html>