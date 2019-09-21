<?php
  session_start(); 
	echo ($_POST["captcha"]." POST<BR>");
	echo ($_SESSION["captcha"]." SESSION<BR>");

  if (isset($_POST["captcha"])){  
    if ($_POST["captcha"]==$_SESSION["captcha"])
    {    
      echo "ok";
      exit();    
    }      
    else echo "ERROR";
  }
?>
<form action="index.php" method="post">
  <img id="captcha_img" src="captcha.php?t=<?php echo time();?>" style="border: 1px solid black"/><br/>
  <p><a href="javascript:void(0)" onclick="var d = new Date(); document.getElementById('captcha_img').src = 'captcha.php?t='+d.getTime();">Не вижу символы</a></p>
  <p><input type="text" name="captcha"/>
  <input type="submit" value="OK" /></p>
</form>
