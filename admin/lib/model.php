<?php 
	class model{
		private $_totalslug;
		public $db;
		private $lang;
		
		private $main_image;
		private $zoom = "thumb/375x540/1";
		private $zoom_v2 = "thumb/268x375/1";
		private $sizes;
		private $colors;
		private $cart_status;
		private $member;
		private $discount;
		function __construct($d,$lang){
			$this->db = $d;
			
			$this->lang = $lang;
			
			$this->setData();
			$this->refreshMemberData();
			$this->getAllDiscount();
		}
		function getMemberCash($id){
			if(!$id){
				die("Missing member id");
			}
			$this->db->query("select price,type from #_member_history where id_member = $id");
			$total = 0;
			foreach($this->db->result_array() as $k=>$v){
				if($v['type']==1){
					$total+=$v['price'];
				}else{
					$total-=$v['price'];
				}
			}
			return $total;
			
		}
		function getTotalCartPay($id){
			
			$this->db->query("select sum(price) as total from #_order_history oh,#_donhang dh where dh.id = oh.id_order and thanhvien = $id");
			$r = $this->db->fetch_array();
			return $r['total'];
		}
		function getOrderHistory($id){
			
			$this->db->query("select oh.* from #_order_history oh where id_order  = $id order by create_time asc");
			$r = $this->db->result_array();
			return $r;
		}
		
		function getCartByIdMember($id=null,$type=0){
			$this->db->query("select * from #_donhang where thanhvien = $id");
			$rs = $this->db->result_array();
			if(!$type)
				return $rs;
			if($type==1){// get price
				$total = 0;
				
				
				foreach($rs as $k=>$v){
					$total+=$v['tonggia'];
				}
				return $total;
			}
		}
		
		
		function getMemberById($id,$key="fullname"){
			if(!$id){
				die("ERROR ID");
			}
			if(!$member){
				$this->db->query("select * from #_member ");
				foreach($this->db->result_array() as $k=>$v){
					$this->member[$v['id']] = $v;
				}
			}
			return $this->member[$id][$key];
			
		}
		function getCartStatus($id){
			if(!$cart_status){
				$this->db->query("select id,trangthai as name,class from #_tinhtrang order by id");
				foreach($this->db->result_array() as $k2=>$v2){
					$this->cart_status[$v2['id']] = $v2;
				}
			}
			return $this->cart_status[$id];
		}
		function getProductInCart($id){
			$this->db->query("select pc.name,p.id as pid,p.tenkhongdau as slug,p.ten_".$this->lang." as product_name,cd.quantity from #_cart_detail cd,#_product_condition pc,#_product p where p.id = cd.id_product and pc.id = cd.id_condition and id_order = ".$id);
			return $this->db->result_array();
			
			
		}
		
		function refreshMemberData(){
			if(isset($_SESSION['member_log'])){
				$id = $_SESSION['member_log']['id'];
				unset($_SESSION['member_log']);
				$this->db->query("select id,email,fullname,phone,secret,birthday,address,type from #_member where id = $id");
				$_SESSION['member_log'] = $this->db->fetch_array();
			}
		}
		function isMember(){
			$is = false;
			if(isset($_SESSION['member_log'])){
				$is = true;
			}
			return $is;
		}
		function getTotalQuantity(){
			$num = 0;
			if(isset($_SESSION['cart'])){
			
				foreach($_SESSION['cart'] as $k=>$v){
					$num+=$v['qty'];
				}
			}
			return $num;
		}
		function getPrice($id_product,$id_size,$id_color){
			
		}
		function removeCart($pid){
			$pid=intval($pid);
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				if($pid==$_SESSION['cart'][$i]['productid']){
					unset($_SESSION['cart'][$i]);
					break;
				}
			}
			$_SESSION['cart']=array_values($_SESSION['cart']);
		}
		function addToCart($pid,$q,$color,$size,$price){
		
			if($pid<1 or $q<1) return;
			$code = md5($pid.$color.$size);
			if(is_array(@$_SESSION['cart'])){
				if(isset($_SESSION['cart'][$code])){
					$_SESSION['cart'][$code]['qty'] = $_SESSION['cart'][$code]['qty']+$q;
				}else{
					
					$_SESSION['cart'][$code]['productid']=$pid;
					$_SESSION['cart'][$code]['qty']=$q;
					$_SESSION['cart'][$code]['color']=$color;
					$_SESSION['cart'][$code]['size']=$size;
					$_SESSION['cart'][$code]['price']=$price;
				}
			}
			else{
				$_SESSION['cart'] = array();
				$_SESSION['cart'][$code]['productid']=$pid;
				$_SESSION['cart'][$code]['qty']=$q;
				$_SESSION['cart'][$code]['color']=$color;
				$_SESSION['cart'][$code]['size']=$size;
				$_SESSION['cart'][$code]['price']=$price;
			}
		}
		function getTotalPriceCart(){
			$qty=0;
			$price = 0;
			if(isset($_SESSION['cart'])){
				$sess = $_SESSION['cart'];
				if(count($sess)){
					foreach($sess as $k=>$v){
						$qty+=$v['qty'];
						$price+=($v['price']*$v['qty']);
					}
				}
			}
			
			return array("qty"=>$qty,"price"=>$price);
		}
		function setData(){
			$this->db->query("select ten_vi as name,id,bg_color from #_product_color");
			
			foreach($this->db->result_array() as $k=>$v){
				$this->colors[$v['id']] = $v;
			}
			
			$this->db->query("select ten_vi as name,id from #_product_size");
			
			foreach($this->db->result_array() as $k=>$v){
				$this->sizes[$v['id']] = $v;
			}
		}
		function getSize($id=null,$key){
			if(!$id){
				die("ERROR SIZE ID");
			}
			return $this->sizes[$id][$key];
		}
		function getColor($id=null,$key){
			if(!$id){
				die("ERROR COLOR ID");
			}
			return $this->colors[$id][$key];
		}
		function showAllProductCondition($id){
			$type = (isset($_SESSION['member_log'])) ? $_SESSION['member_log']['type'] : 0;
			
			$this->db->query("select id_color,id_size,sold,quantity,id,price_$type as price from #_product_condition where id_product = $id ");
			
			return $this->db->result_array();
		}
		function getAllDiscount(){
			$this->db->query("select * from  #_product_discount pd,#_discount d where pd.id_discount = d.id and end_date > ".time()." and hienthi = 1");
			foreach($this->db->result_array() as $k=>$v){
				$this->discount[$v['id_product']] = $v;
			}
		}
		function checkInPrice($id,$price){
	
	// id is id of product
				
		if(isset($this->discount[$id])){
					
					
					$r = $this->discount[$id];
				
					$discount = $r['discount'];
					$max_discount = $r['max_discount'];		
					if($r['price']){	
					if($r['price'] < $price){	
						$data['price'] = $r['price'];	
					}	
					}else{
						
					if($r['type']==1){
						// price
						$data['price'] =(float)($price-$discount);
						
					}else{ // percent
						
						
						$pre = ($price / 100)*$discount;
						if($pre > $max_discount){
							$pre = $max_discount;
						}
						
						
						$data['price'] = $price-$pre;
					}		}
					$data['percent'] = getPercent($price,$data['price']);
					return array("status"=>true,"data"=>$data);
				}
				return array("status"=>false);
				
			}
		function generateSizeColor($id){
			$data = $this->showAllProductCondition($id);
		
			if(count($data)){
				$tmp = array();
				
				
				
				
				foreach($data  as $k=>$v){
					$discount = $this->checkInPrice($id,$v['price']);
					
				if($discount['status']){
						
						$v['price'] = $discount['data']['price'];
				}
					$v['size_name'] = $this->getSize($v['id_size'],'name');
					 $s1 = $this->checkProductQuantity($v['id'],$id,0);
					 $s2 = $this->checkProductQuantity($v['id'],$id,1);
					$v['sold'] = $s1+$s2; 
					
					$tmp[$v['id_color']][] = $v;
				}
				
				return $tmp;
				
			}
			return false;
			
		}
		function getMember($key){
			return $_SESSION['member_log'][$key];
		}
		function loadLang(){
			header('Content-Type: application/json');
			$arr = array("error_poll"=>"Vui lòng chọn một trong các đáp án",
						 "error_pick_color"=>"Vui lòng chọn màu cho sản phẩm",
						 "error_pick_size"=>"Vui lòng chọn size cho sản phẩm",
						 "add_cart_success"=>"Thêm sản phẩm {name} vào giỏ!",
						 "clearcart"=>"Bạn có muốn xóa tất cả sản phẩm trong giỏ hàng?",
						 "delete_cart"=>"Bạn có muốn xóa sản phẩm này trong giỏ hàng?",
						 "out_of_stock"=>"Size và màu của sản phẩm này đã hết. Vui lòng chọn sản phẩm khác?",



						);
			echo "var _lang = ".json_encode($arr).";";
			die;
		}
		function checkProductAvailable($id,$color,$size){
			if($color & $size){
				
			
			$this->db->query("select sum(quantity) as total from #_cart_detail where id_size = $size and id_color  = $color and id_product = $id and status < 2");
			$n = $this->db->fetch_array();
			$tt = (int)$n['total'];
			
			$this->db->reset();
			$this->db->query("select quantity from #_product_condition where id_size = $size and id_color = $color and id_product = $id ");
			$r = $this->db->fetch_array();
			
			return $r['quantity']-$tt;
			}else{
				return 100;
			}
		}
		function checkProductAvailableInCart($id,$color,$size,$qty,$available){
			$code = md5($id.$color.$size);
			if(isset($_SESSION['cart'][$code])){
			$i = $_SESSION['cart'][$code]['qty'];
			if($i+$qty > $available)
				return false;
			return true;
			}
			return true;
			
			
		}
		function getAllColor(){
			$this->db->query("select id,bg_color from #_product_color");
			foreach($this->db->result_array() as $k=>$v){
			$this->colors[$v['id']] = $v['bg_color'];
			}
		}
		
		
		
		function displayColor($color,$mini=false){
			return false;
			$str = "";
			if(count($color)){
				$str.= '<div class="showing-color">';
					
					foreach($color as $k=>$v){
						
						$img = json_decode($v['image'],true);
						$ximg = $this->main_image;
						if(count($img)){
							$ximg = $this->zoom.$img[0];
							if($mini){
								$ximg = $this->zoom_v2.$img[0];
							}
						}
						$str.= '<div class="color-item" data-img="'.$ximg.'" style="background:'.$this->colors[$v['id_color']].'"></div>';
					}
				$str.= '</div>';
			}
			return $str;
			
		}
		
		function getSizeCondition($p,$s,$c){
			$type = (isset($_SESSION['member_log'])) ? $_SESSION['member_log']['type'] : 0;
			$this->db->query("select id,price_$type as price from #_product_condition where id_product = $p and id_size = $s and id_color = $c");
			if(!$this->db->num_rows())
				
			return $this->db->fetch_array();
		}
		
		function checkProductQuantity($id_condition,$id_product,$stt){
			$this->db->query("select sum(quantity) as total from #_cart_detail where id_condition = $id_condition and id_product = $id_product and  status = $stt");
			
			$r = $this->db->fetch_array();
		
			return (int)$r['total'];
			
		}
		function updateOrderStt($id_cart,$stt){
			$this->db->query("select * from #_cart_detail where id_order = $id_cart and status != $stt");
			if($stt==1){
			foreach($this->db->result_array() as $k=>$v){
				$this->db->query("update #_product_condition set sold = sold + ".$v['quantity']." where id = ".$v['id_condition']);
			}
			}
			$this->db->query("update #_cart_detail set status = $stt where id_order = $id_cart");
		}
		
		
		
		
		
		function showProduct($v,$options = array(),$k=-1,$echo = true){
	
			if($k<0){
				//die("Error index");
			}
			$lang = $this->lang;
			
			if(!isset($options['class'])){
					$options['class'] = 'col-xs-12 col-md-3 col-sm-4 item-product col-8 ';
			}
		$error = "this.src='images/no_photo.png'";
		$link = "san-pham/".$v['tenkhongdau'].'-'.$v['id'].".html";
		//$str.= '<div class="'.$options['class'].' wow fadeInUp" data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
		$str= '<div class="'.$options['class'].' " data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
				$str.= '<div class="">';
				$str.= '<div class="wrap-product">';
				
				if(isset($options['remove-wishlisth'])){
					$str.= '<a href=""data-id="'.$v['id'].'" data-toggle="tooltip" class="add-wishlist remove add-to-wishlist" ><i class="fa fa-heart" aria-hidden="true"></i></a>';
				}
				
					$str.= '<div class="wrap-image">';
						$str.= '<div class="relative-image">';
							$rb_cls ='';
							$percent = getPercent($v['giacu'],$v['gia']);
							
							$discount = checkInPrice($v);
						
							if($discount['status']){
									$v['giacu'] = $v['gia'];
									$v['gia'] = $discount['data']['price'];
									$percent = $discount['data']['percent'];
									
							}
							
							if($percent > 0 & $percent < 100){
								$str.="<div class='rb2 sale'></div>";
							}
							
							if($v['new']){
								$str.="<div class='rb2 new'></div>";
							}
							
							$str.= '<div class="rel"><div class="xm-image">';
							/*$str.= '<div class="x-view">
								<a href="'.$link.'" title="'._chitiet.' '._product.' '.$v['ten_'.$lang].'" class="fancybox fancybox.ajax"><i class="fa fa-expand"></i>&nbsp;'._chitiet.'</a>
							</div>';*/
							$this->main_image = $this->zoom."/"._upload_sanpham_l.$v['photo'];
							
							$str.= '<div class="x-inner"><a href="'.$link.'" title="'.$v['ten_'.$lang].'" class=""><img src="'.$this->main_image.'" onerror="'.$error.'" data-img-default="'.$this->main_image.'" class="img-responsive img-max" alt="'.$v['ten_'.$lang].'" /></a></div>';
							
							$str.= '</div><!-- end xm-image -->';
							//$str.= $this->displayColor($this->getColor($v['id']));
							
							
							
							
							$str.= '</div><div class="tools">';
								$str.= '<div class="wrap-tools"><div class="inner-tools">';
								$str.= '<div class="clearfix"></div>';
								
								$str.= '<div class="name ">';
									$str.= '<h3><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.($v['ten_'.$lang]).'</a></h3>';
								$str.= '</div>';
								
								$str.= '<div class="clearfix"></div>';
//								$str.= ' <div class="wrap-raty"><div class="raty" data-score="'.$v['score'].'"></div></div>';
								$str.= '<div class="wrap-price">';
								
								
								
								
								
								
								if(($v['giacu'] > 0) & ($v['giacu'] > $v['gia']) & $v['gia'] > 0){
								
									$str.= '<div class="old-price ">';
									$str.= '<span>'.myformat($v['giacu']).'</span>';
								$str.= '</div>';
								$str.= '<div class="price seller">';
									$str.= '<span>'.(($v['gia']) ? myformat($v['gia']) : '').'</span>';
								$str.= '</div>';
								
								if($percent > 0 & $percent < 100){
								$str.= '<div class="seller">';
								
									$str.= '<span>-'.$percent.'%</span>';
								
								$str.= '</div>';
								}
								
								}else{
								$str.= '<div class="price ">';
									$str.= '<span>'.(($v['gia']) ? myformat($v['gia']) : 'Xem chi tiết').'</span>';
								$str.= '</div>';
								}
								$str.= '</div><!-- end wrap-price -->';
								/*
								$colors = $this->generateSizeColor($v['id']);
								$str.="<div class='rel foot'>";
							if(count($colors)){
								
								$ci = array();
								foreach(getColorByProductId($v['id']) as $kx=>$vx){
									$j = json_decode($vx['image'],true);
									
									if(count($j) > 0){
										$ci[$vx['id_color']] = getUrl($j[0]);
									}
								}
								
								$str.= '<div class="showing-color"><div class="inner-view"> More color </div>';								
								$str.= '<div class="showing-size size-'.$v['id'].'"></div>';
								foreach($colors as $k2=>$v2){
									
									$str.= '<script>';
									
								
									
									$str.=  "   if(_size_".$v['id']."_".$k2."==undefined){   var _size_".$v['id']."_".$k2." = ".json_encode($v2)."; }";
									$str.=  '</script>';
									$str.= '<div class="color-item" data-img="'.$ci[$v2[0]['id_color']].'" data-id="'.$k2.'" data-pid="'.$v['id'].'" style="background:'.$this->getColor($k2,'bg_color').'"></div>';
								}
								$str.= '</div>';
							}
							
							$str.='</div>';
						*/
							
							
							$str.= '<div class="clearfix"></div>';
							
							
							//$str.='<div class="add-cart"><a href="javascript:void(0)" onclick="doAddCartSpecial($(this),\''.$v['ten_'.$lang].'\',\''.$v['id'].'\',1)"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Mua hàng</a></div>';
							
							$str.= '</div><!--end --></div></div><!-- end inner-tools--> <!-- end tools-->';
							
							
						$str.= '</div><!--- end relative-image -->';
					$str.= '</div>';
				
					
					
				
				$str.= '</div>';
				$str.= '</div>';
			
			$str.= '</div>';
			/*if(!isset($options['max'])){
				if($k > -1){
					if(($k+1)%2==0){
						$str.= '<div class="clearfix visible-xs"></div>';
					}
					if(($k+1)%3==0){
						$str.= '<div class="clearfix visible-sm visible-lg visible-md"></div>';
					}
					if(($k+1)%4==0){
					//	$str.= '<div class="clearfix visible-lg visible-md"></div>';
					}
				}
			}else{
				
				if($k > -1){
					if(($k+1)%2==0){
						$str.= '<div class="clearfix visible-xs"></div>';
					}
					if(($k+1)%3==0){
						$str.= '<div class="clearfix visible-sm "></div>';
					}
					if(($k+1)%4==0){
						$str.= '<div class="clearfix visible-lg visible-md"></div>';
					}
				}
			}
			*/
			if($echo) {
				echo $str;
			}else{
				return $str;
			}
			
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		function showProduct2x($v,$options = array(),$k=-1,$echo = true){
	
			if($k<0){
				//die("Error index");
			}
			$lang = $this->lang;
			
			if(!isset($options['class'])){
					$options['class'] = 'col-xs-6 col-md-4 col-sm-4 item-product';
			}
		$error = "this.src='images/no_photo.png'";
		$link = "san-pham/".$v['tenkhongdau'].'-'.$v['id'].".html";
		//$str.= '<div class="'.$options['class'].' wow fadeInUp" data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
		$str= '<div class="'.$options['class'].' " data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
				$str.= '<div class="">';
				$str.= '<div class="wrap-product">';
				
				if(isset($options['remove-wishlisth'])){
					$str.= '<a href=""data-id="'.$v['id'].'" data-toggle="tooltip" class="add-wishlist remove add-to-wishlist" ><i class="fa fa-heart" aria-hidden="true"></i></a>';
				}
				
					$str.= '<div class="wrap-image">';
						$str.= '<div class="relative-image">';
							$rb_cls ='';
							$percent = getPercent($v['giacu'],$v['gia']);
							
							
							if($percent > 999){
								$str.= '<div class="rb seller">';
								
									$str.= '<span>-'.$percent.'%</span>';
								
								$str.= '</div>';
							}
							$str.= '<div class="rel"><div class="xm-image">';
							/*$str.= '<div class="x-view">
								<a href="'.$link.'" title="'._chitiet.' '._product.' '.$v['ten_'.$lang].'" class="fancybox fancybox.ajax"><i class="fa fa-expand"></i>&nbsp;'._chitiet.'</a>
							</div>';*/
							$this->main_image = $this->zoom."/"._upload_sanpham_l.$v['photo'];
							
							$str.= '<div class="x-inner"><a href="'.$link.'" title="'.$v['ten_'.$lang].'" class=""><img src="'.$this->main_image.'" onerror="'.$error.'" data-img-default="'.$this->main_image.'" class="img-responsive img-max" alt="'.$v['ten_'.$lang].'" /></a></div>';
							
							$str.= '</div><!-- end xm-image -->';
							//$str.= $this->displayColor($this->getColor($v['id']));
							$colors = $this->generateSizeColor($v['id']);
							if(count($colors)){
								$ci = array();
								foreach(getColorByProductId($v['id']) as $kx=>$vx){
									$j = json_decode($vx['image'],true);
									if(count($j) > 0){
										$ci[$vx['id_color']] = getUrl($j[0]);
									}
								}
								$str.= '<div class="showing-color">';								
								$str.= '<div class="showing-size size-'.$v['id'].'"></div>';
								foreach($colors as $k2=>$v2){
									$str.= '<script>';
									$str.=  "   if(_size_".$v['id']."_".$k2."==undefined){   var _size_".$v['id']."_".$k2." = ".json_encode($v2)."; }";
									$str.=  '</script>';
									$str.= '<div class="color-item" data-img="'.@$ci[$k2].'" data-id="'.$k2.'" data-pid="'.$v['id'].'" style="background:'.$this->getColor($k2,'bg_color').'"></div>';
								}
								$str.= '</div>';
							}
							
							
							
							$str.= '</div><div class="tools">';
								$str.= '<div class="wrap-tools"><div class="inner-tools">';
								$str.= '<div class="clearfix"></div>';
								
								$str.= '<div class="name ">';
									$str.= '<h3><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.($v['ten_'.$lang]).'</a></h3>';
								$str.= '</div>';
								
								$str.= '<div class="clearfix"></div>';
								$str.= ' <div class="wrap-raty"><div class="raty" data-score="'.$v['score'].'"></div></div>';
								$str.= '<div class="wrap-price">';
								
								
								
								
								/*if(($v['giacu'] > 0) & ($v['giacu'] > $v['gia']) & $v['gia'] > 0){
								$str.= '<div class="price seller">';
									$str.= '<span>'.(($v['gia']) ? myformat($v['gia']) : '').'</span>';
								$str.= '</div>';
									$str.= '<div class="old-price pull-left">';
									$str.= '<span>'.myformat($v['giacu']).'</span>';
								$str.= '</div>';
								
								
								$str.= '<div class="clearfix"></div>';
								}else{*/
								$type = (isset($_SESSION['member_log'])) ? $_SESSION['member_log']['type'] : 0;
								$price = $v['price_'.$type];
								$str.= '<div class="price " data-price="'.$price.'">';
								$str.= '<span>Giá: '.(($price) ? myformat($price) : 'Xem chi tiết').'</span>';
								$str.= '</div>';
								//}
								$str.= '</div><!-- end wrap-price -->';
							$str.= '<div class="clearfix"></div>';
							
							
							//$str.='<div class="add-cart"><a href="javascript:void(0)" onclick="doAddCartSpecial($(this),\''.$v['ten_'.$lang].'\',\''.$v['id'].'\',1)"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Mua hàng</a></div>';
							
							$str.= '</div><!--end --></div></div><!-- end inner-tools--> <!-- end tools-->';
							$str.= $this->displayColor($this->getColor($v['id']));
							
						$str.= '</div><!--- end relative-image -->';
					$str.= '</div>';
				
					
					
				
				$str.= '</div>';
				$str.= '</div>';
			
			$str.= '</div>';
			if(!$options['max']){
				if($k > -1){
					if(($k+1)%2==0){
						$str.= '<div class="clearfix visible-xs"></div>';
					}
					if(($k+1)%3==0){
						$str.= '<div class="clearfix visible-sm"></div>';
					}
					if(($k+1)%4==0){
						$str.= '<div class="clearfix visible-lg visible-md"></div>';
					}
				}
			}else{
				if($k > -1){
					if(($k+1)%2==0){
						$str.= '<div class="clearfix visible-xs"></div>';
					}
					if(($k+1)%3==0){
						$str.= '<div class="clearfix visible-sm"></div>';
					}
					if(($k+1)%4==0){
						$str.= '<div class="clearfix visible-lg visible-md"></div>';
					}
				}
			}
			if($echo) {
				echo $str;
			}else{
				return $str;
			}
			
			
		}
		
		function getNewProduct($id=null,$limit=8){
			$w = '';
			if($id){
				$w = " and id != $id ";
			}
			$this->db->query("select * from #_product where hienthi = 1 and new  > 0  $w order by new desc,stt asc limit $limit");
			
			$data = $this->db->result_array();
			
			return $data;
			
		}
		function getFeatureProduct($id=null,$limit=8){
			$w = '';
			if($id){
				$w = " and id != $id ";
			}
			$this->db->query("select * from #_product where hienthi = 1 and noibat  > 0 $w order by noibat desc,stt asc limit $limit");
			return $this->db->result_array();
		}
		function showProductWithStart($v,$options = array(),$k=-1,$echo = true){
			
			if($k<0){
				//die("Error index");
			}
			$lang = $this->lang;
			
			if(!isset($options['class'])){
			$options['class'] = 'col-xs-6 col-md-3 col-sm-4 item-product';
			}
		$error = "this.src='images/no_photo.png'";
		$link = "product/".$v['tenkhongdau'].'-'.$v['id'].".html";
		//$str.= '<div class="'.$options['class'].' wow fadeInUp" data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
		$str= '<div class="'.$options['class'].' " data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
				$str.= '<div class="">';
				$str.= '<div class="wrap-product">';
					$str.= '<div class="wrap-image">';
						$str.= '<div class="relative-image">';
							$rb_cls ='';
							$percent = getPercent($v['giacu'],$v['gia']);
							
							
							if($percent > 999){
								$str.= '<div class="rb seller">';
								
									$str.= '<span>-'.$percent.'%</span>';
								
								$str.= '</div>';
							}
							
							$str.= '<div class="rel"><div class="xm-image">';
							/*$str.= '<div class="x-view">
								<a href="'.$link.'" title="'._chitiet.' '._product.' '.$v['ten_'.$lang].'" class="fancybox fancybox.ajax"><i class="fa fa-expand"></i>&nbsp;'._chitiet.'</a>
							</div>';*/
							$this->main_image = $this->zoom."/"._upload_sanpham_l.$v['photo'];
							
							$str.= '<div class="x-inner"><a href="'.$link.'" title="'.$v['ten_'.$lang].'" class=""><img src="'.$this->main_image.'" onerror="'.$error.'" data-img-default="'.$this->main_image.'" class="img-responsive img-max" alt="'.$v['ten_'.$lang].'" /></a></div>';
							
							$str.= '</div><!-- end xm-image -->';
							//$str.= $this->displayColor($this->getColor($v['id']));
							
							$str.= '</div><div class="tools">';
								$str.= '<div class="wrap-tools"><div class="inner-tools">';
								$str.= '<div class="clearfix"></div>';
								
								$str.= '<div class="name ">';
									$str.= '<h3><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.($v['ten_'.$lang]).'</a></h3>';
								$str.= '</div>';
								
								$str.= '<div class="clearfix"></div>';
								$str.= ' <div class="wrap-raty"><div class="raty" data-score="'.$v['score'].'"></div></div>';
								$str.= '<div class="wrap-price">';
								if(($v['giacu'] > 0) & ($v['giacu'] > $v['gia']) & $v['gia'] > 0){
								$str.= '<div class="price seller">';
									$str.= '<span>'.(($v['gia']) ? myformat($v['gia']) : '').'</span>';
								$str.= '</div>';
									$str.= '<div class="old-price pull-left">';
									$str.= '<span>'.myformat($v['giacu']).'</span>';
								$str.= '</div>';
								
								
								$str.= '<div class="clearfix"></div>';
								}else{
								$str.= '<div class="price ">';
									$str.= '<span>Giá: '.(($v['gia']) ? myformat($v['gia']) : 'Xem chi tiết').'</span>';
								$str.= '</div>';
								}
								$str.= '</div><!-- end wrap-price -->';
							
							
							$str.= '<div class="clearfix"></div>';
							
							$str.='<div class="add-cart"><a href="javascript:void(0)" onclick="doAddCart(\''.$v['ten_'.$lang].'\',\''.$v['id'].'\',1)"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Mua hàng</a></div>';
							
							$str.= '</div><!--end --></div></div><!-- end inner-tools--> <!-- end tools-->';
							
							
						$str.= '</div><!--- end relative-image -->';
					$str.= '</div>';
				
					
					
				
				$str.= '</div>';
				$str.= '</div>';
			
			$str.= '</div>';
			if(!isset($options['max'])){
			if($k > -1){
			if(($k+1)%2==0){
				$str.= '<div class="clearfix visible-xs"></div>';
			}
			if(($k+1)%3==0){
				$str.= '<div class="clearfix visible-sm"></div>';
			}
			if(($k+1)%4==0){
				$str.= '<div class="clearfix visible-lg visible-md visible-sm"></div>';
			}
			}
			}else{
				
				if($k > -1){
				if(($k+1)%2==0){
					$str.= '<div class="clearfix visible-xs"></div>';
				}
				if(($k+1)%3==0){
					$str.= '<div class="clearfix visible-sm"></div>';
				}
				if(($k+1)%3==0){
					
					$str.= '<div class="clearfix visible-lg visible-md visible-sm"></div>';
				}
				}
				
			}
			if($echo) {
				echo $str;
			}else{
				return $str;
			}
		}
		
		
		
		function getUrlFromType($type){
			$_allower = array("news"=>"tin-tuc","tuvan"=>"khuyen-mai");
			if(isset($_allower[$type])){
				return $_allower[$type];
			}
			return $type;
		}
		function getTags(){
			return $this->_totalslug;
		}	
		function setTotalSlug(){
			return true;
			$this->d->query("select * from #_tag order by length_".$this->lang." desc");
			$this->_totalslug = $this->d->result_array();
		}
		function getTagName($tag){
			$this->d->query("select * from #_tag where slug_".$this->lang." = '".$tag."'");
			$rs = $this->d->fetch_array();
			return $rs['ten_'.$this->lang];
		}
		function getContentWithTag($tagname){
			$tagname = $this->getTagName($tagname);
			$content = array();
			$this->d->query("select id,noidung_".$this->lang.",tenkhongdau,ngaytao,thumb from #_content where hienthi = 1 order by stt desc");
			$content = $this->d->result_array();
			$list = array();
			$reg ='/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))($name)/imsU';
			foreach ($content as $k=>$v) {
			
				$name = str_replace(',','|',$tagname);
			
				$regexp=str_replace('$name', $name, $reg);    
				if(preg_match_all($regexp,  $v['noidung_'.$this->lang], $matches)){
					$list[] = $v['id'];
				}
				
			}
			return array("id"=>$list,"name"=>$tagname);
		}
		function autoAddSeoTags($text){
		return $text;
		foreach($this->_totalslug as $k=>$v){	
			
			if(!$v['type']){
				$kw_array[$v['ten_'.$this->lang]]['link'] = "tag/".changeTitle($v['ten_'.$this->lang])."/";
			}else{
				$kw_array[$v['ten_'.$this->lang]]['link'] = $v['link'];
			}
			$kw_array[$v['ten_'.$this->lang]]['type'] = $v['type'];
		}
		$maxsingle=-1;
		$reg ='/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))($name)/imsU';
		foreach ($kw_array as $name=>$item) {
			$url = $item['link'];
			$stt = 0;
			$name = str_replace(',','|',$name);
			$replace="<a title=\"$1\" href=\"$url\">$1</a>";
			$regexp=str_replace('$name', $name, $reg);    
			$newtext = preg_replace($regexp, $replace, $text, $maxsingle);            
			if ($newtext!=$text) {                
				$stt++;
				$text=$newtext;                       
			}         
			if($stt > 0 & !$item['type']){
			
			}		
		}
		
		return trim( $text );
}
	
		
	}