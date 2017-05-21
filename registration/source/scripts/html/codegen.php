<?php
//error_reporting(E_ALL);
/* $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", $DOCUMENT_ROOT."/source/scripts/");
define("imgs_dir", $DOCUMENT_ROOT."/source/imgs/");
define("font_dir", $DOCUMENT_ROOT."/source/fonts/");
*/
//выше вариант, который надо использывать при расположении сайта в интернете, а не на ПК.

//на локале
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", "../../../source/scripts/");
define("imgs_dir", "../../../source/imgs/");
define("font_dir", "../../../source/fonts/");
//


function generate_code() //генерируем код
{
                
    $hours = date("H"); // час       
    $minuts = substr(date("H"), 0 , 1);// минута 
    $mouns = date("m");    // месяц             
    $year_day = date("z"); // день в году

    $str = $hours . $minuts . $mouns . $year_day; //создаем строку
    $str = md5(md5($str)); //дважды шифруем в md5
	$str = strrev($str);// реверс строки
	$str = substr($str, 3, 6); // извлекаем 6 символов, начиная с 3
	// Вам конечно же можно постваить другие значения, так как, если взломщики узнают, каким именно способом это все генерируется, то в защите не будет смысла.
	

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand ((float)microtime()*1000000);
    shuffle ($array_mix);
	//Тщательно перемешиваем, соль, сахар по вкусу!!!
    return implode("", $array_mix);
}

function img_code() //Берем карандаши и рисуем картинку :)
{

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                   
header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);           
header("Pragma: no-cache");                                           
header("Content-Type:image/png");
//защита от кэширования...кстати сказать не очень надежная...

$linenum = 1; //линии
$img_arr = array(
                 "codegen01.png", "codegen02.png", "codegen03.png", "codegen04.png", "codegen05.png", "codegen06.png", "codegen07.png", "codegen08.png", "codegen09.png", "codegen10.png", "codegen11.png", "codegen12.png", "codegen13.png", "codegen14.png", "codegen15.png", "codegen16.png", "codegen17.png", "codegen18.png", "codegen19.png", "codegen20.png", "codegen21.png", "codegen22.png"
                );

$font_arr = array();
$font_arr[0]["fname"] = "font.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[0]["size"] = 22;//размер
$font_arr[1]["fname"] = "font.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[1]["size"] = 24;//размер
$font_arr[2]["fname"] = "font.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[2]["size"] = 26;//размер
$font_arr[3]["fname"] = "font.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[3]["size"] = 28;//размер
$font_arr[4]["fname"] = "font.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[4]["size"] = 30;//размер

$n = rand(0,sizeof($font_arr)-1);
$img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
$im = imagecreatefrompng (imgs_dir . $img_fn); //создаем изображение со случайным фоном

for ($i=0; $i<$linenum; $i++)
{
//рисуем линии
    $c = rand(0, 170);
	$color = imagecolorallocate($im, $c, $c, $c);//rand(0, 150), rand(0, 100), rand(0, 150));
	imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

$colortext = imagecolorallocate($im, 0,0,0);//rand(0, 200), 0, rand(0, 200));
imagettftext ($im, $font_arr[$n]["size"], rand(-4, 4), rand(10, 45), rand(25, 40), $colortext, font_dir.$font_arr[$n]["fname"], generate_code());//накладываем код

for ($i=0; $i<$linenum; $i++)//еще раз линии! Уже сверху.
{
    $color = imagecolorallocate($im, 0,0,0);//rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

ImagePNG ($im);
ImageDestroy ($im);//ну вот и создано изображение!
}

img_code();
?>
