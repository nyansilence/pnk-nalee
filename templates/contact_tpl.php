<link href="assets/css/lienhe.css" type="text/css" rel="stylesheet" />
<link href="assets/css/map.css" type="text/css" rel="stylesheet" />
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<link href="assets/css/news_special.css" type="text/css" rel="stylesheet" />	
<div class="box_containerlienhe" style="">



   <div class="content">
		<div class="">
           
		
				<section id="contact">	
			
			<div class="">
			 <div class="">
					<div class="map-contact" style="margin-bottom:10px">
						<div class="video-wrapper">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d823.9169681634908!2d106.63557933341242!3d10.793559447496772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ae45c4f8b9%3A0x2af276af4562a0a9!2zQsOpIEfhuqV1IFNob3AgLSBD4butYSBow6BuZyBxdeG6p24gw6FvIHRo4budaSB0cmFuZyB0cuG6uyBlbQ!5e0!3m2!1svi!2s!4v1536734247122" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						<!--
							<iframe src="map.php?info=1"></iframe>
						-->
						</div>
					</div>
				</div>
				<div class="col-xs-12">
			
			<div class="col-5 col-xs-12 col-md-5">
			<div class="title-global"><h2><?=_thongtinlienhe?></h2><div class="clearfix"></div></div>
			 
			<div class="fix-title"><?=$company_contact['noidung_'.$lang];?> </div>
			
			</div>
			<div class="col-5 col-xs-12 col-md-7">
				<div class="title-global"><h2><?=_fromlienhe?></h2><div class="clearfix"></div></div>
				<?php 
					if(isset($error)){
						echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					}
				
				
				?>
            <form method="post" name="frm" action="">
				
				<div class="row-5">
                        <div class="col-xs-6 col-md-4 col-5 inputx">
							
						<input name="name" type="text" required class="form-control" id="name" value="<?=@$_POST['name']?>" placeholder="Name:" size="40" />
                     
					  </div>
                        
						<div class="col-xs-6 col-md-4  col-5 inputx">
							
						<input name="email" id="email" type="text" required class="form-control" value="<?=@$_POST['email']?>" placeholder="Email:" size="40"  />
                     
					  </div>
					  
					  <div class="col-xs-12 col-md-4  col-5 inputx">
							
							<input name="phone" type="text" required class="form-control" id="phone" value="<?=@$_POST['phone']?>" placeholder="Phone:" size="40"/>
                     
					  </div>
					  
					
                       
                       
					
                       
                        <div class="col-xs-12 col-md-12  col-5 inputx">
							<textarea name="content" cols="35"   class="form-control" rows="5" placeholder="Message:"  id="content" style="background-color:#FFFFFF; color:#666666;"><?=@$_POST['content']?></textarea>
						</div>
						
						
						<div class="clearfix"></div>
						
                    
					<div class="col-xs-12 inputx">
							<input class="button" type="button" value="CLear" onclick="document.frm.reset();" />
								<input class="button" type="submit" value="Send" onclick="" />
                            </div>                             
                                                       
                            </div>                             
                       
	             </form>
                </div>
				<div class="clearfix"></div>
					</div>
					</div>
				</section>	
					
					
					
				
			
		</div>	
	</div>		
		
			
			
			
			
			
			
			
			
		
				 
				
			
			<div class="clearfix"></div>

</div>	
