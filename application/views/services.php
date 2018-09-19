<?=$header?>
<div class="template-content">
					
					<!-- Section -->
					<div class="template-section template-section-padding-1 template-clear-fix template-main">
						
						<!-- Header + subheader -->
						<div class="template-component-header-subheader">
							<h2>Our Services</h2>
							<div></div>
							<span>Save time and money</span>
						</div>		
						
						<!-- Text -->
						<div class="template-align-center"> 
							<p>
								We are dedicated to providing quality service, customer satisfaction at a great value in multiple locations offering convenient hours.<br>
								Our goal is to provide our customers with the friendliest, most convenient hand bike polish experience possible.
							</p>
						</div>
						
						<!-- Space -->
						<div class="template-component-space template-component-space-2"></div>
						
						<!--- Layout 33x33x33% -->
						<ul class="template-layout-33x33x33 template-clear-fix">
							
                            <?php $cnt =0;
                            
                            foreach( get_services(array('type'=>'bike','parent_id'=>0),"*",false) as $k => $v ):?>
							<!-- Left column -->
                            <?php $dpos = array(0=>'left',1=>'center',2=>'right');
                            
                            if( $cnt > 2 ) $cnt =0;
                            ?>
                            
							<li class="template-layout-column-<?=$dpos[$cnt]?>" style="visibility: visible;">
								<div class="template-component-image template-component-image-preloader" style="background-image: none;">
									<a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>" style="opacity: 1;">
                                    <?php   
                                            $service_img = json_decode($v['service_image'],true);
                                            $img ="";
                                            
                                            if( isset($service_img[0]['s3_url']))
                                                $img=  "https://s3.amazonaws.com/".$service_img[0]['s3_url'];?>
										<img src="<?=$img?>" alt="">
										<span class="template-component-image-hover"></span>
									</a>
								</div>
								<h5 class="template-margin-top-2">
									<a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>">
										<?=$v['name']?>
									</a>
								</h5>
								<p class="template-padding-reset"><?=$v['description']?></p>
							</li>
                            <?php $cnt++;
                            endforeach;?>
							
							
						</ul>
						
					</div>
					
					<!-- Section -->
					<div class="template-section template-section-padding-reset template-clear-fix">
					
						<!-- Flex layout 50x50% -->
						<div class="template-layout-flex template-background-color-1 template-clear-fix">

							<!-- Left column -->
							<div class="template-align-center">

								<!--- Header + subheader -->
								<div class="template-component-header-subheader">
									<h2>Why Choose Us</h2>
									<div></div>
									<span>A great value services</span>
								</div>
								
								<!-- Text -->
								<p class="template-padding-reset">
									Dakbro Incredible cleans and maintains all kind of motorcycles with feature leading-edge Detailing, innovative materials, consistently, and superior quality with the ability to personalize.<br /> We also provide:
								</p>
								
								<!-- Space -->
								<div class="template-component-space template-component-space-2"></div>
								
								<!-- Button -->
								<a href="<?=site_url('booking/')?>" class="template-component-button">Book Appointment</a>
								
							</div>

							<!-- Right column -->
							<div class="template-background-image template-background-image-3"></div>

						</div>
						
						<!-- Flex layout 50x50% -->
						<div class="template-layout-flex template-background-color-1 template-clear-fix">

							<!-- Left column -->
							<div class="template-background-image template-background-image-4"></div>

							<!-- Right column -->
							<div class="template-align-center">
								
								<!-- Header + subheader -->
								<div class="template-component-header-subheader">
									<h2>Experienced Team</h2>
									<div></div>
									<span>We can deliver the best result</span>
								</div>
								
								<!-- Text -->
								<p class="template-padding-reset">
									At Dakbro Incredible, we're service with world class product according our customer's expectations with talented individuals who share our passion to lead the Idea. Our culture is fast-paced, energetic and innovative.  When we started in 2011 in Shed in Besant nagar, we work to build an inclusive environment in which everyone, regardless of, religion, age, or background, can do their best work. 
								</p>
								
								<!-- Space -->
								<div class="template-component-space template-component-space-2"></div>
								
								<!-- Button -->
								<a href="<?=site_url('booking/')?>" class="template-component-button">Book Appointment</a>
								
							</div>

						</div>
						
					</div>
					
					<!-- Section -->
					<div class="template-section template-section-padding-1 template-clear-fix template-main">
						
						<!-- Header + subheader -->
						<div class="template-component-header-subheader" style="padding-top: 30px;">
							<h2>No.1 Bike Polishing Studio in Chennai</h2>
						
							
						</div>
					
						
						<!-- Space -->
						<div class="template-component-space template-component-space-2"></div>
						
						<!-- Divider -->
						<div class="template-component-divider"></div>
						
						<!-- Space -->
						<div class="template-component-space template-component-space-2"></div>
						
						<!-- Features list -->
						<div class="template-component-feature-list template-component-feature-list-position-top">
							
							<!-- Layout 25x25x25x25% -->
							<ul class="template-layout-25x25x25x25 template-clear-fix">
								
								<!-- Left column -->
								<li class="template-layout-column-left" style="visibility: visible;">
									<span class="template-icon-feature-user-chat"></span>
									<h5>Easy To Reach</h5>
									<p>One call a complete guide  for to care your bike.</p>
								</li>
								
								<!-- Center left column -->
								<li class="template-layout-column-center-left" style="visibility: visible;">
									<span class="template-icon-feature-check"></span>
									<h5>Best Results</h5>
									<p>By using the world class product, we achieve the best result for your bike.</p>
								</li>				
								
								<!-- Center right column -->
								<li class="template-layout-column-center-right" style="visibility: visible;">
									<span class="template-icon-feature-eco-car"></span>
									<h5>Eco Friendly</h5>
									<p>By using the world class product, we achieve the best result for your bike.</p>
								</li>
							
								<!-- Center right column -->
								<li class="template-layout-column-right" style="visibility: visible;">
									<span class="template-icon-feature-payment"></span>
									<h5>Online Payments</h5>
									<p>Easy and Convenient, Secure, and rewards you. ( Coming soon )</p>
								</li>	
								
								
							</ul>
							
						</div>
						
					</div>
				
					
				</div>
 <?=$footer?>