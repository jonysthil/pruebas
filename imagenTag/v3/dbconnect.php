<?php
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = 'pocoyojony12';

  $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

  $dbname = 'tag';
  mysql_select_db($dbname);

?>