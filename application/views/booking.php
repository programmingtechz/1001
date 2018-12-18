<?=$header?>

<div class="booking-section template-content" >
	
</div>


<div id="booking-template" style="display: none;">
    <!-- Section -->
    <div class="template-component-booking template-section template-main template-width-1170" id="template-booking">
		<div class="row pb-20 pt-20">
	    	<div class="col-md-6 template-component-booking-item-header template-clear-fix">
	            <span>
	            	<span>1</span>
	            	<span>/</span>
	            	<span>6</span>	
	            </span>
	            <h3>Shop</h3>
	            <h5>Select Shop below.</h5>
	        </div>

	        <div class="col-md-6">
	        	<div class="row">
	        		<div class="col-md-6 offset-md-6">
	        			<div class="form-group row">
						    <label class="col-md-2 col-form-label">Area:</label>
						    <div class="col-md-10">
						    	<select class="form-control areas"></select>
						    </div>
						 </div>		        		
		        	</div>
		        </div>
	        </div>

	    </div>
       

        <div class="row shops-list"></div>
        

        <div class="row pb-20 pt-20">
            <div class="col-md-6 template-component-booking-item-header template-clear-fix">
                <span>
                    <span>2</span>
                    <span>/</span>
                    <span>6</span>  
                </span>
                <h3>Vehicle type</h3>
                <h5>Select vehicle type below.</h5>
            </div>
        </div>

        <div class="row">
             <ul class="vehicles-list template-component-booking-vehicle-list"></ul>
        </div>

        <div class="row pb-20 pt-20">
            <div class="col-md-6 template-component-booking-item-header template-clear-fix">
                <span>
                    <span>3</span>
                    <span>/</span>
                    <span>6</span>  
                </span>
                <h3>Services</h3>
                <h5>Select a service below.</h5>
            </div>
        </div>
        
        <div class="row">
            <ul class="services-list template-component-booking-package-list row"></ul>
        </div>

        <div class="row pb-20 pt-20">
            <div class="col-md-6 template-component-booking-item-header template-clear-fix">
                <span>
                    <span>4</span>
                    <span>/</span>
                    <span>6</span>  
                </span>
                <h3>Related Services</h3>
                <h5>Select related services below.</h5>
            </div>
        </div>

        <div class="row">
            <ul class="sub-services-list template-component-booking-service-list"></ul>
        </div>

        <div class="row pb-20 pt-20">
            <div class="col-md-6 template-component-booking-item-header template-clear-fix">
                <span>
                    <span>5</span>
                    <span>/</span>
                    <span>6</span>  
                </span>
                <h3>Booking summary</h3>
                <h5>Please provide us with your contact information.</h5>
            </div>
        </div>

        <div class="row">
            <!-- Content -->
            <div class="template-component-booking-item-content" style="width: 100%">
                <ul class="template-component-booking-summary template-clear-fix row" style="width: 100%">
                    <!-- Duration -->
                    <li class="template-component-booking-summary-duration" class="col-md-3">
                        <div class="template-icon-booking-meta-total-duration"></div>
                        <h5>
                            <span class="hrs">0</span>
                            <span>h</span>
                            &nbsp;
                            <span class="mins">25</span>
                            <span>min</span>
                        </h5>
                        <span>Duration</span>
                    </li>
                    <!-- Price -->
                    <li class="template-component-booking-summary-price ">
                        <div class="template-icon-booking-meta-total-price"></div>
                        <h5>
                            <span class="template-component-booking-summary-price-symbol">₹</span>
                            <span class="template-component-booking-summary-price-value">0</span>
                        </h5>
                        <span>Total Price</span>                
                    </li>
                </ul>
            </div>
        </div>
        <div class="row pb-20">
            <!-- Content -->
            <div class=" home-form-sec template-component-booking-item-content template-margin-top-reset" style="width: 100%">
                <!-- Layout -->
                <ul class="template-layout-50x50 sec-one template-layout-margin-reset template-clear-fix email-phone" style="width: 100%">
                    <!-- First name -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-first-name">First Name </label>
                            <input type="text" name="booking-form-first-name" value="<?php echo $user_data['fname'];?>">
                        </div>
                    </li>
                    <!-- Second name -->
                    <li class="template-layout-column-right template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-second-name">Last Name </label>
                            <input type="text" name="booking-form-second-name" value="<?php echo $user_data['lname'];?>">
                        </div>
                    </li>
                </ul>
                <!-- Layout -->
                <ul class="template-layout-50x50 sec-two template-layout-margin-reset template-clear-fix email-phone">
                    <!-- E-mail address -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-email">E-mail Address </label>
                            <input type="text" name="booking-form-email" value="<?php echo $user_data['email'];?>">
                        </div>
                    </li>
                    <!-- Phone number -->
                    <li class="template-layout-column-right template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-phone">Phone Number *</label>
                            <input type="text" name="booking-form-phone" value="<?php echo $user_data['phone'];?>">
                        </div>
                    </li>
                </ul>
                <!-- Layout -->
                <ul class="template-layout-33x33x33 sec-three template-layout-margin-reset template-clear-fix">
                    <!-- Vehicle model -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-vehicle-model">Vehicle Model *</label>
                            <input type="text" name="booking-form-vehicle-model" >
                        </div>
                    </li>
                    <!-- Vehicle make -->
                    <li class="template-layout-column-center template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-vehicle-number">Vehicle Number *</label>
                            <input type="text" name="booking-form-vehicle-number" >
                        </div>
                    </li>
                    
                    <!-- Booking date -->
                    <li class="template-layout-column-right template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="booking-form-date">Booking Date *</label>
                            <input type="text" data-field="datetime" name="booking-form-date" >
                        </div>
                    </li>
                </ul>
                <!-- Layout -->
                <ul class="template-layout-100 sec-four template-layout-margin-reset template-clear-fix">
                    <!-- Message -->
                    <li>
                        <div class="template-component-form-field">
                            <label for="booking-form-message">Particulars if any</label>
                            <textarea rows="1" cols="1" name="booking-form-message" ></textarea>
                        </div>
                    </li>
                </ul>                
            </div>
        </div>

        <div class="row pb-20 pt-20">
            <div class="col-md-6 template-component-booking-item-header template-clear-fix">
                <span>
                    <span>6</span>
                    <span>/</span>
                    <span>6</span>  
                </span>
                <h3>Payment Info</h3>
                <h5>Pay using debit/credit card.</h5>
            </div>
        </div>

        <div class="row pb-20">
            <!-- Content -->
            <div class=" home-form-sec template-component-booking-item-content template-margin-top-reset" style="width: 100%">
                <!-- Layout -->
                <ul class="template-layout-50x50 sec-one template-layout-margin-reset template-clear-fix email-phone" style="width: 100%">
                    <!-- First name -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="payment-form-card-number">Card Number </label>
                            <input type="text" placeholder="Enter Card Number" name="payment-form-card-number" value="" autocomplete="off">
                        </div>
                    </li>
                    
                </ul>

                <ul class="template-layout-33x33x33 sec-three template-layout-margin-reset template-clear-fix">
                    <!-- Vehicle model -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="payment-form-exp-month">Expiration Date <br/>Month *</label>
                            <input type="text" placeholder="MM" name="payment-form-exp-month" >
                        </div>
                    </li>
                    <!-- Vehicle make -->
                    <li class="template-layout-column-center template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="payment-form-exp-year"><br/>Year *</label>
                            <input type="text" placeholder="YY" name="payment-form-exp-year" >
                        </div>
                    </li>
                    
                    <!-- Booking date -->
                    <li class="template-layout-column-right template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="payment-form-cvv"><br/>CVV/CVC *</label>
                            <input type="text" data-field="datetime" name="payment-form-cvv" autocomplete="off">
                        </div>
                    </li>
                </ul>

                <ul class="template-layout-50x50 sec-one template-layout-margin-reset template-clear-fix email-phone" style="width: 100%">
                    <!-- First name -->
                    <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <label for="payment-form-card-name">Card Holder Name </label>
                            <input type="text" placeholder="Enter Card Holder Name" name="payment-form-card-name" value="">
                        </div>
                    </li>
                    
                </ul>

                <!-- Layout -->
                <ul class="template-layout-33x33x33 sec-five template-layout-margin-reset template-clear-fix">
                    <!-- Vehicle model -->
                    <!-- <li class="template-layout-column-left template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                         <label for="booking-form-pickup" class="col-sm-4 col-form-label">Pick Up</label>
                             <input type="checkbox" name="booking-form-pickup" class="form-control-plaintext" value="1">
                              </div>
                    </li> -->
                    <!-- Booking date -->
                    <li class="template-layout-column-center template-margin-bottom-reset" style="visibility: visible;">
                        <div class="template-component-form-field">
                            <input type="checkbox" name="booking-form-donate" value="1">
                            <label for="booking-form-donate">Are you interested to <a href="<?=site_url('social')?>">donate</a> clothes?</label>
                        </div>
                    </li>                   
                    
                    <li class="template-layout-column-center template-margin-bottom-reset tc">  
                        <div class="template-component-form-field">
                            <label for="booking-form-terms">Terms & conditions &nbsp;<a href="<?=site_url('terms')?>">Accept Terms</a>*</label>
                            <input type="checkbox" name="booking-form-terms" >
                        </div>
                    </li>

                </ul>

                <!-- Vehicle make -->                
               
                
                
                <!-- Text + submit button -->
                <div class="template-align-center template-clear-fix template-margin-top-2">
                    <p class="template-padding-reset template-margin-bottom-2">We will confirm your appointment with you by phone or sms as soon as possible.</p>
                    <button type="button" class="template-component-button" name="booking-form-submit">Confirm Booking</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="shop-template" style="display: none;">
    <div class="col-md-12 content shop">
        <div class="strip_all_tour_list fadeIn clearfix">
            <div class="">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="img_list">
                        <a href="">
                            <img src="">
                            <div class="short_info" style="font-size:12.5px"></div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="tour_list_desc">
                        <div class="row hidden-sm hidden-xs shop-name">
                            <a href="#">
                                <h2><strong>Lakshmi Air con</strong></h2>
                            </a>
                        </div>
                        <div class="row hidden-md hidden-lg">
                            <div class="rating hidden-md hidden-lg col-lg-8 col-md-8 col-sm-8" style="float:left">
                                <i class="icon icon-filled-star "></i>
                                <i class="icon icon-filled-star "></i>
                                <i class="icon icon-filled-star "></i>
                                <i class="icon icon-filled-star "></i>
                                <i class="icon icon-filled-star "></i>
                                <small></small>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <i class="icon icon-24x7-phone hidden-md hidden-lg" style="color:#ffa800; font-size:24px;"></i>
                            </div>
                        </div>
                        <div class="row location"></div>

                        <div class="row icon-info">
                            
                        </div>
                        <ul class="row add_info">
                            <li data-action="icon-since">
                                <a href="javascript:void(0);" title=""><i class="icon icon-since"></i></a>
                            </li>
                            <li data-action="icon-number-mechanics">
                                <a href="javascript:void(0);" title=""><i class="icon icon-number-mechanics"></i></a>
                            </li>
                            <li data-action="icon-sqft">
                                <a href="javascript:void(0);" title=""><i class="icon icon-sqft"></i></a>
                            </li>
                            <li data-action="icon-map-pin">
                                <a href="javascript:void(0);" title=""><i class="icon icon-map-pin"></i></a>
                            </li>
                            <li data-action="icon-pay-online">
                                <a href="javascript:void(0);" title=""><i class="icon icon-pay-online"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="row">&nbsp;
                        <!-- <center class="starting-from">
                            <div> Starting from<br></div>
                            <span class="">₹</span><span class="amount"></span>
                        </center> -->
                    </div>
                    <div class="row template-component-button-box">
                        <button type="button" class="template-component-button">Select</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="vehicle-template" style="display: none;">
    <li class="vehicle" data-id="regular-size-car">
        <div>
            <!-- Icon -->
            <div class="template-icon-vehicle-small-car"></div>
            <!-- Name -->
            <div class="vehicle-name"></div>
        </div>
    </li>
</div>

<div id="service-template" style="display: none;">
    <li  class="service col-md-3">
        <!-- Header -->
        <h4 class="template-component-booking-package-name">Basic Hand Wash</h4>
        <!-- Price -->
        <div class="template-component-booking-package-price">
            <span class="template-component-booking-package-price-total strike discount-section">
                <strike>&#8377; <span class="original_price"></span></strike> ( <span class="discount"></span> % Discount )
            </span>
            <br/>
            <span class="template-component-booking-package-price-currency">₹
                <!-- <img src="../assets/frontend/media/image/rupee-sign.svg"> -->
            </span>
            <span class="template-component-booking-package-price-total dicounted-price"></span>
            <span class="template-component-booking-package-price-decimal">95</span>
        </div>
        <!-- Duration -->
        <div class="template-component-booking-package-duration">
            <span class="template-icon-booking-meta-duration"></span>
            <span class="template-component-booking-package-duration-value hrs"></span>
            <span class="template-component-booking-package-duration-unit hrs-unit">hour</span>
            <span class="template-component-booking-package-duration-value mins"></span>
            <span class="template-component-booking-package-duration-unit mins-unit">min</span>
        </div>
        <!-- Services -->
        <ul class="template-component-booking-package-service-list"></ul>
        <!-- Button -->
        <div class="template-component-button-box">
            <button type="button" class="template-component-button btn-book-now">Book Now</button>
        </div>
    </li>
</div>

<div id="sub-service-template" style="display: none;">
    <li class="sub-service template-clear-fix">
        <div class="template-component-booking-service-name"></div>
        <div class="template-component-booking-service-duration">
            <span class="template-icon-booking-meta-duration"></span>
            <span class="template-component-booking-service-duration-value hrs"></span>
            <span class="template-component-booking-service-duration-unit hrs-unit">min</span>
            <span class="template-component-booking-service-duration-value mins"></span>
            <span class="template-component-booking-service-duration-unit mins-unit">min</span>
        </div>
        <div class="template-component-booking-service-price">
            <span class="template-component-booking-package-price-total strike discount-section">
                <strike>&#8377; <span class="original_price"></span></strike> ( <span class="discount"></span> % Discount )
            </span>
            <br/>
            <span class="template-icon-booking-meta-price"></span>
            <span class="template-component-booking-service-price-currency">₹
                <!-- <img src="../assets/frontend/media/image/rupee-sign.svg"> -->
            </span>
            <span class="template-component-booking-service-price-value"></span>
        </div>
        <div class="template-component-button-box">
            <button type="button" class="template-component-button">Select</button>
        </div>
    </li>
</div>

<script type="text/javascript">
	var areas = <?php echo json_encode($areas)?>;
    var shops = <?php echo json_encode($shops)?>;
    var vehicles = <?php echo json_encode($vehicles)?>;
    var services = <?php echo json_encode($services)?>;
	var raw_data = <?php echo json_encode($raw_data)?>;
</script>


<?=$footer?>