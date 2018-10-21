<div class="login-box">
	<div class="login-logo">
		<a href="javascript:;"><b>DakBro</b></a>
	</div>

	<div class="login-box-body">
	    <p class="login-box-msg">Forgot Password</p>

		<form method="post">

					<?php if(validation_errors() || $this->session->flashdata('error_msg')==TRUE || $this->session->flashdata('success_msg')==TRUE):?>
				<div class="Metronic-alerts alert alert-<?=($this->session->flashdata('success_msg')==TRUE)?'success':'danger'?> fade in">
					<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa-lg fa fa-warning"></i></button>
					<?php echo validation_errors(); ?>

					<?php if($this->session->flashdata('success_msg')==TRUE)
	                    echo "<p>".$this->session->flashdata('success_msg')."</p>"; ?>
                        
                        <?php if($this->session->flashdata('error_msg')==TRUE)
	                    echo "<p>".$this->session->flashdata('error_msg')."</p>"; ?>
	                  
				</div>
			<?php endif;?>

	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" name="password" placeholder="Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" name="confpassword" placeholder="Confirm Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
	        </div>
	        <!-- /.col -->
	      </div>
	    </form>
	   

	</div>
</div>

