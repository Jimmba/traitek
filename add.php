<?php
try{
	include("csv.php");
    $csv = new CSV("messages.csv"); //Открываем наш csv
    /**
     * Вывод из CSV  (и вывод на экран в красивом виде)
     */
	if (isset($_POST['num'])){	
		if (isset($_POST['num']) && ($_POST['num']!=NULL)){
			$number = $_POST['num'];
			$answer = $_POST['message'];
			$csv->allowMessage($number, $answer);
			echo "<html>
						<head>
							<meta charset=\"utf-8\"/>
							
						</head>
						<H1>Отзыв будет показываться на сайте</H1>
					</html>";
		}
	}else{
		if (isset($_GET['num']) && ($_GET['num']!=NULL)){
			$num = $_GET['num'];
			$data = $csv->getData($num);
			printf("
					<html>
						<head>
							<meta charset=\"utf-8\"/>
							<title>$subject</title>
							<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
							<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css\" integrity=\"sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp\" crossorigin=\"anonymous\">
						</head>
						<body>
							<h3>Сообщение</h3>
							<p>Посетитель сайта <strong>%s</strong> (%s) оставил отзыв:</p>
							<hr>
							<p>%s</p>                       
							<hr>
							<form method = \"POST\" action = \"add.php\" id=\"send_review_form\" class=\"send-review-form\">
								<input name = \"num\" type = \"hidden\" value = %s></div>
								<div class=\"form-group\">
									<label for=\"message-input\">Введите ответ, который будет отображаться на сайте</label>
									<textarea class=\"form-control message\" id=\"message-input send_review_message\" rows=\"8\" name=\"message\" required=\"required\"></textarea>
								</div>
								<div id=\"alert\"></div>
								<button type=\"submit\" class=\"btn btn-success\" name=\"submit\" id=\"send_review\">Разместить на сайте</button>
							</form>
						</body>
					</html>",$data[2],$data[3],$data[4],$data[0]);
			
			
		}
	}
}catch (Exception $e) { //Если csv файл не существует, выводим сообщение
	echo "Ошибка: " . $e->getMessage();
}
?>