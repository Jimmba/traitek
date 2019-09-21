<?php
	$countOfMessagesIsTrue=0;
	include("csv.php");
	try {
		$csv = new CSV("php/reviews/messages.csv"); //Открываем наш csv
		/**
		 * Вывод из CSV  (и вывод на экран в красивом виде)
		 */
		$get_csv = $csv->getCSV();
		foreach ($get_csv as $value){ //Проходим по строкам
			if ($value[5]=="TRUE"){
				$countOfMessagesIsTrue++;
				printf("
				<div class=\"row\">
					<div class=\"col-lg-11 col-md-11 col-sm-11 col-xs-11 review-item\">
						<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6 user-name\">%s</div>
						<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6 review-date\">%s</div>
						<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 review-body\">%s</div>
					</div>
					<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"></div>
				</div>
				", $value[2],$value[1],$value[4]);
			}
			
			//Выводим ответ
			if ($value[5]=="TRUE"){
				$countOfMessagesIsTrue++;
				printf("
				<div class=\"row\">
					<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"></div>
					<div class=\"col-lg-11 col-md-11 col-sm-11 col-xs-11 review-answer\">
						<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6 user-name\">Администратор</div>
						<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6 review-date\">%s</div>
						<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 review-body\">%s</div>
					</div>
				</div>
				", $value[6],$value[7]);
			}
			
			
		}
		if ($countOfMessagesIsTrue ==0){
			printf("
			<div class=\"row review-item\">
				<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 user-name\">Оставьте сообщение</div>
				<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 review-body\">Ваш отзыв может стать первым</div>
			</div>");
		}
    }
	
	
		
	catch (Exception $e) { //Если csv файл не существует, выводим сообщение
		echo "Ошибка: " . $e->getMessage();
	}
?>