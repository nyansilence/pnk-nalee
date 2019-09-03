<link href="assets/css/left.css" rel="stylesheet" type="text/css" />
<section>

        <div class="box-left product">
			<div class="right-title">
				<h2 style=""><?=_danhmucsanpham?></h2>
			</div>
           
            <div class="content product no-bd">
				<ul>
              <?php
				$d->query("select id,tenkhongdau,ten_$lang from #_product_danhmuc where hienthi = 1 order by stt desc");
				$dm = array();
				foreach($d->result_array() as $k=>$v){
				
				
				//echo '<li><a href="san-pham/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
				$d->reset();
						$d->query("select id,ten_$lang,tenkhongdau from #_product_list where id_danhmuc = '".$v['id']."' and hienthi = 1 and noibat = 1 order by stt desc");
						if($d->num_rows()){
							//echo '<ul>';
								foreach($d->result_array() as $k2=>$v2){
									echo '<li><a href="'.$v['tenkhongdau'].'/'.$v2['tenkhongdau'].'/" title="'.$v2['ten_'.$lang].'">'.$v2['ten_'.$lang].'</a></li>';
								}
							//echo '</ul>';
						}
				
			//	echo '</li>'; 
					
				
				}	
				?>
				</ul>
            </div>
        </div>
    </section>
	

	
	
	
<section>

        <div class="box-left">
			<div class="right-title">
					<h2>Hỗ trợ trực tuyến</h2><div class="clearfix"></div>
			</div>
           
            <div class="content support">
				<div class="hotline">
					Hotline
					<div class="inner"><?=$rs_hotline['hotline_'.$lang]?></div>
				</div>
				<?php 
				$d->query("select * from #_yahoo where hienthi = 1 order by stt desc");
				foreach($d->result_array() as $k=>$v){?>
				<div class="sp-item">
					<div>
						<div class="phone">
							<?php if($v['dienthoai']){echo $v['dienthoai'];}?>
						
						</div>
						<?php if($v['email']){?>
							<div class="email"><?=$v['email']?></div>
						<?php } ?>
						<div class="text-center">
						<?=$v['ten']?>
						<?php if($v['skype']){?>
						<a href="skype:<?=$v['skype']?>?chat" alt="Chat với tôi" style="margin-right:3px"><img src="assets/img/skype-mini.png"></a>
						<?php }?>
						<?php if($v['yahoo']){?>
						<a href="ymsgr:sendIM?<?=$v['yahoo']?>" title="Chat với tôi"><img src="assets/img/yahoo-mini.png"></a>
						<?php } ?>
						</div>
					</div>
					
				</div>		
						
				<?php } ?>
              	
					</div>
            </div>
       
    </section>

<section>
		
        <div class="box-left">
			<div class="right-title">
				<h2><a href="san-pham-moi.html" title="Sản phẩm mới"><?=_spmoi?></a></h2>
			</div>
           
            <div class="content  no-bd has-bx">
				<ul id="scroller">
				 <?php
					$d->query("select * from #_product where hienthi = 1 and new = 1 order by new desc,stt desc limit 10");
					
					
					foreach($d->result_array() as $k=>$v){ 
					echo '<li>';
						echo '<a href="san-pham/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
							echo '<img class="img-responsive" src="thumb/270x200/2/'._upload_sanpham_l.$v['photo'].'" alt="'.$v['ten_'.$lang].'" />';
						echo '</a>';
					echo '</li>';
					}
					?>
				</ul>
            </div>
        </div>
    </section>
	
	
	<script src="assets/plugins/simplyscroll/jquery.simplyscroll.min.js"></script>
	<link type="text/css" rel="stylesheet" href="assets/plugins/simplyscroll/jquery.simplyscroll.css" />
<script>
	$().ready(function(){
		$("#scroller,#scroller2").simplyScroll({
			customClass: 'vert',
			orientation: 'vertical',
            
            manualMode: 'loop',
			frameRate: 20,
			speed: 2
		});
	
	})

</script>




<section>

        <div class="box-left">
			<div class="right-title">
					<h2>Facebook</h2><div class="clearfix"></div>
			</div>
			 <div class="content">
			
				<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=580130358671180";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-page" data-href="<?=$rs_hotline['facebook']?>" data-width="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$rs_hotline['facebook']?>"><a href="<?=$rs_hotline['facebook']?>">Facebook</a></blockquote></div></div>
							
				
			</div>
           
        </div>
    </section>









	
	

