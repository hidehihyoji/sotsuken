<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>楽曲を探す</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div id="main">
<div id="container">

<?php

require_once 'youtube.php';

$yes = $_POST['yes'];
$no = $_POST['no'];

$yes = explode(",", $yes);
$no = explode(",", $no);

$music_list = simplexml_load_file("music_list.xml");
$id = array();
$nec_id = array();
$no_id = array();

// ”はい”のIDリスト
if(isset($yes)) {
  foreach ($yes as $ans) {
    echo $ans." ";

    if($ans == "男性ボーカル" || $ans == "女性ボーカル" || $ans == "インスト") {
      $tmp = $music_list -> xpath('/music/song[.//text()="'.$ans.'"]/@id');

      foreach($tmp as $t) {
        array_push($nec_id, (string)$t[0]);
      }
    }

    $tmp = $music_list -> xpath('/music/song[.//text()="'.$ans.'"]/@id');

    foreach($tmp as $t) {
      array_push($id, (string)$t[0]);
    }
  }

  if($nec_id != NULL) {
    $id = array_intersect($nec_id, $id);
  }
}

echo "<p></p>";

// ”いいえ”のIDリスト
if(isset($no)) {

  foreach ($no as $ans) {
    echo $ans." ";
    $tmp = $music_list -> xpath('/music/song[.//text()="'.$ans.'"]/@id');

    foreach($tmp as $t) {
      array_push($no_id, (string)$t[0]);
    }
  }
}


$no_id = array_values(array_unique($no_id)); //重複削除
$id = array_diff($id,$no_id); //差分
$id = array_count_values($id); //score
arsort($id);


$i = 0;
foreach($id as $key => $val) {
  $title = $music_list -> xpath('/music/song[@id='.(string)$key.']/title');
  $artist = $music_list -> xpath('/music/song[@id='.(string)$key.']/artist');

  echo "<div class='list'>";
  echo $i+1 .". ";

  youtube($title[0], $artist[0]);

  echo "</div>";

  $i++;
  if($i == 3) break;

}

?>

<a class="md-btn" href="https://sotsuken-music-app.herokuapp.com">TOP</a>

</div>
</div>

</body>
</html>