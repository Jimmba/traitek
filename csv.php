<?php
	class CSV {

		private $_csv_file = null;
		private $content=array();
		/**
		 * @param string $csv_file  - ���� �� csv-�����
		 */
		 
		public function __construct($csv_file) {
			if (file_exists($csv_file)) { //���� ���� ����������
				$this->_csv_file = $csv_file; //���������� ���� � ����� � ����������
			//$this->send_message1("1", "File found");
			}
				else { //���� ���� �� ������ �� �������� ����������
			throw new Exception("file \"$csv_file\" not found"); 
			//$this->send_message1("1", "File not found");
			}
		}

		public function setCSV(Array $csv) {
			//��������� csv ��� ��-������, 
			//���� ������� w, ��  ���������� ������� ���� � csv ����� �������
			$text = file_get_contents('messages.csv');
			$handle = fopen($this->_csv_file, "w"); 
			foreach ($csv as $value) { //�������� ������
				fputcsv($handle, explode(";", $value), ";"); 
			}
			fclose($handle); //���������
			
			$new = file_get_contents('messages.csv');
			
			$txt = $new.$text;
			$f_out=fopen("messages.csv","w");
			fwrite($f_out, $txt);
			fclose($f_out);
		}

		/**
		 * ����� ��� ������ �� csv-�����. ���������� ������ � ������� �� csv
		 * @return array;
		 */

		public function getCSV() {
		$handle = fopen($this->_csv_file, "r"); //��������� csv ��� ������
			$array_line_full = array(); //������ ����� ������� ������ �� csv
			//�������� ���� csv-����, � ������ ���������. 3-�� �������� ����������� ����
			while (($line = fgetcsv($handle, 0, ";")) !== FALSE) { 
				$array_line_full[] = $line; //���������� ������� � ������
			}
			fclose($handle); //��������� ����
		//$this->send_message1("4", "return $array_line_full");
			return $array_line_full; //���������� ���������� ������
		}
		
		public function getNum(){
			$handle = fopen($this->_csv_file, "r"); //��������� csv ��� ������
				$line = fgetcsv($handle, 0, ";");
			fclose($handle); //��������� ����
			return $line[0];
			$this->send_message1("4", "number is $line[0]");
		}
		
		public function allowMessage($number, $message){
			$handle = fopen($this->_csv_file, "r"); //��������� csv ��� ������
			$array_line_full = array(); //������ ����� ������� ������ �� csv
			//�������� ���� csv-����, � ������ ���������. 3-�� �������� ����������� ����
			while (($line = fgetcsv($handle, 0, ";")) !== FALSE) { 
				if ($line[0]==$number){
					$line[5]="TRUE";
					$d = getdate();
					$dateArray = array($d[mday], $d[mon], $d[year], $d[hours], $d[minutes]);
					for ($i=0; $i<count($dateArray); $i++){
						if ($dateArray[$i] < 10){
							$dateArray[$i]= "0".$dateArray[$i];
						}
					}
					$date = $dateArray[0].".".$dateArray[1].".".$dateArray[2]." ".$dateArray[3].".".$dateArray[4];				
					$line[6]=$date;
					$line[7]=$message;
				}
				$array_line_full[] = $line; //���������� ������� � ������
			}
			fclose($handle); //��������� ����
			$fp = fopen("messages.csv", w);
			foreach ($array_line_full as $fields){
				fputcsv ($fp, $fields,";");
			}
			fclose($fp);
			return; //���������� ���������� ������
		}
		public function getData($number){
			$handle = fopen($this->_csv_file, "r"); //��������� csv ��� ������
			//�������� ���� csv-����, � ������ ���������. 3-�� �������� ����������� ����
			while (($line = fgetcsv($handle, 0, ";")) !== FALSE) { 
				if ($line[0]==$number){
					$array_line_full = $line; //���������� ������� � ������
				}
			}
			fclose($handle); //��������� ����
			return $array_line_full;
		}
	}
?>
