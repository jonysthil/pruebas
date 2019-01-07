<?php
include('conexion.php');

if ($_POST['type'] == "insert")
{
  $name = $_POST['name'];
  $pic_x = $_POST['pic_x'];
  $pic_y = $_POST['pic_y'];
  $sql = "INSERT INTO image_tag (name,pic_x,pic_y) VALUES ('$name',$pic_x,$pic_y)";
  $qry = mysqli_query($mysqli, $sql);
}

if ($_POST['type'] == "remove")
{
  $tag_id = $_POST['tag_id'];
  $sql = "DELETE FROM image_tag WHERE id = '".$tag_id."'";
  $qry = mysqli_query($mysqli, $sql);
}

// fetch all tags
$sql = "SELECT * FROM image_tag WHERE pic_id = '".$pic_id."' ORDER BY id";
$qry = mysqli_query($mysqli, $sql);
$rs = mysqli_fetch_array($qry);

if ($rs){
  do{
    echo '<li rel="'.$rs['id'].'"><a>'.$rs['name'].'</a> (<a class="remove">Remove</a>)</li>';
  }while($rs = mysqli_fetch_array($qry));
}

?>
