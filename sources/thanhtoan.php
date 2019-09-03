<?php  if(!defined('_source')) die("Error");		
	// thanh tieu de
	$title_bar = "Thanh toán ";
	$assets->addCss("assets/css/new-cart.css");
	$bread->add("Thanh toán",getCurrentPageUrl());
	$m = @$_SESSION['member_log'];
	if(!empty($_POST)){
		
	
		//validate dữ liệu
			
			 
			if(is_array($_SESSION['cart']))
			{
					$m = $_POST;
				
				$time = strtotime(date("m/d/Y 0:00",time()));
				$d->query("select id from #_donhang where ngaytao > $time");
				
			
				$part =  str_pad(($d->num_rows()+1), 4, "0", STR_PAD_LEFT);
				
				$mahoadon = "DC".date("dmy",time()).$part;
			
				
				
				
				$data['hoten'] = $_POST['bill']['name'];
				$data['dienthoai'] = $_POST['bill']['phone'];
				$data['diachi'] = $_POST['bill']['address'];
				$data['email'] = $_POST['bill']['email'];
				$data['noidung'] = $_POST['content'];
				$data['receive_name'] = $_POST['receive']['name'];
				$data['receive_phone'] = $_POST['receive']['phone'];
				$data['receive_address'] = $_POST['receive']['address'];
				$data['receive_email'] = $_POST['receive']['email'];
				
				$data['hinhthucthanhtoan'] = $_POST['trans'];
				$data['hinhthucvanchuyen'] = $_POST['trans2'];
				$data['madonhang'] = $mahoadon;				
				
			$d->query("select * from #_hinhthucthanhtoan where id = '".$data['hinhthucthanhtoan']."'");
			$httt = $d->fetch_array();
			$d->query("select * from #_hinhthucvanchuyen where id = '".$data['hinhthucvanchuyen']."'");
			$htvc = $d->fetch_array();
			
			
			$data_email = $data;
			$data_email['httt'] = $httt['ten_'.$lang];
			$data_email['htvc'] = $htvc['ten_'.$lang]." - ".myformat($htvc['gia']);
			$data_email['ship'] = $htvc['gia'];
			$data_email['loinhan'] = $_POST['content'];
			$email_info = getInlineCssInfo($data_email);
			$ngaydangky=time();
			
			$c = $model->getTotalPriceCart();
			$tonggia=$c['price'];
			
			$cart = getData(_template."layout/cart_checkout_tpl.php",array("model"=>$model,"ship"=>$htvc['gia']));
			$email = getData(_template."layout/body_mail_checkout.php",array("model"=>$model,"ship"=>$htvc['gia'],"mahoadon"=>$mahoadon,"ngaydathang"=>$ngaydangky,"httt"=>$httt['ten_'.$lang],"htvc"=>$htvc['ten_'.$lang],"ship"=>$htvc['gia']));
			
			
			$data['donhang'] = magic_quote($cart);
			$data['ngaytao'] = $ngaydangky;
			$data['tinhtrang'] = 1;
			$data['thanhvien'] = $_SESSION['member_log']['id'];
			$data['ship'] = $htvc['gia'];
			$data['tienhang'] = $tonggia;
			$data['tonggia'] = $tonggia+ $htvc['gia'];
			$x = array();
			$x[]['email'] = $data['email'];
			if(sendEmail($global_setting['email_contact'],null,$htl['ten_'.$lang], "Thư đặt hàng từ ".$htl['ten_'.$lang], $email,$x)){
			
				$d->reset();
				$d->setTable("donhang");
				$d->insert($data);
				$id = mysql_insert_id();
				
				foreach($_SESSION['cart'] as $k=>$v){
					
					$c = $model->getSizeCondition($v['productid'],$v['size'],$v['color']);
				
					$data = array();
					$data['id_order'] = $id;
					$data['id_product'] = $v['productid'];
					$data['id_condition'] = $c['id'];
					$data['id_member'] = $_SESSION['member_log']['id'];
					$data['id_size'] = $v['size'];
					$data['id_color'] = $v['color'];
					$data['price'] = $c['price'];
					$data['quantity'] = $v['qty'];
					$d->reset();
					$d->setTable("cart_detail");
					$d->insert($data);
				}
				
			
				unset($_SESSION['cart']);
				 
				 transfer("Đơn hàng của bạn đã được gửi", "index.html");
			}
			
			
		
	}
			}
	
	
		