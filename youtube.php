<?php

function youtube($title, $artist) {
  $title = str_replace(" ", "+", $title);
  $artist = str_replace(" ", "+", $artist);
  $keyword = $title . "+" . $artist; 
  $key = "AIzaSyC81jJ_NE7_eyALcieIxfNGJv3qE8iWLZY";
  $q_url = "https://www.googleapis.com/youtube/v3/search?key=".$key."&q=".$keyword."&part=id,snippet&maxResults=1&fields=items(id(videoId))";
  $json = file_get_contents($q_url);
  $arr = json_decode($json);

  $id = $arr -> items[0] -> id -> videoId; //videoId

  $v_url = "https://www.googleapis.com/youtube/v3/videos?id=".$id."&key=".$key."&fields=items(snippet(title),statistics,player)&part=snippet,statistics,player";
  $json = file_get_contents($v_url);

  $arr = json_decode($json);

  $video = $arr -> items[0];
  $title = $video -> snippet -> title;
  $embed = $video -> player -> embedHtml;
  $viewCount = $video -> statistics -> viewCount;
  $like = $video -> statistics -> likeCount;
  $dislike = $video -> statistics -> dislikeCount;

  echo $title;
  echo "<div class='video'>".$embed."</div>";
  echo "<span>".number_format($viewCount)."views</span> ";
  echo "<span>good:".number_format($like)."</span> ";
  echo "<span>bad:".number_format($dislike)."</span>";
}

?>