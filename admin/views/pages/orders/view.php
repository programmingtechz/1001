	
<section class="content-header">
  	<h1>
    Sales Order: <?php echo $so_id; ?>
    <!-- <small>advanced tables</small> -->
  	</h1>
  	<!-- <div class="page-bar">
  			<?php echo set_breadcrumb(); ?>
  		</div> -->
</section>


<!-- Main content -->
<section class="content order-view">
  	
	<div class="row">
		<div class="col-xs-12">
			<div class="box"></div>
		</div>
	</div>

  	<div class="row top-info">
		
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-aqua">
				<!-- <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span> -->

				<div class="info-box-content">
					<span class="info-box-text">Order Status</span>
					<span class="info-box-number"><?php echo $order_status;?></span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-green">
				<!-- <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span> -->

				<div class="info-box-content">
					<span class="info-box-text">Order Total</span>
					<span class="info-box-number"><?php echo $order_total;?></span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-yellow">
				<!-- <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span> -->

				<div class="info-box-content">
					<span class="info-box-text">Order Date</span>
					<span class="info-box-number"><?php echo $order_date;?></span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-red">
				<!-- <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span> -->

				<div class="info-box-content">
					<span class="info-box-text">Mobile No</span>
					<span class="info-box-number"><?php echo $phone;?></span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

	</div>
	<!-- /.row -->
	

	<div class="row">
		<div class="col-xs-6">
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

		<div class="col-xs-6">
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

	<div class="row">
		<div class="col-sm-12">
			<h3 class="box-title">Shop Info</h3>
			
			<div class="row">
				<div class="col-xs-3">Name:</div>
				<div class="col-xs-9"><?php echo $shop_name.' ( '.$area_name.' )';?></div>
			</div>
		</div>
	</div>

	<div class="row">
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
						<th>Unit Price</th>
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


	<div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">
			<div class="row">
				<div class="col-xs-6">Vehicle Model:</div>
				<div class="col-xs-6"><?php echo $vehicle_model;?></div>
			</div>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="col-xs-6">Vehicle Number:</div>
				<div class="col-xs-6"><?php echo $vehicle_number;?></div>
			</div>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="col-xs-6">Order Status:</div>
				<div class="col-xs-6"><?php echo form_dropdown('order_status', $order_status_list, $order_status, array('data-order-id' => $order_id));?></div>
			</div>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="col-xs-4">&nbsp;</div>
				<div class="col-xs-4 align-self-center">
					<button type="button" class="btn btn-block btn-success btn-xs" onclick="updateOrderStatus()">SUBMIT</button>
				</div>
				<div class="col-xs-4">&nbsp;</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-xs-6">
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

	<?php if($message): ?>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
	<div class="row">
		<div class="col-xs-6">
			<div class="row">
				<div class="col-xs-6">Message:</div>
				<div class="col-xs-6"><?php echo $message;?></div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</section>


<script>

function updateOrderStatus()
{
	var params = {
		id: $('select[name="order_status"]').attr('data-order-id'),
		status: $('select[name="order_status"]').val()
	};

	console.log(params);

	$.post(base_url+'orders/updateOrderStatus', params, function(resp){
		console.log(resp);
		alert('Updated successfully!.');
		location.reload()
	}, 'json');
}

</script>