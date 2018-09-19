<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add/Edit Area
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
              <h3 class="box-title">Add/Edit Area</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">

                 <?=$form_fields;?>            
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-7">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

        </div>

      </div>
    </section>