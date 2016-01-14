<?php
/*
Plugin Name: XT Galleria
Description: Displays a beautiful Galleria slideshow in place of the built-in WordPress image grid. Overrides the default functionality of the [gallery] shortcode.
Version: 1.0.3
Author: Georges Haddad
Author URI: http://xplodedthemes.com
Original Author: Andy Whalen
Original Author URI: http://amwhalen.com/
License: The MIT License
*/

require_once dirname(__FILE__) . '/XT_Galleria.php';
$xt_galleria = new XT_Galleria(plugins_url(basename(dirname(__FILE__))));
