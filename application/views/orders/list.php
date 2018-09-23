<?=$header?>

<div class="booking-section template-content">
	<div class="template-component-booking template-section template-main template-width-1170 booking-confirmation" >
	
		<div class="row pb-20 pt-20">My Orders</div>

		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Service Date</th>
							<th>Shop Name</th>
                            <th>Branch</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($orders as $order):?>
							<tr>
								<td><?php echo $order['so_id'];?></td>
								<td><?php echo date('d/m/y',strtotime($order['service_date']));?></td>
								<td><?php echo $order['shop_name'];?></td>
                                <td><?php echo $order['branch'];?></td>
								<td><?php echo numberToCurrency($order['total_amount']);?></td>
								<td><?php echo $order['order_status'];?></td>
								<td>
									<a href="<?php echo base_url('/account/order_view/'.$order['id']);?>">view</a>
								</td>
							</tr>
						<?php endforeach;?>					
					</tbody>
				</table>

			</div>
		</div>
        <div class="row"><?=$pagination?></div>
		<!-- /.row -->

	</div>
</div>
<?=$footer?>