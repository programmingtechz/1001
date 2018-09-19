<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Holidays
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
              <h3 class="box-title">Holiday List</h3>
            </div>
            <!-- /.box-header -->
           <div id="holiday_list"></div>
          </div>

        </div>

      </div>
    </section>
    
    <div style="display: none;" id="holiday-template"> 
    <div>

            <div class="modal-content modal-dialog vertical-align-center">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
            
                    </button>
                     <h4 class="modal-title" id="myModalLabel">Add/Edit Holiday</h4>
            
                </div>
                <div class="modal-body"> <?=$form_fields;?>  </div>
                 <div class="modal-footer">
                                <button type="button" class="cancel btn btn-default" >Close</button>
                                <button type="button" class="delete btn btn-default" >Delete</button>
                                <button type="button" class="btn btn-primary save">Save</button>
                 </div>  
            </div>      
    </div>
    
    </div>