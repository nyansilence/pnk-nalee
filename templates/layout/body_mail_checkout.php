<?php
// Nội dung email thông báoc

$data = $_POST;
$bill = $data['bill'];
$receive = $data['receive'];
$body_mail = '';
$body_mail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="border-spacing:0;border-collapse:collapse;font-size:14px">';
$body_mail .= '<tbody>';
$body_mail .= '<tr>';
$body_mail .= '<td align="center" valign="top" style="border-collapse:collapse">';
$body_mail .= '<table width="600" border="0" cellpadding="0" cellspacing="0" style="border-spacing:0;border-collapse:collapse;font-size:14px;max-width:600px">';
$body_mail .= '<tbody>';
$body_mail .= '<tr>';
$body_mail .= '<td style="border-collapse:collapse">';
$body_mail .= '<table border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0;border-collapse:collapse;font-size:14px">';
$body_mail .= '<tbody>';
$body_mail .= '<tr>';
$body_mail .= '<td valign="top" style="border-collapse:collapse">';
$body_mail .= '<h1 style="font-size:14px;color:#4c4848"><em style="background:#ff6"></h1>';
$body_mail .= '<div style="margin-top:20px"><strong style="font-size:16px">Kính chào quý khách '.$bill['name'].',</strong></div>';
$body_mail .= '<div style="margin-top:10px;margin-bottom:20px">';
$body_mail .= 'Chúng tôi vừa nhận được đơn hàng <strong style="color:#f36f21">'.$mahoadon.'</strong> của quý khách đặt ngày <strong>'.date('l F d, Y',$ngaydathang).'</strong> với hình thức thanh toán là <strong>'.$httt.'</strong>. ';
$body_mail .= 'Chúng tôi sẽ gửi thông báo đến quý khách qua một email khác ngay khi sản phẩm được giao cho đơn vị vận chuyển.';
$body_mail .= '</div>';
$body_mail .= '</td>';
$body_mail .= '</tr>';
$body_mail .= '<tr>';
$body_mail .= '<td align="center" width="100%" style="border-collapse:collapse;background-color:#f2f4f6;border-top:2px solid #646464">';
$body_mail .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0;border-collapse:collapse;font-size:14px">';
$body_mail .= '<tbody>';
$body_mail .= '<tr>';
$body_mail .= '<td valign="top" style="border-collapse:collapse;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;text-align:left">';
$body_mail .= '<div>';
$body_mail .= '<div style="color:#646464">Đơn hàng sẽ được giao đến:</div>';
$body_mail .= '<div style="margin-top:5px"><strong style="color:#f36f21">'.$receive['name'].'</strong></div>';
$body_mail .= '<div style="margin-top:5px">';
$body_mail .= '<strong>';
$body_mail .= $receive['address'].' <br> Phone: '.$receive['phone'];
$body_mail .= '</strong>';
$body_mail .= '</div>';
$body_mail .= '<div style="margin-top: 10px">với hình thức <b>'.$htvc.'</b></div>';
$body_mail .= '</div>';
$body_mail .= '</td>';
$body_mail .= '</tr>';
$body_mail .= '</tbody>';
$body_mail .= '</table>';
$body_mail .= '</td>';
$body_mail .= '</tr>';
$body_mail .= '<tr>';
$body_mail .= ' <td align="left" style="border-collapse:collapse;padding:0">
                                    <div style="margin-top:20px;margin-bottom:10px;margin-right:10px"><strong>Sau đây là thông tin chi tiết về đơn hàng:</strong></div>
                                 </td>
                              </tr>
                             
                              <tr>
                                 <td style="border-collapse:collapse;border:1px dashed #e7ebed;border-bottom:none">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0;border-collapse:collapse;font-size:14px">
                                       <tbody>'; 

										$total = 0;
                                        foreach($_SESSION['cart'] as $k=>$v) { 
										
											$code  =$k;
											$pid=$v['productid'];
											$q=$v['qty'];					
											$color = $v['color'];
											$size = $v['size'];
											$info=getProductInfo($pid);
											$pname=get_product_name($pid);
											$image = $config_url."/"._upload_sanpham_l.$info['thumb'];
											if($color){
											$img = getProductThumbnailWidthColor($pid,$color);
											if($img){
											$image = $config_url.$img;
											}
											}
											$mx = $v['price']*$v['qty'];
											$total+=$mx;
										
										
					                        $body_mail .= '<tr>';
											$body_mail .= '<td valign="top" align="center" height="120" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px">
													<a href="'.$config_url.'/san-pham/'.changeTitle($pname).'-'.$pid.'.html" target="_blank">
													<img src="'.$image.'" style="width:100px" class="CToWUd">
													</a>
												</td>
												<td valign="top" style="border-collapse:collapse;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
													<div style="margin-bottom:5px"><a href="'.$config_url.'/san-pham/'.changeTitle($pname).'-'.$pid.'.html" style="text-decoration:none;color:#292929" target="_blank">'.$pname;
													if ($color) {
							
															$body_mail.='<br>Màu:&nbsp;'.$model->getColor($color,"name");
														}
														if ($size) {
															$body_mail.='<br>Size:&nbsp;'.$model->getSize($size,"name");
														}
													$body_mail.='</a></div>
													<div style="margin-bottom:5px;color:#646464">Số lượng: '.$q.'</div>
												</td>
												<td valign="top" align="right" style="border-collapse:collapse;padding-top:10px;padding-right:10px;width:110px;">
													<strong>'.myformat($v['price']).'</strong>
												</td>
											</tr>';
										};
										$c = $model->getTotalPriceCart();
    
    $body_mail .= '</tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="border-collapse:collapse;border:1px dashed #e7ebed">
                                    <div>
                                       <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0;border-collapse:collapse;font-size:14px;width:100%!important">
                                          <tbody>
                                             <tr>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:10px;padding-right:10px;color:#646464;width:80%">Thành tiền:</td>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:10px;padding-right:10px;color:#292929;min-width:140px">'.myformat($c['price']).'</td>
                                             </tr>
                                            
                                             <tr>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:5px;padding-right:10px;color:#646464;width:80%">Phí giao hàng:</td>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:5px;padding-right:10px;color:#292929;min-width:140px">'.myformat($ship).'</td>
                                             </tr>
                                            
                                             ';

                    	

                    $body_mail.=             '<tr>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:10px;padding-right:10px;font-size:16px;width:80%"><strong>Tổng cộng:</strong></td>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:10px;padding-right:10px;font-size:16px;color:#646464;min-width:140px"><strong style="color:#f36f21">'.myformat($c['price']+$ship).' VND</strong></td>
                                             </tr>
                                             <!--<tr>
                                                <td valign="top" align="right" style="border-collapse:collapse;width:80%"></td>
                                                <td valign="top" align="right" style="border-collapse:collapse;padding-top:5px;padding-right:10px;padding-bottom:10px;font-size:13px;color:#646464;min-width:140px">(Đã bao gồm thuế)</td>
                                             </tr>-->
        								  </tbody>
                                       </table>
                                    </div>
                                 </td>
                              </tr>';
                             

    $body_mail.=            '</tbody>
                        </table>
                     </td>
                  </tr>
                  
                  
   </tbody>
</table>';

echo $body_mail;