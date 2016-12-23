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
<div id="box2">
<form action="result.php" name="answer" method="post" accept-charset="utf-8">

<?php

$music_list =simplexml_load_file("music_list.xml");
$que = $music_list->xpath('/music/song/data');
$que = array_unique($que); //重複削除
shuffle($que);

for($i=0;$i<10;$i++) {
  if($i<9){
?>
  <div id="que<?=$i+1?>" class="question">
    <p>Q<?=$i+1?>, <?=$que[$i]?>?</p>
    <div><a class="quePush bg-btn" href="#" onClick="yes('<?=$que[$i]?>')">はい</a></div>
    <div><a class="quePush bg-btn" href="#" onClick="no('<?=$que[$i]?>')">いいえ</a></div>
    <div><a class="quePush bg-btn" href="#">わからない</a></div>
  </div>
<?php
  }elseif($i==9){
?>
    <div id="que10" class="question">
    <p>Q<?=$i+1?>, <?=$que[$i]?>?</p>
    <div><a class="quePush bg-btn" href="#" onClick="yes('<?=$que[$i]?>');">はい</a></div>
    <div><a class="quePush bg-btn" href="#" onClick="no('<?=$que[$i]?>');">いいえ</a></div>
    <div><a class="quePush bg-btn" href="#">わからない</a></div>

    <div><a class="quePush bg-btn" href="#" onClick="lyes('<?=$que[$i]?>');">はい</a></div>

    </div>
<?php
  }
}
?>

<input name="yes" type="hidden">
<input name="no" type="hidden">

</form>

<a class="md-btn" href="https://sotsuken-music-app.herokuapp.com">TOP</a>

</div>
</div>

<script>
var y_ans = [];
var n_ans = [];

function a(){
  alert("a");
}
function yes(ans){
  y_ans.push(ans);

}

function no(ans){
    n_ans.push(ans);
  $('form[name=answer] input[name=no]').val(n_ans);
}

function lyes(ans){
  y_ans.push(ans);
  $('form[name=answer] input[name=yes]').val(y_ans);
  document.answer.submit();

}
</script>

<script>
$(function(){
  for (var i=2; i<11; i++) {
  // 質問非表示
    $("#que"+i).css("display", "none");
  }
  // 「id="quePush"」がクリックされた場合
  var i = 1;
  $(".quePush").click(function(){
  // 「id="que1,2,3.."」の表示、非表示を切り替える
    $("#que"+i).toggle();
    i++;
    $("#que"+i).toggle();
  });

});
</script>


</body>
</html>