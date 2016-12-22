<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>楽曲の登録</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="main">
<div id="box">
<form id="register" action="register.php" method="post">
  <div>
  <input type="text" id="title" name="title" placeholder="曲名" class="bg-input" required>
  <input type="text" id="artist" name="artist" placeholder="アーティスト名" class="bg-input" required>
  <input type="submit" class="bg-btn" value="この曲を登録する">
  </div>
</form>

<script type="text/javascript">
$(function() {
  $("#title").autocomplete({
      source: "autocomplete-title.php",
      messages: {
      noResults: '',
      results: function() {}
  }
  });
});

$(function() {
  $("#artist").autocomplete({
      source: "autocomplete-artist.php",
      messages: {
      noResults: '',
      results: function() {}
  }
  });
});
</script>
<a class="md-btn" href="https://sotsuken-music-app.herokuapp.com">TOP</a>

</div>
</div>

</body>
</html>