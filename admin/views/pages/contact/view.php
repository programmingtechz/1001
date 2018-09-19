<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contact
      </h1>
      <div class="page-bar">
        <?php echo set_breadcrumb(); ?>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-9">
          
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">View Contact</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Name
                		</label>
                		<div class="col-sm-10">
                			<?=$data['name']?>
                			
                		</div>
                	</div>
                	
                </div>
                <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Email
                		</label>
                		<div class="col-sm-10">
                			<?=$data['email']?>
                			
                		</div>
                	</div>
                	
                </div>
                <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Phone
                		</label>
                		<div class="col-sm-10">
                			<?=$data['phone']?>
                			
                		</div>
                	</div>
                	
                </div>
                <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Subject
                		</label>
                		<div class="col-sm-10">
                			<?=$data['subject']?>
                			
                		</div>
                	</div>
                	
                </div>
                <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Comments
                		</label>
                		<div class="col-sm-10">
                			<p><?=$data['comments']?></p>
                			
                		</div>
                	</div>
                	
                </div>
                
                <div class="box-body">
                	<div class="form-group >">
                		<label for="name" class="col-sm-2 control-label">
                			Received Date
                		</label>
                		<div class="col-sm-10">
                			<p><?=date('d, F Y h:i:s a',strtotime($data['created_time']))?></p>
                			
                		</div>
                	</div>
                	
                </div>
          </div>

        </div>

      </div>
    </section>