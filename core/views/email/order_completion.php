 <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="htts://dakbroincredible.com" target="_blank"><img src="https://s3.amazonaws.com/prod-dakbro/logo_yellow.png" alt="Dakbro Incredible Polishing Studio" style="border:none;width: 224px;height:80px;"><br></a> </td>
                    </tr>
                </tbody>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="background:#36bea6; padding:20px; color:#fff; text-align:center;"> Your Vehicle service is completed. </td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td><b></b>
                                <p style="margin-top:0px;">Invoice #<?= (isset($so_id)?(''.$so_id):('')); ?></p>
                            </td>
                            <td align="right" width="100"> <?=$order_date?> </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding:20px 0; border-top:1px solid #f6f6f6;">
                                <div>
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        
                                        	<?php foreach ($order_items as $product_detail):?>
                                		<tr>
                                        <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;"><?php echo $product_detail['service_name'];?></td>
                                        <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" align="right"><?php echo displayData(($product_detail['quantity']*$product_detail['unit_price']), 'custom_money');?></td>
                                    </tr>
                                    	 		
                                		<?php endforeach;?>
                                            <?php if($total_tax>0):?>
        	
                                                <tr class="total">
                                                    <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" width="80%">Total Tax</td>
                                                    <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" align="right"><?php echo displayData($total_tax, 'custom_money'); ?></td>
                                                </tr>
			                                 <?php endif;?>
                                           
                                            <tr class="total">
                                                <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" width="80%">Total</td>
                                                <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" align="right"><?php echo displayData($total_amount, 'custom_money'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <p>DakBro Incredible Polishing Studio
                    <br>
                     4B Shanthi Colony, 7th main Rd,NAC Jewellery adjacent street,Anna Nagar, Chennai 600040<br>
                    <a href="https://dakbroincredible.com/index.php/unsubscribe/index/<?=$email?>" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
            </div>
        </div>
    </div>