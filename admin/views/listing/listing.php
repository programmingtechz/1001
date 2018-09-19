
	<input type="hidden" name="bulk_all" id="bulk_all" value="0" />
	<input type="hidden" name="bulk_action" id="bulk_action" value="" />
	<input type="hidden" name="cur_page" id="cur_page" value="<?php echo $cur_page;?>" />
	<input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url;?>" />
	<input type="hidden" name="namespace" id="namespace" value="<?php echo $namespace;?>" />
<?php 
$uri = $this->uri->segment(2);?>
<br/>
<?php if($count):?>
	
	<div class="row">
		<div class="col-lg-4 m_top_10">
			<i class="grey"> Showing <?php echo ($cur_page+1);?> - <?php echo ($cur_page+$per_page)>$count?$count:($cur_page+$per_page);?> from <?php echo $count;?>
			</i>
		</div>

		<div class="col-lg-3 m_top_10">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="grey">Show entries:</i> 
				</span>
				<?php echo form_dropdown('outer_per_page_options', $per_page_options, $per_page, 'class="form-control input-sm"');?>
			</div>         	
		</div>

		<div class="col-lg-5">
			<?php echo $pagination ?>
		</div>
		
	</div>
	
<?php endif;?>
<br>
<div id="data_table" >	
	<div class="data-sale col-md-12">
		<table class="table table-striped table-hover tableSite table-bordered" id="data_table">
			<thead>
				<tr>
				 <th> # </th>
				<?php  $cols = 0; 
				foreach ($fields as $field => $values):$cols++;?>

				<?php if($values['default_view'] == '0') continue; ?>
				<th>
				<input type="hidden" value="<?php echo $base_url.$cur_page.'/'.$field.'/';?><?php echo Listing::reverse_direction($direction); ?>">	
				<a href="<?php echo $base_url.$cur_page.'/'.$field.'/';?><?php echo Listing::reverse_direction($direction); ?>" data-original-title="Click to sort" data-toggle="tooltip" data-placement="top" title="Click to sort" style="display: block;">
					<?php echo $values['name'];?> 
					<span class="fa fa-sort pull-right"></span>
				</a>
				
				<?php if(strcmp($order,$field) === 0): $arrow_icon = (strcmp($direction, 'ASC') === 0)?'up_sort':'down_sort';?>
					
					 <div class="sort_group">

						<a style="display:<?php echo strcmp($arrow_icon, 'up_sort') === 0?'block':'none';?>" href="<?php echo $base_url.$cur_page.'/'.$field.'/';?><?php echo Listing::reverse_direction($direction); ?>">
							<i class="up_sort m_top_15"></i>
						</a>

						<a style="display:<?php echo strcmp($arrow_icon, 'down_sort') === 0?'block':'none';?>" href="<?php echo $base_url.$cur_page.'/'.$field.'/';?><?php echo Listing::reverse_direction($direction); ?>">
							<i class="down_sort m_top_15"></i>
						</a>
						
					</div>  
				<?php else:?>
					
				<?php endif;?>
				</th>

				<?php endforeach;?>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(count($list)):?>

			<?php foreach ($list as $item) : ?>
            
			<?php $val = $this->uri->segment(1);?>
			<tr id="<?php echo (isset($item['id']))?$item['id']:""; ?>">

				<td>
					<?php echo form_checkbox("op_select[]", $item['id'], '', "id='op_select{$item['id']}'"); ?>
				</td>

				<?php foreach ($fields as $field => $row):?>

				<?php if($row['default_view'] == '0') continue; ?>
                                                 
				<td>
					<?php echo displayData($item[$field], $row['data_type'], $item);?>
				</td>
               
                
				<?php endforeach;?>

				<td>
					<?php if(strcmp($listing_action, '') === 0):?>
					<a class="btn btn-small" href="<?php echo site_url($this->uri->segment(1, 'index')."/view/". $item['id']);?>"
						data-placement="top" data-toggle="tooltip"
						data-original-title="view"> <i class="icon-eye-open"></i>
					</a>
					<?php else:?>
						<?php 
							echo $this->parser->parse_string($listing_action, $item, TRUE);
						?>
					<?php endif;?>
				</td>
			</tr>
            
    	<?php endforeach; ?>

	        <?php else:?>
			<tr>
				<td colspan="<?php echo $cols+2;?>">
					<h2 class="text-center ">No records found.</h2>
				</td>
			</tr>
			<?php endif;?>
		</tbody>
	</table>
    </div>
</div>

<div class="pagination text-right col-md-12 pull-right" id="pagination">
	<?php echo $pagination;?>
</div>