<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	
	
	
	
	$d->query("select id from #_product_cat ");
	$cat =array();
	foreach($d->result_array() as $k=>$v){
		$cat[$v['id']] = $v['id_list'];
	}
	//foreach($d->result_array() as $k2=>$v2){
	$d->query("select * from content  a,content_body b,content_meta c where  a.contentid = b.contentidx and a.contentid = c.contentidxx and content_group = 3 ");
	foreach($d->result_array() as $k=>$v){
	//	check($v);die;
		$data['id'] = $v['contentid'];
		$data['ten_vi'] = $v['title'];
		$data['luotxem'] = $v['view'];
		$data['tenkhongdau'] = $v['alias'];
		$data['title'] = $v['meta_title'];
		$data['description'] = $v['meta_description'];
		$data['keyword'] = $v['meta_keywords'];
		$data['hienthi'] = $v['status'];
		$data['ngaytao'] = $v['create_time'];
		$data['com'] = $v['product'];
		$data['id_list'] = $v['parentid'];
		$data['id_cat'] = $v['catid'];
		$data['stt'] = $v['catid'];
		$data['mota_vi'] = magic_quote($v['body']);
		$data['noidung_vi'] = magic_quote($v['body']);
		$data['photo'] = $v['image'];
		$data['thumb'] = $v['image'];
		
		//check($data);die;
		$d->reset();
		$d->setTable("product");
		$d->insert($data);
		
		
		
		//$d>query("	")
	
	}
	die("done");
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	die("X");
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
	
	if (class_exists('model')) {
		
		$model = new model($d,$lang);
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
			//$source = "about";
			//$template = isset($_GET['id']) ? "news/detail" : "news/index";
			$source = "baiviet";
			$_GET['id'] = 1;
			$template = "baiviet/detail";
			break;	
		case 'bai-viet':
			$source = "baiviet";
			$template = "content/detail";
			break;	
				
		case 'tuyen-dung':
			$source = "baiviet";
			$_GET['id'] = 2;
			$template = "content/detail";
			break;	
		
		case 'video':
			$source = "video";
			$template = isset($_GET['id']) ? "video/detail" : "video/index";
			break;	
			
		
		case 'san-pham':
			$source = "product";
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
		case 'thu-vien-anh':
			$source = "content";
			$type = "album";
			$suffix = "Thư viện ảnh";
			$template = @isset($_GET['id']) ? "content/detail_photo" : "content/index_photo";
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
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
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
		case 'tin-tuc':
			$source = "content";
			$type = "news";
			$suffix = _news;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;	
		case 'khuyen-mai':
			$source = "content";
			$type = "tuvan";
			$suffix = 'Khuyến mãi';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
		break;
		case 'chinh-sach':
			$source = "content";
			$type = "chinhsach";
			$suffix = 'Chính sách';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
		break;
			case 'y-nghia-cac-loai-nuoc-hoa':
			$source = "content";
			$type = "poison";
			$suffix = 'Ý nghĩa các loại nước hoa';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;
		case 'gioi-thieux':
			$source = "content";
			$type = "about";
			$suffix = _about;
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
			}
			echo '<script language="javascript">history.go(-1)</script>';
			break;		
		case '404':
			$source = "index";
			$template = "404";
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
	if(@$_REQUEST['com']=='logout')
	{
	session_unregister($login_name);
	header("Location:index.php");
	}

?>
