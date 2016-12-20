<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>楽曲を探す</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="main">
<div id="box">
<?php

$music_list =simplexml_load_file("music_list.xml");
$que = $music_list->xpath('/music/song/data');
$que = array_unique($que); //重複削除
shuffle($que);

/* ファイルを閉じる */

for($i=0;$i<10;$i++):
?>

  <div id="que<?=$i?>" class="question">
  <p>Q<?=$i+1?>, <?=$que[$i]?>?</p>
  <div><a class="quePush bg-btn" href="#" onClick="ans('<?=$que[$i]?>',1)">はい</a></div>
  <div><a class="quePush bg-btn" href="#" onClick="ans('<?=$que[$i]?>',2)">いいえ</a></div>
  <div><a class="quePush bg-btn" href="#">わからない</a></div>
    </div>
<?php endfor;?>
</div>
<script>
var y_ans = [];
var n_ans = [];
function ans(id,res){
  if(res == 1){
    y_ans.push(id);
  }else if(res == 2){
    n_ans.push(id);
  }
  $.ajax({
    type: "POST",
    url: "post.php",
    data: {'yes': y_ans, 'no':n_ans},
    success: function (data){
      //PHPから返ってきたデータの表示
      $("#result").html(data);
    }
  });
}
</script>

<script>
$(function(){
  for (var i=1; i<10; i++) {
  // 「id="que1,2,3.."」を非表示
    $("#que"+i).css("display", "none");
  }
  // 「id="quePush"」がクリックされた場合
  var i = 0;
  $(".quePush").click(function(){
  // 「id="que1,2,3.."」の表示、非表示を切り替える
    $("#que"+i).toggle();
    i++;
    $("#que"+i).toggle();
  });

});
</script>

<div id="result">
</div>

</div>
</body>
</html>