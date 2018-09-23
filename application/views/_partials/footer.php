
        <!-- Footer -->
        <div class="template-footer">
            <div class="template-main">
                <!-- Footer top -->
                <div class="template-footer-top">
                    <!-- Layout 25x25x25x25 -->
                    <div class="template-layout-25x25x25x25 template-clear-fix">
                        <!-- Left column -->
                        <div class="template-layout-column-left">
                            <h6>About</h6>
                            <p>India's 1st Bike Polishing studio.</p>
                            <img src="https://s3.amazonaws.com/prod-dakbro/logo_yellow.png" alt="" class="template-logo" />
                        </div>
                        <!-- Center left column -->
                        <div class="template-layout-column-center-left">
                            <h6>Services/Memebership</h6>
                            <ul class="template-list-reset">
                             <?php foreach( get_services(array('type'=>'bike','parent_id'=>0),"name",false) as $k => $v ):?>
                            <li><a href="<?=site_url('services/detail/'.str_replace(' ','-',$v['name']))?>"><?=ucwords($v['name'])?></a></li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                        <!-- Center right column -->
                        <div class="template-layout-column-center-right">
                            <h6>Company</h6>
                            <ul class="template-list-reset">
                                <li><a href="<?=site_url('about')?>">About Us</a></li>
                                <li><a href="<?=site_url('gallery')?>">Gallery</a></li>
                                <li><a href="<?=site_url('services')?>">Our Services</a></li>
                                <li><a href="<?=site_url('booking')?>">Booking</a></li>
                                <li><a href="<?=site_url('contact')?>">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Right column -->
                        <div class="template-layout-column-right">
                            <h6>Policy</h6>
                             <ul class="template-list-reset">
                                <li><a href="<?=site_url('terms')?>">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="template-footer-bottom">
                    <!-- Social icon list -->
                    <ul class="template-component-social-icon-list template-component-social-icon-list-2">
                        <li><a href="https://www.facebook.com/Incrediblebikepolishingstudio" class="template-icon-social-facebook" target="_blank"></a></li>
                        </ul>
                    <!-- Copyright -->
                    <div class="template-footer-bottom-copyright">
                        &copy; 2018 <a href="http://dakbroincredible.com/" target="_blank">dakbroincredible</a>. All rights reserved 
                    </div>
                </div>
            </div>
        </div>
        <!-- Search box 
        <div class="template-component-search-form">
            <div></div>
            <form>
                <div>
                    <input type="search" name="search"/>
                    <span class="template-icon-meta-search"></span>
                    <input type="submit" name="submit" value=""/>
                </div>
            </form>
        </div>-->
        <!-- Go to top button -->
        <a href="#go-to-top" class="template-component-go-to-top template-icon-meta-arrow-large-tb"></a>
        <!-- Wrapper for date picker -->
        <div id="dtBox"></div>