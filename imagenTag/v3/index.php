<?php include('dbconnect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
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
    $qry = mysql_query($sql);
    $rs = mysql_fetch_array($qry);
  ?>
  <div class="imglist">
    <ul>
      <?php do{ ?>
      <li><a href="picture.php?pic_id=<?php echo $rs['id'] ?>"><img src="<?php echo $rs['name'] ?>" /></a></li>
      <?php }while($rs = mysql_fetch_array($qry)); ?>
    </ul>
  </div>
  </body>
</html>