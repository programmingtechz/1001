#!/bin/bash

echo -e ""
date +"%r"

if [ "$1" = "production" ]; then # Production dependencies will be minified

	# Build external dependencies for prod
    # Build login app files for prod
    cat	 assets/frontend/script/jquery-ui.min.js \
    assets/frontend/script/jquery-ui.min.js \
    assets/frontend/script/superfish.min.js \
    assets/frontend/script/jquery.easing.js \
    assets/frontend/script/jquery.blockUI.js \
    assets/frontend/script/jquery.qtip.min.js \
    assets/frontend/script/jquery.fancybox.js \
    assets/frontend/script/isotope.pkgd.min.js \
    assets/frontend/script/jquery.actual.min.js \
    assets/frontend/script/jquery.flexnav.min.js \
    assets/frontend/script/jquery.waypoints.min.js \
    assets/frontend/script/sticky.min.js \
    assets/frontend/script/jquery.scrollTo.min.js \
    assets/frontend/script/jquery.fancybox-media.js \
    assets/frontend/script/jquery.fancybox-buttons.js \
    assets/frontend/script/jquery.carouFredSel.packed.js \
    assets/frontend/script/jquery.responsiveElement.js \
    assets/frontend/script/jquery.touchSwipe.min.js \
    assets/frontend/script/revolution/jquery.themepunch.revolution.min.js \
    assets/frontend/script/template/jquery.template.tab.js \
    assets/frontend/script/template/jquery.template.image.js \
    assets/frontend/script/template/jquery.template.helper.js \
    assets/frontend/script/template/jquery.template.header.js \
    assets/frontend/script/template/jquery.template.counter.js \
    assets/frontend/script/template/jquery.template.gallery.js \
    assets/frontend/script/template/jquery.template.goToTop.js \
    assets/frontend/script/template/jquery.template.fancybox.js \
    assets/frontend/script/template/jquery.template.moreLess.js \
    assets/frontend/script/template/jquery.template.googleMap.js \
    assets/frontend/script/template/jquery.template.accordion.js \
    assets/frontend/script/template/jquery.template.searchForm.js \
    assets/frontend/script/template/jquery.template.testimonial.js \
    assets/frontend/script/bootstrap.js \
    assets/frontend/script/public.js | uglifyjs > assets/frontend/script/dependencies.js

    echo "Built prod frontend to dependencies.js"

else
	# Build external dependencies for dev
  
  # Build login app files for dev
  
    cat	 assets/frontend/script/jquery-ui.min.js \
    assets/frontend/script/jquery-ui.min.js \
    assets/frontend/script/superfish.min.js \
    assets/frontend/script/jquery.easing.js \
    assets/frontend/script/jquery.blockUI.js \
    assets/frontend/script/jquery.qtip.min.js \
    assets/frontend/script/jquery.fancybox.js \
    assets/frontend/script/isotope.pkgd.min.js \
    assets/frontend/script/jquery.actual.min.js \
    assets/frontend/script/jquery.flexnav.min.js \
    assets/frontend/script/jquery.waypoints.min.js \
    assets/frontend/script/sticky.min.js \
    assets/frontend/script/jquery.scrollTo.min.js \
    assets/frontend/script/jquery.fancybox-media.js \
    assets/frontend/script/jquery.fancybox-buttons.js \
    assets/frontend/script/jquery.carouFredSel.packed.js \
    assets/frontend/script/jquery.responsiveElement.js \
    assets/frontend/script/jquery.touchSwipe.min.js \
    assets/frontend/script/revolution/jquery.themepunch.revolution.min.js \
    assets/frontend/script/revolution/jquery.themepunch.tools.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.actions.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.carousel.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.kenburn.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.layeranimation.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.migration.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.navigation.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.parallax.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.slideanims.min.js \
    assets/frontend/script/revolution/extensions/revolution.extension.video.min.js \
    assets/frontend/script/template/jquery.template.tab.js \
    assets/frontend/script/template/jquery.template.image.js \
    assets/frontend/script/template/jquery.template.helper.js \
    assets/frontend/script/template/jquery.template.header.js \
    assets/frontend/script/template/jquery.template.counter.js \
    assets/frontend/script/template/jquery.template.gallery.js \
    assets/frontend/script/template/jquery.template.goToTop.js \
    assets/frontend/script/template/jquery.template.fancybox.js \
    assets/frontend/script/template/jquery.template.moreLess.js \
    assets/frontend/script/template/jquery.template.googleMap.js \
    assets/frontend/script/template/jquery.template.accordion.js \
    assets/frontend/script/template/jquery.template.searchForm.js \
    assets/frontend/script/template/jquery.template.testimonial.js \
    assets/frontend/script/bootstrap.js \
    assets/frontend/script/public.js > assets/frontend/script/dependencies.js
    
    echo "Built dev frontend scripts to dependencies.js"
fi							