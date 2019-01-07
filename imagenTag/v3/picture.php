<?php include('dbconnect.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
    <style> 
    #imgtag
    {
      position:relative;
      min-width:300px;
      min-height:300px;
      float:left;
      border:solid 3px #fff;
      cursor: crosshair;
    }
    .tagview
    {
      border:solid 3px #fff;
      width:100px;
      height:100px;
      position:absolute;
      display:none;
    }
    #tagit
    {
      position:absolute;
      top:0;left:0;
      width:250px;
    }
    #tagit .box
    {
      border:solid 3px #fff;
      width:100px;
      height:100px;
      float:left;
    }
     
    #tagit .name
    {
      float:left;
      background-color:#fff;
      width:130px;
      height:80px;
      padding:5px;
    }
    #tagit div.text
    {
      margin-bottom:5px;
    }
    #tagit input[type=text]
    {
      margin-bottom:5px;
    }
    #tagit #tagname
    {
      width:110px;
    }
    #taglist
    {
      background-color:#aaa;
      width:300px;
      min-height:200px;
      height:auto !important;
      height:200px;
      float:left;
      padding:10px;
      margin-left:20px;
      color:#000;
     
    }
    #taglist ol { padding:0 20px;float:left;cursor:pointer}
    #taglist ol a { }
    #taglist ol a:hover { text-decoration:underline }
    .tagtitle
    {
      font-size:14px;
      text-align:center;
      width:100%;
      float:left; 
    }
    </style>
    <script> 
  $(document).ready(function(){
    var counter = 0;
    var mouseX = 0;
    var mouseY = 0;
    
    $("#imgtag img").click(function(e){ // make sure the image is click
      var imgtag = $(this).parent(); // get the div to append the tagging list
      mouseX = e.pageX - $(imgtag).offset().left; // x and y axis
      mouseY = e.pageY - $(imgtag).offset().top;
      $('#tagit').remove(); // remove any tagit div first
      $(imgtag).append('<div id="tagit"><div class="box"></div><div class="name"><div class="text">Type any name or tag</div><input type="text" name="txtname" id="tagname" /><input type="button" name="btnsave" value="Save" id="btnsave" /><input type="button" name="btncancel" value="Cancel" id="btncancel" /></div></div>');
      $('#tagit').css({top:mouseY,left:mouseX});
      
      $('#tagname').focus();
    });
    
    $('#tagit #btnsave').live('click',function(){
      name = $('#tagname').val();
      
      $.ajax({
        type: "POST", 
        url: "savetag.php", 
        data: "name=" + name + "&pic_x=" + mouseX + "&pic_y=" + mouseY + "&type=insert",
        cache: true, 
        success: function(data){
          viewtag();
          $('#tagit').fadeOut();
        }
      });
      
    });
    
     $('#tagit #btncancel').live('click',function(){
      $('#tagit').fadeOut();
      
    });
    
    $('#taglist li').live('mouseover mouseout',function(event){
      id = $(this).attr("rel");
      if (event.type == "mouseover"){
        $('#view_' + id).show();
      }else{
        $('#view_' + id).hide();
      }
    });
    
    $('#taglist li a.remove').live('click',function(){
      id = $(this).parent().attr("rel");
      // get all tag on page load
      $.ajax({
        type: "POST", 
        url: "savetag.php", 
        data: "tag_id=" + id + "&type=remove",
        success: function(data){
          viewtag();
        }
      });
    });
    
    viewtag(); // get all tag on page load
    
    function viewtag(pic_id)
    {
      // get the tag list with action remove
      $.ajax({
        type: "POST", 
        url: "savetag.php", 
        data: "pic_id=" + pic_id,
        cache: true, 
        success: function(data){
          $('#taglist ol').html(data);
        }
      });
      
      // get the tag list for boxes
      $.ajax({
        type: "POST", 
        url: "taglist.php", 
        data: "pic_id=" + pic_id,
        cache: true, 
        success: function(data){
          $('#tagbox').html(data);
        }
      });
    }
    
    
  });
</script> 
  </head> 
  <body>
  <div class="sampleTitle">Facebook Style Photo Tagging</div><br /><br /> 
  <?php if ($_GET['pic_id']): ?>
  <div id="imgtag"> 
    <?php 
    $sql = "SELECT * FROM picture WHERE id = " . stripslashes($_GET['pic_id']);
    $qry = mysql_query($sql);
    $rs = mysql_fetch_array($qry);
    ?>
    <img src="<?php echo $rs['name'] ?>" /> 
    <div id="tagbox">
    </div>
  </div> 
  <div id="taglist"> 
    <span class="tagtitle">List of Tags</span> 
    <ol> 
    </ol> 
  </div> 
  <?php else: ?>
  Must have a pic ID
  <?php endif; ?>
  </body>
</html>