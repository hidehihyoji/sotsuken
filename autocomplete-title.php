<?php
$music_list =simplexml_load_file("music_list.xml");
// 該当ソングIDの検索
$artist_list = $music_list->xpath('/music/song/title');

$artist_list = array_unique($artist_list);
$artist_list = array_values($artist_list);

$words = array();

// 現在入力中の文字を取得
$term = (isset($_GET['term']) && is_string($_GET['term'])) ? $_GET['term'] : '';
 
// 部分一致で検索
foreach($artist_list as $word){
  $word = (string)$word;
  if(mb_stripos( $word, $term) !== FALSE){
      $words[] = $word;
  }   
}
 
header("Content-Type: application/json; charset=utf-8");
echo json_encode($words);
?>
