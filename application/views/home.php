<?=$header?>
        <div class="template-content">
            <!-- Section -->
            <div class="template-section template-section-padding-1 template-clear-fix template-main">
                <div class="content clearfix">
                    <section id="section-2" style="margin-top:-30px;" class="content-current">
                        <div class="template-component-header-subheader">
                            <h2>Find and book</h2>
                            <div></div>
                            <span> Trusted Bike Polish Centers</span>
                        </div>
                        <div class="row list_vehicle_tabs">
                              <div class="col-md-4 col-sm-4">
                                <ul>
                             <?php $cnt =1;
                              foreach( get_services(array('type'=>'bike','parent_id'=>0),"name,short_text,image",false) as $k => $v ):?>
                           
                                 <li>
                                 <div>
                                    <a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>">
                                    <?php   
                                            $service_img = json_decode($v['image'],true);
                                            $img ="";
                                            
                                            if( isset($service_img[0]['s3_url']))
                                                $img=  "https://s3.amazonaws.com/".$service_img[0]['s3_url'];?>
                                        <figure><img style="margin-top: 12px;" src="<?=$img?>" /></figure>
                                        <h3><strong><?=ucwords($v['name'])?></strong></h3>
                                        <small><?=($v['short_text'])?></small>
                                    </a>
                          
                                </div></li>
                            <?php  if( $cnt%2 == 0):?>
                            </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <ul>
                            <?php endif;?>
                            <?php $cnt++;
                            endforeach;?>
                             </ul>
                            </div>
                             
                        </div>
                    </section>
                </div>
             
            </div>
          
           
            <div class="template-section template-section-padding-1 template-clear-fix template-main" style="padding-top: 50px;">
                <!-- Header + subheader -->
                <div class="template-component-header-subheader">
                    <h2>Instant Booking</h2>
                    <div></div>
                    <span>Which wash is the best for your vehicle?</span>
                </div>
                <!-- Booking -->
                <div class="template-component-booking" id="template-booking">
                  <?php $best_price_list = get_best_price_services_by_vehicles();?>
                    <form>
                        <ul>                       
                            <li>
                                <!-- Content -->
                                <div class="template-component-booking-item-content">
                                    <!-- Vehicle list -->
                                    <ul class="template-component-booking-vehicle-list">
                                        <!-- Vehicle -->
                                        <?php foreach( $best_price_list['vehicles'] as $k => $v ):?>
                                        <li data-id="<?=$v['id']?>" >
                                            <div>

                                           <?php  $vehicle_icon = json_decode($v['image'],true);
                                            $img ="";
                                            
                                            if( isset($vehicle_icon[0]['s3_url']))
                                            $img = "https://s3.amazonaws.com/".$vehicle_icon[0]['s3_url'];
                                            
                                            $vehicle_hover_icon = json_decode($v['hover_image'],true);
                                            $hover_img ="";
                                            
                                            if( isset($vehicle_hover_icon[0]['s3_url']))
                                            $hover_img = "https://s3.amazonaws.com/".$vehicle_hover_icon[0]['s3_url'];
                                            ?>
                                                <!-- Icon -->
                                                <div class="template-icon-vehicle-small-car" data-hover-image="<?=$hover_img?>" data-main-image="<?=$img?>" style="background-repeat:no-repeat;background-image:url(<?=$img?>);"></div>
                                                <!-- Name -->
                                                <div><?=$v['name']?></div>
                                            </div>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <!-- Content -->
                                <div class="template-component-booking-item-content">
                                    <!-- Package list -->
                                    <ul class="template-component-booking-package-list row">
                                        <!-- Package -->
                                        
                                        <?php
                                        foreach( $best_price_list['services'] as $k => $v ):
                                        
                                        foreach( $v as $ik => $iv ):
                                        ?>
                                        
                                        <?php if( $ik > 3)break;?>
                                        
                                        <li data-id="<?=$k?>" data-id-vehicle-rel="<?=$k?>" class="col-md-3">
                                            <!-- Header -->
                                            <h4 class="template-component-booking-package-name"><?=$iv['name']?></h4>
                                            <!-- Price -->
                                            <div class="template-component-booking-package-price">
                                              
                                              <?php if(($iv['discount'])):?>
                                                <span class="template-component-booking-package-price-total strike "><strike>&#8377; <?=$iv['price']?></strike> <?="( ".($iv['discount'])." % Discount )"?></span><br />
                                                 <?php endif;?>
                                                 <span class="template-component-booking-package-price-currency">&#8377; </span>
                                                <span class="template-component-booking-package-price-total" ><?php echo ($iv['discount'])?$iv['price']- (($iv['price']*$iv['discount'])/100):$iv['price']?></span>
                                            </div>
                                            <!-- Duration -->
                                            <div class="template-component-booking-package-duration">
                                                <span class="template-icon-booking-meta-duration"></span>
                                                <?php if($iv['service_time']):?>
                                                <span class="template-component-booking-package-duration-value"><?=$iv['service_time']?></span>
                                                <span class="template-component-booking-package-duration-unit">min</span>
                                                <?php else:?>
                                                <span class="template-component-booking-package-duration-value">custom</span>
                                                <span class="template-component-booking-package-duration-unit"></span>
                                                <?php endif;?>
                                            </div>
                                            <!-- Services -->
                                            <?php $detailsList = explode(PHP_EOL, $iv['service_details']);?>
                                            <ul class="template-component-booking-package-service-list">
                                            <?php foreach($detailsList as $dl => $dv ):?>
                                                <li data-id="exterior-hand-wash"><?=$dv?></li>
                                                <?php endforeach;?>
                                            </ul>
                                            <!-- Button -->
                                            <div class="template-component-button-box">
                                                <a href="<?=site_url('booking/index/'.$iv['area_id'].'/'.$iv['shop_id'].'/'.$iv['vehicle_id'].'/'.$iv['service_id'])?>" class="template-component-button">Book Now</a>
                                            </div>
                                        </li>
                                        <?php endforeach;
                                        endforeach;?>
                                        <!-- Package -->
                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <!-- Section -->
            <div class="template-section template-section-padding-reset template-clear-fix">
                <!-- Flex layout 50x50% -->
                <div class="template-layout-flex template-background-color-1 template-clear-fix">
                    <!-- Left column -->
                    <div class="template-background-image template-background-image-1"></div>
                    <!-- Right column -->
                    <div class="template-section-padding-1">
                        <!-- Features list -->
                        <div class="template-component-feature-list template-component-feature-list-position-top">
                            <!-- Layout 50x50% -->
                            <ul class="template-layout-50x50 template-clear-fix">
                                <!-- Left column -->
                                <li class="template-layout-column-left">
                                    <span class="template-icon-feature-location-map"></span>
                                    <h5>Convenience</h5>
                                    <p>We are dedicated to providing quality service, customer satisfaction at a great value in multiple locations offering convenient hours.</p>
                                </li>
                                <!-- Right column -->
                                <li class="template-layout-column-right">
                                    <span class="template-icon-feature-eco-nature"></span>
                                    <h5>Organic products</h5>
                                    <p>By using the world class product, we achieve the best result for your bike.</p>
                                </li>
                                <!-- Left column -->
                                <li class="template-layout-column-left">
                                    <span class="template-icon-feature-team"></span>
                                    <h5>Experienced Team</h5>
                                    <p>At Dakbro Incredible, we're service with world class product according our customer's expectations with talented individuals who share our passion to lead the Idea. Our culture is fast-paced, energetic and innovative.  When we started in 2011 in Shed in Besant nagar, we work to build an inclusive environment in which everyone, regardless of, religion, age, or background, can do their best work.</p>
                                </li>
                                <!-- Right column -->
                                <li class="template-layout-column-right">
                                    <span class="template-icon-feature-spray-bottle"></span>
                                    <h5>Great Value</h5>
                                    <p>We offer multiple services at a great value to meet your needs. We offer a premium service while saving your time and money.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="template-section template-section-padding-reset template-clear-fix">
                <!-- Flex layout 50x50% -->
                <div class="template-layout-flex template-clear-fix template-background-color-1">
                    <!-- Left column -->
                    <div>
                        <!-- Header + subheader -->
                        <div class="template-component-header-subheader">
                            <h2>Testimonials</h2>
                            <div></div>
                            <span>Our customers love us</span>
                        </div>
                        <!-- Space -->		
                        <div class="template-component-space template-component-space-2"></div>
                        <!-- Testimonials list -->							
                        <div class="template-component-testimonial-list template-clear-fix">
                            <!-- Content -->
                            <ul class="template-clear-fix">
                                 <?php foreach( get_testimonials(array(),"name,message",false) as $k => $v ):?>
                                 <li>
                                 <p><?=$v['message']?></p>
                                    <h6><?=$v['name']?></h6></li>
                                <?php endforeach;?>
                            </ul>
                            <!-- Navigation -->
                            <div class="template-component-testimonial-list-navigation">
                                <a href="#" class="template-component-testimonial-list-navigation-left template-icon-meta-arrow-large-rl"></a>
                                <span class="template-component-testimonial-list-navigation-center template-icon-feature-testimonials"></span>
                                <a href="#" class="template-component-testimonial-list-navigation-right template-icon-meta-arrow-large-rl"></a>
                            </div>
                        </div>
                    </div>
                    <!-- Right column -->
                    <div class="template-background-image template-background-image-2 template-color-white">
                        <!-- Header + subheader -->
                        <div class="template-component-header-subheader">
                            <h2>Recent News</h2>
                            <div></div>
                            <span>Recent from the blog</span>
                        </div>
                        
                       <ul  class="template-component-recent-post">
                        <?php 
                        $feeds = file_get_contents('http://blog.dakbroincredible.com/feed/');
                        $feeds = simplexml_load_string($feeds);
                        $items = (isset($feeds->channel) && isset($feeds->channel->item))?json_decode(json_encode($feeds->channel->item),true):array();
                     
                        $items = (isset($items['title']))?array($items):$items;
                       
                        if(!empty($items)){
                        
                        foreach( $items as $k => $v){
                            
                            if( $k > 3) break;
                        ?>
                        <li>
                        <a href="<?=$v['link']?>" title="<?=$v['title']?>">
                        <span class="post_title"><?=$v['title']?></span>
                        <span class="post_time">Posted on <?=date('M d, Y h:m:s a',strtotime($v['pubDate']))?> </span>
                        </a>
                        </li>
                        <?php }
                        } else {
                        echo '<p>There are no posts available</p>';
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Section -->
            <div class="template-section template-section-padding-1 template-clear-fix template-main">
                <!-- Features list -->
                <div class="template-component-feature-list template-component-feature-list-position-left template-clear-fix">
                    <!-- Layout 33x33x33% -->
                    <ul class="template-layout-33x33x33 template-clear-fix">
                        <!-- Left column -->
                        <li class="template-layout-column-left">
                            <span class="template-icon-feature-phone-circle"></span>
                            <h5>Call Us At</h5>
                            <p>
                                (+91) 9176599630<br/>
                                (+91) 9176084047<br/>
                            </p>
                        </li>
                        <!-- Center column -->
                        <li class="template-layout-column-center">
                            <span class="template-icon-feature-location-map"></span>
                            <h5>Our Address</h5>
                            <p>
                                4B Shanthi Colony, 7th main Rd<br/>
                                NAC Jewellery adjacent street, <br/>Anna nagar, Chennai -600040
                            </p>
                        </li>
                        <!-- Right column -->
                        <li class="template-layout-column-right">
                            <span class="template-icon-feature-clock"></span>
                            <h5>Working hours</h5>
                            <p>
                                Monday - sunday: 9 am - 8.30 pm
                            </p>
                        </li>
                    </ul>
                    	<ul class="template-layout-33x33x33 template-clear-fix">
								
								<!-- Left column -->
								<li class="template-layout-column-left" style="visibility: visible;">
								
								</li>
								
								<!-- Center column -->
								<li class="template-layout-column-center" style="visibility: visible;">
									<span class="template-icon-feature-location-map"></span>
									<h5>Our Address</h5>
									<p>
										Shed no:6<br>
										28th cross street, <br/>
                                        Adjacent lane of KFC, <br/>
                                        Besant Nagar, Chennai 600090
									</p>
								</li>
								
								<!-- Right column -->
								<li class="template-layout-column-right" style="visibility: visible;">
									<span class="template-icon-feature-clock"></span>
									<h5>Working hours</h5>
									<p>
										Monday - sunday: 9 am - 8.30 pm
									</p>
								</li>
								
							</ul>
                </div>
            </div>
            <!-- Google Maps -->
            <div class="template-section template-section-padding-reset template-clear-fix">
                <!-- Google Map -->
                <div class="template-component-google-map">
                    <!-- Content -->
                  	<div class="template-component-google-map-box">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.284015334843!2d80.21406531491346!3d13.081177990784106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a526420ad055555%3A0xd88ccfdfed56bf3c!2sdakbro+incredible+bike+polishing+studio!5e0!3m2!1sen!2sin!4v1535832879436" height="400" frameborder="0" style="border:0;width:100%" allowfullscreen></iframe>
				</div>
                    <!-- Button -->
                    <a href="#" class="template-component-google-map-button">
                    <span class="template-icon-meta-marker"></span>
                    <span class="template-component-google-map-button-label-show">Show Map</span>
                    <span class="template-component-google-map-button-label-hide">Hide Map</span>
                    </a>
                </div>				
            </div>
        </div>
        <?=$footer?>