<?php
include('conexion.php');

// fetch all tags
$sql = "SELECT * FROM image_tag WHERE pic_id = '".$_GET['pic_id']."'";
$qry = mysqli_query($mysqli, $sql);
$rs = mysqli_fetch_array($qry);

if ($rs){
  do{
    echo '<div class="tagview" style="left:'.$rs['pic_x'].'px;top:'.$rs['pic_y'].'px;" id="view_'.$rs['id'].'"></div>';
  }while($rs = mysqli_fetch_array($qry));
}

?>