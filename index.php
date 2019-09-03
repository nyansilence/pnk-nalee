<?php
	session_start();
	$session=session_id();
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	@define ( '_template' , './templates/');
	@define ( '_assets' , './assets/');
	include_once _lib."config.php";	
   # include_once _lib."cache/phpfastcache.php";	
	include_once _lib."constant.php";
	include_once _lib."class.database.php";
	include_once _lib."functions.php";	
	include_once _lib."functions_giohang.php";
	include_once _lib."model.php";	
	include_once _lib."breadcrumb.php";	
	include_once _lib."assets.php";	
	include_once _lib."file_requick.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<base href="<?=$config_url?>/"  />
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="vi" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" />
<meta name="keywords" content="<?=$keyword?>" />
<meta name="description" content="<?=$description?>" />
<meta name="author" content="" />
<meta name="copyright" content="" />
<meta name="robots" content="noodp,index,follow" />
<meta name="DC.title" content="" />
<meta name="ICBM" content="" />
<meta name='revisit-after' content='1 days' />
<meta name="google-site-verification" content="vpkmNA3f1oSzneBoDoUtjL8E6NKG7dDB_Yuvr519cp4" /> 
<?=$global_setting['meta_top']?>
<?=$global_setting['google_analytics']?>
<?php 
$img = $config_url."/thumb/600x315/3/"._upload_hinhanh_l.$global_setting['share_image'];
if(isset($product_detail)){
$img  = ($product_detail) ?  $config_url."/thumb/600x315/3/"._upload_sanpham_l.$product_detail['thumb'] : $img ;
}
if(isset($tintuc_detail)){
$img = ($tintuc_detail) ? $config_url."/thumb/600x315/3/"._upload_news_l.$tintuc_detail['thumb'] : $img ;
}
?>
<meta property="og:image" content="<?=$img?>" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="https://begaushop.vn" />
<meta property="og:description" content="<?=($description) ? $description : $title_bar.$row_title['ten']  ?>" />
<meta property="og:site_name" content="" />
<meta property="og:title" content="<?=$title?>" />
<link rel="alternate" hreflang="vi" href="<?=$config_url?>" />
<link rel="canonical" href="https://begaushop.vn" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
<title><?=($title_bar) ? trim(trim($title_bar),"-") : $title?></title>
<script>var base_url = '<?=$config_url?>';  </script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&subset=vietnamese" rel="stylesheet">
<script src="global/lang.json" type="text/javascript"></script>
<script src="assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '171160393799336');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=171160393799336&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<?=$assets->showCss()?>
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0; url=<?=$config_url?>/detect.html" />
	<script type="text/javascript">
	/* <![CDATA[ */
	window.top.location = '<?=$config_url?>/detect.html';
	/* ]]> */
	</script>
<![endif]-->
</head>
<?php if($maintenance){echo $maintenance;die;}?>
<body class="status js-status <?=$template?>"  itemscope itemtype=https://schema.org/WebPage> 

		<a href="" class="back-to-top"><img src="assets/img/top.png"></a>
		<div class="visible-xs visible-sm">
    <?php include _template."layout/responsive-menu.php" ?>
    </div>
		<?php include _template."layout/header.php";?>		
		<div class="xmove">
		<?php 
			if($template=="index" | $template=="giacong/index"){
				include _template."layout/slider_camera.php"; 
			}
		
		?>	
<div id="main-web-wrapper">
	
<div id="page-wrapper" >		

			
				<div id="content-center" >	
	<?php 
					echo $bread->display();
					echo '<div class="clearfix"></div>';
					include _template.$template."_tpl.php";
					
					?>
			
			</div>
			
			
			
	
	
	<div class="clearfix"></div>	
	
	<?php //include _template."layout/facebook.php";?>
<?php //include _template."layout/advs.php";?>
<?php //include _template."layout/product-featured.php";?>

	</div><!--end page-wrapper-->
	<div class="clearfix"></div>
	<div class="clearfix"></div>	
	<?php //include _template."layout/popup_tpl.php";?>	
	</div>
	</div>
	
	<?php include _template."layout/footer.php";?>
</div>	
	
	<?php //include _template."layout/cart_mini.php";?>
<?=$assets->showJs()?>
<?=$global_setting['meta_bottom']?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=580130358671180&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php /*
<style type="text/css">
.hisella-messages { position: fixed; bottom: 0; right: 0; z-index: 999999; }
.hisella-messages-outer { position: relative; }
#hisella-minimize { background: #3b5998; font-size: 14px; color: #fff; padding: 3px 10px; position: absolute; top: -34px; left: -1px; border: 1px solid #E9EAED; cursor: pointer; }
@media screen and (max-width:768px){ #hisella-facebook { opacity:0; } .hisella-messages { bottom: -300px; right: -135px; } }
</style>
<div id='fb-root'></div>
<script>
(function($) { $(document).ready(function(){ $( '#hisella-minimize' ).click( function() { if( $( '#hisella-facebook' ).css( 'opacity' ) == 0 ) { $( '#hisella-facebook' ).css( 'opacity', 1 ); $( '.hisella-messages' ).animate( { right: '0' } ).animate( { bottom: '0' } ); } else { $( '.hisella-messages' ).animate( { bottom: '-300px' } ).animate( { right: '-135px' }, 400, function(){ $( '#hisella-facebook' ).css( 'opacity', 0 ) } ); } } ) }); })(jQuery);
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="hisella-messages"><div class="hisella-messages-outer"><div id="hisella-minimize">Hotline: 08 3989 6039</div><div id="hisella-facebook" class='fb-page' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='https://www.facebook.com/giaconglabelle/' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='250'></div></div></div>
*/?>
<?php 
					
					echo _template.$template."";
					
					?>
			
			</div>
</body>
</html>