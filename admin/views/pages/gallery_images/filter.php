<?php
	
	$created_time     = array('name' => 'created_time', 'value' => '', 'class' => 'datepicker', 'size' => '16');

?>

<div class="modal fade" id="advance_search_form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Advance Search</h4>
      </div>
      <div class="modal-body">
        <form method="POST">

			<div class="row-fluid">
				<div class="span2">
				  <fieldset>
				    <label>Created After</label>
			    	<?php echo form_input($created_time);?> 	
				  </fieldset>
				</div>
			
				
			</div>

		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$.fn.submit_advance_search_form();">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>