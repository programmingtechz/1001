<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>
        Gallery List
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
				<div class="box-header">
	              <h3 class="box-title">Gallery List</h3><button type="button" class="btn btn-block btn-primary pull-right w50" onclick="helperManager.route_url('<?=site_url('gallery/add')?>');">Add</button>
	            </div>

	            <div class="box-body">
					<?=$grid;?>
	            </div>
			</div>
        </div>
      </div>
    </section>


<div class="modal fade" id="TicketEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> </div>
