  <?=$header?>
<div class="template-content">
					
					<!-- Section -->
					<div class="template-section template-section-padding-1 template-main template-align-center">
						
		<!-- Gallery -->
		<div class="template-component-gallery">

			<!-- Filter buttons list -->
			<ul class="template-component-gallery-filter-list">
             <li><a href="#" class="template-filter-all template-state-selected">All</a></li>
            <?php foreach($gallery as $k => $v ):?>
               
                	<li><a href="#" class="template-filter-<?=trim(strtolower(str_replace(' ','-',$v['name'])))?>"><?=$v['name']?></a></li>
            <?php endforeach;?>
			</ul>

			<!-- Images list -->
			<ul class="template-component-gallery-image-list" style="position: relative; height: 1151.72px;">
				<!-- Image -->
                <?php foreach($gallery_images as $k => $v ):?>
				<li class="template-filter-<?=trim(strtolower(str_replace(' ','-',$v['gallery_name'])))?>" style="max-width: 350px; position: absolute; left: 0px; top: 0px;">
					
					<div class="template-component-image template-component-image-preloader" style="background-image: none;">
						
                        <?php $slider_img = json_decode($v['image'],true);
                                $img ="";
                                if( isset($slider_img[0]['s3_url']))
                                    $img=  "https://s3.amazonaws.com/".$slider_img[0]['s3_url'];
                                ?>
						<!-- Orginal image -->
						<a href="<?=$img?>" class="template-fancybox" data-fancybox-group="gallery-1" style="opacity: 1;">
							
							<!-- Thumbnail -->
							<img src="<?=$img?>" alt="">
							
							<!-- Image hover -->
							<span class="template-component-image-hover">
								<span>
									<span>
										<span class="template-component-image-hover-header"><?=$v['title']?></span>
									</span>
								</span>
							</span>
						
						</a>
						
						<!-- Fancybox description -->
						<div class="template-component-image-description">
						<?=$v['description']?></div>
					
					</div>
				
				</li>
                 <?php endforeach;?>
				
			</ul>

		</div>					</div>
					
				
					
				</div>
                <?=$footer?>