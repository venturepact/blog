<?php
/*
	Plugin Name: XplodedThemes Optimum Speed
	Plugin URI: http://xplodedthemes.com
	Description: Optimum Speed for GoodNews Theme - Optimize and moves the styles and scripts to the footer when possible. Activates Defered Javascript Loading for better site speed.
	Author: XplodedThemes
	Version: 1.0.1
	Author URI: http://xplodedthemes.com
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define('XT_OPTIMUM_SPEED' , '1.0.1');

class XT_Optimum_Speed {

	var $defer_scripts = true;
	var $defer_styles = false;
	var $enable_footer_scripts = true;
	var $enable_footer_styles = false;
	
    var $xt_theme_name = '';
    var $xt_theme_version = '';
    
    // By Handle
	var $exclude_defer_styles = array();	
	var $exclude_defer_scripts = array(
		'jquery-core'
	);	

	var $footer_styles = array();	


    function __construct() {

        add_action('xt_optimum_speed_loaded', array($this, 'loaded'));
    }


    function loaded() {

        if (defined('XT_THEME_VERSION') and defined('XT_THEME_NAME')) {
            $this->xt_theme_name = XT_THEME_NAME;
            $this->xt_theme_version = XT_THEME_VERSION;
        } else {
            return;
        }

        // Hooks
        add_action('wp_enqueue_scripts', array($this, 'optimize'), 999); 
        add_action('wp_enqueue_scripts', array($this, 'defer'), 1000); 
        add_action('wp_footer', array($this, 'footer_hook'), 15);
     
    }

	function optimize() {

		global $wp_scripts;

		if ( is_admin() || xt_is_login_page() ) 
			return;		

 
		$this->js_to_footer('heartbeat');
			
		// JQUERY TO FOOTER
		//$this->js_to_footer('jquery');
		$this->js_to_footer('jquery-migrate');
		$this->js_to_footer('jquery-ui-core');
		$this->js_to_footer('jquery-ui-widget');
		$this->js_to_footer('jquery-ui-mouse');
		$this->js_to_footer('jquery-ui-position');
		$this->js_to_footer('jquery-ui-draggable');
		$this->js_to_footer('jquery-ui-resizable');
		$this->js_to_footer('jquery-ui-button');
		$this->js_to_footer('jquery-ui-dialog');
		
		
		// BUDDYPRESS TO FOOTER
		if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {

			$this->js_to_footer('bp-legacy-js');
	        $this->js_to_footer('bp-confirm');
	        $this->js_to_footer('jquery-caret');
	        $this->js_to_footer('jquery-atwho');
	        $this->js_to_footer('bp-widget-members');
	        $this->js_to_footer('bp-jquery-query');
	        $this->js_to_footer('bp-jquery-cookie');
	        $this->js_to_footer('bp-jquery-scroll-to');
	        $this->js_to_footer('groups_widget_groups_list-js');
	        
	        $this->js_to_footer('bbp-default-bbpress');  //bpress old
	        $this->js_to_footer('bbp-default');  //bpress
	        
        } 
        	
        // MAILCHIMP TO FOOTER
        if ( is_plugin_active( 'mailchimp-widget/nm_mailchimp.php' ) ) {
	        
        	$this->js_to_footer('mailchimp_ajax');
        }
        
        // CONTACT FORM 7 TO FOOTER
        if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
			$this->js_to_footer('contact-form-7');
		}	

        // REVSLIDER TO FOOTER    
        if ( is_plugin_active( 'revslider/revslider.php' ) ) {
          
	        $this->js_to_footer('rs-plugin-settings');
	        $this->js_to_footer('tp-tools');
	        $this->js_to_footer('revmin');

        } 
        
        // REVSLIDER TO FOOTER    
        if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
        
			$this->style_to_footer('js_composer_front');
			wp_deregister_style( 'js_composer_custom_css' );
		}
        
 
		// XT LOGIN / REGISTER
		$this->style_to_footer('ajax-login-register-style');
		$this->style_to_footer('ajax-login-register-login-style');
		$this->style_to_footer('ajax-login-register-register-style');
		
		
		// XT VENDORS
		$this->style_to_footer('xt-vendors');
 
	}

	function defer() {


		// Filters
		if($this->defer_styles) {
        	add_filter('style_loader_tag', array($this, 'filter_defer_style'), 10000, 3);
        	add_filter('bwp_minify_get_tag', array($this, 'filter_defer_min_style'), 10000, 4);
        }
        
		if($this->defer_scripts) {
			add_filter('script_loader_tag', array($this, 'filter_defer_script'), 10000, 3);
			add_filter('bwp_minify_get_tag', array($this, 'filter_defer_min_script'), 10000, 4);	
		}	
		 
	}


    function footer_hook() {

        foreach ($this->footer_styles as $style_id => $style_src) {
	        $version = "";
	        if(strpos($style_src, "?") === false) {
		        $version = "?ver=" . $this->xt_theme_version;
	        }
            echo "<link rel='stylesheet' id='" . $style_id . "-css'  href='" . $style_src . $version. "' type='text/css' media='all' defer />\n";
        }
    }



    function style_to_footer($style_id) {
	    
	    if(!$this->enable_footer_styles) 
	    	return false;

        global $wp_styles;
        
        if (!empty($wp_styles->registered[$style_id]) && !empty($wp_styles->registered[$style_id]->src)  && wp_style_is( $js_id, 'enqueued' )) {
            $this->footer_styles[$style_id] = $wp_styles->registered[$style_id]->src;
            wp_deregister_style($style_id);
        }
    }

    function js_to_footer($js_id) {
	    
	    if(!$this->enable_footer_scripts) 
	    	return false;
	    
        global $wp_scripts;
        
        if (isset($wp_scripts->registered[$js_id]) && wp_script_is( $js_id, 'enqueued' )) {
            wp_enqueue_script($js_id, ($wp_scripts->registered[$js_id]->src), '', $wp_scripts->registered[$js_id]->ver, true);
        }
    }


	function filter_defer_style($tag, $handle)
	{
	
		if (is_admin())
			return $tag;
	
		$styles = $this->exclude_defer_styles;
		
		if(in_array($handle, $styles))
			return $tag;		

	    return str_replace('/>', ' defer />', $tag); 
	}	
	
	function filter_defer_script($tag, $handle, $src)
	{
	
		if (is_admin())
			return $tag;
	
		$scripts = $this->exclude_defer_scripts;
				
		if(in_array($handle, $scripts))
			return $tag;	
	
	    return str_replace('></script>', ' defer></script>', $tag); 
	}

	function filter_defer_min_style($tag, $src, $type, $group) {
		
		if(is_admin() || $type != 'style')
			return $tag;
			
	    return str_replace('/>', ' defer />', $tag); 
	    		
	}
		
	function filter_defer_min_script($tag, $src, $type, $group) {
		
		if(is_admin() || $type != 'script')
			return $tag;
			
	    return str_replace('></script>', ' defer></script>', $tag); 
	    		
	}
	
	
	
	function is_buddypress_page() {
		return function_exists('bp_is_blog_page') && !bp_is_blog_page();
	}

	function is_woocommerce_page() {
		
		if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
	}
}

new XT_Optimum_Speed();