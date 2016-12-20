<?php
$music_list =simplexml_load_file("music_list.xml");

$a = $music_list->xpath('/music/song[not(@id="3")]/@id');
// $a = $music_list->xpath('/music/song/@id[..//text()="Androp"]');
echo('<pre>');
var_dump($a);
echo('</pre>');

?>