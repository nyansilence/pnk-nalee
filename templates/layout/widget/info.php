<section id="widget-info">
	<div class="col-xs-12">
		<div class="row">
		<div class="col-xs-12 col-md-3 col-sm-6">
			<div class="toggle-block block">
				<div class="title">Tin tức mới</div>
				<div class="clearfix"></div>
				<div class="content">
					<ul>
					<?php 
						foreach(getContentFeatured("news","5") as $k=>$v){
							echo '<li><a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-3 col-sm-6">
			<div class="toggle-block block">
				<div class="title">Cam kết bán hàng</div>
				<div class="clearfix"></div>
				<div class="content">
					<ul>
					<?php 
						foreach(getContentFeatured("info","5") as $k=>$v){
							echo '<li><a href="cam-ket-ban-hang/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-3 col-sm-6">
			<div class="toggle-block block">
				<div class="title">Dịch vụ</div>
				<div class="clearfix"></div>
				<div class="content">
					<ul>
					<?php 
						foreach(getContentFeatured("service","5") as $k=>$v){
							echo '<li><a href="dich-vu/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-3 col-sm-6">
			<div class="block">
				<div class="content">
					<?php 
					$d->query("select * from #_video where hienthi = 1 order by stt desc");
					$rs_video  =$d->result_array();
													
					echo '<div class="embed-responsive embed-responsive-4by3"><iframe class="embed-responsive-item" id="iframe"  src="https://www.youtube.com/embed/'.getYoutubeIdFromUrl($rs_video[0]['link']).'" frameborder="0" allowfullscreen></iframe></div>';
				 ?>
					<select class="form-control" id="video-control">
					<?php 
					foreach($rs_video as $k=>$v){
					echo '<option value="'.getYoutubeIdFromUrl($v['link']).'">'.$v['ten_'.$lang].'</option>';
					   }
					?>
					</select>
				</div>
			</div>
		</div>
	
		<div class="clearfix"></div>
	</div>
	</div>
	<div class="clearfix"></div>
</section>
