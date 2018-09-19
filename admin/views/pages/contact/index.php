<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>
        Contacts List
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
	              <h3 class="box-title">Contacts List</h3>
	            </div>

	            <div class="box-body">
					<?=$grid;?>
	            </div>
			</div>
        </div>
      </div>
    </section>



	<div class="modal fade" id="TicketEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> </div>
