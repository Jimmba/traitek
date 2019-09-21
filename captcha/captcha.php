<?php
$cap = new Captcha();
class Captcha{

    private $imageX=150;//размер изображения
    private $imageY=40;
    private $minAngle=-30;//угол наклона
    private $maxAngle=30;
    private $minSize=14;//размер шрифта
    private $maxSize=18;
    private $fonts = array('comic.ttf', 'ROCK.TTF', 'PAPYRUS.TTF', 'ONYX.TTF', 'ITCKRIST.TTF');//разные шрифты
    private $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';//набор символов
    private $length;//длина капчи
    private $captcha = '';
    function __construct()
    {
        $this->length= mt_rand(5, 7);
        $this->init();
    }

    public function init(){
        for ($i =0; $i < $this->length; $i++) {
            $this->captcha .= $this->chars[mt_rand(0,strlen($this->chars)-1)];//формируем капчу
        }
	session_start();
        $_SESSION["captcha"]=$this->captcha;//заносим в сессию
        $im = imagecreatetruecolor($this->imageX, $this->imageY);//создаем изображение
        $background = imagecolorallocate($im,255,255,255);
        imagefill($im, 0,0, $background);//заливаем фон белым цветом
        $step=round($this->imageX/(strlen($this->captcha)+2));//шаг символов
        $sx=0;
        for($i=0;$i<strlen($this->captcha);$i++) {
            $letter=$this->captcha[$i];
            $sx += $step + (rand(-round($step/5),round($step/5))); //случайная координата x
            $sy=$this->imageY-round($this->imageY/3)+rand(-round($this->imageY/5),round($this->imageY/5)); //случайная координата у
            $sa=rand($this->minAngle,$this->maxAngle); //случайный угол поворота
            $ss=rand($this->minSize,$this->maxSize); //случайный размер
            $sf=$this->fonts[rand(0,count($this->fonts)-1)]; //случайный шрифт
            $sc=imagecolorallocate($im, 100+rand(-100,100), 100+rand(-100,100), 100+rand(100,100)); // случайный цвет 0-200
	    imagettftext($im, $ss, $sa, $sx, $sy, $sc, $sf, $letter);
        }
        header("Content-type: image/png");
        //header("Pragma: no-cache");для исключения кэширования
	imagepng($im);//неплохо бы и шума немного добавить из случайных линий и т.п.
        imagedestroy($im);
    }
    function generteCaptcha(){
        //$this->init();
        return $this->captcha;
    }
}
?>