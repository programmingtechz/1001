<?=$header?>

<div class="booking-section template-content">
	<div class="template-component-booking template-section template-main template-width-1170 booking-confirmation" >
		
		<div class="row pb-20 pt-20">
			<div class="col-xs-10">
				<h3>Order ID: <?php echo $so_id;?></h3>
			</div>
			<div class="col-xs-2">
				<a target="_blank" href="<?php echo site_url('booking/confirmation/'.$order_id.'/print');?>">Print</a>
			</div>
		</div>

		<div class="row pb-20 pt-20">
			<div class="col-sm-6">
				<h3 class="box-title">User Info</h3>
				
				<div class="row">
					<div class="col-xs-6">Name:</div>
					<div class="col-xs-6"><?php echo $user_name;?></div>
				</div>
				<div class="row">
					<div class="col-xs-6">Email:</div>
					<div class="col-xs-6"><?php echo $email;?></div>
				</div>
				<div class="row">
					<div class="col-xs-6">Phone:</div>
					<div class="col-xs-6"><?php echo $phone;?></div>
				</div>
			</div>

			<div class="col-sm-6">
				<h3 class="box-title">Payment Info</h3>

				<div class="row">
					<div class="col-xs-6">Payment Mode:</div>
					<div class="col-xs-6"><?php echo $payment_type;?></div>
				</div>
				<div class="row">
					<div class="col-xs-6">TXN ID:</div>
					<div class="col-xs-6"><?php echo $txn_id;?></div>
				</div>
				<div class="row">
					<div class="col-xs-6">Payment Status:</div>
					<div class="col-xs-6"><?php echo $payment_status;?></div>
				</div>
			</div>
		</div>

		<div class="row pb-20 pt-20">
			<div class="col-sm-12">
				<h3 class="box-title">Shop Info</h3>
				
				<div class="row">
					<div class="col-xs-3">Name:</div>
					<div class="col-xs-9"><?php echo $shop_name.' ( '.$area_name.' )';?></div>
				</div>
			</div>
		</div>

		<div class="row pb-20 pt-20">
			<div class="col-xs-4">
				<h3 class="box-title">Item Details</h3>
			</div>		
		</div>
		
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Service</th>
							<!-- <th>Qty</th> -->
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($order_items as $order_item):?>
							<tr>
								<td><?php echo $order_item['service_name'];?></td>
								<!-- <td><?php echo $order_item['quantity'];?></td> -->
								<td><?php echo numberToCurrency($order_item['unit_price']);?></td>
								<td><?php echo numberToCurrency($order_item['sub_total']);?></td>
							</tr>

						<?php endforeach;?>					
					</tbody>
				</table>
			</div>
		<!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="row pb-20 pt-20">
			<!-- accepted payments column -->
			<div class="col-sm-6">
				<div class="table-responsive">
					<table class="table">
						<!-- <tr>
							<th style="width:50%">Pick Up:</th>
							<td><?php echo ((int)$pickup)?'Yes':'No';?></td>
						</tr> -->
						<?php if((int)$donate):?>
						<tr>
							<th>Intrested to donate clothes:</th>
							<td>
								<?php echo ((int)$donate)?'Yes':'No';?>
							</td>
						</tr>
						<?php endif;?>
					</table>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<div class="table-responsive">
					<table class="table">
						<tr>
							<th style="width:50%">Subtotal:</th>
							<td><?php echo numberToCurrency($sub_total);?></td>
						</tr>
						<tr>
							<th>Discount:</th>
							<td>
								<?php echo numberToCurrency($total_discount);?>
							</td>
						</tr>
						<tr>
							<th>Total:</th>
							<td>
								<?php echo $order_total;?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>

		
	</div>
</div>

<?=$footer?>