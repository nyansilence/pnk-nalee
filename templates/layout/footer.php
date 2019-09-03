<?php	

	$d->reset();
	$sql_contact = "select * from #_hotline ";
	$d->query($sql_contact);
	$rs_hotline = $d->fetch_array();
	
	
	$d->reset();
	$d->query("select * from #_footer "); 
	$footer = $d->fetch_array();	
	
	$d->reset();
	$d->query("select * from #_background where id = 1");
	$r = $d->fetch_array();

?>
<footer>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-3">
				<div class="title">Danh mục sản phẩm</div>
				<div class="content">
					<ul>
					<?php 
						$d->query("select id,ten_$lang,tenkhongdau from #_product_danhmuc where hienthi = 1 and type='product' order by stt desc");
						if($d->num_rows()){
							
						
							$xp = $d->result_array();
								foreach($xp as $k=>$v){
									echo '<li class="f"><a href="category/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
								}
								}
					?>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">Fanpage</div>
				<div class="content">
					<div class="fb-page" data-href="<?=$rs_hotline['facebook']?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$rs_hotline['facebook']?>" class="fb-xfbml-parse-ignore"><a href="<?=$rs_hotline['facebook']?>"><?=$rs_hotline['ten_'.$lang]?></a></blockquote></div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">Hỗ trợ</div>
				<div class="content">
					<ul>
						
						<?php 
							foreach(getContent("support") as $k=>$v){
						?>
						<li>
							<a href="ho-tro/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
						</li>
							<?php } ?>
						
						<?php /*
							foreach(getContent("support") as $k=>$v){
								echo '<li><a href="ho-tro/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
								
							}
							*/
						?>
						
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title"><a href="lien-he.html">Liên hệ</a></div>
				<div class="content">
					
					<div class="form">
												<div class="sub-desc">Đăng ký nhận tin để nhận những thông tin mới nhất của chúng tôi</div>
												<form id="mail-form">
													<input type="email" placeholder="<?=_enter_your_email?>" required />
													<button type="submit"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
												
												</form>
												
											</div>
					<?php 
						include _template."layout/social.php"
					?>
				</div>
			</div>
		</div>
		
	
	</div>


						
						<div class="clearfix"></div>
						
					

			

	
	
	
	<section id="copyright" class="texr-center">
			
			
				
		<div class="copyright">
				
				&copy; 2018 <?=pureUrl($config_url)?>
				
		</div>
	
	</section>
		<section class="full-page pnk hide" style="padding-bottom:5px">
             
                    <div class="logo-company text-center">
                       <a href="https://pnkmedia.vn/" title="PNK Media"> <img src="https://pnkmedia.vn/images/logo.png" alt="Logo PNK media" style = "max-width: 20px;position:relative;top:-1px"/> </a>
                        <span class="txt"> <a target="_blank" href="https://pnkmedia.vn" style= "color: #fff;">PNK Media</a> </span>

                 
           
              </div>
            </section>
	</footer>	

	
	