<?php 
	class watermark{
		private $old;
		private $newname;
		private $path;
		
		
		function cloneImg($img,$newname,$path){
			$wmi = "../upload/watermark/watermark.png";
			$this->old = $img;
			$this->path = $path;
			$this->newname = $newname;
			return $this->createwmimage($this->old,$wmi,5,30);
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
$main_img       = $this->path.$s; // main big photo / picture
$watermark_img  = $t; // use GIF or PNG, JPEG has no tranparency support
$padding        = $p; // distance to border in pixels for watermark image
$opacity        = $o;  // image opacity for transparent watermark

$watermark  = $this->checkimg($watermark_img); // create watermark
$image      = $this->checkimg($main_img); // create main graphic


if(!$image) die("Error: main image could not be loaded! ".$main_img);
if(!$watermark) die("Error: watermark could not be loaded!");


$watermark_size     = getimagesize($watermark_img);
$watermark_width    = $watermark_size[0];  
$watermark_height   = $watermark_size[1];  

$image_size     = getimagesize($main_img);  

#unlink($main_img);

$img_width = $image_size[0];
$img_height = $image_size[1];
if (isset ($_GET['twper'])) {
$thumb_perwidth = ($_GET['twper'])/100;
} else $thumb_perwidth = 0.5;
if (isset ($_GET['thper'])) {
$thumb_perheight = ($_GET['thper'])/100;
} else $thumb_perheight = 0.5;
$wmdim = $this->resize_dimensions($img_width*$thumb_perwidth,$img_height*$thumb_perheight,$watermark_width,$watermark_height);

$watermark_width =  $wmdim['width'];
$watermark_height = $wmdim['height'];

$watermark  = $this->checkimg($watermark_img);

$new_image = imagecreatetruecolor ( $watermark_width, $watermark_height ); // new wigth and height
imagealphablending($new_image , false);
imagesavealpha($new_image , true);

imagecopyresampled ( $new_image, $watermark, 0, 0, 0, 0, $watermark_width, $watermark_height, imagesx ( $watermark ), imagesy ( $watermark ) );

$watermark = $new_image;

$dest_x         = $img_width - $watermark_width - $padding;  
#$dest_x         = $padding;  
#$dest_y         = $img_height - $watermark_height - $padding;
$dest_y         = $padding;
$white = imagecolorallocate($image, 255, 255, 255);
$ext = strtolower(end(explode(".",$this->old)));
$bname = $this->newname.".".$ext;
imagefill($image, 0, 0, $white);
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height); 
if($ext=="png"){
	imagepng($image,$this->path.$bname);  
}else{
	imagejpeg($image,$this->path.$bname);  
}
imagedestroy($image);  
imagedestroy($watermark);  
return $bname;
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
	}