 <?=$header?>
<div class="template-content">

					<!-- Main -->
					<div class="template-section template-main">
					 <form role="form" id="filters_form" action="<?=site_url('shops/index/'.$service['id'])?>" method="POST">
						<!-- Layout -->
						<div class="template-content-layout template-content-layout-sidebar-left template-clear-fix">

							<!-- Left column -->
							<div class="template-content-layout-column-left">
								<div id="filters_col">
									<div style="font-size:16px">Filters</div>
									<div class="collapse in show" id="collapseFilters">
									  
										  
										  <input type="hidden" name="sort_val" value="sort_price" />
										  <div class="filter_type">
										  <h6 style="font-size:14px">Nearby Localities</h6>
										  <ul>
										  <?php foreach($areas as $a => $v ):?>
                                           
                                            <label class="container"><?=$v['name']?>
                                              <input type="checkbox" name="area" onclick="$('#filters_form').submit();" <?php echo (isset($post_data['area']) && $v['id'] == $post_data['area'])?"checked=checked":"";?>  value="<?=$v['id']?>"/>
                                              <span class="checkmark"></span>
                                            </label><br/>
                                          <?php endforeach;?>
                                        
												  
																  </ul>
                                            	  <h6 style="font-size:14px">Vehicles</h6>
										  <ul>
										  <?php foreach($vehicles as $a => $v ): if( empty($v['name']) ) continue;?>
                                           
                                            <label class="container"><?=$v['name']?>
                                              <input type="checkbox" name="vehicle" onclick="$('#filters_form').submit();" <?php echo (isset($post_data['vehicle']) && $v['id']==$post_data['vehicle'])?"checked=checked":"";?>  value="<?=$v['id']?>"/>
                                              <span class="checkmark"></span>
                                            </label><br/>
                                          <?php endforeach;?>
                                        
												  
																  </ul>
												  <ul>
							  
												  <h6 style="font-size:14px">Pick Up</h6>
							                 <label class="container">
                                              <input type="checkbox" onclick="$('#filters_form').submit();" <?php echo ( isset($post_data['pickup']) && $post_data['pickup'] == 'yes')?"checked=checked":"";?> name="pickup" value="yes">
                                              <span class="checkmark"></span>
                                            </label>
							  
													  </ul>
											  </div>
										  </div><!--End collapse -->
										  
							  
									  </div>
							</div>
							
							<!-- Right column -->
							<div class="template-content-layout-column-right">
										
		<!-- Header + subheader -->
		<div class="template-component-header-subheader template-align-left">
			<h2><?=$service['name']?></h2>
			<div></div>
			<span></span>
		</div>	

		<!-- Text -->
		<p class="template-padding-reset">
			<?=$service['description']?></p>

		<div class="hidden-xs hidden-sm clearfix" id="tools">
			<div class="row">
							<div class="col-md-9 col-sm-9" style="left:5px; font-size:12px; bottom:8px; margin-bottom:-16px;">
							<h1 style="font-size:12px; color:#333;margin-top: 16px;">
								<label for="search_results_count"><?=count($shops)?></label>
								<label for="vehicle_results"> shops found for </label>
								<?=$service['name']?>
								<label for="locality_results"> in chennai </label>
							</h1>
							</div>
							<div class="col-md-3 col-sm-3">
							<div class="styled-select-filters" style="float:right">
							
							
			
								<select name="sort_val" id="sort_id" class="sort_select" onchange="this.form.submit()">
									<!--<option value="sort_distance" selected="selected">Sort by Distance</option>-->
									<option value="sort_price" <?php echo (isset($post_data['sort_val']) && $post_data['sort_val'] == 'sort_price')?"selected=selected":"";?>>Sort by Price</option>
									<option value="sort_ratings" <?php echo (isset($post_data['sort_val']) && $post_data['sort_val'] == 'sort_ratings')?"selected=selected":"";?>>Sort by Ratings</option>
								</select>
						
							</div>
							</div>
			</div>
			</div>
			<!--  -->

			<div class="content">
				
                <?php if(empty($shops)):?>
                No Shops.
                <?php endif;?>
                <?php foreach($shops as $a => $v ):?>
				<!--  Loop Product Start-->
				<div class="strip_all_tour_list fadeIn clearfix">

						<div class="">
						 <div class="col-lg-3 col-md-3 col-sm-3">
							<div class="img_list">
							 <a href="">
                             <?php
                             
                                $shops_img = json_decode($v['image'],true);
                                $img ="";
                                
                                if( isset($shops_img[0]['s3_url']))
                                    $img=  "https://s3.amazonaws.com/".$shops_img[0]['s3_url'];?>
								<img src="<?=$img?>">
							 	<div class="short_info" style="font-size:12.5px"></div>
							 </a>
							</div>
						 </div>
						  <div class="clearfix visible-xs-block"></div>
						 <div class="col-lg-6 col-md-6 col-sm-6">
								 <div class="tour_list_desc">
									<div class="hidden-sm hidden-xs">
							 			<a href="#">
							 				<h2>
							 					<strong><?=$v['name']?></strong> 
							 				</h2>
							 			</a>
								 	</div>
								 
								 <div class="hidden-md hidden-lg ">
									 <div class="rating hidden-md hidden-lg" style="float:left; width:90%;">
									 	<i class="icon icon-filled-star <?=($v['ratings']>=1)?'voted':''?>"></i>
									 	<i class="icon icon-filled-star <?=($v['ratings']>=2)?'voted':''?>"></i>
									 	<i class="icon icon-filled-star <?=($v['ratings']>=3)?'voted':''?>"></i>
									 	<i class="icon icon-filled-star <?=($v['ratings']>=4)?'voted':''?>"></i>
									 	<i class="icon icon-filled-star <?=($v['ratings']>=5)?'voted':''?>"></i>
									 	<small></small>
		 
									 </div>
								 		<i class="icon icon-24x7-phone hidden-md hidden-lg" style="float:right; color:#ffa800; font-size:24px;"></i>
								 </div>

								 <p> <i class="icon icon-map-pin" style="font-size:16px; margin-left:-5px;"></i><?=$v['area']?> </p>
								 <p class="shop_sub_data"></p>
								 <ul class="add_info">
									 <li>
										  <a href="javascript:void(0);" title=""><i class="icon icon-since"></i></a>
                                          <span class="hide"><i class="icon icon-since"></i>&nbsp;<?=$v['start_day']?> - <?=$v['end_day']?> | <?=$v['start_time']?> - <?=$v['end_time']?></span>
									</li>
									 <li>
										  <a href="javascript:void(0);"  title=""><i class="icon icon-number-mechanics"></i></a>
                                          <span class="hide"><?=$v['no_of_mechanics']?> Mechanics</span>
									</li>
									 <li>
										  <a href="javascript:void(0);"  title=""><i class="icon icon-sqft"></i></a>
									<span class="hide"><?=$v['shop_area']?> sqft</span>
                                    </li>
									 <li>
										  <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?=$v["lat"]?>,<?=$v["lon"]?>" title=""><i class="icon icon-map-pin"></i></a>
									</li>
									 <li>
										  <a href="javascript:void(0);"  title=""><i class="icon icon-pay-online"></i></a>
										<span class="hide">Online Payment Available</span>
                                    </li>
								 </ul>
								 </div>
						 </div>
						 <div class="col-lg-2 col-md-2 col-sm-2">
							 <div class="price_list" style="color:#000;"><div>
																									 
								<center>
                                         
                                         
									<div > Price<br></div> 
									<?php if(($v['discount'])):?>
                                    <span class="strike shop-price" ><strike>&#8377; <?=$v['price']?></strike> <?="( ".($v['discount'])." % Discount )"?></span><br />
                                     <?php endif;?>
                                     <span class="shop-price">&#8377; </span>
                                    <span class="shop-price" ><?php echo ($v['discount'])?$v['price']- (($v['price']*$v['discount'])/100):$v['price']?></span>
                                            
								</center>
								<br>
							 <br/>
							 <p style="text-align:center"><a href="<?=site_url('booking/index/'.$post_data['area'].'/'.$v["id"].'/'.$post_data['vehicle'].'/'.$service['id'])?>" class="btn_1 btn-responsive">Book Now</a></p>
							 </div>
							 </div>
						 </div>
						 </div>
					 </div>

				<!--  Loop Product End-->
                <?php endforeach;?>

				<hr>
			</div>
		</div>

			<div class="clearfix"></div>
			<div class="container clearfix">
				<div class="row">
					<div class="col-md-3">
                  		<h3>Service Details</h3>
              		</div>
              		<div class="col-md-9">
			                  <p>
			            
			         </p>
			         <div class="row">
			            <div class="col-md-6 col-sm-6">
			               <ul class="list_ok">
                            <?php $detailsList = explode(PHP_EOL, $service['service_details']);?>
                                    
                                    <?php foreach($detailsList as $dl => $dv ):?>
                                        <li> <?=$dv?></li>
                                        <?php endforeach;?>
			               </ul>
			            </div>
			         </div>
			         <!-- End row  -->
			        
			                  
			      </div>
				</div>
			</div>
							
						</div>
						
					</div>
						</form>
				</div>
               <?=$footer?>