<section class="content-header">
	<div class="page-bar">
  			<?php echo set_breadcrumb(); ?>
  		</div>
        <br />  <br />
  	<h1>Create Sales Order</h1>
</section>

<!-- Main content -->
<section class="content order-view">
	<div class="row">
		<div class="col-xs-12">
			<div class="box"></div>
		</div>
	</div>

	

	<div class="row">
		<div class="col-xs-6 user-info">
			<h3 class="box-title">User Info</h3>

			<div class="row">
				<div class="col-xs-12 user-selection">
					<label  class="col-sm-5 control-label">Select User</label>
					<div class="col-sm-7">
                    <input type="text" class="typeahead form-control" data-provide="typeahead" placeholder="Type phone number or name">
                  </div>
				</div>
				<input type="hidden" name="user_id">
				<input type="hidden" name="shop">
			</div>
			
			<div class="row">
				<label class="col-xs-6">Name:</label>
				<div class="col-xs-6 user-name"></div>
			</div>
			<div class="row">
				<label class="col-xs-6">Email:</label>
				<div class="col-xs-6 email"></div>
			</div>
			<div class="row">
				<label class="col-xs-6">Phone:</label>
				<div class="col-xs-6 phone"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-4">
			<h3 class="box-title">Item Details</h3>
		</div>		
	</div>


	<!-- Table row -->
	<div class="row cart-info">
		<div class="col-xs-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	<!-- /.col -->
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-xs-offset-10 col-xs-2">
			<h3 class="box-title">
              <button type="button" class="btn btn-block btn-primary" onclick="orderManager.openAddItemPopup()">Add Item</button>
            </h3>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th style="width:50%">Vehicle Model:</th>
						<th class="">
							<div class="form-group">
				                <div class='input-group' >
				                    <input type='text' name="vehicle_model" class="form-control" />
				                    </span>
				                </div>
				            </div>
						</th>
					</tr>
					<tr>
						<th style="width:50%">Vehicle Number:</th>
						<th class="">
							<div class="form-group">
				                <div class='input-group' >
				                    <input type='text' name="vehicle_number" class="form-control" />
				                </div>
				            </div>
						</th>
					</tr>
					<tr>
						<th style="width:50%">Service Date:</th>
						<th class="">
							<div class="form-group">
				                <div class='input-group date datetpicker' >
				                    <input type='text' name="service_date" value="<?=date('Y-m-d')?>" class="form-control" />
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
				            </div>
						</th>
					</tr>
				</table>
			</div>
		</div>

		<div class="col-xs-6">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th style="width:50%">Subtotal:</th>
						<td class="sub-total"></td>
					</tr>
					<tr>
						<th>Discount:</th>
						<td class="discount"></td>
					</tr>
					<tr>
						<th>Total:</th>
						<td class="tax"></td>
					</tr>
				</table>
			</div>
		</div>
		<!-- /.col -->
	</div>

	<div class="row">
		<div class="col-xs-offset-4 col-xs-4">
			<h3 class="box-title">
              <button type="button" class="btn btn-block btn-primary" onclick="orderManager.createOrder()">SUBMIT</button>
            </h3>
		</div>
	</div>

</section>

<div class="modal fade" id="add-item-form">
  <div class="modal-dialog">
    
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Item</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" method="post">
			<div class="box-body">
			 <?=$form_fields;?> 
			</div>
			<div class="row">
				<label class="col-xs-offset-1 col-xs-1">Price</label>
				<div class="col-xs-6 item-price"></div>
			</div>			
		</form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="orderManager.addItemToCart()">Add</button>
      </div>

    </div>
   
  </div> 
</div>