<?php
    session_start();
    //проверяет соответствие коду CAPTCHA
	//echo ("session ".$_SESSION["captcha"]."<br>");
	//echo ("POST ".$_POST["captcha-input"]."<br>");
    if ($_SESSION["captcha"] == $_POST["captcha-input"]) {
      //сообщаем строку true, если код соответствует
      echo 'true';
    } 
    else {
      //сообщаем строку false, если код не соответствует
      echo 'false';
    }
?>