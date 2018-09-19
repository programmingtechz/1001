<?=$header?>
<div class="template-content">
     <div class="row">
<div class="col-md-3">
</div>
        <div class="col-md-9">
            <div id="flash">
            <?php display_flashmsg($this->session->flashdata()); ?>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Profile Information</h3>
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
                  <div class="col-md-9">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

        </div>

      </div>
</div>
<?=$footer?>