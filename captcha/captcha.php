<?php
$cap = new Captcha();
class Captcha{

    private $imageX=150;//������ �����������
    private $imageY=40;
    private $minAngle=-30;//���� �������
    private $maxAngle=30;
    private $minSize=14;//������ ������
    private $maxSize=18;
    private $fonts = array('comic.ttf', 'ROCK.TTF', 'PAPYRUS.TTF', 'ONYX.TTF', 'ITCKRIST.TTF');//������ ������
    private $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';//����� ��������
    private $length;//����� �����
    private $captcha = '';
    function __construct()
    {
        $this->length= mt_rand(5, 7);
        $this->init();
    }

    public function init(){
        for ($i =0; $i < $this->length; $i++) {
            $this->captcha .= $this->chars[mt_rand(0,strlen($this->chars)-1)];//��������� �����
        }
	session_start();
        $_SESSION["captcha"]=$this->captcha;//������� � ������
        $im = imagecreatetruecolor($this->imageX, $this->imageY);//������� �����������
        $background = imagecolorallocate($im,255,255,255);
        imagefill($im, 0,0, $background);//�������� ��� ����� ������
        $step=round($this->imageX/(strlen($this->captcha)+2));//��� ��������
        $sx=0;
        for($i=0;$i<strlen($this->captcha);$i++) {
            $letter=$this->captcha[$i];
            $sx += $step + (rand(-round($step/5),round($step/5))); //��������� ���������� x
            $sy=$this->imageY-round($this->imageY/3)+rand(-round($this->imageY/5),round($this->imageY/5)); //��������� ���������� �
            $sa=rand($this->minAngle,$this->maxAngle); //��������� ���� ��������
            $ss=rand($this->minSize,$this->maxSize); //��������� ������
            $sf=$this->fonts[rand(0,count($this->fonts)-1)]; //��������� �����
            $sc=imagecolorallocate($im, 100+rand(-100,100), 100+rand(-100,100), 100+rand(100,100)); // ��������� ���� 0-200
	    imagettftext($im, $ss, $sa, $sx, $sy, $sc, $sf, $letter);
        }
        header("Content-type: image/png");
        //header("Pragma: no-cache");��� ���������� �����������
	imagepng($im);//������� �� � ���� ������� �������� �� ��������� ����� � �.�.
        imagedestroy($im);
    }
    function generteCaptcha(){
        //$this->init();
        return $this->captcha;
    }
}
?>