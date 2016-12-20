<?php
$yes = $_POST['yes'];
$no = $_POST['no'];


$music_list =simplexml_load_file("music_list.xml");
$id = array();
$no_id = array();

// ”はい”のIDリスト
if(isset($yes)){
  foreach ($yes as $ans) {
    echo $ans." ";
    $tmp = $music_list->xpath('/music/song[.//text()="'.$ans.'"]/@id');
    foreach($tmp as $t) {
      array_push($id, (string)$t[0]);
    }
  }
}
echo "<p></p>";

// ”いいえ”のIDリスト
if(isset($no)){
  foreach ($no as $ans) {
    echo $ans." ";
    $tmp = $music_list->xpath('/music/song[.//text()="'.$ans.'"]/@id');
    foreach($tmp as $t) {
      array_push($no_id, (string)$t[0]);
    }
  }
}



$no_id = array_values(array_unique($no_id)); //重複削除

// ”いいえ”のIDを削除
// foreach($id as $key => $val){
//     foreach($no_id as $n){
//       echo('<pre>');
//       var_dump($n);
//       echo('</pre>');
//     if($val == $n[0]){
//       unset($id[$key]);
//     }
//   }
// }


$id = array_diff($id,$no_id); //差分

$id = array_count_values($id);
arsort($id);

foreach($id as $key => $val){
  $title = $music_list->xpath('/music/song[@id='.(string)$key.']/title');
  $artist = $music_list->xpath('/music/song[@id='.(string)$key.']/artist');

  echo "<p>[".$val."]".$title[0]." / ".$artist[0]."</p>";
}

if($id == NULL){
  echo "該当する曲を教えてください。";
  //result.php
}
