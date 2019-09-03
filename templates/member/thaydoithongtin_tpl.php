<link href="assets/css/member/style.css" type="text/css" rel="stylesheet">
<a href="#success-post" class="fancybox-sya"></a>

<div class="hide">
	<div id="success-post">
		<div class="col-sm-12">
			
			<div class="alert alert-success" role="alert">
				<p><strong>CHỈNH SỬA THÔNG TIN THÀNH CÔNG!</strong></p>
				
			</div>
		</div>
	</div>
</div>

<div class="main-member-place">
<div class="global-title"><h2>Thay đổi thông tin</h2><div class="clearfix"></div></div>

	<!-- 
	<div class="content">

		<form class="form-horizontal" role="form" id="form-thongtin" method="post">
		
	
	<div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-3 control-label">Tên truy cập</label>
	
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputEmail3" name="username" <?=($member_log['username']) ? 'disabled' : 'required' ?>  value="<?=$member_log['username']?>">
	   <span class="help-block red"><?=@$err['username']?></span>
    </div>
  </div>	
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-3 control-label">Họ tên</label>
	
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputEmail3" name="name" required value="<?=$member_log['full_name']?>">
	   <span class="help-block red"><?=@$err['name']?></span>
    </div>
  </div>
  
   <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-8">
      <input type="email" class="form-control" id="inputEmail3" readonly disabled value="<?=$member_log['email']?>">
	  <span class="help-block red"><?=@$err['email']?></span>
    </div>
  </div>
  
   <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-3 control-label">Điện thoại</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputEmail3" required name="phone"  value="<?=$member_log['phone']?>" >
	   <span class="help-block red"><?=@$err['phone']?></span>
    </div>
  </div>
 
  
  <?php
  if($member_log['password']){?>
 <P> <div class="title"><h2>THAY ĐỔI MẬT KHẨU</h2></div></p>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-3 control-label">Mật khẩu cũ</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="old-password" class="input-sm id="inputPassword3" >
	  <span class="help-block red"><?=@$err['old-password']?></span>
    </div>
  </div>
   <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-3 control-label">Mật khẩu mới</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="new-password" class="input-sm id="inputPassword3" >
	   <span class="help-block red"><?=@$err['new-password']?></span>
    </div>
  </div> 
   <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-3 control-label">Nhập lại mật khẩu</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="renew-password" class="input-sm id="inputPassword3">
	   <span class="help-block red"><?=@$err['renew-password']?></span>
    </div>
  </div> 
  
  <?php }else{?>
   <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-3 control-label">Đặt mật khẩu</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="inputEmail3" required name="password"   >
	   <span class="help-block red"><?=@$err['password']?></span>
    </div>
  </div>
  <?php } ?>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
	<input type="hidden" name="action" value="submit" />
      <button type="submit" class="btn btn-success" id="si">Cập nhật</button>
    </div>
  </div>
</form>
	</div> -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<form class="form-horizontal" enctype="multipart/form-data" id="form-register" id="form-register" role="form" method="post">		

	<div class="ttl"><h4>Thông tin tài khoản</h4></div>

		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-6">
				<input type="email" class="form-control email-input" readonly name="" value="<?=@$member_log['email']?>" id="inputEmail3" placeholder="Email" required>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Mật khẩu cũ</label>
			<div class="col-sm-6">
				<input type="password" class="form-control old-password-input" name="old-password" id="inputEmail3" placeholder="Mật khẩu cũ" >
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Mật khẩu mới</label>
			<div class="col-sm-6">
				<input type="password" class="form-control password-input" name="reg[password]" id="inputEmail3" placeholder="Mật khẩu" >
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Nhập lại mật khẩu mới</label>
			<div class="col-sm-6">
				<input type="password" class="form-control re-password-input" name="re-password" id="inputEmail3" placeholder="Nhập lại mật khẩu" >
			</div>
		</div>
		
		
		<div class="ttl hide"><h4>Loại tài khoản</h4></div>
		<div class="form-group hide">
			<label for="inputEmail3" class="col-sm-3 control-label">Loại thành viên</label>
			<div class="col-sm-4">
				<select name="reg[type]" id="m-type" class="form-control"  disabled readonly>
					<option value="">Chọn</option>
					<option value="1" <?=(@$member_log['type']==1) ? 'selected' : ''?>>Tài khoản Đăng tin BĐS - tìm việc làm</option>
					<option value="2" <?=(@$member_log['type']==2) ? 'selected' : ''?>>Tài khoản Tuyển dụng</option>
				</select>
				
			</div>
		</div>
		
		<!-- congty -->
		
		<!-- end conty -->
		<div class="" id="tab_1">
		<div class="ttl"><h4>Thông tin cá nhân</h4></div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Họ tên<span>*</span></label>
			<div class="col-sm-6">
				<input type="text" class="form-control fullname-input" value="<?=@$member_log['fullname']?>" name="reg[fullname]" id="inputEmail3" placeholder="Tên bạn" required>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Ngày sinh <span>*</span></label>
				<div class="col-sm-7">
			<div class="">
			<?php
				$bd = explode("-",@$member_log['birthday']);
				
			?>
			<div class="col-sm-3">
				<div class="fix-row" style="margin-left:-15px">
				<select name="date" class="form-control" required>
					<option value="">Ngày</option>
					<?php for($i=1;$i<=31;$i++){
						$slt = "";
						if($i == $bd[0]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="fix-row">
				<select name="month" class="form-control" required>
					<option value="">Tháng</option>
					<?php for($i=1;$i<13;$i++){
						$slt = "";
						if($i == $bd[1]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
				
			</div>
			<div class="col-sm-3">
				<div class="fix-row">
				<select name="year" class="form-control" required>
					<option value="">Năm</option>
					<?php for($i=date("Y")-18;$i > (date("Y")-70);$i--){
						$slt = "";
						if($i == $bd[2]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
			</div>
		</div>
		</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Giới tính</label>
			<div class="col-sm-9">
				<label class="radio-inline">
				  <input type="radio" name="reg[gender]" id="inlineRadio1" checked value="0"> Nam
				</label>
				<label class="radio-inline">
				  <input type="radio" name="reg[gender]" id="inlineRadio2" value="1"> Nữ
				</label>
			</div>
		</div>
		
		<div class="form-group hide">
			<label for="inputEmail3" class="col-sm-3 control-label">Ảnh của bạn</label>
			<div class="col-sm-6">
			<div style="margin-bottom:5px">
				<?php 
					
						if(!$member_log['avatar']){
							echo '<img src="upload/no_img.png" />';
						}else{
							echo '<a href="'._upload_member_l.$member_log['avatar'].'" class="fancybox"><img width="200px" class="img-thumbnail" src="'._upload_member_l.$member_log['avatar'].'" /></a>';
						}
					?>
				</div>
				<input type="file" class="form-control avatar-input" name="avatar" id="inputEmail3">
				<span class="help-block">(File ảnh .jpg, .gif, .bmp, .png, dung lượng <= 50KB)</span>
			</div>
		</div>
		
		
		
		<div class="ttl"><h4>Thông tin liên hệ</h4></div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Địa chỉ liên hệ <span>*</span></label>
			<div class="col-sm-6">
			
				<input type="text" class="form-control address-input" value="<?=@$member_log['address']?>" name="reg[address]" id="inputEmail3" placeholder="Địa chỉ" required/>
			</div>
		</div>

			
			
		
		
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Số điện thoại<span>*</span></label>
			<div class="col-sm-6">
				<input type="text" class="form-control phone-input" value="<?=@$member_log['phone']?>" name="reg[phone]" id="inputEmail3" placeholder="Điện thoại" required />
			</div>
		</div>
		
		
	
		
		
		</div>
		
		
		<!-- end hide -->
		<div class="form-group hide">
			<label for="inputEmail3" class="col-sm-3 control-label">Mã bảo vệ</label>
			<div class="col-sm-6">
				<input type="text" style="width:100px" class="form-control pull-left captcha-input" name="captcha" id="inputEmail3" placeholder="" autocomplete="off" >
				<img src="captcha/captcha.php" width="100px"/><a onclick="$(this).prev().attr('src','captcha/captcha.php?c=<?=time()?>');return false" href=""><img src="assets/img/refresh.png" style="width: 20px;margin-left: 5px;" /></a>
				<div class='clearfix'></div>
				<span class="help-block red"></span>
			</div>
		</div>
		<div class="form-group last">
			<div class="col-sm-offset-3 col-sm-9">
					<input  type="hidden" name="required" value="1">
					<input  type="hidden" name="has_error" class="has_error" value="1">
					
				<button type="submit" class="btn btn-success btn-sm btn-blue">Sửa thông tin</button>
				<button type="reset" class="btn btn-default btn-sm btn-reset">Nhập lại</button>
			</div>
		</div>
																		
</form>


<script>


function checkValid(){
	$("#form-register").submit(function(){
			if($(".has_error").val()==1){
			$options = new Array();
			$options.url = base_url+"/thanh-vien/valid.html";
			$options.data = $(this).serialize()+"&edit=1";
			$options.dataType = "json";
			$options.success = function(data){
			
				console.log(data);
				
				if(data.error.stt){
					$.each(data.error.data,function(i,item){
						$("."+i+"-input").parent().find(".help-block").html(item);
					})
					return false;
				}
				else{
					$(".has_error").val(0);
					$("#form-register").submit();
					
				}
				
				
			
			};
			 initAjax($options);
			 return false;
			 }
		
	
	})


}
function toggleRequired($id){
		$("#tab_1").find("input,select,textarea").each(function(){
			$name = $(this).attr("name");
			$(this).attr("data-name",$name);
			$(this).removeAttr("name");
			attr = $(this).attr("required");
			
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).removeAttr("required");
				$(this).attr("data-required","required");
			}
		
		})
		$("#tab_2").find("input,select,textarea").each(function(){
			$name = $(this).attr("name");
			$(this).attr("data-name",$name);
			$(this).removeAttr("name");
			attr = $(this).attr("required");
			
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).removeAttr("required");
				$(this).attr("data-required","required");
			}
		
		})
		$("#tab_"+$id).find("input,select,textarea").each(function(){
		//$("#tab_").find("input,select,textarea").each(function(){
			attr = $(this).data("required");
			$name = $(this).data("name");
			$(this).attr("name",$name);
			if (typeof attr !== typeof undefined && attr !== false) {
				
				$(this).attr("required","true");
			}
		
		})
	
	
	
	}
$().ready(function(){
	
	$("#form-register input[type=text],#form-register input[type=password],#form-register input[type=email],#form-register select,#form-register selected").each(function(){
		if(!$(this).parent().find(".help-block").length){
			$(this).after("<div class='clearfix'></div><span class='help-block red'></span>");
			
		}
	
	})
	$("#form-register").click(function(){
		$(this).find(".help-block").html("");
	})
	checkValid();
	$("#m-type").change(function(){
		if($(this).val()!=''){
			toggleRequired($(this).val());
			$("#tab_1,#tab_2").hide().removeClass("hide");
			$("#tab_"+$(this).val()).fadeIn();
			
			
		
		
		}
	
	
	})

})	


</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>	
<script>
	$().ready(function(){
	$("#form-thongtin").submit(function(){
		if($("input[name='old-password']").length){
			if($("input[name='old-password']").val()!='' & !$("input[name='new-password']").attr("required")){
				$("input[name='new-password'],input[name='renew-password']").attr("required",'');
				$("#si").trigger("click");
				return false;
			}else{
			$("input[name='new-password'],input[name='renew-password']").removeAttr("required");
			}
		}
	
	})
	$(".fancybox-sya").fancybox({
	
		autoSize:false,
		width:400,
		height:80,
		beforeClose:function(){
			window.location.href='<?=$config_url.'/thanh-vien/main.html'?>';
		
		}
		
	
	});
	if(1==<?=@$success?>){
		$(".fancybox-sya").click();
	}

	})
</script>
