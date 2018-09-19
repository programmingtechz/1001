<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<?php include_title(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_stylesheets(); ?>
    <?php include_raws() ?>
	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	<script>
         //declare global JS variables here
         var base_url = '<?php echo base_url();?>';
         var current_controller = '<?php echo $this->uri->segment(1, 'index');?>';
         var current_method = '<?php echo $this->uri->segment(2, 'index');?>';
         var namespace = '<?php echo $this->namespace;?>';
         var previous_url = '<?php echo $this->previous_url;?>';
  	</script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.4.7.min.js" defer></script>
</head>

<?php if( get_current_user_id() !== FALSE ): ?>

	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			
			<?php $this->load->view('_partials/header'); ?>

			<!-- Content Wrapper. Contains page content -->
	  		<div class="content-wrapper">
            <div id="flash">
            <?php display_flashmsg($this->session->flashdata()); ?>
            </div>
				<?php echo $content; ?>
	  		</div>
			
			<?php $this->load->view('_partials/footer'); ?>

			<?php include_javascripts(); ?>
			
			<?php 
			
				if(is_array($this->init_scripts))
				{
					foreach ($this->init_scripts as $file)
						$this->load->view($file, $this->data);
				}
			?>

		</div>
	</body>

<?php else: ?>	

	<body class="hold-transition login-page">
		<?php echo $content; ?>
	</body>

	<?php include_javascripts(); ?>
			
	<?php 
	
		if(is_array($this->init_scripts))
		{
			foreach ($this->init_scripts as $file)
				$this->load->view($file, $this->data);
		}
	?>
	<script>
		$(function () {
		    $('input').iCheck({
		      checkboxClass: 'icheckbox_square-blue',
		      radioClass: 'iradio_square-blue',
		      increaseArea: '20%' // optional
		    });
		});
	</script>
<?php endif; ?>	

</html>