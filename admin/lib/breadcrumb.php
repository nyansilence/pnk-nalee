<?php
class breadcrumb{
	public $link;
	public $name;
	public $show = true;
	public $is_brand = false;
	public $class;
	function setName($name){
		$this->name = $name;
	}
	function isBrand(){
		$this->is_brand = true;
	}
	function setClass($cls){
		$this->class=$cls;
	}
	public function add($name,$link){
		$this->link[] = array("name"=>$name,"link"=>$link);
	}
	public function hide(){
		$this->show = false;
	}
	public function display(){
		$str = '<div id="my-breadcrumbs" class="'.$this->class.'" ><div class="container">';
			if($this->name){
				
				$str.="<div class='has-name'>".(($this->is_brand) ? '<h1>' : '').$this->name.(($this->is_brand) ? '</h1>' : '').'</div><div class="clearfix"></div>';
				
			}
			
		
		
		
		$str.= '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';
		foreach($this->link as $k=>$v){
			$cls = '';
			if($k==0){
				$cls = "";
			}	
			$str.="<li ".$cls." itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' style='z-index:".(10-$k)."' href='".$v['link']."'><span itemprop='name'>".$v['name']."</span></a><meta itemprop='position' content='".($k+1)."' /><span class='sperate'></span></li>";
		
		}
		$str.="</ul><div class='clearfix'></div></div></div><div class='clearfix'></div>";
		if($this->show)
			return $str;
	
	}
}