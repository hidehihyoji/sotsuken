<?php
$yes = $_POST['yes'];
$no = $_POST['no'];


$music_list =simplexml_load_file("music_list.xml");
$yes_id = array();
$no_id = array();
// 該当ソングIDの検索
if(isset($yes)){
  foreach ($yes as $ans) {
    $yes_id[] = $music_list->xpath('/music/song[.//text()="'.$ans.'"]/@id');
  }
}

if(isset($no)){
  foreach ($no as $ans) {
    $no_id[] = $music_list->xpath('/music/song[.//text()="'.$ans.'"]/@id');
  }
}

$id = $music_list->xpath('/music/song/@id');

// 条件判定
foreach($yes_id as $y){
  $id = array_intersect($id, $y); //重複IDの取り出し
}
foreach($no_id as $n){
  $id = array_diff($id, $n); //No以外のID取り出し
}


foreach($id as $val){
  $title = $music_list->xpath('/music/song[@id='.(string)$val.']/title');
  $artist = $music_list->xpath('/music/song[@id='.(string)$val.']/artist');

  echo "<p>".$title[0]." / ".$artist[0]."</p>";
}

if($id == NULL){
  echo "該当する曲を教えてください。";
  //result.php
}
//検索結果が0になったら0になる手前の結果を表示する。
