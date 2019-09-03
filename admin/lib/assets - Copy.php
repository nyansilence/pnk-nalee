<?php if(!defined('_lib')) die("Error");
require "class.magic-min.php";
class Assets
{
	public $js;
	public $css;
	public $isCache = true;
	public $css_files;
	public $css_path = "";
	public $is_dev = 0;
	public $minified;
	function addCss($str){
		$this->css[] = $str;
	}
	function __construct(){
		$this->minified = new Minifier(array(
        'gzip' => true, 
       'closure' => true, 
       // 'hashed_filenames' => true, 
       // 'output_log' => true
    ));
	}
	function setDeveloper($var){
		$this->is_dev = $var;
	}
	function registerPackage($id_package){
		$package = array(
			"camera_slider"=>array("js"=>array("assets/plugins/camera/scripts/camera.min.js","assets/plugins/camera/scripts/jquery.easing.1.3.js"),			
								   "css"=>array("assets/plugins/camera/css/camera.css","assets/plugins/camera/css/slider.css")
								   )
			);	
			
		if($package[$id_package]){
			foreach($package[$id_package] as $k=>$v){
				if($k=="js"){
					foreach($v as $k2=>$v2){
						$this->addJs($v2);
					}
				}
				if($k=="css"){
					foreach($v as $k2=>$v2){
						$this->addCss($v2);
					}
				}
			}
		}
	}
	function addJs($str){
		$this->js[] = $str;
	}
	function showJs(){
		if(!$this->is_dev){
			$tmp = array();
			foreach($this->js as $k=>$v){
				$tmp[] = "../".$v;
			}
			$ur = $this->minified->merge( 'cache/packed.min.js', 'js', 'js', $tmp);
		echo '<script defer="defer" src="'.$ur.'" type="text/javascript"></script>';
		}else{
			foreach($this->js as $k=>$v){
				echo '<script  defer="defer" src="'.$v.'" type="text/javascript"></script>';
			}
		}
	}
	function showCss(){
		if(!$this->is_dev){
			$this->minified->merge( 'cache/css.min.css','css/base', $this->css);
			echo '<link href="cache/css.min.css" type="text/css" rel="stylesheet"/>';
		}else{
			foreach($this->css as $k=>$v){
				echo '<link href="'.$v.'" type="text/css" rel="stylesheet"/>';
			}
		}
	}
	
}
function sanitize_output($buffer) {
		$ignored = array();
        $i = 0;
        preg_match_all("/<textarea[^>]*?>(.*?)<\/textarea>/s", $buffer, $expr);
        foreach ($expr[0] as $k => $v) {
                $ignored[$i] = $expr[0][$k];
                $buffer = str_replace($expr[0][$k], '<='.$i.'=>', $buffer);
                $i++;
        }

        preg_match_all("/<script[^>]*?>(.*?)<\/script>/s", $buffer, $expr);
        foreach ($expr[1] as $k => $v) {
                if(empty($expr[1][$k]))
                        continue;
                $temp = preg_replace('/\s+\/{2,}.*\s+/', '', $expr[1][$k]);
                $temp = preg_replace('/\s+\/\*.*\*\/\s+/s', '', $temp);
                $buffer = str_replace($expr[1][$k], $temp, $buffer);
        }
        $buffer = preg_replace('/\n\r|\r\n|\n|\r|\t/', '', $buffer);
        $buffer = preg_replace('/ {2,}/', ' ', $buffer);
        foreach($ignored as $k => $v) {
                $buffer = preg_replace('/<='.$k.'=>/', $v, $buffer);
        }
       
    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1\x1A>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            // Force line-break with `&#10;` or `&#xa;`
            '#&\#(?:10|xa);#',
            // Force white-space with `&#32;` or `&#x20;`
            '#&\#(?:32|x20);#',
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            "<$1$2</$1\x1A>",
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            "\n",
            ' ',
            ""
        ),
    $buffer);
	}
