#!/bin/bash

echo -e ""
date +"%r"

if [ "$1" = "production" ]; then # Production dependencies will be minified

	# Build external dependencies for prod
    # Build login app files for prod
    
 	browserify assets/admin/requirejs.js | uglifyjs > assets/admin/requiredjs.js

    echo "Built prod assets to requiredjs.js"

else
	# Build external dependencies for dev
  
  # Build login app files for dev
  
    browserify assets/admin/requirejs.js --debug > assets/admin/requiredjs.js
    
    echo "Built dev assets to requiredjs.js"
fi							