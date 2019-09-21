<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$mes = $_POST['message'];
	include("csv.php");
	$d = getdate();
	$dateArray = array($d[mday], $d[mon], $d[year], $d[hours], $d[minutes]);
	for ($i=0; $i<count($dateArray); $i++){
		if ($dateArray[$i] < 10){
			$dateArray[$i]= "0".$dateArray[$i];
		}
	}

	$date = $dateArray[0].".".$dateArray[1].".".$dateArray[2]." ".$dateArray[3].".".$dateArray[4];
	$csv = new CSV("messages.csv"); //Открываем наш csv
	  /**
	 * Чтение из CSV  (и вывод на экран в красивом виде)
	 */
	$get_csv = $csv->getCSV();
	$get_num = $csv->getNum();
	$get_num++;
	/**
	 * Запись новой информации в CSV
	*/     
	$arr = array("$get_num;$date;$name;$email;$mes;FALSE;;");
	$csv->setCSV($arr);
	/**
	 * Вывод из CSV  (и вывод на экран в красивом виде)
	 */
	$get_csv = $csv->getCSV();
	send_message($get_num, $name, $email, $mes);

	function send_message($num, $name, $email, $mes){
		$to = 'gimv@mail.ru';
		$subject = 'Отзыв с сайта'; 
		$link = "https://traitek.by/php/reviews/add.php";
		$message = "
				<html>
						<head>
							<title>$subject</title>
						</head>
						<body>
							<h3>$subject</h3>
							<p>Посетитель сайта <strong>$name</strong> ($email) оставил отзыв:</p>
							<p>$mes</p>                       
							<a href=$link?num=$num>Оставить ответ</a>
						</body>
					</html>"; 
		$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		mail($to, $subject, $message, $headers); 
		
		$to = 'traitekby@gmail.com';
		mail($to, $subject, $message, $headers);
	}
?>
