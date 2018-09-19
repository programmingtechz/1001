<!-- Header -->

        <div class="template-header">
            <!-- Top header -->
            <?php $current_page = get_current_page();
            
            $force_sticky = "force-top-sticky";//( in_array($current_page,array('booking','terms','about','account','shops') ))?
            ?>
            <div class="template-header-top <?=$force_sticky?>">
                <!-- Logo -->
                <div class="template-header-top-logo">
                    <a href="<?=base_url()?>" title="">
                    <img src="https://s3.amazonaws.com/prod-dakbro/logo_yellow.png" class="template-logo"/>
                    <img src="https://s3.amazonaws.com/prod-dakbro/logo_yellow.png" alt="Dakbro incredible polishing studio" class="template-logo template-logo-sticky"/>
                    </a>
                </div>
                <!-- Menu-->
                <div class="template-header-top-menu template-main">
                    <nav>
                        <!-- Default menu-->
                        <div class="template-component-menu-default">
                            <ul class="sf-menu">
                                <li><a href="<?=site_url("home")?>" class="template-state-selected">Home</a></li>
                                  <li>
                                    <a href="<?=site_url('services')?>">Services</a>
                                    <ul>
                                    <?php foreach( get_services(array('type'=>'bike','parent_id'=>0),"name",false) as $k => $v ):?>
                                        <li><a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>"><?=ucwords($v['name'])?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                </li>
                                <li><a href="<?=site_url('booking')?>">Booking</a></li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                                <li><a href="<?=site_url('gallery')?>">Gallery</a></li>
                                
                                  <li class="my_account_menu <?=(is_front_end_logged_in())?'':'hide'?>">
                                    <a href="<?=site_url('services')?>">My Account</a>
                                    <ul>
                                        <li><a href="<?=site_url('account/my_orders/')?>">Orders</a></li>
                                        <li><a href="<?=site_url('account/profile/')?>">Profile</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?=site_url('contact')?>">Contact</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('social')?>">Social Activities</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <nav>
                        <!-- Mobile menu-->
                        <div class="template-component-menu-responsive">
                            <ul class="flexnav">
                                <li><a href="<?=site_url("home")?>" class="template-state-selected">Home</a></li>
                                
                                <li>
                                    <a href="<?=site_url('services')?>">Services</a>
                                    <ul>
                                    <?php foreach( get_services(array('type'=>'bike','parent_id'=>0),"name",false) as $k => $v ):?>
                                        <li><a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>"><?=ucwords($v['name'])?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                </li>
                                <li><a href="<?=site_url('booking')?>">Booking</a></li>
                                <li>
                                    <a href="https://blog.dakbroincredible.com/">Blog</a>
                                </li>
                                <li><a href="<?=site_url('gallery')?>">Gallery</a></li>
                                <li>
                                    <a href="<?=site_url('contact')?>">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                   
                </div>
                <!-- Social icons -->
                <div class="template-header-top-icon-list template-component-social-icon-list-1">
            
                    <ul class="template-component-social-icon-list">
                    <li><a href="#" class="template-icon-meta-menu"></a></li>
                    
                       <li>    <?php $user_data = is_front_end_logged_in();
                        if($user_data):?>
                         <span>(<?=($user_data['user_name'] != 'null' && $user_data['user_name'])?$user_data['user_name']:$user_data['phone']?>)</span><a href="<?=base_url('login/logout')?>"  >Logout</a>
                         <a href="#"  data-target="#phoneModal" class="hide" >Login</a>
                         <?php else:?>   
                          <a href="#"  data-target="#phoneModal">Login</a>
                        <?php endif;?></li>
                       
                       
                    </ul>
                </div>
            </div>
               <?php $sliders = get_sliders();  if( !empty($sliders) && !in_array($current_page,array('booking','terms','about','account','shops')) ):?>
            <div class="template-header-bottom" >
                <div id="rev_slider_wrapper" class="rev_slider_wrapper fullwidthbanner-container" >
                    
                 
                    <div id="rev_slider" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                        
                        <ul>
                            <!-- Slide 1 -->
                            <?php foreach( $sliders as $key => $val ):?>
                            <li data-index="slide-<?=$key?>" data-transition="fade" data-slotamount="1" data-easein="default" data-easeout="default" data-masterspeed="500" data-rotate="0" data-delay="4000">
                                <!-- Main image -->
                                
                                <?php $slider_img = json_decode($val['image'],true);
                                $img ="https://s3.amazonaws.com/prod-dakbro/313037/bfa39a70-2f41-11e8-8551-fd83e2209884_1521882006934.jpg";
                                if( isset($slider_img[0]['s3_url']))
                                    $img=  "https://s3.amazonaws.com/".$slider_img[0]['s3_url'];
                                ?>
                                <img src="<?=$img?>" alt="<?=$val['title']?>" data-bgfit="cover" data-bgposition="center bottom">
                                <!-- Layers -->
                                <!-- Layer 01 -->
                                <div class="tp-caption tp-resizeme" 
                                    data-x="['center','center','center','center','center']" data-hoffset="['0','0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle','middle']" data-voffset="<?php echo (get_current_page() == 'home')?"['-120','-105','-91','-33','-36']":"['-10','-105','-91','-33','-36']";?>"
                                    data-fontsize="['17','17','17','15','14']"
                                    data-fontweight="['700','700','700','700','900']"
                                    data-lineheight="['17','17','17','15','27']"
                                    data-whitespace="['nowrap','nowrap','nowrap','nowrap','normal']"
                                    data-width="['auto','auto','auto','auto','300']"
                                    data-height="auto"
                                    data-basealign="grid"
                                    data-transform_idle="o:1;"
                                    data-transform_in="o:1;x:[175%];y:0px;z:0px;s:2000;e:Power4.easeInOut;"
                                    data-transform_out="o:0;x:0px;y:0px;z:0px;s:1000;e:Power4.easeInOut;"
                                    data-mask_in="x:[-100%];y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                    data-start="100"
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on"
                                    style="letter-spacing: 2px;"
                                    >
                                    <?=$val['title']?>
                                </div>
                                <!-- Layer 02 -->
                                <div class="tp-caption tp-resizeme" 
                                    data-x="['center','center','center','center','center']" data-hoffset="['0','0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle','middle']" data-voffset="<?php echo (get_current_page() == 'home')?"['-41','-35','-29','17','26']":"['50','-35','-29','17','26']";?>"
                                    data-fontsize="['62','55','43','29','22']"
                                    data-fontweight="['900','900','900','700','700']"
                                    data-lineheight="['62','55','43','29','32']"
                                    data-whitespace="['nowrap','nowrap','nowrap','nowrap','normal']"
                                    data-width="['auto','auto','auto','auto','300']"
                                    data-height="auto"
                                    data-basealign="grid"
                                    data-transform_idle="o:1;"
                                    data-transform_in="o:1;x:0px;y:[100%];z:0px;s:2000;e:Power4.easeInOut;"
                                    data-transform_out="o:1;x:0px;y:[100%];z:0px;s:1000;e:Power4.easeInOut;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="0"
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on"
                                    style="letter-spacing: 4px;"
                                    >
                                     <?=$val['sub_title']?>
                                </div>
                            </li>
                        <?php endforeach;?>
                        </ul>
                    </div>
                
                </div>
                <!--/-->
                <?php if( get_current_page() == 'home'):?>
                <div class="" style="display: table; width:100%; position: relative; top: -70px;">
                    <div class="row" id="features_row" style="display:table-row;width:100%;height:55px;background:rgba(0,0,0,0.1);margin-bottom: 20px;margin-top: 20px;margin-left:0px;margin-right:0px;text-align: -webkit-center;padding-top: 15px;padding-bottom: 15px;text-align: -moz-center;">
                        <div id="features" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <i id="feat_icon" class="icon_set icon-pay-online"></i>
                            <div id="desc">INSTANT QUOTES</div>
                            <div class="divider"></div>
                        </div>
                        <div id="features" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <i id="feat_icon" class="icon_set icon-pick-up-drop"></i>
                            <div id="desc">PICKUP &amp; DROP</div>
                            <div class="divider"></div>
                        </div>
                        <div id="features" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <i id="feat_icon" class="icon_set icon-discounts"></i>
                            <div id="desc">EXCLUSIVE OFFERS</div>
                            <div class="divider"></div>
                        </div>
                        <div id="features" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <i id="feat_icon" class="icon_set icon-home"></i>
                            <div id="desc">DOORSTEP SERVICE</div>
                            <div class="divider"></div>
                        </div>
                        <div id="features" class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="border:none;">
                            <img width="25" height="25" src="assets/media/image/call_white.png" alt="" style="position: relative; top: 10px;">
                            <br>
                            <div id="desc">24x7 SUPPORT</div>
                        </div>
                    </div>
                </div>	
                <?php endif;?>				
            </div>
            <?php endif;?>
            
        </div>
        <div class="phoneModal-popup">
        <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                    <div class="load"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="close-pop" aria-hidden="true">x</span></button>
                        <div class="store-find-block">
                                <div class="logindivs">
                                    <div class="store-find">
                                <div class="store-head">
                                    <h6>Phone Number Verifcation</h6>
                                    <div class="label">Enter Your phone number to login/ sign up</div>
                                </div>
                                <!-- Text input-->
                                <div class="store-form">
                                    <form class="login-form" method="POST">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label sr-only" for="Phone">Phone</label>
                                                <div class="col-md-12">
                                                    <input id="verify-Phone" required="required" maxlength="10" pattern="^\d{10}$" name="Phone" type="text" placeholder="Phone" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label sr-only" for="next">next</label>
                                                <div class="col-md-12">
                                                    <button type="submit"  name="login-next" class="btn btn-primary btn-block btn-lg">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="code-varifications">
                                <div class="store-find">
                                    <div class="store-head">
                                    <button name="login-prev"  class="btn btn-primary btn-block btn-sml" >Back</button>
                                     
                                        <h6>Code Verifcation</h6>
                                        <div class="label">Enter your code in below area.</div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="store-form">
                                        <form class="verify-form" method="POST">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label class="col-md-12 control-label sr-only" for="Phone">Phone</label>
                                                    <div class="col-md-3 nopr">
                                                        <input id="val-number1" name="val-number1" maxlength="1" pattern="^\d{1}$" type="text" placeholder="0" class="form-control input-md" required="">
                                                    </div>
                                                    <div class="col-md-3 nopr">
                                                        <input id="val-number2" name="val-number2" maxlength="1" pattern="^\d{1}$" type="text" placeholder="0" class="form-control input-md" required="">
                                                    </div>
                                                    <div class="col-md-3 nopr">
                                                        <input id="val-number3" name="val-number3" maxlength="1" pattern="^\d{1}$" type="text" placeholder="0" class="form-control input-md" required="">
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <input id="val-number4" name="val-number4" maxlength="1" pattern="^\d{1}$" type="text" placeholder="0" class="form-control input-md" required="">
                                                    </div>
                                                </div>
                                                <!-- Button -->
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label sr-only" for="next">next</label>
                                                    <div class="col-md-12">
                                                        <button  type="submit"   name="login_submit" class="btn btn-primary btn-block btn-lg">Verify</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="success-message">
                                <div class="store-find">
                                    <div class="store-form">
                                        <div class="success-sign"><i class="fa fa-check-circle"></i></div>
                                        <div class="label hide success" >Successful Verification</div>
                                    </div>
                                </div>
                            </div>
                                </div>
                                <span class="errmsg"></span>
                            <div class="store-footer text-center">
                                <p>You agree to our <a target="_blank" href="<?=site_url('terms')?>"><strong>Terms of Service</strong> & <strong>Privacy Policy</a></strong></p>
                            </div>
                            <!-- next div code -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Content -->