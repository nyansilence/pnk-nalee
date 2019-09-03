<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);

	$d->query("select * from #_setting");
	$global_setting = $d->fetch_array();
	if(!isset($_SESSION['lang'])){
		$_SESSION['lang']=$global_setting['default_lang'];
	}
	if(count($config['lang']) == 1){
		$lang=$global_setting['default_lang'];
	}else{
		$lang=$_SESSION['lang'];
	}
	$maintenance = false;
	
	
	if($global_setting['site_maintenance'] & @$_GET['com']==""){
		$maintenance = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$maintenance.= $global_setting['site_maintenance_message']."</body></html>";
		
	}
	
	if (file_exists(_lib."AntiSQLInjection.php") & $config['defender']){
		include_once _lib."AntiSQLInjection.php";
	}
	if (file_exists(_lib."firewall.php")){
		include_once _lib."firewall.php";
	}
	if (class_exists('model')) {
		
		$model = new model($d,$lang);
	}
	if (class_exists('Assets')) {
		
		$assets = new Assets($config['dev']);
		$assets->addCss("assets/css/normalize.css");
		$assets->addCss("assets/bootstrap/css/bootstrap.min.css");
		$assets->addCss("assets/plugins/fancybox-v3/v2/jquery.fancybox.css");
		$assets->addCss("assets/plugins/owlcarousel/assets/owl.carousel.css");
		$assets->addCss("assets/plugins/wow/css/libs/animate.css");
		$assets->addCss("assets/plugins/nprogress-master/nprogress.css");
		$assets->addCss("assets/plugins/notify/css/jquery.notify.css");
		$assets->addCss("assets/css/product.css");
		$assets->addCss("assets/plugins/carousel/css/style.css");
		$assets->addCss("assets/fonts/font-awesome-4.5.0/css/font-awesome.min.css");
		$assets->addCss("assets/plugins/raty/jquery.raty.css");
		$assets->addCss("assets/fonts/helvetica/helveticaneue.css");
		$assets->addCss("assets/fonts/fontello/css/animation.css");
		$assets->addCss("assets/fonts/fontello/css/fontello.css");
		$assets->addCss("assets/fonts/fontello/css/fontello-ie7.css");
		$assets->addCss("assets/plugins/jssocials/social-buttons.css");
		
		
		
		$assets->addJs("assets/plugins/nprogress-master/nprogress.js");
		$assets->addJs("assets/plugins/wow/dist/wow.min.js");
		$assets->addJs("assets/plugins/fancybox-v3/v2/jquery.fancybox.js");
		$assets->addJs("assets/plugins/owlcarousel/owl.carousel.min.js");
		$assets->addJs("assets/bootstrap/js/bootstrap.min.js");
		$assets->addJs("assets/plugins/notify/js/jquery.notify.min.js");
		$assets->addJs("assets/plugins/carousel/js/jquery.flexisel.js");
		$assets->addJs("assets/js/less-1.7.3.min.js");
		$assets->addJs("assets/plugins/raty/jquery.raty.js");
		$assets->addJs("assets/plugins/jssocials/social-buttons.js");
		
		
		
		
	}
	require_once _source."lang_$lang.php";	
	if (class_exists('breadcrumb')) {
		$bread = new breadcrumb();
		$bread->add(_home,$config_url);
		
		
	}
	switch($com)
	{
		case 'detect':
			include_once _template."detect.php";
			die();
			break;
		case 'loadlang':
			$model->loadLang();
			die;
			break;
		case 'google0f500410c5f9ea72':
			include_once "google0f500410c5f9ea72.html";
			die();
			break;
		case 'ajax':
			$source = "ajax";
			break;	
		case 'home':
			$source = "index";
			$template = (isset($_GET['id'])) ? "index_item" : "index";
		break;	
		
		case 'shopcart':
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;
				case 'thanh-vien':
			$source = "member";
			
			break;
		case 'tag':
			$source = "tag";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
		break;	
		case 'css':
			$source = "css";
			//$template = "camera/index";
		break;
		
		
		case 'gioi-thieu':
			
			$source = "baiviet";
			$_GET['id'] = 1;
			$template = "baiviet/detail";
			break;
		case 'doi-tra-linh-hoat':
			
			$source = "baiviet";
			$_GET['id'] = 13;
			$template = "baiviet/detail";
			break;		
			
		case 'thanh-toan-qua-ngan-hang':
			
			$source = "baiviet";
			$_GET['id'] = 16;
			$template = "baiviet/detail";
			break;
			case 'thu-tien-tai-nha':
			
			$source = "baiviet";
			$_GET['id'] = 17;
			$template = "baiviet/detail";
			break;
		case 'khuyen-mai':
			$source = "khuyenmai";
			$template = isset($_GET['id']) ? "khuyenmai/index_product" : "khuyenmai/index";
			$template = isset($_GET['id']) ? "khuyenmai/index_product" : "giacong/index";
			break;
		case 'lookbook':
			$source = "lookbook";
		
			$template = isset($_GET['id']) ? "giacong/detail_lookbook" : "giacong/index2";
			break;


			case 'tra-hang-mien-phi-trong-5-ngay':
			
			$source = "baiviet";
			$_GET['id'] = 18;
			$template = "baiviet/detail";
			break;	

			case 'giao-hang-mien-phi':
			
			$source = "baiviet";
			$_GET['id'] = 19;
			$template = "baiviet/detail";
			break;			
			case 'hoan-tien-mien-phi':
			
			$source = "baiviet";
			$_GET['id'] = 19;
			$template = "baiviet/detail";
			break;
			
			case 'van-chuyen-an-toan':
			
			$source = "baiviet";
			$_GET['id'] = 14;
			$template = "baiviet/detail";
			break;
			case 'giam-gia-uu-dai':
			
			$source = "baiviet";
			$_GET['id'] = 15;
			$template = "baiviet/detail";
			break;	
		case 'dang-ky-dai-ly':
			//$source = "about";
			//$template = isset($_GET['id']) ? "news/detail" : "news/index";
			$source = "baiviet";
			$_GET['id'] = 7;
			$template = "baiviet/detail";
			break;	
			case 'tai-khoan-ngan-hang':
			//$source = "about";
			//$template = isset($_GET['id']) ? "news/detail" : "news/index";
			$source = "baiviet";
			$_GET['id'] = 9;
			$template = "baiviet/detail";
			break;		
		case 'bai-viet':
			$source = "baiviet";
			$template = "content/detail";
			break;	
				
		
		
		case 'video':
			$source = "video";
			$template = isset($_GET['id']) ? "video/detail" : "video/index";
			break;	
			
		
		case 'product':
		case 'san-pham':
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;	
		case 'san-pham-moi':
			$source = "product";
			$type = "new";
			$pfix = 'Sản phẩm mới';
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
		break;
		case 'khuyen-mai':
			$source = "product";
			$type = "new";
			$pfix = 'Sản phẩm khuyến mãi';
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
		break;
		
		case 'hang-gia-cong':
			$source = "giacong";
			$template = "giacong/index";
		break;
		
		
		case 'san-pham-tieu-bieu':
			$source = "product";
			$type = "noibat";
			$pfix = 'Sản phẩm tiêu biểu';
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
		break;
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;		


		
		case 'dat-cau-hoi':
			$source = "question";
			$template =  "question/index";
			break;	
		case 'kien-thuc-phong-thuy':
			$source = "content";
			$type = "info";
			$suffix = "Kiến thức phong thủy";
			$template = @isset($_GET['id']) ? "content/detail_photo" : "content/index_photo";
			$template = @isset($_GET['id']) ? "content/detail" : "content/index";
			break;	
		case 'tai-lieu':
			$source = "content";
			$type = "document";
			$suffix = "Tài liệu";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_document";
			break;
		case 'thuc-don':
			$source = "menu";
			$template = isset($_GET['id']) ? "menu/detail" : "menu/index";
			break;
			
			case "phap-ly";
			$type = "juridical";
			$suffix = "Pháp lý";
			$source = "content";
			$template = @isset($_GET['id']) ? "content/detail" : "content/index";
			break;
			case "tham-dinh-gia";
			$type = "valuation";
			$suffix = "Thẩm định giá";
			$source = "content";
			$template = isset($_GET['id']) ? "content/detail" : "content/index";
			break;
		
		case 'tien-ich':
			$source = "content";
			$type = "tool";
			$perpage = 12;
			$suffix = "Tiện ích";
			$template = isset($_GET['id']) ? "content/detail" : "content/index_special2";
			break;	
		case 'du-an':
			$source = "content";
			$type = "project";
			$suffix = "Dự án";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;		
		case 'dich-vu':
			$source = "content";
			$type = "service";
			$suffix = _service;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_x";
			break;
		case 'cong-trinh':
			$source = "content";
			$type = "company";
			$suffix = "Công trình";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;	
		case 'bang-gia':
			$source = "content";
			$type = "price";
			$suffix = "Bảng giá";
			$template = isset($_GET['id']) ? "content/detail_service" : "content/service_index";
			break;	
		case 'news':
		case 'tin-tuc':
			$source = "content";
			$type = "news";
			$suffix = _news;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_x";
			break;

		
		case 'huong-dan':
			$source = "content";
			$type = "huongdan";
			$suffix = "Hướng Dẫn";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_x";
			break;			
		case 'cam-ket-ban-hang':
			$source = "content";
			$type = "info";
			$suffix = 'Cam kết bán hàng';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_x";
			break;	
		case 'tuyen-dung':
			$source = "content";
			$type = "recruitment";
			$suffix = _recruitment;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index";
			break;
			case 'gioi-thieu':
			$source = "content";
			$type = "about";
			$suffix = 'Giới thiệu';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_x";
			break;	
			case 'hoi-dap':
			$source = "content";
			$type = "question";
			$suffix = 'Hỏi đáp';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index";
			break;
		case 'hop-thu-gop-y':
			$source = "feedback";
			$template = "feedback/index";
			break;
		case 'ho-tro':
			$source = "content";
			$type = "support";
			$suffix = 'Hỗ trợ khách hàng';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index";
			break;	
		
		case 'chinh-sach':
			$source = "content";
			$type = "policy";
			$suffix = 'Chính sách';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
		break;
			case 'y-nghia-cac-loai-nuoc-hoa':
			$source = "content";
			$type = "poison";
			$suffix = 'Ý nghĩa các loại nước hoa';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;
	
		
		
		
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;	
		case 'search':
			$source = "search";
			$template = "search/product";
			break;	
		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					case 'cn':
						$_SESSION['lang'] = 'cn';
						break;	
					
					default: 
						$_SESSION['lang'] = 'vi';
						break;
					}
			}
			else{
			$_SESSION['lang'] = 'vi';
			}			redirect($_SERVER['HTTP_REFERER']);
			break;		
		case '404':
			$source = "index";
			$template = "404";
			header("HTTP/1.0 404 Not Found");
			include _template.$template."_tpl.php";die;
			break;
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	

	#  lay meta tim kiem
	$sql_meta = "select * from #_meta limit 0,1";
	$d->query($sql_meta);
	$row_meta= $d->fetch_array();	
	$title = $row_meta['title'];
	$description = $row_meta['description'];
	$keyword = $row_meta['keyword'];
	if($source!="") include _source.$source.".php";
	if (class_exists('Assets')) {
		$assets->addCss("assets/css/style.css");
		$assets->addJs("assets/js/script.js");
	}
	if(@$_REQUEST['com']=='logout')
	{
	session_unregister($login_name);
	header("Location:index.php");
	}

?>
