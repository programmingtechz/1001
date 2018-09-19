<?=$header?>
<div class="template-content">

					<!-- Main -->
					<div class="template-section template-main">
					
						<!-- Layout -->
						<div class="template-content-layout template-content-layout-sidebar-right template-clear-fix">

							<!-- Left column -->
							<div class="template-content-layout-column-left">	
										
		<!-- Header + subheader -->
		<div class="template-component-header-subheader template-align-left">
			<h2><?=$service_data['name']?></h2>
			<div></div>
			
		</div>	

		<!-- Text -->
		<p class="template-padding-reset">
		<?=$service_data['description']?></p>
 <?php   
                                            $service_img = json_decode($service_data['service_image'],true);
                                            $img ="";
                                            
                                            if( isset($service_img[0]['s3_url']))
                                                $img=  "https://s3.amazonaws.com/".$service_img[0]['s3_url'];?>
		<!-- Image -->
		<div class="template-component-image template-component-image-preloader template-margin-top-1 template-margin-bottom-1" style="background-image: none;">
			<a href="<?=site_url('shops/index/'.$service_data['id'])?>" style="opacity: 1;">
				<img src="<?=$img?>" alt="<?=$service_data['name']?>">
				<span class="template-component-image-hover"></span>
			</a>
		</div>
		
		<!-- Layout 50x50% -->
		<div class="template-layout-50x50">
            <h4>What includes:</h4>
            			<!-- Left column -->
            			<div class="template-layout-column-left" style="visibility: visible;">
            				
                            <?php $detailsList = explode(PHP_EOL, $service_data['service_details']);?>
                                    <ul class="template-component-booking-package-service-list">
                                    <?php foreach($detailsList as $dl => $dv ):?>
                                        <li><span class="template-icon-meta-check"></span><?=$dv?></li>
                                        <?php endforeach;?>
                                    </ul>
            				
            			</div>
            		</div>


					</div>
				
				<!-- Right column -->
				<div class="template-content-layout-column-right">
								
		<!-- Widgets list -->
		<ul class="template-widget-list">
			
			<!-- Widget -->
			<li>
				<div class="template-widget">	
					
					<!-- Announcement -->
					<div class="template-component-announcement">
					<div class="template-component-italic">Book for <?=$service_data['name']?></div>
						<a href="<?=site_url('shops/index/'.$service_data['id'])?>" class="template-component-button">Book Appointment</a>
					</div>
					
				
				</div>
			</li>
				
			<!-- Widget -->
			<li>
				<div class="template-widget">
					<h6>Our Services</h6>
					
					<!-- Services widget -->
					<div class="template-widget-service">
						<ul>
                        
                         <?php foreach( get_services(array('type'=>'bike','parent_id'=>0),"name",false) as $k => $v ):?>
                            <li><a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>"><span> <?=ucwords($v['name'])?></span>	<span class="template-icon-meta-arrow-right-12"></span></a></li>
                            <?php endforeach;?>
						
						</ul>
					</div>
					
				</div>
			</li>
		</ul>			</div>
							
						</div>
						
					</div>
					
				</div>
 <?=$footer?>