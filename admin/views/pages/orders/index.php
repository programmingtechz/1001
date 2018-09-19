<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>
        Sales Orders
        <!-- <small>advanced tables</small> -->
      	</h1>
      	<div class="page-bar">
			<?php echo set_breadcrumb(); ?>
		</div>
    </section>

	<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
    			<div class="box">
    	      <div class="row">
              <div class="col-xs-4">
                <h3 class="box-title">
                  Pending Orders: <a href="javascript:;" onclick="$.fn.custom_search('order_status', 'ACCEPTED')"><?php echo isset($status_count['ACCEPTED'])?$status_count['ACCEPTED']:0;?></a>
                </h3>
              </div>

              <div class="col-xs-5">
                <h3 class="box-title">
                  Hold Orders: <a href="javascript:;" onclick="$.fn.custom_search('order_status', 'HOLD')"><?php echo isset($status_count['HOLD'])?$status_count['HOLD']:0;?></a>
                </h3>
              </div>

              <div class="col-xs-3">
                <h3 class="box-title">
                  <button type="button" class="btn btn-block btn-primary" onclick="helperManager.route_url('<?=site_url('orders/add')?>');">Create New Order</button>
                </h3>
              </div>
            </div>

            <div class="box-body">
    		     <?=$grid;?>
            </div>
    			</div>
        </div>
      </div>
    </section>



	<div class="modal fade" id="TicketEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> </div>
