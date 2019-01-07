<?php include('conexion.php'); ?>
<!DOCTYPE html> 
<html > 
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <style>
    img { border:none;width:200px; }
    li { width:200px;height:150px;overflow:hidden; }
    </style>
  </head> 
  <body>
  <div class="sampleTitle">Facebook Style Photo Tagging by Bryan</div><br /><br /> 
  <?php 
    $sql = "SELECT * FROM picture";
    $qry = mysqli_query($mysqli, $sql);
    $rs = mysqli_fetch_array($qry);
  ?>
  <div class="imglist">
    <ul>
      <?php do{ ?>
        <li>
            <a href="picture.php?pic_id=<?php echo $rs['id'] ?>">
            <img src="<?php echo $rs['name'] ?>" /></a>
        </li>
      <?php }while($rs = mysqli_fetch_array($qry)); ?>
    </ul>
  </div>
  </body>
</html>