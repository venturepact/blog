<?php
/*
Plugin Name: Filament
Plugin URI: http://filament.io/
Description: Install & manage all your Web apps from a single place. Connect your website to Filament with this plugin, and never bug your developers again!
Version: 1.2.14
Author: dtelepathy
Author URI: http://www.dtelepathy.com/
Contributors: kynatro, dtelepathy, dtlabs
License: GPL3

Copyright 2012 digital-telepathy  (email: support@filament.io)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Filament {
    var $label = "Filament";
    var $slug = "filament";
    var $menu_hooks = array();
    var $version = '1.2.14';

    /**
     * Initialize the plugin
     *
     * @uses add_action()
     * @uses load_theme_textdomain()
     * @uses Filament::_route()
     */
    function __construct() {
        /**
         * Make this plugin available for translation.
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain( $this->slug, dirname( __FILE__ ) . '/locales' );

        // Admin in-line styles
        add_action( 'admin_head', array( &$this, 'admin_head' ) );

        // Enqueue admin JavaScripts for this plugin
        add_action( 'admin_menu', array( &$this, 'wp_enqueue_admin_scripts' ), 1 );

        // Admin menu addition
        add_action( 'admin_menu', array( &$this, 'admin_menu' ) );

        // Admin page load
        add_action( "admin_print_styles-toplevel_page_{$this->slug}", array( &$this, "load_admin_page" ) );

        // Filament meta output
        add_action( 'wp_head', array( &$this, 'wp_head' ) );

        // Code snippet output
        add_action( 'wp_footer', array( &$this, 'wp_footer' ) );

        // Plugin action link
        add_filter( 'plugin_action_links', array( &$this, 'plugin_action_links' ), 10, 2 );

        // Custom routing
        if( !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) add_action( 'init', array( &$this, 'route' ) );

        // Site Structure
        add_action( 'wp_ajax_' . $this->slug . '_taxonomy_structure', array( &$this, 'ajax_taxonomy_structure' ) );
        add_action( 'wp_ajax_nopriv_' . $this->slug . '_taxonomy_structure', array( &$this, 'ajax_taxonomy_structure' ) );

        // StumbleUpon JSONP
        add_action( 'wp_ajax_' . $this->slug . '_stumbleupon_jsonp', array( &$this, 'ajax_stumbleupon_jsonp' ) );
        add_action( 'wp_ajax_nopriv_' . $this->slug . '_stumbleupon_jsonp', array( &$this, 'ajax_stumbleupon_jsonp' ) );

        // Google+ JSONP
        add_action( 'wp_ajax_' . $this->slug . '_googleplus_jsonp', array( &$this, 'ajax_googleplus_jsonp' ) );
        add_action( 'wp_ajax_nopriv_' . $this->slug . '_googleplus_jsonp', array( &$this, 'ajax_googleplus_jsonp' ) );
    }

    /**
     * Submit processing for admin_options view
     *
     * @uses update_option()
     * @uses wp_die()
     * @uses wp_verify_nonce()
     */
    private function _submit_admin_options() {
        $code_snippet = wp_check_invalid_utf8( htmlentities( stripslashes( $_REQUEST['single_drop'] ), ENT_QUOTES, "UTF-8" ) );
        $caching = "";

        update_option( $this->slug . '_single_drop', $code_snippet );

        // Other cache sources
        if( defined( 'WP_CACHE' ) && ( WP_CACHE == true ) ) $caching = "other";
        // Check for CloudFlare
        if( defined( 'CLOUDFLARE_VERSION' ) ) $caching = "cloudflare";
        // Check for W3 Total Cache
        if( defined( 'W3TC' ) ) {
          if( function_exists( 'w3tc_pgcache_flush_url' ) ) {
            w3tc_pgcache_flush_url( "/" );
            $caching = "";
          } else {
            $caching = "w3-total-cache";
          }
        }
        // Check for WP Super Cache
        if( function_exists( 'wpsupercache_site_admin' ) ) $caching = "wp-super-cache";
        // Check for Quick Cache
        if( class_exists('\\quick_cache\\plugin') ) $caching = "quick-cache";

        wp_redirect( admin_url( 'admin.php' ) . '?page=' . $this->slug . '&message=submit&caching=' . $caching ); exit;
    }

    /**
     * Hook into admin_head action
     *
     * Output in-line styles for admin menu icon sizing
     */
    public function admin_head() {
        include( dirname( __FILE__ ) . '/views/admin/_styles.php' );
    }

    /**
     * Define the admin menu options for this plugin
     *
     * @uses add_action()
     * @uses add_menu_page()
     * @uses add_submenu_page()
     */
    public function admin_menu() {
        $this->menu_hooks['deploy'] = add_menu_page( $this->label, $this->label, 'edit_theme_options', $this->slug, array( &$this, 'admin_options' ), plugins_url( 'assets/images/bolt.png', __FILE__ ) );

        // Sign up for Filament
        $this->menu_hooks['code_snippet'] = add_submenu_page( $this->slug, $this->label, 'Add/Edit code snippet', 'edit_theme_options', $this->slug, array( &$this, 'admin_options' ) );
        $this->menu_hooks['login'] = add_submenu_page( $this->slug, $this->label, 'Login to Filament', 'edit_theme_options', $this->slug . '/signup', array( &$this, 'admin_options' ) );
        $this->menu_hooks['blog_overview'] = add_submenu_page( $this->slug, $this->label, 'Blog Overview', 'edit_theme_options', $this->slug . '/blog_overview', array( &$this, 'admin_options' ) );
        $this->menu_hooks['traffic_quality'] = add_submenu_page( $this->slug, $this->label, 'Traffic Quality', 'edit_theme_options', $this->slug . '/traffic_quality', array( &$this, 'admin_options' ) );
        $this->menu_hooks['social_activity'] = add_submenu_page( $this->slug, $this->label, 'Social Activity', 'edit_theme_options', $this->slug . '/social_activity', array( &$this, 'admin_options' ) );
        $this->menu_hooks['visitor_behavior'] = add_submenu_page( $this->slug, $this->label, 'Visitor Behavior', 'edit_theme_options', $this->slug . '/visitor_behavior', array( &$this, 'admin_options' ) );
    }

    /**
     * Admin options page view
     *
     * Sets up and renders the view for setting deploy options
     *
     * @uses get_option()
     */
    public function admin_options() {
        $data = array();
        $action = $this->slug . '_admin_options';
        $code_snippet = get_option( $this->slug . '_single_drop', "" );
        $data['single_drop'] = html_entity_decode( $code_snippet, ENT_QUOTES, "UTF-8" );

        $step = 1;
        if( !empty( $code_snippet ) ) $step = 3;
        if( !empty( $code_snippet ) && isset( $_GET['message'] ) ) $step = 2;

        include( dirname( __FILE__ ) . '/views/admin/admin_options.php' );
    }

    /**
     * Public site taxonomy structure URL for Filament App knowledge
     */
    public function ajax_taxonomy_structure() {
        $header = "application/json";

        if( isset( $_REQUEST['callback'] ) ) {
          $callback = preg_replace( "/([^A-Za-z0-9_\$\.]+)/", "", $_REQUEST['callback'] );
          $header =  "application/javascript";
        }

        header( 'Content-type: ' . $header );

        $structure = array(
          'post_types' => array(),
          'categories' => array(),
          'tags' => array()
        );

        $post_types = wp_cache_get( 'post_types', $this->slug );
        if( !$post_types ) {
            $post_types = array();
            $post_type_slugs = get_post_types( array( 'public' => true ) );

            foreach( $post_type_slugs as $post_type_slug ) $post_types[] = get_post_type_object( $post_type_slug );

            wp_cache_set( 'post_types', $post_types, $this->slug, 3600 );
        }

        $categories = wp_cache_get( 'categories', $this->slug );
        if( !$categories ) {
            $categories = get_terms( 'category' );
            wp_cache_set( 'categories', $categories, $this->slug, 3600 );
        }

        $tags = wp_cache_get( 'tags', $this->slug );
        if( !$tags ) {
            $tags = get_terms( 'post_tag' );
            wp_cache_set( 'tags', $tags, $this->slug, 3600 );
        }

        foreach( $post_types as $post_type ) $structure['post_types'][$post_type->name] = $post_type->label;
        foreach( $categories as $category ) $structure['categories'][$category->slug] = $category->name;
        foreach( $tags as $tag ) $structure['tags'][$tag->slug] = $tag->name;

        $data = json_encode( $structure );

        if( isset( $callback ) && !empty( $callback ) ) {
            $data = "$callback($data)";
        }

        exit( $data );
    }

    public function ajax_googleplus_jsonp() {
        # Default header is JSON
        $header = "application/json";
        $content_type = "json";

        # URL to lookup
        $url = $_REQUEST['url'];
        # JSONP callback function
        $callback = $_REQUEST['callback'];

        # If a callback is present set header to JSONP
        if( !empty( $callback ) ) {
            $header = "application/javascript";
            $content_type = "jsonp";
        }

        # Default data values to return
        $data = array( 'count' => 0 );

        # Transient cache lookup
        $cache_key = $this->slug . '-googleplus-' . md5( $url );
        $response = get_transient( $cache_key );

        # If no transient cache, retrieve the data fresh
        if( !$response ) {
            $response = wp_remote_get( "https://plusone.google.com/u/0/_/%2B1/fastbutton?count=true&url=" . $url );

            if( !is_wp_error( $response ) ) {
                set_transient( $cache_key, $response, 30 );
            } else {
                $data['error'] = $response->get_error_message();
            }
        }

        # Parse the response to extract the count
        if( !is_wp_error( $response ) ) {
            $body = $response['body'];

            $json_obj = substr( $body, strpos( $body, "window.__SSR = {" ) + 15 );
            $json_obj = substr( $json_obj, 0, strpos( $json_obj, "};" ) + 2 );
            $json_obj = preg_replace( "/(\s)/", "", $json_obj );

            $matches = array();
            preg_match( "/c\:([\d\.]+)/", $json_obj, $matches );

            if( !empty( $matches ) ) {
                $data['count'] = intval( $matches[1] );
            }
        }

        # Convert the array to a JSON string
        $data = json_encode( $data );

        header( "Content-type: " . $header );
        include( dirname( __FILE__ ) . '/views/_jsonp.php' );
        exit;
    }

    public function ajax_stumbleupon_jsonp() {
        # Default header is JSON
        $header = "application/json";
        $content_type = "json";

        # URL to lookup
        $url = $_REQUEST['url'];
        # JSONP callback function
        $callback = $_REQUEST['callback'];

        # If a callback is present set header to JSONP
        if( !empty( $callback ) ) {
            $header = "application/javascript";
            $content_type = "jsonp";
        }

        # Default data values to return
        $data = json_encode( array( 'result' => array(
          'in_index' => false,
          'views' => 0
        ) ) );

        # Transient cache lookup
        $cache_key = $this->slug . '-stumbleupon-' . md5( $url );
        $response = get_transient( $cache_key );

        if( !$response ) {
            $response = wp_remote_get( "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=" . $url );

            if( !is_wp_error( $response ) ) {
                set_transient( $cache_key, $response, 30 );
            }
        }

        if( !is_wp_error( $response ) ) {
            $data = $response['body'];
        }

        header( "Content-type: " . $header );
        include( dirname( __FILE__ ) . '/views/_jsonp.php' );
        exit;
    }

    /**
     * Initialization function to hook into the WordPress init action
     *
     * Instantiates the class on a global variable and sets the class, actions
     * etc. up for use.
     */
    static function instance( ) {
        global $Filament;

        // Only instantiate the Class if it hasn't been already
        if( !isset( $Filament ) )
            $Filament = new Filament( );
    }

    public function load_admin_page() {
        wp_enqueue_style( "{$this->slug}-admin", filament_plugin_url( "/assets/css/admin.main.css" ), array(), $this->version, 'screen' );
    }

    /**
     * Hook into plugin_action_links filter
     *
     * Adds a "Deploy Filament" link next to the "Deactivate" link in the plugin
     * listing page when the plugin is active.
     *
     * @param object $links An array of the links to show, this will be the
     * modified variable
     * @param string $file The name of the file being processed in the filter
     *
     * @uses plugin_basename()
     */
    public function plugin_action_links( $links, $file ) {
        $new_links = array( );

        if( $file == plugin_basename( dirname( __FILE__ ) . '/' . basename( __FILE__ ) ) ) {
            $new_links[] = '<a href="' . admin_url( 'admin.php?page=' . $this->slug ) . '">' . __( "Deploy Filament" ) . '</a>';
        }

        return array_merge( $new_links, $links );
    }

    /**
     * Route the user based off of environment conditions
     *
     * This function will handling routing of form submissions to the appropriate
     * form processor.
     */
    public function route() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_parse = parse_url( $uri );
        $protocol = isset( $_SERVER['HTTPS'] ) ? 'https' : 'http';
        $hostname = $_SERVER['HTTP_HOST'];
        $url = "{$protocol}://{$hostname}{$uri}";
        $method = $_SERVER['REQUEST_METHOD'];
        $is_post = !!( $method == "POST" );
        parse_str( $_SERVER['QUERY_STRING'], $params );

        if( basename( $uri_parse['path'] ) == 'admin.php' && isset( $params['page'] ) && $params['page'] == $this->slug . '/signup' ) {
          wp_redirect( "https://app.filament.io/users/login?utm_source=filament_wp&utm_medium=link&utm_content=plugin&utm_campaign=filament", 301 ); exit;
        }
        if( basename( $uri_parse['path'] ) == 'admin.php' && isset( $params['page'] ) && $params['page'] == $this->slug . '/blog_overview' ) {
          wp_redirect( "https://app.filament.io/insights/goto/insight", 301 ); exit;
        }
        if( basename( $uri_parse['path'] ) == 'admin.php' && isset( $params['page'] ) && $params['page'] == $this->slug . '/traffic_quality' ) {
          wp_redirect( "https://app.filament.io/insights/goto/traffic", 301 ); exit;
        }
        if( basename( $uri_parse['path'] ) == 'admin.php' && isset( $params['page'] ) && $params['page'] == $this->slug . '/social_activity' ) {
          wp_redirect( "https://app.filament.io/insights/goto/social", 301 ); exit;
        }
        if( basename( $uri_parse['path'] ) == 'admin.php' && isset( $params['page'] ) && $params['page'] == $this->slug . '/visitor_behavior' ) {
          wp_redirect( "https://app.filament.io/insights/goto/behavior", 301 ); exit;
        }

        if( $is_post && isset( $_REQUEST['_wpnonce'] ) ) {
            if( wp_verify_nonce( $_REQUEST['_wpnonce'], $this->slug . '_admin_options' ) ) {
                $this->_submit_admin_options();
            }
        }
    }

    /**
     * Output Filament code snippet in the footer of the page
     *
     * @uses get_option()
     */
    public function wp_footer() {
        echo html_entity_decode( get_option( $this->slug . '_single_drop', "" ), ENT_QUOTES, "UTF-8" );
    }

    /**
     * Hook into wp_head for Filament meta tag output
     *
     * @global  $wp_query
     *
     * @uses admin_url()
     * @uses get_category()
     * @uses get_option()
     * @uses get_post_type()
     * @uses get_query_var()
     * @uses is_404()
     * @uses is_archive()
     * @uses is_attachment()
     * @uses is_author()
     * @uses is_category()
     * @uses is_front_page()
     * @uses is_home()
     * @uses is_page()
     * @uses is_search()
     * @uses is_single()
     * @uses is_singular()
     * @uses is_sticky()
     * @uses is_tag()
     * @uses is_tax()
     * @uses is_preview()
     * @uses wp_get_object_terms()
     * @uses wp_get_post_tags()
     * @uses wp_nonce_url()
     */
    public function wp_head() {
        global $wp_query;

        $metas = array(
            'is-404' => is_404(),
            'is-archive' => is_archive(),
            'is-attachment' => is_attachment(),
            'is-author' => is_author(),
            'is-category' => is_category(),
            'is-front-page' => is_front_page(),
            'is-home' => is_home(),
            'is-page' => is_page(),
            'is-search' => is_search(),
            'is-single' => is_single(),
            'is-singular' => is_singular(),
            'is-sticky' => is_sticky(),
            'is-tag' => is_tag(),
            'is-tax' => is_tax(),
            'is-preview' => is_preview(),
            'post-type' => get_post_type(),
            'categories' => "",
            'tags' => ""
        );

        if( $metas['is-category'] ) {
            $category = get_category( get_query_var( 'cat' ), false );
            $metas['categories'] = $category->slug;
        } else if( $metas['is-singular'] ) {
            $category_ids = wp_get_object_terms( $wp_query->post->ID, 'category', array( 'fields' => 'ids' ) );
            $categories = array();

            foreach( (array) $category_ids as $category_id ) {
                $category = get_category( $category_id );
                $categories[] = $category->slug;
            }

            $metas['categories'] = implode( $categories, "," );

            $tag_objs = wp_get_post_tags( $wp_query->post->ID );
            $tags = array();

            foreach( (array) $tag_objs as $tag_obj ) {
                $tags[] = $tag_obj->slug;
            }

            $metas['tags'] = implode( $tags, "," );
        }

        $namespace = $this->slug;

        # URLs for localized proxying
        $stumbleupon_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=' . $this->slug . '_stumbleupon_jsonp' ), $this->slug . '_stumbleupon_jsonp' );
        $googleplus_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=' . $this->slug . '_googleplus_jsonp' ), $this->slug . '_googleplus_jsonp' );

        include( dirname( __FILE__ ) . '/views/_meta.php' );
    }

    function wp_enqueue_admin_scripts(){
      wp_enqueue_script( "{$this->slug}-admin", filament_plugin_url( "/assets/js/admin.main.js" ), array( 'jquery' ), $this->version, true );
    }
}

function filament_plugin_url( $path = "" ) {
    return trailingslashit( plugins_url() ) . basename( dirname( __FILE__ ) ) . $path;
}

add_action( 'plugins_loaded', array( 'Filament', 'instance' ) );
