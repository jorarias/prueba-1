<?php
  $link = mysql_connect('localhost', 'root', '');
  $bd = mysql_select_db('prueba', $link);

  return $link;
  return $bd;
?>
