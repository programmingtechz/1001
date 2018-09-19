<h3><u>DakBro - Order<?= (isset($so_id)?('- #'.$so_id):('')); ?></u></h3>

Your vehicle service is completed.

<br/>

Thank you.


<h2>Services</h2>
<div class="cart-info">
	<table cellspacing="10" width="100%">
		<tr>
			<th>Service</th>
			<th>Price</th>
			<!-- <th>Quantity</th> -->
			<th>Sub Total</th>
		</tr>
		<tr><td colspan=4><hr/></td></tr>

		<?php foreach ($order_items as $product_detail):?>
			<tr>
				<td><?php echo $product_detail['service_name'];?></td>
				<td><?php echo displayData($product_detail['unit_price'], 'money');?></td>
				<!-- <td><?php echo $product_detail['quantity'];?></td> -->
				<td><?php echo displayData(($product_detail['quantity']*$product_detail['unit_price']), 'money');?></td>				
			</tr>
		<tr><td colspan=4><hr/></td></tr>	 		
		<?php endforeach;?>
		
			<tr>
				<td colspan=3 align="right">Sub-total:</td>
				<td align="right"><?php echo displayData($cart_total, 'money'); ?></td>
			</tr>
			<tr>
				<td colspan=3 align="right">Discount:</td>
				<td align="right">-<?php echo displayData($total_discount, 'money'); ?></td>
			</tr>
			<?php if($total_tax>0):?>
			<tr>
				<td colspan=3 align="right">Total Tax:</td>
				<td align="right"><?php echo displayData($total_tax, 'money'); ?></td>
			</tr>
			<?php endif;?>
			<tr>
				<td colspan=3 align="right">Total:</td>
				<td align="right"><?php echo displayData($total_amount, 'money'); ?></td>
			</tr>
	
	 </table>
 </div>