<div class="login-box">
	<div class="login-logo">
		<a href="javascript:;"><b>DakBro</b></a>
	</div>

	<div class="login-box-body">
	    <p class="login-box-msg">Sign in to start your session</p>

		<form method="post">

			<?php if(validation_errors() || $this->session->flashdata('login_fail1')==TRUE):?>
				<div class="Metronic-alerts alert alert-danger fade in">
					<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa-lg fa fa-warning"></i></button>
					<?php echo validation_errors(); ?>

					<?php if($this->session->flashdata('login_fail1')==TRUE)
	                    echo "<p>".$this->session->flashdata('login_fail1')."</p>"; ?>
	                  
				</div>
			<?php endif;?>

	      <div class="form-group has-feedback">
	        <input type="email" class="form-control" name="email" placeholder="Email" value="<?=set_value('email');?>">
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" name="password" placeholder="Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	        </div>
	        <!-- /.col -->
	      </div>
	    </form>

	    <a href="<?=site_url('login/forgot')?>">I forgot my password</a><br>
	   

	</div>
</div>

