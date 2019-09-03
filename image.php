<?php

@session_start();
if (isset ($_GET['src'])) {
//$wmi = param('wm',$_SESSION['wm']);
if (isset ($_GET['thumb'])) {
$wmi = $_GET['thumb'];
}
else
{
$wmi = "upload/watermark/watermark.png";
}
if(!is_dir('cache'))
{
	mkdir('cache/',0755);	
}
$imge = $img = 'cache/'.uniqid().".".strtolower(pathinfo( $_GET['src'], PATHINFO_EXTENSION ));
$bas = "http://".$_SERVER['HTTP_HOST']."/".trim($_SERVER['PHP_SELF'],"image.php");
$ourl = $bas.'crop.php?';
$ourl .= attach_param_link();
file_put_contents($img, file_get_contents(myUrlEncode($ourl)));
createwmimage($img,$wmi,param('p',5),param('o',100));
}
function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}
function attach_param_link() {
	$url = '';
	$param = array("src","w","h","q","a","zc","f","s","cc","ct");
	foreach ($param as $value) {
		if (isset ($_GET[$value])) {
			$url = $url."&".$value."=".$_GET[$value];
		}
	}
	return $url;
}
function resize_dimensions($goal_width,$goal_height,$width,$height) { 
    $return = array('width' => $width, 'height' => $height); 

    // If the ratio > goal ratio and the width > goal width resize down to goal width 
    if ($width/$height > $goal_width/$goal_height && $width > $goal_width) { 
        $return['width'] = $goal_width; 
        $return['height'] = $goal_width/$width * $height; 
    } 
    // Otherwise, if the height > goal, resize down to goal height 
    else if ($height > $goal_height) { 
        $return['width'] = $goal_height/$height * $width; 
        $return['height'] = $goal_height; 
    } 

    return $return; 
}

function param($property, $default = '') {
		if (isset ($_GET[$property])) {
			return $_GET[$property];
		} else {
			return $default;
			}
}

function checkimg($name) {
$ext =	strtolower(pathinfo( $name, PATHINFO_EXTENSION ));
//$ext = strtolower(end(explode('.',$name)));
if($ext=='jpg' || $ext=='jpeg')
$val = imagecreatefromjpeg($name);
else if($ext=='png')
$val = imagecreatefrompng($name);
else if($ext=='gif')
$val = imagecreatefromgif($name);
return $val;
}

function createwmimage($s,$t,$p,$o) {
$main_img       = $s; // main big photo / picture
$watermark_img  = $t; // use GIF or PNG, JPEG has no tranparency support
$padding        = $p; // distance to border in pixels for watermark image
$opacity        = $o;  // image opacity for transparent watermark

$watermark  = checkimg($watermark_img); // create watermark
$image      = checkimg($main_img); // create main graphic


if(!$image || !$watermark) die("Error: main image or watermark could not be loaded!");


$watermark_size     = getimagesize($watermark_img);
$watermark_width    = $watermark_size[0];  
$watermark_height   = $watermark_size[1];  

$image_size     = getimagesize($main_img);  

unlink($main_img);

$img_width = $image_size[0];
$img_height = $image_size[1];
if (isset ($_GET['twper'])) {
$thumb_perwidth = ($_GET['twper'])/100;
} else $thumb_perwidth = 0.5;
if (isset ($_GET['thper'])) {
$thumb_perheight = ($_GET['thper'])/100;
} else $thumb_perheight = 0.5;
$wmdim = resize_dimensions($img_width*$thumb_perwidth,$img_height*$thumb_perheight,$watermark_width,$watermark_height);

$watermark_width =  $wmdim['width'];
$watermark_height = $wmdim['height'];

$watermark  = checkimg($watermark_img);

$new_image = imagecreatetruecolor ( $watermark_width, $watermark_height ); // new wigth and height
imagealphablending($new_image , false);
imagesavealpha($new_image , true);

imagecopyresampled ( $new_image, $watermark, 0, 0, 0, 0, $watermark_width, $watermark_height, imagesx ( $watermark ), imagesy ( $watermark ) );

$watermark = $new_image;

$dest_x         = $img_width - $watermark_width - $padding;  
$dest_y         = $img_height - $watermark_height - $padding;
$white = imagecolorallocate($image, 255, 255, 255);
#$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);

/*
if($img_width/2<=$watermark_width || $img_height/2<=$watermark_height) {
if($img_width>$img_height) $cn = $img_width; else $cn = $img_height; 
$cn = $cn/3;
if($img_width>$img_height) $scale = $img_width / $img_height; else $scale = $img_height / $img_width;
$watermark_width =  (int)$cn/ $scale; //$watermark_width;
$watermark_height = (int)$cn/ $scale; //$watermark_height;

$watermark  = imagecreatefrompng($watermark_img);

$new_image = imagecreatetruecolor ( $watermark_width, $watermark_height ); // new wigth and height
imagealphablending($new_image , false);
imagesavealpha($new_image , true);

imagecopyresampled ( $new_image, $watermark, 0, 0, 0, 0, $watermark_width, $watermark_height, imagesx ( $watermark ), imagesy ( $watermark ) );

$watermark = $new_image;

$dest_x         = $img_width - $watermark_width - $padding;  
$dest_y         = $img_height - $watermark_height - $padding;
 
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
}
else
{
$dest_x         = $img_width - $watermark_width - $padding;  
$dest_y         = $img_height - $watermark_height - $padding;
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
}
*/
header("content-type: image/jpeg");   
imagejpeg($image);  
imagedestroy($image);  
imagedestroy($watermark);  
}
?>