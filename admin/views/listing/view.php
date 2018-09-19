<?php /*if ($message = $this->service_message->render()) :?>
<?php echo $message;?>
<?php endif; */?>

<!-- button tool bar section start here -->


  <div class="tableView">
		<?php echo $search_bar;?>
    
		<?php $uri = $this->uri->segment(1); ?>

      <?php if($uri=='customer'):?>

      <div class="col-md-3 button-group text-right">
        <a href="<?php echo site_url('customer/add');?>" class="btn green ">New Customer <i class="fa fa-plus"></i></a>
      </div>

      <?php endif;?>

       <?php if($uri=='tickets'):?>

      <div class="col-md-3 button-group text-right">
        <a href="<?php echo site_url('tickets/export');?>" class="btn green ">Export <i class="fa fa-plus"></i></a>
      </div>

      <?php endif;?>


		
      <form name="<?php echo $this->namespace;?>" id="<?php echo $this->namespace;?>" action="<?php echo site_url($this->uri->segment(1, 'index').'/bulk_actions');?>" method="post">
      	
		    <?php echo $listing;?>				
		  </form>	

      <!--Advanced Search Popup content starts here-->
      <div id="popOverBox" style="display:none;"> </div>

	</div>	




