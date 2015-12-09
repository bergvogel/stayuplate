<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

/**
 * Acive Plugins
 */
define( "SNPSHPWP_MULTISITE", ( is_multisite() ? true : false ) );
$using_woo = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'woocommerce/woocommerce.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_woo = true;
	}
	elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_woo = true;
	}
}
elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_woo = true;
}
define( "SNPSHPWP_WOOCOMMERCE", $using_woo );

$using_fbuilder = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'frontend_builder/frontend_builder.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_fbuilder = true;
	}
	elseif ( in_array( 'frontend_builder/frontend_builder.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_fbuilder = true;
	}
}
elseif ( in_array( 'frontend_builder/frontend_builder.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_fbuilder = true;
}
define( "SNPSHPWP_FBUILDER", $using_fbuilder );

$using_revslider = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'revslider/revslider.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_revslider = true;
	}
	elseif ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_revslider = true;
	}
}
elseif ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_revslider = true;
}
define( "SNPSHPWP_REVSLIDER", $using_revslider );

$using_prdctfltr = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'prdctfltr/prdctfltr.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_prdctfltr = true;
	}
	elseif ( in_array( 'prdctfltr/prdctfltr.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_prdctfltr = true;
	}
}
elseif ( in_array( 'prdctfltr/prdctfltr.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_prdctfltr = true;
}
define( "SNPSHPWP_PRDCTFLTR", $using_prdctfltr );

$using_chimp = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'mailchimp-for-wp/mailchimp-for-wp.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_chimp = true;
	}
	elseif ( in_array( 'mailchimp-for-wp/mailchimp-for-wp.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_chimp = true;
	}
}
elseif ( in_array( 'mailchimp-for-wp/mailchimp-for-wp.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_chimp = true;
}
define( "SNPSHPWP_MAILCHIMP", $using_chimp );

$using_fbuilder_commerce = false;
if ( SNPSHPWP_MULTISITE === true ) {
	if ( array_key_exists( 'frontend_builder_commerce/frontend_builder_commerce.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) ) ) {
		$using_fbuilder_commerce = true;
	}
	elseif ( in_array( 'frontend_builder_commerce/frontend_builder_commerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
		$using_fbuilder_commerce = true;
	}
}
elseif ( in_array( 'frontend_builder_commerce/frontend_builder_commerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? 'active' : '' ) {
	$using_fbuilder_commerce = true;
}
define( "SNPSHPWP_FBUILDER_COMMERCE", $using_fbuilder_commerce );


/**
 * Slightly Modified Options Framework
 */
require_once ('admin/index.php');

/*
 * After Setup SnapShopWP Theme
*/
if ( !function_exists('snpshpwp_setup_theme') ) :
function snpshpwp_setup_theme() {
	global $snpshpwp_data;

	load_theme_textdomain( 'snpshpwp', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	$feat_width = ( isset($snpshpwp_data['fimage_width']) ? $snpshpwp_data['fimage_width'] : 960 );
	$feat_height = ( isset($snpshpwp_data['fimage_height']) ? $snpshpwp_data['fimage_height'] : 400 );
	add_image_size( 'snpshpwp-fullblog', $feat_width, $feat_height, true );

	$feat_width = ( isset($snpshpwp_data['single_fimage_width']) ? $snpshpwp_data['single_fimage_width'] : 1200 );
	$feat_height = ( isset($snpshpwp_data['single_fimage_height']) ? $snpshpwp_data['single_fimage_height'] : 400 );
	add_image_size( 'snpshpwp-fullsingle', $feat_width, $feat_height, true );

	add_image_size( 'snpshpwp-square', 200, 200, true );

	add_theme_support( 'custom-background');

	// Add support for Post Formats
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'link', 'video', 'image', 'quote' ) );

	// Adds editor style
	add_editor_style();
}
endif;
add_action( 'after_setup_theme', 'snpshpwp_setup_theme' );


/**
 * Includes
 */
if ( SNPSHPWP_FBUILDER === true ) { include_once ('shortcodes.php'); }
require_once ('lib/wp-less/lessc.inc.php');
require_once ('lib/wp-less/wp-less.php');
include_once ('lib/twitteroauth/twitteroauth.php');
include_once ('lib/hybridcore/hybridcore-breadcrumb-trail.php');
if ( is_admin() ) {
	include_once ('lib/snpshpwp-menu/snpshpwp-menu.php');
	require_once ('lib/tgm-plugin-activation/class-tgm-plugin-activation.php');
}

/**
 * TGM Plugin Activation
 */

if ( !function_exists('snpshpwp_register_required_plugins') ) :
function snpshpwp_register_required_plugins() {

	$plugins = array(
		array(
			'name'					=> 'Frontend Builder',
			'slug'					=> 'frontend_builder',
			'source'				=> get_template_directory() . '/lib/plugins/frontend_builder.zip',
			'required'				=> true,
			'version'				=> '2.7.1',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> 'http://codecanyon.net/item/frontend-builder-wordpress-content-assembler?ref=br0'
		),
		array(
			'name'					=> 'Revolution Slider',
			'slug'					=> 'revslider',
			'source'				=> get_template_directory() . '/lib/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '4.5.95',
			'force_activation'		=> false,
			'force_deactivation'		=> false,
			'external_url'			=> 'http://www.themepunch.com/codecanyon/revolution_wp/',
		),
		array(
			'name'					=> 'Content Timeline',
			'slug'					=> 'content_timeline',
			'source'				=> get_template_directory() . '/lib/plugins/content_timeline.zip',
			'required'				=> false,
			'version'				=> '2.35',
			'force_activation'		=> false,
			'force_deactivation'		=> false,
			'external_url'			=> 'http://www.shindiristudio.com/demo/?item=Content%20Timeline_Wordpress',
		),
		array(
			'name'					=> 'WooCommerce',
			'slug'					=> 'woocommerce',
			'required'				=> false,
			'version'				=> '2.1.12'
		),
		array(
			'name'					=> 'Frontend Builder Commerce',
			'slug'					=> 'frontend_builder_commerce',
			'source'				=> get_template_directory() . '/lib/plugins/frontend_builder_commerce.zip',
			'required'				=> true,
			'version'				=> '1.10',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '#'
		),
		array(
			'name'					=> 'WooCommerce Product Filter',
			'slug'					=> 'prdctfltr',
			'source'				=> get_template_directory() . '/lib/plugins/woocommerce-product-filter.zip',
			'required'				=> true,
			'version'				=> '1.2.4',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> 'http://codecanyon.net/item/woocommerce-product-filter/8514038?ref=dzeriho'
		),
		array(
			'name'					=> 'MailChimp for WordPress Lite',
			'slug'					=> 'mailchimp-for-wp',
			'required'				=> false,
			'version'				=> '2.1.1'
		)
	);

	$theme_text_domain = 'snpshpwp';

	$config = array(
		'domain'			=> $theme_text_domain,
		'default_path'		=> '',
		'parent_menu_slug'	=> 'themes.php',
		'parent_url_slug'	=> 'themes.php',
		'menu'				=> 'install-required-plugins',
		'has_notices'		=> true,
		'is_automatic'		=> true,
		'message'			=> '',
		'strings'	=> array(
			'page_title' => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title' => __( 'Install Plugins', $theme_text_domain ),
			'installing' => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended'=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator 	of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required'  => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended'   => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate'=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update'  => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update'  => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated' => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' => __( 'All plugins installed and activated successfully. %s', $theme_text_domain )
		)
	);

	tgmpa( $plugins, $config );

}
endif;
add_action( 'tgmpa_register', 'snpshpwp_register_required_plugins' );


/*
 * Load Scripts
*/
if ( !function_exists('snpshpwp_scripts') ) :
function snpshpwp_scripts() {
	global $snpshpwp_data;
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'snpshpwp-mdrnzr', get_template_directory_uri() . '/js/modernizer.min.js', array( 'jquery' ), '1.0', false);
	wp_enqueue_script( 'snpshpwp-tween', get_template_directory_uri() . '/js/TweenMax.min.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-scrolltoplugin', get_template_directory_uri() . '/js/scrolltoplugin.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-swipebox', get_template_directory_uri() . '/js/swipebox/source/jquery.swipebox.min.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-idangerous', get_template_directory_uri() . '/js/idangerous.swiper.min.js', array( 'jquery' ), '2.6.1', true);
	wp_enqueue_script( 'snpshpwp-smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-imgsloaded', get_template_directory_uri() . '/js/imagesloaded.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-fntsmoothie', get_template_directory_uri() . '/js/fontsmoothie.min.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-pjax', get_template_directory_uri() . '/js/jquery.pjax.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-notify', get_template_directory_uri() . '/js/notification.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script( 'snpshpwp-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true);



	$entry = 'none';
	$entry_mute = 'none';
	$entry_loop = 'none';
	$entry_hd = 'none';
	$entry_fallback = 'none';

	if ( is_page() ) {
		$page_bg = get_post_meta( get_the_ID(), 'snpshpwp_page_bg', true );
		if ( $page_bg !== '' && $page_bg !== 'none' ) {
			switch ($page_bg) :
				case 'videoembed' :
					$entry = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_embed',true);
					$entry_mute = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_embed_mute',true);
					$entry_loop = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_embed_loop',true);
					$entry_hd = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_embed_hd',true);
					$entry_fallback = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				break;
				case 'html5video' :
					$entry = 'none';
					$entry_mute = 'none';
					$entry_loop = 'none';
					$entry_hd = 'none';
					$entry_fallback = 'none';
				break;
				default :
					die( __('Invalid options.', 'snpshpwp') );
			endswitch;
		}
	}

	wp_localize_script( 'snpshpwp-main-js', 'snpshpwp', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'siteurl'=> home_url('/'), 'ts_viewmore' => __('VIEW DETAILS', 'snpshpwp') , 'video_bg' => $entry, 'video_mute' => $entry_mute, 'video_loop' => $entry_loop, 'video_hd' => $entry_hd, 'content_width' => intval($snpshpwp_data['fb_mres_w']), 'content_width_mobile' => intval($snpshpwp_data['fb_lres_w']), 'loader' => ( isset($snpshpwp_data['loader_active']) ? $snpshpwp_data['loader_active'] : 0 ) ) );

}
endif;
add_action( 'wp_enqueue_scripts', 'snpshpwp_scripts' );


/*
 * Load Styles
*/
if ( !function_exists('snpshpwp_styles_css') ) :
function snpshpwp_styles_css() {

	global $snpshpwp_data;

	if ( ! isset( $content_width ) )
		$content_width = $snpshpwp_data['content_width'];

	wp_enqueue_style( 'snpshpwp-style', get_stylesheet_uri() );
	wp_enqueue_style( 'snpshpwp-less-style', get_stylesheet_directory_uri() . '/less/snapshop.less' );

	if ( SNPSHPWP_FBUILDER === false ) {
		wp_enqueue_style( 'snpshpwp-fbuilder', get_template_directory_uri() . '/css/frontend.css' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'snpshpwp_styles_css' );



/*
 * LESS CSS
*/

if ( !function_exists('snpshpwp_less') ) :
function snpshpwp_less( $vars, $handle ) {
	global $snpshpwp_data;

	/* header bar vars */

	if ( $snpshpwp_data['f_header_bar_mnggl_on'] !== '1' ) {
		$vars['f_header_bar_mn_face'] = $snpshpwp_data['f_header_bar_mn']['face'];
		$vars['f_header_bar_mn_size'] = $snpshpwp_data['f_header_bar_mn']['size'];
		$vars['f_header_bar_mn_style'] = $snpshpwp_data['f_header_bar_mn']['style'];
		$vars['f_header_bar_mn_weight'] = $snpshpwp_data['f_header_bar_mn']['weight'];
	}
	else {
		$vars['f_header_bar_mn_face'] = $snpshpwp_data['f_header_bar_mnggl']['face'];
		$vars['f_header_bar_mn_size'] = $snpshpwp_data['f_header_bar_mnggl']['size'];
		$vars['f_header_bar_mn_style'] = $snpshpwp_data['f_header_bar_mnggl']['style'];
		$vars['f_header_bar_mn_weight'] = $snpshpwp_data['f_header_bar_mnggl']['weight'];
	}
	$vars['header_bar_height'] = ( $snpshpwp_data['header_bar'] !== '1' ? $snpshpwp_data['header_bar_height'].'px' : '0px' );
	$vars['s_header_bar_bg'] = $snpshpwp_data['s_header_bar_bg'];
	$vars['s_header_bar_txt'] = $snpshpwp_data['s_header_bar_txt'];
	$vars['s_header_bar_lnk'] = $snpshpwp_data['s_header_bar_lnk'];
	$vars['s_header_bar_lnkhvr'] = $snpshpwp_data['s_header_bar_lnkhvr'];
	$vars['s_header_bar_brdr'] = $snpshpwp_data['s_header_bar_brdr'];


	/* header vars */
	$vars['header_custom_height'] = ( $snpshpwp_data['header_custom'] !== '' ? $snpshpwp_data['header_custom_height'].'px' : '0px' );

	$vars['header_height'] = $snpshpwp_data['header_height'].'px';
	$vars['header_width'] = $snpshpwp_data['header_width'].'px';
	$vars['header_logo'] = $snpshpwp_data['header_logo'];
	$vars['s_header_ldbr'] = $snpshpwp_data['s_header_ldbr'];
	$vars['s_header_bg'] = $snpshpwp_data['s_header_bg'];
	$vars['s_header_txt'] = $snpshpwp_data['s_header_txt'];
	$vars['s_header_lnk'] = $snpshpwp_data['s_header_lnk'];
	$vars['s_header_lnkhvr'] = $snpshpwp_data['s_header_lnkhvr'];
	$vars['s_header_brdr'] = $snpshpwp_data['s_header_brdr'];
	$vars['s_header_tpbrdr'] = $snpshpwp_data['s_header_tpbrdr'];
	$vars['s_header_drpdwn_bg'] = $snpshpwp_data['s_header_drpdwn_bg'];
	$vars['s_header_drpdwn_lnk'] = $snpshpwp_data['s_header_drpdwn_lnk'];
	$vars['s_header_drpdwn_lnkhvr'] = $snpshpwp_data['s_header_drpdwn_lnkhvr'];


	if ( $snpshpwp_data['f_header_mnggl_on'] !== '1' ) {
		$vars['f_header_mn_face'] = $snpshpwp_data['f_header_mn']['face'];
		$vars['f_header_mn_size'] = $snpshpwp_data['f_header_mn']['size'];
		$vars['f_header_mn_style'] = $snpshpwp_data['f_header_mn']['style'];
		$vars['f_header_mn_weight'] = $snpshpwp_data['f_header_mn']['weight'];
	}
	else {
		$vars['f_header_mn_face'] = $snpshpwp_data['f_header_mnggl']['face'];
		$vars['f_header_mn_size'] = $snpshpwp_data['f_header_mnggl']['size'];
		$vars['f_header_mn_style'] = $snpshpwp_data['f_header_mnggl']['style'];
		$vars['f_header_mn_weight'] = $snpshpwp_data['f_header_mnggl']['weight'];
	}

	if ( $snpshpwp_data['f_header_drpdwnggl_on'] !== '1' ) {
		$vars['f_header_drpdwn_face'] = $snpshpwp_data['f_header_drpdwn']['face'];
		$vars['f_header_drpdwn_size'] = $snpshpwp_data['f_header_drpdwn']['size'];
		$vars['f_header_drpdwn_style'] = $snpshpwp_data['f_header_drpdwn']['style'];
		$vars['f_header_drpdwn_weight'] = $snpshpwp_data['f_header_drpdwn']['weight'];
	}
	else {
		$vars['f_header_drpdwn_face'] = $snpshpwp_data['f_header_drpdwnggl']['face'];
		$vars['f_header_drpdwn_size'] = $snpshpwp_data['f_header_drpdwnggl']['size'];
		$vars['f_header_drpdwn_style'] = $snpshpwp_data['f_header_drpdwnggl']['style'];
		$vars['f_header_drpdwn_weight'] = $snpshpwp_data['f_header_drpdwnggl']['weight'];
	}


	/* breadcrumbs vars */
	$vars['breadcrumbs_height'] = $snpshpwp_data['breadcrumbs_height'].'px';


	$vars['s_breadcrumbs_bg'] = $snpshpwp_data['s_breadcrumbs_bg'];
	$vars['s_breadcrumbs_txt'] = $snpshpwp_data['s_breadcrumbs_txt'];
	$vars['s_breadcrumbs_lnk'] = $snpshpwp_data['s_breadcrumbs_lnk'];
	$vars['s_breadcrumbs_lnkhvr'] = $snpshpwp_data['s_breadcrumbs_lnkhvr'];
	$vars['s_breadcrumbs_brdr'] = $snpshpwp_data['s_breadcrumbs_brdr'];


	if ( $snpshpwp_data['f_breadcrumbs_ggl_on'] !== '1' ) {
		$vars['f_breadcrumbs_face'] = $snpshpwp_data['f_breadcrumbs']['face'];
		$vars['f_breadcrumbs_size'] = $snpshpwp_data['f_breadcrumbs']['size'];
		$vars['f_breadcrumbs_style'] = $snpshpwp_data['f_breadcrumbs']['style'];
		$vars['f_breadcrumbs_weight'] = $snpshpwp_data['f_breadcrumbs']['weight'];
	}
	else {
		$vars['f_breadcrumbs_face'] = $snpshpwp_data['f_breadcrumbs_ggl']['face'];
		$vars['f_breadcrumbs_size'] = $snpshpwp_data['f_breadcrumbs_ggl']['size'];
		$vars['f_breadcrumbs_style'] = $snpshpwp_data['f_breadcrumbs_ggl']['style'];
		$vars['f_breadcrumbs_weight'] = $snpshpwp_data['f_breadcrumbs_ggl']['weight'];
	}


	/* footer vars */
	$vars['footer_height'] = $snpshpwp_data['footer_height'].'px';
	$vars['footer_width'] = $snpshpwp_data['footer_width'].'px';
	$vars['custom-css-snpshp_limit_width'] = $snpshpwp_data['custom-css-snpshp_limit_width'].'px';

	$vars['s_footer_tpbrdr'] = $snpshpwp_data['s_footer_tpbrdr'];
	$vars['s_footer_bg'] = $snpshpwp_data['s_footer_bg'];
	$vars['s_footer_txt'] = $snpshpwp_data['s_footer_txt'];
	$vars['s_footer_hdr'] = $snpshpwp_data['s_footer_hdr'];
	$vars['s_footer_lnk'] = $snpshpwp_data['s_footer_lnk'];
	$vars['s_footer_lnkhvr'] = $snpshpwp_data['s_footer_lnkhvr'];

	$vars['s_footer_lmnt_bg'] = $snpshpwp_data['s_footer_lmnt_bg'];
	$vars['s_footer_lmnt_txt'] = $snpshpwp_data['s_footer_lmnt_txt'];
	$vars['s_footer_lmnt_lnk'] = $snpshpwp_data['s_footer_lmnt_lnk'];
	$vars['s_footer_lmnt_lnkhvr'] = $snpshpwp_data['s_footer_lmnt_lnkhvr'];
	$vars['s_footer_lmnt_brdr'] = $snpshpwp_data['s_footer_lmnt_brdr'];

	if ( $snpshpwp_data['f_footer_wtggl_on'] !== '1' ) {
		$vars['f_footer_wt_face'] = $snpshpwp_data['f_footer_wt']['face'];
		$vars['f_footer_wt_size'] = $snpshpwp_data['f_footer_wt']['size'];
		$vars['f_footer_wt_style'] = $snpshpwp_data['f_footer_wt']['style'];
		$vars['f_footer_wt_weight'] = $snpshpwp_data['f_footer_wt']['weight'];
	}
	else {
		$vars['f_footer_wt_face'] = $snpshpwp_data['f_footer_wtggl']['face'];
		$vars['f_footer_wt_size'] = $snpshpwp_data['f_footer_wtggl']['size'];
		$vars['f_footer_wt_style'] = $snpshpwp_data['f_footer_wtggl']['style'];
		$vars['f_footer_wt_weight'] = $snpshpwp_data['f_footer_wtggl']['weight'];
	}

	if ( $snpshpwp_data['f_footer_wtxtggl_on'] !== '1' ) {
		$vars['f_footer_wtxt_face'] = $snpshpwp_data['f_footer_wtxt']['face'];
		$vars['f_footer_wtxt_size'] = $snpshpwp_data['f_footer_wtxt']['size'];
		$vars['f_footer_wtxt_style'] = $snpshpwp_data['f_footer_wtxt']['style'];
		$vars['f_footer_wtxt_weight'] = $snpshpwp_data['f_footer_wtxt']['weight'];
	}
	else {
		$vars['f_footer_wtxt_face'] = $snpshpwp_data['f_footer_wtxtggl']['face'];
		$vars['f_footer_wtxt_size'] = $snpshpwp_data['f_footer_wtxtggl']['size'];
		$vars['f_footer_wtxt_style'] = $snpshpwp_data['f_footer_wtxtggl']['style'];
		$vars['f_footer_wtxt_weight'] = $snpshpwp_data['f_footer_wtxtggl']['weight'];
	}

	if ( $snpshpwp_data['f_footer_fbrggl_on'] !== '1' ) {
		$vars['f_footer_fbr_face'] = $snpshpwp_data['f_footer_fbr']['face'];
		$vars['f_footer_fbr_size'] = $snpshpwp_data['f_footer_fbr']['size'];
		$vars['f_footer_fbr_style'] = $snpshpwp_data['f_footer_fbr']['style'];
		$vars['f_footer_fbr_weight'] = $snpshpwp_data['f_footer_fbr']['weight'];
	}
	else {
		$vars['f_footer_fbr_face'] = $snpshpwp_data['f_footer_fbrggl']['face'];
		$vars['f_footer_fbr_size'] = $snpshpwp_data['f_footer_fbrggl']['size'];
		$vars['f_footer_fbr_style'] = $snpshpwp_data['f_footer_fbrggl']['style'];
		$vars['f_footer_fbr_weight'] = $snpshpwp_data['f_footer_fbrggl']['weight'];
	}






	/* pages and posts vars */

	$vars['s_post_bg'] = $snpshpwp_data['s_post_bg'];
	$vars['s_post_txt'] = $snpshpwp_data['s_post_txt'];
	$vars['s_post_hdr'] = $snpshpwp_data['s_post_hdr'];
	$vars['s_post_lnk'] = $snpshpwp_data['s_post_lnk'];
	$vars['s_post_lnkhvr'] = $snpshpwp_data['s_post_lnkhvr'];
	$vars['s_post_brdr'] = $snpshpwp_data['s_post_brdr'];
	$vars['s_post_bttn'] = $snpshpwp_data['s_post_bttn'];
	$vars['s_post_bttnhvr'] = $snpshpwp_data['s_post_bttnhvr'];
	$vars['s_post_bttnlnk'] = $snpshpwp_data['s_post_bttnlnk'];
	$vars['s_post_bttnlnkhvr'] = $snpshpwp_data['s_post_bttnlnkhvr'];

	if ( $snpshpwp_data['f_post_mnggl_on'] !== '1' ) {
		$vars['f_post_mn_face'] = $snpshpwp_data['f_post_mn']['face'];
		$vars['f_post_mn_size'] = $snpshpwp_data['f_post_mn']['size'];
		$vars['f_post_mn_style'] = $snpshpwp_data['f_post_mn']['style'];
		$vars['f_post_mn_weight'] = $snpshpwp_data['f_post_mn']['weight'];
	}
	else {
		$vars['f_post_mn_face'] = $snpshpwp_data['f_post_mnggl']['face'];
		$vars['f_post_mn_size'] = $snpshpwp_data['f_post_mnggl']['size'];
		$vars['f_post_mn_style'] = $snpshpwp_data['f_post_mnggl']['style'];
		$vars['f_post_mn_weight'] = $snpshpwp_data['f_post_mnggl']['weight'];
	}

	if ( $snpshpwp_data['f_post_hdrggl_on'] !== '1' ) {
		$vars['f_post_hdr_face'] = $snpshpwp_data['f_post_hdr']['face'];
		$vars['f_post_hdr_size'] = $snpshpwp_data['f_post_hdr']['size'];
		$vars['f_post_hdr_style'] = $snpshpwp_data['f_post_hdr']['style'];
		$vars['f_post_hdr_weight'] = $snpshpwp_data['f_post_hdr']['weight'];
	}
	else {
		$vars['f_post_hdr_face'] = $snpshpwp_data['f_post_hdrggl']['face'];
		$vars['f_post_hdr_size'] = $snpshpwp_data['f_post_hdrggl']['size'];
		$vars['f_post_hdr_style'] = $snpshpwp_data['f_post_hdrggl']['style'];
		$vars['f_post_hdr_weight'] = $snpshpwp_data['f_post_hdrggl']['weight'];
	}

	if ( $snpshpwp_data['f_post_crsvggl_on'] !== '1' ) {
		$vars['f_post_crsv_face'] = $snpshpwp_data['f_post_crsv']['face'];
		$vars['f_post_crsv_size'] = $snpshpwp_data['f_post_crsv']['size'];
		$vars['f_post_crsv_style'] = $snpshpwp_data['f_post_crsv']['style'];
		$vars['f_post_crsv_weight'] = $snpshpwp_data['f_post_crsv']['weight'];
	}
	else {
		$vars['f_post_crsv_face'] = $snpshpwp_data['f_post_crsvggl']['face'];
		$vars['f_post_crsv_size'] = $snpshpwp_data['f_post_crsvggl']['size'];
		$vars['f_post_crsv_style'] = $snpshpwp_data['f_post_crsvggl']['style'];
		$vars['f_post_crsv_weight'] = $snpshpwp_data['f_post_crsvggl']['weight'];
	}























	$vars['content_width'] = $snpshpwp_data['content_width'];
	$vars['fimage_width'] = ( isset($snpshpwp_data['fimage_width']) ? $snpshpwp_data['fimage_width'].'px' : '960px' );
	$vars['fimage_height'] = ( isset($snpshpwp_data['fimage_height']) ? $snpshpwp_data['fimage_height'].'px' : '600px' );



	$vars['single_fimage_width'] = ( isset($snpshpwp_data['single_fimage_width']) ? $snpshpwp_data['single_fimage_width'].'px' : '1200px' );
	$vars['single_fimage_height'] = ( isset($snpshpwp_data['single_fimage_height']) ? $snpshpwp_data['single_fimage_height'].'px' : '400px' );


	$vars['fb_content_width'] = (intval($snpshpwp_data['content_width'])).'px';
	$vars['fb_hres_c'] = (intval($snpshpwp_data['fb_hres_c'])/2).'px';
	$vars['fb_hres_w'] = (intval($snpshpwp_data['fb_hres_w'])).'px';
	$vars['fb_mres_w'] = (intval($snpshpwp_data['fb_mres_w'])).'px';
	$vars['fb_mres_c'] = (intval($snpshpwp_data['fb_mres_c'])/2).'px';
	$vars['fb_mres_s'] = (intval($snpshpwp_data['fb_mres_s']) == 1 ) ? '1' : '0';
	$vars['fb_lres_w'] = (intval($snpshpwp_data['fb_lres_w'])).'px';
	$vars['fb_lres_c'] = (intval($snpshpwp_data['fb_lres_c'])/2).'px';
	$vars['fb_lres_s'] = (intval($snpshpwp_data['fb_lres_s']) == 1 ) ? '1' : '0';

	return $vars;
}
endif;
add_filter( 'less_vars', 'snpshpwp_less', 10, 2 );



/*
 * Head CSS
*/
if ( !function_exists('snpshpwp_wp_head') ) :
function snpshpwp_wp_head() {
	global $snpshpwp_data;

	if( $snpshpwp_data['custom-css'] !== '' || $snpshpwp_data['custom-css-med'] !== '' || $snpshpwp_data['custom-css-low'] !== '' ) :

		$curr_res = array();

		if ( $snpshpwp_data['custom-css-med'] !== '' ) {
			$curr_res['med'] = array(
				'css'=>$snpshpwp_data['custom-css-med'],
				'res'=>$snpshpwp_data['fb_mres_w']
			);
		}
		if ( $snpshpwp_data['custom-css-low'] !== '' ) {
			$curr_res['low'] = array(
				'css'=>$snpshpwp_data['custom-css-low'],
				'res'=>$snpshpwp_data['fb_lres_w']
			);
		}

		echo "<style type='text/css'>";
		if ( $snpshpwp_data['custom-css'] !== '' ) echo $snpshpwp_data['custom-css'];
		foreach ( $curr_res as $k => $v ) {
			printf( '@media (max-width: %1$spx) {%2$s}', $v['res'], $v['css'] );
		}
		echo "</style>";
	endif;

	if( $snpshpwp_data['tracking-code'] != '' ) :
		echo $snpshpwp_data['tracking-code'];
	endif;
}
endif;
add_action( 'wp_head', 'snpshpwp_wp_head' );


/*
 * Google Fonts
*/
if ( !function_exists('snpshpwp_fonts') ) :
function snpshpwp_fonts() {
	global $snpshpwp_data;



	$font = array ();
	if ( $snpshpwp_data['f_header_bar_mnggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_header_bar_mnggl']['face'];
	if ( $snpshpwp_data['f_header_mnggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_header_mnggl']['face'];
	if ( $snpshpwp_data['f_header_drpdwnggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_header_drpdwnggl']['face'];
	if ( $snpshpwp_data['f_post_mnggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_post_mnggl']['face'];
	if ( $snpshpwp_data['f_post_hdrggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_post_hdrggl']['face'];
	if ( $snpshpwp_data['f_post_crsvggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_post_crsvggl']['face'];
	if ( $snpshpwp_data['f_footer_wtggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_footer_wtggl']['face'];
	if ( $snpshpwp_data['f_footer_wtxtggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_footer_wtxtggl']['face'];
	if ( $snpshpwp_data['f_footer_fbrggl_on'] == '1' )
		$font[] = $snpshpwp_data['f_footer_fbrggl']['face'];


	$protocol = is_ssl() ? 'https' : 'http';

	$i = 0;
	foreach ( array_unique($font) as $cf ) {
		$i++;
		$scf = str_replace(' ', '%20', $cf);
		wp_enqueue_style( "snpshpwp-font-$i", $protocol."://fonts.googleapis.com/css?family=$scf%3A100%2C200%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C700%2C700italic%2C800&amp;subset=all" );
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'snpshpwp_fonts' );


/*
 * Widgets Init
*/
if ( !function_exists('snpshpwp_widgets_init') ) :
function snpshpwp_widgets_init() {

	global $snpshpwp_data;

	$snpshpwp_layout['widget_title_before'] = '<h3 class="snpshpwp_widget_title margin-bottom24">';
	$snpshpwp_layout['widget_title_after'] = '</h3>';
	$snpshpwp_layout['footer_widget_title_before'] = '<h3 class="snpshpwp_widget_title margin-bottom24">';
	$snpshpwp_layout['footer_widget_title_after'] = '</h3>';

	register_sidebar( array (
		'name' => __( 'Blog Archives Sidebar', 'snpshpwp' ),
		'id' => 'sidebar-blog',
		'before_widget' => '<aside id="%1$s" class="widget margin-top36 %2$s">',
		'after_widget' => "</aside>",
		'before_title' => $snpshpwp_layout['widget_title_before'],
		'after_title' => $snpshpwp_layout['widget_title_after'],
		'description' => __( 'This sidebar appears on Blog Archive pages.', 'snpshpwp' )
	) );

	register_sidebar( array (
		'name' => __( 'Single Posts Sidebar', 'snpshpwp' ),
		'id' => 'sidebar-single',
		'before_widget' => '<aside id="%1$s" class="widget margin-top36 %2$s">',
		'after_widget' => "</aside>",
		'before_title' => $snpshpwp_layout['widget_title_before'],
		'after_title' => $snpshpwp_layout['widget_title_after'],
		'description' => __( 'This sidebar appears on Single Posts.', 'snpshpwp' )
	) );

	register_sidebar( array (
		'name' => __( 'Pages Sidebar', 'snpshpwp' ),
		'id' => 'sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget margin-top36 %2$s">',
		'after_widget' => "</aside>",
		'before_title' => $snpshpwp_layout['widget_title_before'],
		'after_title' => $snpshpwp_layout['widget_title_after'],
		'description' => __( 'This sidebar appears on Pages.', 'snpshpwp' )
	) );

	if ( isset($snpshpwp_data['footer_widgets']) && $snpshpwp_data['footer_widgets'] !== '1' ) {
		register_sidebar( array (
			'name' => __( 'Footer 1', 'snpshpwp' ),
			'id' => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['footer_widget_title_before'],
			'after_title' => $snpshpwp_layout['footer_widget_title_after']
		) );

		register_sidebar( array (
			'name' => __( 'Footer 2', 'snpshpwp' ),
			'id' => 'footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['footer_widget_title_before'],
			'after_title' => $snpshpwp_layout['footer_widget_title_after']
		) );

		register_sidebar( array (
			'name' => __( 'Footer 3', 'snpshpwp' ),
			'id' => 'footer-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['footer_widget_title_before'],
			'after_title' => $snpshpwp_layout['footer_widget_title_after']
		) );

		register_sidebar( array (
			'name' => __( 'Footer 4', 'snpshpwp' ),
			'id' => 'footer-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['footer_widget_title_before'],
			'after_title' => $snpshpwp_layout['footer_widget_title_after']
		) );

		register_sidebar( array (
			'name' => __( 'Footer 5', 'snpshpwp' ),
			'id' => 'footer-5',
			'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['footer_widget_title_before'],
			'after_title' => $snpshpwp_layout['footer_widget_title_after']
		) );
	}


	if ( SNPSHPWP_WOOCOMMERCE === true ) {
		register_sidebar( array (
			'name' => __( 'Woocommerce Archive Sidebar', 'snpshpwp' ),
			'id' => 'sidebar-woo',
			'before_widget' => '<aside id="%1$s" class="widget margin-top36 %2$s">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['widget_title_before'],
			'after_title' => $snpshpwp_layout['widget_title_after'],
			'description' => __( 'This sidebar appears on Woocommerce archive and shop pages.', 'snpshpwp' )
		) );

		register_sidebar( array (
			'name' => __( 'Woocommerce Posts Sidebar', 'snpshpwp' ),
			'id' => 'sidebar-woo-single',
			'before_widget' => '<aside id="%1$s" class="widget margin-top36 %2$s">',
			'after_widget' => "</aside>",
			'before_title' => $snpshpwp_layout['widget_title_before'],
			'after_title' => $snpshpwp_layout['widget_title_after'],
			'description' => __( 'This sidebar appears on Woocommerce single posts.', 'snpshpwp' )
		) );

		if ( isset($snpshpwp_data['shop-widgets-before']) ) {
			$shop_widgets_before = $snpshpwp_data['shop-widgets-before'];
			if ( isset($snpshpwp_data['shop-widgets-before']) || $snpshpwp_data['shop-widgets-before'] !== 'none' ) :
				for ($i = 1; $i <= $shop_widgets_before; $i++) {
					register_sidebar( array (
						'name' => __( 'Shop Archives Widgets Before '.$i, 'snpshpwp' ),
						'id' => 'shop-widgets-before-'.$i,
						'before_widget' => '<aside id="%1$s" class="widget %2$s margin-bottom36">',
						'after_widget' => "</aside>",
						'before_title' => $snpshpwp_layout['widget_title_before'],
						'after_title' => $snpshpwp_layout['widget_title_after']
					) );
				}
			endif;
		}

		if ( isset($snpshpwp_data['shop-widgets-after']) ) {
			$shop_widgets_after = $snpshpwp_data['shop-widgets-after'];
			if ( isset($snpshpwp_data['shop-widgets-after']) || $snpshpwp_data['shop-widgets-after'] !== 'none' ) :
				for ($i = 1; $i <= $shop_widgets_after; $i++) {
					register_sidebar( array (
						'name' => __( 'Shop Archives Widgets After '.$i, 'snpshpwp' ),
						'id' => 'shop-widgets-after-'.$i,
						'before_widget' => '<aside id="%1$s" class="widget %2$s margin-bottom36">',
						'after_widget' => "</aside>",
						'before_title' => $snpshpwp_layout['widget_title_before'],
						'after_title' => $snpshpwp_layout['widget_title_after']
					) );
				}
			endif;
		}

		if ( isset($snpshpwp_data['product-widgets-before']) ) {
			$product_widgets_before = $snpshpwp_data['product-widgets-before'];
			if ( isset($snpshpwp_data['product-widgets-before']) || $snpshpwp_data['product-widgets-before'] !== 'none' ) :
				for ($i = 1; $i <= $product_widgets_before; $i++) {
					register_sidebar( array (
						'name' => __( 'Single Products Widgets Before '.$i, 'snpshpwp' ),
						'id' => 'product-widgets-before-'.$i,
						'before_widget' => '<aside id="%1$s" class="widget %2$s margin-bottom36">',
						'after_widget' => "</aside>",
						'before_title' => $snpshpwp_layout['widget_title_before'],
						'after_title' => $snpshpwp_layout['widget_title_after']
					) );
				}
			endif;
		}

		if ( isset($snpshpwp_data['product-widgets-after']) ) {
			$product_widgets_after = $snpshpwp_data['product-widgets-after'];
			if ( isset($snpshpwp_data['product-widgets-after']) || $snpshpwp_data['product-widgets-after'] !== 'none' ) :
				for ($i = 1; $i <= $product_widgets_after; $i++) {
					register_sidebar( array (
						'name' => __( 'Single Products Widgets After '.$i, 'snpshpwp' ),
						'id' => 'product-widgets-after-'.$i,
						'before_widget' => '<aside id="%1$s" class="widget %2$s margin-bottom36">',
						'after_widget' => "</aside>",
						'before_title' => $snpshpwp_layout['widget_title_before'],
						'after_title' => $snpshpwp_layout['widget_title_after']
					) );
				}
			endif;
		}
	}

	if ( isset($snpshpwp_data['sidebar']) ) {
		$sidebars = $snpshpwp_data['sidebar'];

		foreach ( $sidebars as $sidebar ) {
			$title = sanitize_title( $sidebar['title'] );
			register_sidebar( array (
				'name' => $sidebar['title'] ,
				'id' => $title,
				'before_widget' => '<aside id="%1$s" class="widget %2$s margin-top36">',
				'after_widget' => "</aside>",
				'before_title' => $snpshpwp_layout['widget_title_before'],
				'after_title' => $snpshpwp_layout['widget_title_after']
			) );
		}
	}


}
endif;
add_action( 'widgets_init', 'snpshpwp_widgets_init' );

/**
 * Breadcrumbs
*/
	if ( !function_exists('snpshpwp_breadcrumbs') ) :
	function snpshpwp_breadcrumbs() {
		if ( is_home() || is_front_page() ) {
			return;
		}
		global $snpshpwp_data;

		if ( ( $snpshpwp_data['breadcrumbs_active'] !== '1' ) || ( is_singular() && get_post_meta( get_the_ID(), 'snpshpwp_breadcrumbs', true ) !== '1' ) ) :

		printf('<div id="snpshpwp_breadcrumbs" class="snpshpwp_breadcrumbs"><div class="snpshpwp_container">');
			breadcrumb_trail(
				array( 
					'container' => 'nav',
					'separator' => ' / ',
					'labels'    => array(
						'browse' => ''
					)
				)
			);
		printf('</div></div>');
		endif;
	}
	endif;
	add_action('snpshpwp_before_content', 'snpshpwp_breadcrumbs', 5);




/*
 * WooCommerce Init
*/

if ( SNPSHPWP_WOOCOMMERCE === true ) {

	/* Image sizes */
	if ( get_theme_mod('snpshpwp_woo_init') !== 'true' ) {
		function snpshpwp_woocommerce_image_dimensions() {
			$catalog = array(
				'width' 	=> '500',
				'height'	=> '600',
				'crop'		=> 1
			);
			$single = array(
				'width' 	=> '500',
				'height'	=> '600',
				'crop'		=> 1
			);
			$thumbnail = array(
				'width' 	=> '200',
				'height'	=> '200',
				'crop'		=> 1
			);

			update_option( 'shop_catalog_image_size', $catalog );
			update_option( 'shop_single_image_size', $single );
			update_option( 'shop_thumbnail_image_size', $thumbnail );

			set_theme_mod('snpshpwp_woo_init', 'true');
		}
		add_action( 'init', 'snpshpwp_woocommerce_image_dimensions', 1 );
	}

	if ( !function_exists( 'snpshpwp_woo_product_navigation' ) ) :
	function snpshpwp_woo_product_navigation ($post_id, $categories_as_array, $position) {
		$query_args = array( 'post__in' => array($post_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $categories_as_array
			)));
		$r_single = new WP_Query($query_args);
		if ($r_single->have_posts()) {
			$r_single->the_post();
			$out = sprintf('<a href="%2$s" class="snpshpwp_singlenav_%1$s" title="%3$s">%4$s</a>', $position, get_permalink(), esc_attr(get_the_title() ? get_the_title() : get_the_ID()), ( $position == 'next' ? '&gt;' : '&lt;' ) );
			wp_reset_query();
			return $out;
		}
	}
	endif;

	if ( !function_exists( 'snpshpwp_product_navigation' ) ) :
	function snpshpwp_product_navigation(){
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;

		if ( is_singular('product') ) {
			global $post;

			$terms = wp_get_post_terms( $post->ID, 'product_cat' );

			$cats_array = array();

			foreach ( $terms as $term ) $cats_array[] = $term->term_id;

			if ( empty($cats_array) ) return;

			$query_args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
				array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $cats_array
				)));
			$r = new WP_Query($query_args);

			if ($r->post_count > 2) {

				$prev_product_id = -1;
				$next_product_id = -1;
		 
				$found_product = false;
				$i = 0;

				$current_product_index = $i;
				$current_product_id = get_the_ID();

				if ($r->have_posts()) {
					while ($r->have_posts()) {
						$r->the_post();
						$current_id = get_the_ID();

						if ($current_id == $current_product_id) {
							$found_product = true;
							$current_product_index = $i;
						}

						$is_first = ($current_product_index == 1);

						if ($is_first) {
							$prev_product_id = -1;
						} else {
							if (!$found_product && $current_id != $current_product_id) {
								$prev_product_id = get_the_ID();
							}
						}

						if ($i == 0) {
							$next_product_id = get_the_ID();
						}

						if ($found_product && $i == $current_product_index + 1) {
							$next_product_id = get_the_ID();
						}

						$i++;
					}

					if ($prev_product_id != -1) { $prev = snpshpwp_woo_product_navigation($prev_product_id, $cats_array, "prev"); } else { $prev = ''; }
					if ($next_product_id != -1) { $next = snpshpwp_woo_product_navigation($next_product_id, $cats_array, "next"); } else { $next = ''; }
				}

				wp_reset_query();
			}
		}
		printf('<span class="snpshpwp_woo_single_navigation">%1$s%2$s</span>', $prev, $next);
	}
	endif;
	add_action('woocommerce_single_product_summary', 'snpshpwp_product_navigation', 0);




	global $snpshpwp_data;

	add_theme_support( 'woocommerce' );
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	$woo_per_page = ( isset( $snpshpwp_data['woo_per_page'] ) ? $snpshpwp_data['woo_per_page'] : 10 );
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$woo_per_page.';' ), 20 );

	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
	
	if ( is_woocommerce() ) {
		remove_action('snpshpwp_before_content', 'snpshpwp_breadcrumbs', 5);
		add_action('snpshpwp_before_content', 'woocommerce_breadcrumb', 5);
	}

	remove_action( 'woocommerce_before_single_product','woocommerce_show_messages', 10, 0);
	add_action('snpshpwp_before_content', 'wc_print_notices', 10);

/*
	function woo_related_products_limit() {
		global $product;
		
		$args['posts_per_page'] = 6;
		return $args;
	}
	add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
*/


	/* Disable tabs */
	function woo_remove_product_tabs( $tabs ) {
		unset( $tabs['additional_information'] );
		return $tabs;
	}
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

	/* Override related */
	function woocommerce_output_related_products() {
		$woo_rel_per_page = ( isset( $snpshpwp_data['woo_rel_per_page'] ) ? $snpshpwp_data['woo_rel_per_page'] : 4 );
		$rel_defaults = array(
			'posts_per_page' => $woo_rel_per_page,
			'columns' => 1,
			'orderby' => 'rand'
		);
		woocommerce_related_products($rel_defaults);
	}

	if ( !function_exists( 'snpshpwp_enqueue_woocommerce_style' ) ) :
	function snpshpwp_enqueue_woocommerce_style(){
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/woocommerce/style.css' );
		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_style( 'woocommerce' );
		}
		wp_enqueue_style( 'snpshpwp-less-woo', get_stylesheet_directory_uri() . '/less/woo.less' );
	}
	endif;
	add_action( 'wp_enqueue_scripts', 'snpshpwp_enqueue_woocommerce_style' );


	/* Single filters */
	if ( !function_exists( 'snpshpwp_woo_single_sku' ) ) :
	function snpshpwp_woo_single_sku() {
		global $product;
		if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?><span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span><?php
		endif;
	}
	endif;
	add_action('woocommerce_single_product_summary', 'snpshpwp_woo_single_sku', 15);

	if ( !function_exists( 'snpshpwp_woo_single_additional' ) ) :
	function snpshpwp_woo_single_additional() {
		global $woocommerce, $post, $product;
		$product->list_attributes();
	}
	endif;
	add_action('woocommerce_single_product_summary', 'snpshpwp_woo_single_additional', 25);


	/* Woo loop filters */
	if ( !function_exists( 'snpshpwp_woo_loop_cat' ) ) :
	function snpshpwp_woo_loop_cat(){
		global $product;
		echo '</a>';
		echo '<div class="snpshpwp_wooa_wrap"><div class="snpshpwp_wooa_wrap_inner">';
		printf('<a href="#" class="button snpshpwp_quick_view" data-product="%2$s"><span>%1$s</span> <span><i class="snpshp-wp-plus"></i></span></a>', __('Quick look', 'snpshpwp'), get_the_ID());


		printf('<a href="%1$s">', get_permalink() );
	}
	endif;

	add_action('woocommerce_before_shop_loop_item_title', 'snpshpwp_woo_loop_cat', 15);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 5);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 15);


	if ( !function_exists( 'snpshpwp_woo_close_archive' ) ) :
	function snpshpwp_woo_close_archive(){
		echo '</div></div>';
	}
	endif;
	add_action('woocommerce_after_shop_loop_item', 'snpshpwp_woo_close_archive', 15);



	/*
	 * SNPSHPWP Quick View
	*/
	if ( ! function_exists('snpshpwp_woo_quickview')) :
	function snpshpwp_woo_quickview() {

	$currId = $_POST['product_id'];

	$product = get_product( $currId );

	$out = '';
	$curr_imgs = '';

	$size = sizeof( get_the_terms( $currId, 'product_cat' ) );
	$curr_cat = $product->get_categories( ', ', '<span class="snpshpwp_quickview_categories">' . _n( '', '', $size, 'snpshpwp' ) . ' ', '</span>' );

	$curr_price = '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
	$curr_price .= '<p class="price">'.$product->get_price_html().'</p>';
	$curr_price .= ($product->is_in_stock() ? '' : '<span class="outofstock">'.__('Out of stock', 'snpshpwp').'</span>' );
	$curr_price .= '</div>';

	$curr_title = sprintf('<a href="%2$s" title="%1$s" class="snpshpwp_quickview_title">%1$s</a>', get_the_title($currId), get_the_permalink($currId) );

	$curr_cart = sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	);

	if ( has_post_thumbnail($currId) ) {

		$image_title = esc_attr( get_the_title( get_post_thumbnail_id($currId) ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id($currId) );
		$curr_imgs .= '<div class="snpshpwp_quickview_slide">'.get_the_post_thumbnail( $currId, apply_filters( 'single_product_large_thumbnail_size', 'full' ), array(
			'title' => $image_title
			) ).'</div>';

		$attachment_ids = $product->get_gallery_attachment_ids();


		foreach ( $attachment_ids as $attachment_id ) {

			$image_link = wp_get_attachment_image( $attachment_id, 'full' );

			if ( ! $image_link )
				continue;


			$curr_imgs .= '<div class="snpshpwp_quickview_slide">'.$image_link.'</div>';


		}


	}





	$out .= sprintf('
	<div class="snpshpwp_quickview_slider_wrap">
	<div class="snpshpwp_quickview_slider">
	%1$s
	</div>
	</div>
	', $curr_imgs );


	$out .= sprintf('
	<div class="snpshpwp_quickview_content">
	%1$s
	%2$s
	%4$s
	<div class="snpshpwp_quickview_text">%3$s</div>
	%5$s
	</div>
	', $curr_cat, $curr_title, $product->post->post_content, $curr_price, $curr_cart );



	$html ='<div id="snpshpwp_woo_quickview"><div class="snpshpwp_woo_quickview_inner"><a href="#" class="snpshpwp_quickview_close"><span>X</span></a>' . $out . '<div class="clearfix"></div></div></div>';

		die($html);
		exit;
	}
	endif;
	add_action('wp_ajax_nopriv_snpshpwp_woo_quickview', 'snpshpwp_woo_quickview');
	add_action('wp_ajax_snpshpwp_woo_quickview', 'snpshpwp_woo_quickview');





	if ( !function_exists( 'snpshpwp_woocart' ) ) :
	function snpshpwp_woocart() {
		global $woocommerce;
		printf('<div class="float_left snpshpwp_woo_shopping_cart"><a class="snpshpwp_cartcont cart-contents" href="#" title="%2$s"><span class="snpshpwp_wciw"><i class="snpshp-wp-bag"></i><span class="snpshpwp_cartico">%3$s</span></span></a>', $woocommerce->cart->get_cart_url(), __('View your shopping cart', 'snpshpwp'), sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'snpshpwp'), $woocommerce->cart->cart_contents_count), $woocommerce->cart->get_cart_total() );

		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			echo '<div id="snpshpwp_woocart" class="snpshpwp_shopping_cart">';
				echo '<h3><span>'. $woocommerce->cart->cart_contents_count .'</span> '.__('Products in your basket', 'snpshpwp').'</h3>';
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<div class = "snpshpwp_cart_item">
						

						<div class="snpshpwp-cart-thumbnail">
							<?php
								$thumbnail = apply_filters( 'snpshpwp-square', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</div>

						<div class="snpshpwp-cart-name">
							<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values ) . ' X ';
								$product_quantity = esc_attr( $values['quantity'] );
								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );


								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
									echo '<p class="backorder_notification">' . __( 'Available on backorder', 'snpshpwp' ) . '</p>';

								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</div>

						<div class="snpshpwp-cart-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'snpshpwp' ) ), $cart_item_key );
							?>
						</div>

					</div>
					<?php
				}
			}
			printf('<a href="%2$s" class="snpshpwp_cart_button div_view_cart float_left">%1$s</a>',__('View cart', 'snpshpwp'), $woocommerce->cart->get_cart_url());
			printf('<a href="%2$s" class="snpshpwp_cart_button div_checkout float_right">%1$s</a>',__('Checkout', 'snpshpwp'), $woocommerce->cart->get_checkout_url());
		echo '</div></div>';
		}
		else {
			$shop = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
			echo '<div id="snpshpwp_woocart" class="snpshpwp_shopping_cart snpshpwp_empty_cart">
					'.__('Your shopping cart is empty','snpshpwp').' '.__('Why not add some items in our','snpshpwp').' <a href="'. get_permalink( woocommerce_get_page_id( 'shop' ) ).'">' . __('Shop', 'snpshpwp') . '</a>
					</div></div>';
		}
	}
	endif;








// Ensure cart contents update when products are added to the cart via AJAX
if ( !function_exists( 'snpshpwp_woocommerce_header_add_to_cart_fragment' ) ) :
function snpshpwp_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

				printf('<div class="float_left snpshpwp_element_woo-cart"><a class="snpshpwp_cartcont cart-contents" href="#" title="%2$s"><span class="snpshpwp_wciw"><i class="snpshp-wp-bag"></i><span class="snpshpwp_cartico">%3$s</span></span></a>', $woocommerce->cart->get_cart_url(), __('View your shopping cart', 'snpshpwp'), sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'snpshpwp'), $woocommerce->cart->cart_contents_count), $woocommerce->cart->get_cart_total() );

		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			echo '<div id="snpshpwp_woocart" class="snpshpwp_shopping_cart">';

				echo '<h3><span>'. $woocommerce->cart->cart_contents_count .'</span> '.__('Products in your basket', 'snpshpwp').'</h3>';

			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<div class = "snpshpwp_cart_item">
						
						<div class="snpshpwp-cart-thumbnail">
							<?php
								$thumbnail = apply_filters( 'snpshpwp-square', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</div>

						<div class="snpshpwp-cart-name">
							<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values ) . ' X ';
								$product_quantity = esc_attr( $values['quantity'] );
								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
									echo '<p class="backorder_notification">' . __( 'Available on backorder', 'snpshpwp' ) . '</p>';

								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</div>

						<div class="snpshpwp-cart-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'snpshpwp' ) ), $cart_item_key );
							?>
						</div>

					</div>
					<?php
				}
			}
			printf('<a href="%2$s" class="snpshpwp_cart_button div_view_cart float_left">%1$s</a>',__('View cart', 'snpshpwp'), $woocommerce->cart->get_cart_url());
			printf('<a href="%2$s" class="snpshpwp_cart_button div_checkout float_right">%1$s</a>',__('Checkout', 'snpshpwp'), $woocommerce->cart->get_checkout_url());
		echo '</div></li>';
		}
		else {
			$shop = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
			echo '<div id="snpshpwp_woocart" class="snpshpwp_shopping_cart snpshpwp_empty_cart text-center">
					'.__('Your shopping cart is empty','snpshpwp').' '.__('Why not add some items in our','snpshpwp').' <a href="'. get_permalink( woocommerce_get_page_id( 'shop' ) ).'">' . __('Shop', 'snpshpwp') . '</a>
					</div></div>';
		}
	
	$fragments['div.snpshpwp_element_woo-cart'] = ob_get_clean();
	
	return $fragments;
	
}
endif;
add_filter('add_to_cart_fragments', 'snpshpwp_woocommerce_header_add_to_cart_fragment');



}


/*
 * SnapShopWP Pagination
*/
if ( !function_exists('snpshpwp_pagination') ) :
function snpshpwp_pagination($pages = '', $page = '', $range = 3, $ajax = '') {
	if ( $page == '' ) {
		global $paged;
		if ( empty( $paged ) ) $paged = 1;
	}
	else {
		$paged = $page;
	}

	$out = '';
	$showitems = 3;

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	} 

	if ( $ajax !== '' && $ajax !== 'no' ) {
		$ajaxload = 'onclick="snpshpwp_ajaxload_portfolio(jQuery(this)); return false;"';
	}
	else {
		$ajaxload = '';
	}

	if ( 1 != $pages ) {
		$out .= "<nav class='snpshpwp_pagination_wrapper'>";
		$out .= '<div class="snpshpwp_pagination_info">' . __('Pages', 'snpshpwp') . ': ' . $paged . ' ' . __('of', 'snpshpwp') . ' '  . $pages . '</div>';
		$out .= "<ul>";

		if ( $paged > 1 ) {
			$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">&lt;&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
		}


		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + 3 || $i <= $paged - 3) || $pages <= $showitems ) ) {
				$out .= ( $paged == $i ) ? "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">" . $i . "</a></li>" : "<li class=\"snpshpwp_pagination_square\"><a title='" . __( 'View page number', 'snpshpwp' ) . " " . $i . "' href='" . get_pagenum_link( $i ) . "' class=\"inactive\" " .$ajaxload . ">" . $i . "<span class='display_none snpshpwp_page'>" . $i . "</span></a></li>";
			}

		}

		if ( $paged < $pages ) {
			$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">&gt;&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
		}


		$out .= "</ul></nav>";
	}
	return $out;
}
endif;


/*
 * SnapShopWP Pagination Mini
*/
if ( !function_exists('snpshpwp_mini_pagination') ) :
function snpshpwp_mini_pagination($pages = '', $page = '', $range = 3, $ajax = '', $title = '') {
	if ( $page == '' ) {
		global $paged;
		if ( empty( $paged ) ) $paged = 1;
	}
	else {
	$paged = $page;
	}
	$next_page = $paged + 1;
	$prev_page = $paged - 1;
	$showitems = 3;
	$out = '';

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}

	if ( $ajax == 'false' ) {
		$ajaxload = '';

		if ( 1 != $pages ) {
			$out .= "<nav class='snpshpwp_pagination_wrapper'>";
			$out .= '<div class="snpshpwp_pagination_info">' . __('Pages', 'snpshpwp') . ': ' . $paged . ' ' . __('of', 'snpshpwp') . ' '  . $pages . '</div>';
			$out .= "<ul>";
			if ( $paged > 1 ) {
				$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">&lt;&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
			}
			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages && ( !( $i >= $paged + 3 || $i <= $paged - 3) || $pages <= $showitems ) ) {
					$out .= ( $paged == $i ) ? "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">" . $i . "</a></li>" : "<li class=\"snpshpwp_pagination_square\"><a title='" . __( 'View page number', 'snpshpwp' ) . " " . $i . "' href='" . get_pagenum_link( $i ) . "' class=\"inactive\" " .$ajaxload . ">" . $i . "<span class='display_none snpshpwp_page'>" . $i . "</span></a></li>";
				}
			}
			if ( $paged < $pages ) {
				$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">&gt;&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
			}
			$out .= "</ul></nav>";
		}
	}
	else {
		$ajaxload = 'onclick="snpshpwp_ajaxload(jQuery(this)); return false;"';
		if ( 1 != $pages ) {
			$out .= "<nav class='snpshpwp_pagination_wrapper snpshpwp_pagination_ajax'>";
			$out .= "<ul>";
			if ( $paged > 1 ) {
				$out .= "<li class=\"snpshpwp_pagination_square snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
			}
			else {
				$out .= "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">&lt;</a></li>";
			}
			if ( $paged < $pages ) {
				$out .= "<li class=\"snpshpwp_pagination_square snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
			}
			else {
				$out .= "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">&gt;</a></li>";
			}
			$out .= "</ul></nav>";
		}
	}


	return $out;
}
endif;


/**
 * Pagination Top WooCommerce
 */
if ( !function_exists( 'snpshpwp_mini_woo_pagination' ) ) :
function snpshpwp_mini_woo_pagination($pages = '', $page = '', $range = 3, $ajax = '', $title = '') {
	if ( $page == '' ) {
		global $paged;
		if ( empty( $paged ) ) $paged = 1;
	}
	else {
	$paged = $page;
	}
	$next_page = $paged + 1;
	$prev_page = $paged - 1;
	$showitems = 5;
	$out = '';

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 2;
		}
	}

	if ( $ajax == 'false' ) {
		$ajaxload = '';

		if ( 1 != $pages ) {
			$out .= "<nav class='snpshpwp_pagination_wrapper'>";
			$out .= '<div class="snpshpwp_pagination_info">' . __('Pages', 'snpshpwp') . ': ' . $paged . ' ' . __('of', 'snpshpwp') . ' '  . $pages . '</div>';
			$out .= "<ul>";

			if ( $paged > 1 ) {
				$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">&lt;&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
			}
			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages && ( !( $i >= $paged + 3 || $i <= $paged - 3) || $pages <= $showitems ) ) {
					$out .= ( $paged == $i ) ? "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">" . $i . "</a></li>" : "<li class=\"snpshpwp_pagination_square\"><a title='" . __( 'View page number', 'snpshpwp' ) . " " . $i . "' href='" . get_pagenum_link( $i ) . "' class=\"inactive\" " .$ajaxload . ">" . $i . "<span class='display_none snpshpwp_page'>" . $i . "</span></a></li>";
				}
			}
			if ( $paged < $pages ) {
				$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">&gt;&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
			}
			$out .= "</ul></nav>";
		}
	}
	else {
		$ajaxload = 'onclick="snpshpwp_ajaxload_send_woo(jQuery(this)); return false;"';

		if ( 1 != $pages ) {
			$out .= "<nav class='snpshpwp_pagination_wrapper snpshpwp_pagination_ajax'>";
			$out .= "<ul>";
			if ( $paged > 1 ) {
				$out .= "<li class=\"snpshpwp_pagination_square snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
			}
			else {
				$out .= "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">&lt;</a></li>";
			}
			if ( $paged < $pages ) {
				$out .= "<li class=\"snpshpwp_pagination_square snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
			}
			else {
				$out .= "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">&gt;</a></li>";
			}
			$out .= "</ul></nav>";
		}
	}

	return $out;
}
endif;


/**
 * Pagination WooCommerce
 */
if ( !function_exists( 'snpshpwp_mini_woo_pagination_cat' ) ) :
function snpshpwp_mini_woo_pagination_cat($pages = '', $paged = '', $offset = '', $ajax = '', $title = '') {

	$out = '';
	$pages = ceil($pages/$offset);
	
	if ( $ajax !== '' && $ajax !== 'no' ) {
		 $ajaxload = 'onclick="snpshpwp_ajaxload_send_woo_cat(jQuery(this)); return false;"';
	}
	else {
		 $ajaxload = '';
	}

	if ( 1 != $pages ) {
		$out .= "<nav class='snpshpwp_pagination_wrapper'>";
		$out .= '<div class="snpshpwp_pagination_info">' . __('Pages', 'snpshpwp') . ': ' . $paged . ' ' . __('of', 'snpshpwp') . ' '  . $pages . '</div>';
		$out .= "<ul>";

		if ( $paged > 1 ) {
			$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_left\"><a title=\"" . __('View newer posts', 'snpshpwp') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous bold_font\" " . $ajaxload . ">&lt;&lt;<span class='display_none snpshpwp_page'>". ($paged - 1)."</span></a></li>";
		}


		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + 3 || $i <= $paged - 3) || $pages <= $showitems ) ) {
				$out .= ( $paged == $i ) ? "<li class=\"snpshpwp_pagination_square\"><a class=\"current\">" . $i . "</a></li>" : "<li class=\"snpshpwp_pagination_square\"><a title='" . __( 'View page number', 'snpshpwp' ) . " " . $i . "' href='" . get_pagenum_link( $i ) . "' class=\"inactive\" " .$ajaxload . ">" . $i . "<span class='display_none snpshpwp_page'>" . $i . "</span></a></li>";
			}
			elseif ( $i == $paged + 3 ) {
				$out .= '<li><a class="current">...</a></li>';
			}
			elseif ( $i == $paged - 3 ) {
				$out .= '<li><a class="current">...</a></li>';
			}

		}

		if ( $paged < $pages ) {
			$out .= "<li class=\"snpshpwp_pagination_normal snpshpwp_right\"><a title=\"" . __( 'View earlier posts', 'snpshpwp' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next bold_font\" " . $ajaxload . ">&gt;&gt;<span class='display_none snpshpwp_page'>".( $paged + 1 )."</span></a></li>";
		}


		$out .= "</ul></nav>";
	}
	return $out;
}
endif;

/*
 * Template for comments and pingbacks
*/
if ( !function_exists( 'snpshpwp_comment' ) ) :
function snpshpwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	
		case '' : ?>
<li <?php comment_class('single_comment'); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>" class="snpshpwp_div_comment border-box">
		<?php echo get_avatar( $comment, 200 ); ?>
		<div class="snpshpwp_comment_bubble">
			<div class="snpshpwpcomment_meta margin-bottom12 snpshpwp_header_font a-inherit">
				<h6 class="comment_date_meta uppercase margin-bottom6"><?php echo get_comment_date(); ?></h6>
				<h4 class="comment_author_meta uppercase snpshpwp_theme_color"><?php echo get_comment_author_link(); ?></h4>
			</div>

			<div class="snpshpwp_comment_text">
				<?php
					comment_text();
					if ( $comment->comment_approved == '0' ) :
				?>
				<p class="moderation">
					<?php _e( 'Your comment is awaiting moderation.', 'snpshpwp' ); ?>
				</p>
				<?php endif; ?>
			</div>

			<div class="snpshpwp_comment_edit snpshpwp_header_font uppercase">
				<?php
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					edit_comment_link( __( 'Edit', 'snpshpwp' ), ' ' );
				?>
			</div>
		</div>
	</div>
	<?php
		break;
		case 'pingback'  :
	?>
<li class="post pingback">
	<p>
	<?php 
		_e( 'Pingback:', 'snpshpwp' );
		comment_author_link();
		edit_comment_link( __('(Edit)', 'snpshpwp'), ' ' );
	?>
	</p>
	<?php
		break;
		case 'trackback' :
	?>
<li class="post pingback">
	<p>
	<?php 
		_e( 'Pingback:', 'snpshpwp' );
		comment_author_link();
		edit_comment_link( __('(Edit)', 'snpshpwp'), ' ' );
	?>
	</p>
	<?php
		break;
		default :
			die( __('Invalid options.', 'snpshpwp') );
		endswitch;
	}
endif;


/*
 * SnapShopWP Blog AJAX
*/
if ( ! function_exists('snpshpwp_ajaxload_send')) :
function snpshpwp_ajaxload_send() {
	$out = '';
	$post_counter = 0;
	$add_class = '';

	$query_string = $_POST['data'];
	$current_page = snpshpwp_get_between($query_string, 'paged=', '&');
	$type = $_POST['type'];
	$page = $_POST['page'];
	$ajax = $_POST['ajax'];
	$words = $_POST['excerpt'];
	$columns = $_POST['columns'];
	$align = $_POST['align'];
	$pagination = $_POST['pagination'];
	$show_category = $_POST['show_category'];
	$show_date = $_POST['show_date'];
	$show_author = $_POST['show_author'];
	$show_comments = $_POST['show_comments'];

	$format = get_post_format();
	$image_size = ( get_theme_mod('fimage_override') == 1 && $format !== 'gallery' ? 'full' : 'snpshpwp-fullblog' );

	$query_string = str_replace('paged='.$current_page.'&', 'paged='.$page.'&', $query_string);
	$snpshpwp_posts = new WP_Query( $query_string );
	if ( $snpshpwp_posts->have_posts() ) :
		$out .= "@@@!SPLIT!@@@<div class='snpshpwp_blog {$type}' data-string='{$query_string}' data-shortcode='{$words}|{$columns}|{$align}|{$pagination}|{$show_category}|{$show_date}|{$show_author}|{$show_comments}'>";

			$out .= '<div class="snpshpwp_blog_separate anivia_row fbuilder_row"><div>';
			while( $snpshpwp_posts->have_posts() ): $snpshpwp_posts->the_post();

				if ( $add_class !== '' ) $out .= '</div></div><div class="snpshpwp_blog_separate anivia_row fbuilder_row"><div>';

				$feat_area = '';
				$heading = '';
				$post_counter++;

				if ( false === $format || $format == 'aside' || $format == 'chat' || $format == 'status' ) {
					$format = 'standard';
				}

				$out .= '<div class="' . implode( ' ', get_post_class() ) . ' snpshpwp_post fbuilder_column fbuilder_column-1-' . $columns . '">';

				if ( !strpos($type, 'snpshpwp_type_0') ) {
					$feat_area .= snpshpwp_get_featarea( $image_size, $format );
				}
				else {
					$feat_area .= get_the_post_thumbnail( get_the_ID(), 'snpshpwp-square' );
				}

				if ( $format !== 'quote' ) {
					$heading .= '<h3 class="snpshpwp_blog_title"><a href="'.get_permalink().'" rel="bookmark">' . get_the_title() . '</a></h3>';
				}

				if ( $show_category == 'true' || $show_date == 'true' || $show_author == 'true' || $show_comments == 'true' ) {

					$heading .= '<div class="snpshpwp_posts_meta">';

					if ( $show_category == 'true' ) {
						$heading .= '<div class="snpshpwp_category_meta">'.__('Published in', 'snpshpwp').' '.get_the_category_list( ', ' ).'</div> ';
					}

					if ( $show_date == 'true' ) {
						$timecode = get_the_date();
						$heading .= '<div class="snpshpwp_date_meta">'.__('on ').'<a href="'.get_month_link( get_the_time('Y'), get_the_time('m') ).'" title="'.__('View all posts this month', 'snpshpwp').'">'.$timecode.'</a></div> ';
					}

					if ( $show_author == 'true' ) {
						$heading .= '<div class="snpshpwp_author_meta">'.__('by', 'snpshpwp').' '.get_the_author_link().'</div> ';
					}

					if ( $show_comments == 'true' ) {
						$num_comments = get_comments_number();
						if ( comments_open() ) {
							if ( $num_comments == 0 ) {
								$comments = __('still no comments', 'snpshpwp');
							} elseif ( $num_comments > 1 ) {
								$comments = $num_comments . ' ' . __('Comments', 'snpshpwp');
							} else {
								$comments = __('1 Comment', 'snpshpwp');
							}
							$write_comments = __('with', 'snpshpwp') . ' ' . '<a href="' . get_comments_link() .'">'. $comments.'</a>';
						} else {
							$write_comments =  __('Comments are off for this post.', 'snpshpwp');
						}
						$heading .= '<div class="snpshpwp_comment_meta">'.$write_comments.'</div>';
					}

					$heading .= '</div>';

				}

				$out .= $feat_area . '<div class="snpshpwp_post">' . $heading;
				if ( $format !== 'quote' ) {
					if ( $words !== '0' ) {
						$excerpt = get_the_excerpt();
						$out .= '<div class="snpshpwp_excerpt">'.snpshpwp_string_limit_words( $excerpt, $words ).'</div>';
					}
				}

				$out .= '</div><div class="clearfix"></div></div>';

				if ( $post_counter == $columns ){
					$post_counter = 0;
					$add_class = 'new_row';
				}
				else {
					$add_class = '';
				}
			endwhile;
			$out .= '</div></div>';

		$out .=  '<div class="clearfix"></div>';

		$out .= '</div>';
		if ( $pagination == 'true') $out .= snpshpwp_mini_pagination($snpshpwp_posts->max_num_pages, $page, 3, $ajax, '');

	endif;

	die($out);
	exit;
}
endif;
add_action('wp_ajax_nopriv_snpshpwp_ajaxload_send', 'snpshpwp_ajaxload_send');
add_action('wp_ajax_snpshpwp_ajaxload_send', 'snpshpwp_ajaxload_send');


/**
 * Ajax Load WooCommerce Products
 */
if ( !function_exists('snpshpwp_ajaxload_send_woo') ) :
function snpshpwp_ajaxload_send_woo() {
	global $woocommerce, $woocommerce_loop;
	$query_string = $_POST['data'];
	$current_page = snpshpwp_get_between($query_string, 'paged=', '&');
	$page = $_POST['page'];
	$ajax = $_POST['ajax'];
	$bot_margin = $_POST['bot_margin'];
	$columns= $_POST['columns'];
	$args = str_replace('paged='.$current_page.'&', 'paged='.$page.'&', $query_string);
	
	$woocommerce_loop['columns'] = $columns;

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>


				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;

	wp_reset_postdata();

	die('<div class="woocommerce">' . ob_get_clean() . '</div>'.snpshpwp_mini_woo_pagination($products->max_num_pages, $page, 1, $ajax));
}
endif;
add_action('wp_ajax_nopriv_snpshpwp_ajaxload_send_woo', 'snpshpwp_ajaxload_send_woo');
add_action('wp_ajax_snpshpwp_ajaxload_send_woo', 'snpshpwp_ajaxload_send_woo');


/**
 * Ajax Load WooCommerce Categories
 */
if ( !function_exists('snpshpwp_ajaxload_send_woo_cat') ) :
function snpshpwp_ajaxload_send_woo_cat() {
	global $woocommerce, $woocommerce_loop;
	$current_page = $_POST['page'];
	$page = $_POST['page'];
	$ajax = $_POST['ajax'];
	$bot_margin = $_POST['bot_margin'];
	$columns= $_POST['columns'];
	$per_page = $_POST['per_page'];
	$order = $_POST['order'];
	$orderby = $_POST['orderby'];
	$ids = $_POST['ids'];
	$hide_empty = 1;
	$parent = '';

		$ids = explode( ',', $ids );
		$ids = array_map( 'trim', $ids );

		$args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => 1,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent,
			'parent'     => '',
			'offset'     => $per_page*($page-1)
		);

		$product_categories = get_terms( 'product_cat', $args );
		$cat_num = count($product_categories);
		$product_categories = array_slice( $product_categories, $per_page*($page-1), $per_page );

		$pagination = snpshpwp_mini_woo_pagination_cat($cat_num, $current_page, $per_page, 'yes');

		if ( $parent !== "" ) {
			$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
		}

		if ( $hide_empty ) {
			foreach ( $product_categories as $key => $category ) {
				if ( $category->count == 0 ) {
					unset( $product_categories[ $key ] );
				}
			}
		}

		$woocommerce_loop['columns'] = $columns;

		ob_start();

		// Reset loop/columns globals when starting a new loop
		$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

		if ( $product_categories ) {

			woocommerce_product_loop_start();

			foreach ( $product_categories as $category ) {

				wc_get_template( 'content-product_cat.php', array(
					'category' => $category
				) );

			}

			woocommerce_product_loop_end();

		}

		woocommerce_reset_loop();

		$shortcode = ob_get_clean();

	die('<div class="woocommerce">' . $shortcode . '</div>'.snpshpwp_mini_woo_pagination_cat($cat_num, $page, $per_page, 'yes'));
}
endif;
add_action('wp_ajax_nopriv_snpshpwp_ajaxload_send_woo_cat', 'snpshpwp_ajaxload_send_woo_cat');
add_action('wp_ajax_snpshpwp_ajaxload_send_woo_cat', 'snpshpwp_ajaxload_send_woo_cat');


/*
 * SnapShopWP Read More Link
*/
if ( ! function_exists('snpshpwp_remove_more_link')) :
function snpshpwp_remove_more_link( $link ) {
	return sprintf('<a href="%1$s" rel="nofollow" class="snpshpwp_read_more block">%2$s</a>', get_permalink(), __('Read More', 'snpshpwp') );
}
endif;
add_filter( 'the_content_more_link', 'snpshpwp_remove_more_link' );



/*
 * SnapShopWP Footer Elements
*/
if ( !function_exists( 'snpshpwp_elements' ) ) :
function snpshpwp_elements($position = '', $location = 'header') {
	global $snpshpwp_data;
	foreach ( $snpshpwp_data[$location.'_'.$position]['enabled'] as $n => $t ) :
	if ( $n == 'placebo' ) continue;
	printf( '<div class="float_left snpshpwp_element_%1$s">', $n, $position );
	switch ($n) :
		case 'login-link':
			if ( $location == 'header' || $location == 'header_bar' ) {
				$registration_enabled = get_option('users_can_register');
				if ( $registration_enabled ) {
					$class = '';
				} else {
					$class = ' snpshpwp_disable';
				}
				if(!is_user_logged_in()) {
					echo '<a href="#">'.__('Log in', 'snpshpwp').'</a>';
					echo '<div class="snpshpwp_login_element'.$class.'">';
					echo '<div class="snpshpwp_login_element_column">';
					echo snpshpwp_login_form();
					echo '</div>';
					echo '<div class="snpshpwp_login_element_column">';
					echo snpshpwp_registration_form();
					echo '</div>';
					echo '<div class="clearfix"></div>';
					echo '</div>';
				} else {
					echo '<a href="' . wp_logout_url( home_url() ) . '" title="Logout">' . __('Logout', 'snpshpwp') . '</a>';
				}
			}
			else {
				wp_loginout();
			}
		break;
		case 'language-bar':
			$languages = $snpshpwp_data['language'];
			$first_key = key($languages);
			printf ( '<a href="#" class="language_selected"><span>%1$s</span><i class="snpshp-wp-down"></i></a><ul>', $languages[$first_key]['language'] );
				foreach ( $languages as $language ) {
					$flag = $language['flag'];
					$lang = $language['language'];
					$langurl = $language['langurl'];
					printf('<li><a href="%2$s">%1$s</a><img src="%3$s" alt="%4$s" /></li>', $lang, $langurl, get_template_directory_uri().'/images/flags/'.$flag, esc_attr($lang));
				}
			echo '</ul>';
		break;
		case 'network-icons':
			if ( $snpshpwp_data[$location.'_networks'] == 'none' ) {
				break;
			}
			$networks = $snpshpwp_data['contact'][$snpshpwp_data[$location.'_networks']]['contact'];
			foreach ( $networks as $network ) {
				printf( '<a href="%1$s" class="snpshpwp_social"><img src="%2$s/images/socials/%3$s" alt="%1$s" /></a>', $network['socialnetworksurl'], get_bloginfo ( 'template_directory' ), $network['socialnetworks'], $position );
			}
		break;
		case 'tagline':
			echo $snpshpwp_data[$location.'_tagline'];
		break;
		case 'to-the-top':
			printf( '<a href="#snpshpwp_wrapper" title="%1$s">%2$s</a>', __('UP!','snpshpwp'), ( $snpshpwp_data['footer_up_text'] !== '' ? $snpshpwp_data['footer_up_text'] : '<i class="snpshp-wp-up"></i>' ) );
		break;
		case 'tagline-alt':
			echo $snpshpwp_data[$location.'_tagline_alt'];
		break;
		case 'menu':
		if ( $snpshpwp_data[$location.'_menu'] !== 'none' ) {
		?>
			<nav class="snpshpwp_nav">
				<?php wp_nav_menu( array( 'menu' => $snpshpwp_data[$location.'_menu'], 'depth' => ( $location !== 'footer' ? '4' : '1'), 'fallback_cb' => 'snpshpwp_list_pages', 'container' => false, 'menu_id' => '', 'menu_class' => 'snpshpwp_menu' ) ); ?>
			</nav>
		<?php
			if ( $location == 'header' ) {
		?>
			<a href="#" class="snpshpwp_responsive_trigger" data-position="<?php echo $position; ?>"><i class="snpshp-wp-bars"></i></a>
		<?php
			}
		} else {
			snpshpwp_list_pages();
		}

		break;
		case 'search':
		?>
			<a id="snpshpwp_srch_trggr" href="#"><i class="snpshp-wp-search"></i></a>
			<div class="snpshpwp_srch_bx">
				<form action="<?php echo home_url( '/' ); ?>" method="get">
				<?php
					if ( SNPSHPWP_WOOCOMMERCE === true ) {
				?>
					<div class="snpshpwp_srch_slct">
						<a id="snpshpwp_srch_slct_trggr" href="#" class="snpshpwp_srch_slct_trggr">
						<?php
							$curr_cats = get_terms( 'product_cat', array( 'hide_empty'=>0) );
							if ( isset($_GET['product_cat']) ) {
								$curr_term = get_term_by( 'slug', $_GET['product_cat'], 'product_cat' );
								echo $curr_term->name;
							}
							else {
								_e('All', 'snpshpwp');
							}
						?>
						</a>
						<ul class="snpshpwp_product_cats">
							<li class="snpshpwp_sct_all"><a href="#" data-cat="-1"><?php _e('All', 'snpshpwp'); ?></a></li>
						<?php
							$curr_cats = get_terms( 'product_cat', array( 'hide_empty'=>0) );
							foreach ( $curr_cats as $curr ) {
								printf('<li class="snpshpwp_sct_%2$s"><a href="#" data-cat="%2$s">%1$s</a></li>', $curr->name, $curr->slug, ( isset($_GET['product_cat'] ) && $_GET['product_cat'] == $curr->slug ? ' selected="selected"' : '' ));
							}
						
						?>
						</ul>
						<input name="product_cat" type="hidden" value="<?php echo ( isset($_GET['product_cat']) ? $curr_term->slug : '' ); ?>" />
					</div>
				<?php
					}
				?>
					<div class="snpshpwp_srch_inpt">
						<input class="snpshpwp_inpt" name="s" type="text" value="" placeholder="<?php echo ( SNPSHPWP_WOOCOMMERCE === true ? __('Search products', 'snpshpwp') : __('Search the website', 'snpshpwp') ); ?>" />
					</div>
					<button type="submit"  class="snpshpwp_srch_sbmt" value="Submit"><i class="snpshp-wp-search"></i></button>
					<div class="clearfix"></div>
				</form>
			</div>
		<?php
		break;
		case 'logo':
			?>
			<a href="<?php echo home_url(); ?>" class="snpshpwp_logo" title="<?php esc_attr(bloginfo('description')); ?>">
				<img src="<?php echo $snpshpwp_data[$location.'_logo']; ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
			</a>
			<?php
		break;
		case 'woo-cart':
			if ( SNPSHPWP_WOOCOMMERCE === true )
				snpshpwp_woocart();
		break;
		case 'sidenav':
			printf('<a id="snpshpwp_sdnv_%1$s" href="#" data-navigation="snpshpwp_sdnv_%1$s_bar" data-position="%1$s"><i class="snpshp-wp-bars"></i></a>', $position);
		break;
	endswitch;
	echo '</div>';
	endforeach;
}
endif;






/*
 * SnapShopWP Custom Functions
*/

// SnapShopWP List Pages
function snpshpwp_list_pages(){
	echo '<ul class="snpshpwp_menu">';
	wp_list_pages( array( 'title_li' => '', 'depth' => '1' ));
	echo '</ul>';
	return;
}

// SnapShopWP List Pages
function snpshpwp_add_options_link() {
	global $wp_admin_bar;
	$wp_admin_bar -> add_menu( array(
		'parent' => 'site-name',
		'id' => 'snpshpwp_options',
		'title' => __('SnapShop Options', 'snpshpwp'),
		'href' => admin_url( 'themes.php?page=snpshpwp_options' ),
		'meta' => false
	));
}
add_action( 'wp_before_admin_bar_render', 'snpshpwp_add_options_link' );


// String limit by char
if ( ! function_exists('snpshpwp_string_limit_words'))
{
	function snpshpwp_string_limit_words($str, $n = 500, $end_char = '...')
	{
		if ( $n == 0 ) return;
		if (strlen($str) < $n)
		{
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}

// Hex to RGB
function snpshpwp_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb);
	return $rgb;
}

// get_between. string function
function snpshpwp_get_between($content,$start,$end){
	$r = explode($start, $content);
	if (isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}
	return '';
}

// snpshpwp_split. split string
function snpshpwp_split($string,$needle,$nth){
$max = strlen($string);
$n = 0;
for($i=0;$i<$max;$i++){
	if($string[$i]==$needle){
		$n++;
		if($n>=$nth){
			break;
		}
	}
}
$arr[] = mb_substr($string,0,$i);
$arr[] = mb_substr($string,$i+1,$max);

return $arr;
}

// Adds featured images thumbnails
add_filter( 'manage_posts_columns', 'snpshpwp_posts_columns', 5 );
add_action( 'manage_posts_custom_column', 'snpshpwp_posts_custom_columns', 5, 2 );
function snpshpwp_posts_columns( $defaults ) {
	$defaults['post_thumbs'] = __( 'Featured image', 'snpshpwp' );
	return $defaults;
}
function snpshpwp_posts_custom_columns( $column_name, $id ) {
	if( $column_name === 'post_thumbs' ) {
		echo the_post_thumbnail( array( 60, 60 ) );
	}
}


/*
 * Widgets
*/
include_once('widgets/socialbro/socialbro.php');
// Tweeter Widget
class SnapShopWP_Twitter_Widget extends WP_Widget {
	function SnapShopWP_Twitter_Widget() {
		$widget_ops = array(
			'classname' => 'widget-snpshpwp-twitter twitter_module',
			'description' => __( 'Show your twitter feeds', 'snpshpwp' )
		);
		$this->WP_Widget( 'snpshpwp_twitter', '+ SnapShopWP Twitter', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$user = empty($instance['user']) ? '' : apply_filters( 'widget_user', $instance['user'] );
		$count = empty($instance['count']) ? '' : apply_filters( 'widget_count', $instance['count'] );
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

		echo snpshpwp_twitter_feed( $user, $count );
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args(
		(array) $instance, array( 
			'title' => '',
			'user' => '',
			'count' => 5
		) );
		$title = strip_tags( $instance['title'] );
		$user = strip_tags( $instance['user'] );
		$count = strip_tags( $instance['count'] );
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'snpshpwp' ); ?> :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e( 'User', 'snpshpwp' ); ?> :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo esc_attr( $user ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count', 'snpshpwp' ); ?> :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" /></p>
<?php }
}
add_action( 'widgets_init', create_function('', 'return register_widget("SnapShopWP_Twitter_Widget");' ) );

// Post widgets
class SnapShopWP_Categories_Widget extends WP_Widget {
	function SnapShopWP_Categories_Widget() {
		$widget_ops = array(
			'classname' => 'widget-snpshpwp-cat', 
			'description' => __( 'Show category posts', 'snpshpwp') );
		$this->WP_Widget( 'snpshpwp_category', '+ SnapShopWP Category Posts', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		if ( isset( $instance['order'] ) ) : $order = $instance['order']; else : $order = 'date'; endif;
		if ( isset( $instance['category'] ) ) : $category = $instance['category']; else : $category = '-1'; endif;
		if ( isset( $instance['number'] ) ) : $number = $instance['number']; else : $number = '5'; endif;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
		echo '<ul>';

		$out = '';
		$query_string = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
			'ignore_sticky_posts' => true,
			'orderby' => $order
			);
		if ( $category !== "-1" ){
			$query_string = $query_string + array(
				'cat' => $category
				);
		}

		$snpshpwp_posts = new WP_Query( $query_string );
		if ( $snpshpwp_posts->have_posts() ) :
			while( $snpshpwp_posts->have_posts() ): $snpshpwp_posts->the_post();
				$out .= '<li>';

				$out .= '<div class="snpshpwp_dticn"><div class="snpshpwp_dticn_day">'.get_the_time('d').'</div><div class="snpshpwp_dticn_month">'.get_the_time('M').'</div></div>';

				$out .= sprintf('<h3><a href="%1$s" title="%2$s">%2$s</a></h3>', get_permalink(), get_the_title() );

				$num_comments = get_comments_number();
				if ( comments_open() ) {
					if ( $num_comments == 0 ) {
						$comments = __('Leave a comment', 'division');
					} elseif ( $num_comments > 1 ) {
						$comments = $num_comments . __(' Comments', 'division');
					} else {
						$comments = __('1 Comment', 'division');
					}
					$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
				} else {
					$write_comments =  __('Comments are off for this post.', 'division');
				}

				$out .= sprintf('<div class="snpshpwp_blog_comments">%1$s</div>', $write_comments );
				$out .= '<div class="clearfix"></div>';

				$out .= '</li>';
			endwhile;
		endif;
		wp_reset_query();
		echo $out;

		echo '</ul>';
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['order'] = strip_tags( $new_instance['order'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args(
		(array) $instance, array( 
			'title' => '',
			'order' => 'date',
			'category' => '34',
			'number' => '5'
		) );
		$title = strip_tags( $instance['title'] );
		$number = strip_tags( $instance['number'] ); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'snpshpwp' ); ?> : <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e( 'Order', 'snpshpwp' ); ?> : <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
		<option value="date" <?php $selected = ( $instance['order'] === 'date') ? 'selected = "selected"' : ''; echo $selected; ?>><?php _e('Recent', 'snpshpwp'); ?></option>
		<option value="comment_count" <?php $selected = ( $instance['order'] === 'comment_count') ? 'selected = "selected"' : ''; echo $selected; ?>><?php _e('Popular', 'snpshpwp'); ?></option>
		<option value="rand" <?php $selected = ( $instance['order'] === 'rand') ? 'selected = "selected"' : ''; echo $selected; ?>><?php _e('Random', 'snpshpwp'); ?></option>
		<option value="author" <?php $selected = ( $instance['order'] === 'author') ? 'selected = "selected"' : ''; echo $selected; ?>><?php _e('Author', 'snpshpwp'); ?></option>
		<option value="title" <?php $selected = ( $instance['order'] === 'title') ? 'selected = "selected"' : ''; echo $selected; ?>><?php _e('Title', 'snpshpwp'); ?></option>
		</select></label></p>  
		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Category', 'snpshpwp' ); wp_dropdown_categories('show_option_none=All&show_count=1&orderby=name&echo=1&name='.$this->get_field_name('category').'&id='.$this->get_field_id('category').'&selected='. $instance['category'] .'');?></label></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display', 'snpshpwp' ); ?> : <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p>
<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("SnapShopWP_Categories_Widget");' ) );


// Twitter OAuth helper function
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}

/*
 * Twitter Feed
*/
if ( !function_exists('snpshpwp_twitter_feed') ) :
function snpshpwp_twitter_feed($user = 'twitter', $count = '5'){
	$transient_key = $user . "_twitter_" . $count;
	$cached = get_transient( $transient_key );

	if ( false !== $cached ) {
		return $cached .= "\n" . '<!-- Returned from cache -->';
	}

	global $snpshpwp_data;
	$output = '';
	$i = 1;

	$twitteruser = $user;
	$notweets = $count;

	$consumerkey = $snpshpwp_data['twitter_ck'];
	$consumersecret = $snpshpwp_data['twitter_cs'];
	$accesstoken = $snpshpwp_data['twitter_at'];
	$accesstokensecret = $snpshpwp_data['twitter_ats'];

	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	$data = json_decode( json_encode($tweets) );
	if ( is_array( $data ) ) :
	$output .= '<ul class="tweets-list list_null">';
	while ( $i <= $count ) {
		if( isset( $data[$i-1] ) ) {
			$feed = $data[( $i - 1 )]->text;
			$feed = str_pad( $feed, 3, ' ', STR_PAD_LEFT );
			$startat = stripos( $feed, '@' );
			$numat = substr_count( $feed, '@' );
			$numhash = substr_count( $feed, '#' );
			$numhttp = substr_count( $feed, 'http' );
			$feed = preg_replace( "#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $feed );
			$feed = preg_replace( "#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $feed );
			$feed = preg_replace( "/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $feed );
			$feed = preg_replace( "/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $feed );
			$output .= sprintf('
			<li class="relative"><a href="http://www.twitter.com/%3$s" title="%4$s" target="_blank"><i class="snpshp-wp-twitter-alt"></i> <span class="snpshpwp_twauthor">%3$s</span> <span class="snpshpwp_twdate snpshpwp_sfont snpshpwp_theme_col">%2$s</span></a><div class="tweet-post padding-left48">%1$s</div></li>', $feed, snpshpwp_time_ago( strtotime( $data[($i-1)]->created_at ) ), $user, __('Visit us on twitter.com', 'snpshpwp') );
		}
		$i++;
	}
	$output .= '</ul>';
	set_transient( $transient_key, $output, 1800 );
	set_transient( $transient_key.'_backup', $output );
	return $output;
	else :
	$cached = get_transient( $transient_key.'_backup' );
	if ( false !== $cached ) {
		return $cached .= "\n" . '<!-- Returned from backup cache -->';
	}
	else {
		return __('Twitter unaviable', 'snpshpwp');	
	}
	endif;
}
endif;


/*
 * Time Ago
*/
if ( !function_exists('snpshpwp_time_ago') ) :
function snpshpwp_time_ago($date) {
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'snpshpwp' ), __( 'years', 'snpshpwp' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'snpshpwp' ), __( 'months', 'snpshpwp' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'snpshpwp' ), __( 'weeks', 'snpshpwp' ) ),
		array( 60 * 60 * 24 , __( 'day', 'snpshpwp' ), __( 'days', 'snpshpwp' ) ),
		array( 60 * 60 , __( 'hour', 'snpshpwp' ), __( 'hours', 'snpshpwp' ) ),
		array( 60 , __( 'minute', 'snpshpwp' ), __( 'minutes', 'snpshpwp' ) ),
		array( 1, __( 'second', 'snpshpwp' ), __( 'seconds', 'snpshpwp' ) )
	);
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
	$since = $newer_date - $date;
	if ( 0 > $since )
		return __( 'sometime', 'snpshpwp' );
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
	$output = ( 1 == $count ) ? '1 <span class="text-ago">'. $chunks[$i][1] : $count . ' <span class="text-ago">' . $chunks[$i][2];
	if ( !(int)trim($output) ){
		$output = '0' . __( 'seconds', 'snpshpwp' );
	}
	$output .= __(' ago', 'snpshpwp').'</span>';
	return $output;
}
endif;


/*
 * Contact Form
*/
if ( !function_exists('snpshpwp_contact_form') ) :
function snpshpwp_contact_form( $users = '1', $margin = ' style="margin-bottom:20px"' ) {
	global $snpshpwp_data, $snpshpwp_contact_form_id;

	if ( isset( $snpshpwp_data['contact'] ) ) $contact_options = $snpshpwp_data['contact'];
	if ( isset ( $snpshpwp_contact_form_id ) == false ) {
		global $snpshpwp_contact_form_id;
		$snpshpwp_contact_form_id = 1;
	}
	if( isset( $_POST['submitted-' . $snpshpwp_contact_form_id] ) ) {
		if( trim( $_POST['contactCaptcha'] ) === ''  ) {
			$captchaError = '<small>' . __( 'Please try again. Thank you!', 'darkone' ) . '</small>';
			$hasError = true;
		}
		elseif ( intval( $_POST['contactCaptcha'] ) !== intval( $_POST['contactCaptchaHid'] ) ) {
			$captchaError = '<small>' . __( 'Please try again. Thank you!', 'darkone' ) . '</small>';
			$hasError = true;
		}
		if( trim( $_POST['contactName'] ) === '' ) {
			$nameError = '<small>' . __( 'Please enter your name', 'snpshpwp' ) . '</small>';
			$hasError = true;
		} else {
			$name = wp_strip_all_tags(trim( $_POST['contactName'] ));
		}
		if( trim( $_POST['contactEmail'] ) === '' ) {
			$emailError = '<small>' . __( 'Please enter your email address', 'snpshpwp' ) . '</small>';
			$hasError = true;
		} else if ( !preg_match( "/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim( $_POST['contactEmail'] ) ) ) {
			$emailError = '<small>' . __('You entered an invalid email address', 'snpshpwp') . '</small>';
			$hasError = true;
		} else {
			$email = trim( $_POST['contactEmail'] );
		}
		if( trim( $_POST['contactWebsite'] ) !== '' ) {
			$website = esc_url(trim( $_POST['contactWebsite'] ));
		}
		if( trim( $_POST['commentsText'] ) === '' ) {
			$commentError = '<small>' . __( 'Please enter a message', 'snpshpwp' ) . '</small>';
			$hasError = true;
		} else {
			if ( function_exists( 'stripslashes' ) ) {
				$comments = wp_strip_all_tags(stripslashes( trim( $_POST['commentsText'] ) ));
			} else {
				$comments = wp_strip_all_tags(trim( $_POST['commentsText'] ));
			}
		}
		if ( !isset( $hasError ) ) {
		if ( $_POST['contactEmailSend'] == 'main' ) : $emailTo = $snpshpwp_data['main_contact']['email']; else : $emailTo = $contact_options[$_POST['contactEmailSend']]['email']; endif;
			$subject = get_bloginfo('name').' / From ' . $name;
			$body = "Name: $name \n\nEmail: $email \n\nWebsite: $website \n\nComments: $comments";
			$headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
			wp_mail( $emailTo, $subject, $body, $headers );
			$emailSent = true;
		}
	}
	$output = '';
	$contactName = '';
	$contactEmail = '';
	$contactWebsite = '';
	$commentsText = '';

	$output .= sprintf( '<div class="contact_form_wrapper"%1$s>', $margin );
	if( isset( $emailSent ) && $emailSent == true ) {
		if ( $snpshpwp_data['contactform_message'] == '' ) {
			$output .= '<div class="success"><img src="'.$snpshpwp_data['logo'].'"/>'. __( 'Thanks, your email was sent successfully!', 'snpshpwp' ).'</div>';
		}
		else $output .= $snpshpwp_data['contactform_message'];
	}
	else {

		$permlink = get_permalink();
		if( isset( $hasError ) ) {
			$output .= '<span class="error send block"><small>! '.__( 'Sorry, an error occured', 'snpshpwp' ).'</small></span>';
		}
		$output .= sprintf( '<form action="%1$s#snpshpwp_cform" id="snpshpwp_cform" class="comment_form contact_form" method="post">', $permlink );

		$output .= '<div class="input_wrapper_select margin-bottom20">';

		if ( $snpshpwp_data['contact'] ) :
			$i = 1;
			$users_array = explode( ',', $users );
			if ( !is_array ( $users_array ) ) { $users_array[] = $users; }
			$curr_count = count($users_array);
			$output .= '<div><select name="contactEmailSend" class="input_field_select block" '.( $curr_count == 1 ? 'disabled' : '' ).'>';

			foreach ( $contact_options as $option ) {
				if ( in_array ( $i, $users_array ) ) { $output .= '<option value="'. $i .'">'. $option['name'] .'</option>'; }
				$i++;
			}
		$output .= '</select></div>';
		endif;

		$output .= '</div>';

		if ( isset( $_POST['contactEmail'] ) ) $contactEmail = esc_attr($_POST['contactEmail']);

		$output .= '<div class="input_wrapper">';
		if( isset( $emailError ) ) {
			$output .= '<span class="error block margin_alter">! '. $emailError .'</span>';
		}
		$output .= sprintf('<input type="text" name="contactEmail" class="input_field block margin-bottom20" value="%1$s" placeholder="%2$s"/>', $contactEmail, __('EMAIL ADDRESS', 'snpshpwp') );

		$output .= '</div>';

		if ( isset( $_POST['contactName'] ) ) $contactName = esc_attr($_POST['contactName']);

		$output .= '<div class="input_wrapper">';
		if( isset( $nameError ) ) {
			$output .= '<span class="error block">! '. $nameError .'</span>';
		}
		$output .= sprintf('<input type="text" name="contactName" class="input_field block margin-bottom20" value="%1$s" placeholder="%2$s"/>', $contactName, __('NAME', 'snpshpwp') );

		$output .= '</div>';

		if ( isset( $_POST['contactWebsite'] ) ) $contactWebsite = esc_url($_POST['contactWebsite']);

		$output .= '<div class="input_wrapper">';
		if( isset( $nameError ) ) {
			$output .= '<span class="error block">!</span>';
		}
		$output .= sprintf('<input type="text" name="contactWebsite" class="input_field block margin-bottom20" value="%1$s" placeholder="%2$s"/>', $contactWebsite, __('WEBSITE', 'snpshpwp') );
		$output .= '</div>';

		if( isset( $_POST['commentsText'] ) ) { if ( function_exists( 'stripslashes' ) ) { $commentsText = wp_strip_all_tags(stripslashes( $_POST['commentsText'] )); } else { $commentsText = wp_strip_all_tags($_POST['commentsText']); } }

		$output .= '<textarea name="commentsText" class="textarea_field block margin-bottom20"  placeholder="'.__('MESSAGE GOES HERE (MAX 300 CHARS)', 'snpshpwp').'">'. $commentsText .'</textarea>';
		if( isset( $commentError ) ) {
			$output .= '<span class="error block">! '. $commentError .'</span>';
		}

		$output .= '<input type="hidden" name="submitted-'. $snpshpwp_contact_form_id .'" value="true" />';
		$output .= '<div class="snpshpwp_captcha_wrap float_left">';
		$rand = rand(0,10);
		$rand2 = rand(0,10);
		$output .= '<p class="float_left">'.$rand.' + '.$rand2.' =</p>';
		$output .= '<div class="input_wrapper snpshpwp_captcha">';
		
		$output .= '<input name="contactCaptcha" class="snpshpwp_button block bg_color_default bg_color_main_hover color_white float_left" type="text" value="" />';
		$output .= '<input name="contactCaptchaHid" class="snpshpwp_button block bg_color_default bg_color_main_hover color_white float_left" type="hidden" value="'. ($rand + $rand2).'" />';
		
		$output .= '</div></div>';
		$output .= '<input class="snpshpwp_button block bg_color_default bg_color_main_hover color_white float_right" type="submit" value="'.__('Send Email', 'snpshpwp').'" />';
		$output .= '<div class="clearfix"></div>';
		if( isset( $captchaError ) ) {
			$output .= '<span class="error block">! '. $captchaError .'</span>';
		}
		$output .= '</form>';

	}
	$output .= '</div>';
	$snpshpwp_contact_form_id++;
	return $output;
}
endif;


/**
 * Get content with formatting
*/
if ( !function_exists('get_the_content_with_formatting') ) :
function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
endif;


/**
 * Custom excerpt lenght
*/
if ( !function_exists('custom_excerpt_length') ) :
function custom_excerpt_length( $length ) {
	return 999;
}
endif;
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Time difference
*/
if ( !function_exists('time_difference') ) :
function time_difference($time_diff) {
	$args = array(
		'posts_per_page'   => 1,
		'offset'           => 0,
		'orderby'          => 'date',
		'order'            => 'ASC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);
	$first_post = get_posts($args);

	$date = $first_post[0]->post_date_gmt;

	$chunks = array(
		'years' => array( 60 * 60 * 24 * 365 ),
		'months' => array( 60 * 60 * 24 * 30 ),
		'weeks' => array( 60 * 60 * 24 * 7 ),
		'days' => array( 60 * 60 * 24 )
	);
	
	
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
	$current_time = current_time( 'mysql', $gmt = 0 );

	$newer_date = strtotime( $current_time );
	$since = $newer_date - $date;
	if ( 0 > $since )
		return __( 'sometime', 'snpshpwp' );
		
	$seconds = $chunks[$time_diff][0];
	$count = floor($since / $seconds);

	$output = ( 1 == $count ) ? '1' : $count;

	return $output;

}
endif;

/**
 * Posts metaboxes
 */
add_action( 'load-post.php', 'snpshpwp_page_meta_boxes_setup' );
add_action( 'load-post-new.php', 'snpshpwp_page_meta_boxes_setup' );


/**
 * Post Types
*/
if ( !function_exists('snpshpwp_page_meta_boxes_setup') ) :
function snpshpwp_page_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'snpshpwp_add_page_meta_boxes' );
	add_action( 'save_post', 'snpshpwp_save_page_meta_boxes', 10, 2 );
}
endif;


/**
 * Post Types
*/
if ( !function_exists('snpshpwp_add_page_meta_boxes') ) :
function snpshpwp_add_page_meta_boxes() {
	add_meta_box(
		'snpshpwp-revolution',
		esc_html__( 'SnapShopWP Full Width Revolution Slider', 'snpshpwp' ),
		'snpshpwp_revolution',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'snpshpwp-page-options',
		esc_html__( 'SnapShopWP Page Options', 'snpshpwp' ),
		'snpshpwp_page_options',
		'page',
		'side',
		'default'
	);

	add_meta_box(
		'snpshpwp-post-options',
		esc_html__( 'SnapShopWP Post Options', 'snpshpwp' ),
		'snpshpwp_post_options',
		'post',
		'side',
		'default'
	);

	add_meta_box(
		'snpshpwp-post-type',
		__('SnapShopWP Post Type Settings', 'snpshpwp'),
		'snpshpwp_post_type',
		'post',
		'side',
		'default'
	);
}
endif;


/**
 * Post Types
*/
if ( !function_exists('snpshpwp_post_type') ) :
function snpshpwp_post_type( $object, $box ) { ?>
	<p>
		<h4><?php _e('Video', 'snpshpwp'); ?></h4>
		<label for="snpshpwp-video-override"><?php _e( "Set featured area video embed (MP4)", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-video-override" id="snpshpwp-video-override"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_video_override', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-video-override"><?php _e( "Set featured area video embed (OGG)", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-video-override-ogg" id="snpshpwp-video-override-ogg"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_video_override_ogg', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-video-override"><?php _e( "Set featured area video embed from site", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-video-override-site" id="snpshpwp-video-override-site"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_video_override_site', true ) ); ?></textarea>
	</p>
	<p>
		<h4><?php _e('Audio', 'snpshpwp'); ?></h4>
		<label for="snpshpwp-audio-override"><?php _e( "Set featured area audio embed", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-audio-override" id="snpshpwp-audio-override"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_audio_override', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-audio-override"><?php _e( "Set featured area audio embed (ogg)", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-audio-override-ogg" id="snpshpwp-audio-override-ogg"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_audio_override_ogg', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-audio-override"><?php _e( "Set featured area audio embed from site", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-audio-override-site" id="snpshpwp-audio-override-site"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_audio_override_site', true ) ); ?></textarea>
	</p>
	<p>
		<h4><?php _e('Gallery', 'snpshpwp'); ?></h4>
		<label for="snpshpwp-gallery-override"><?php _e( "Override default post gallery", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-gallery-override" id="snpshpwp-gallery-override"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_gallery_override', true ) ); ?></textarea>
	</p>
	<p>
		<h4><?php _e('Link', 'snpshpwp'); ?></h4>
		<label for="snpshpwp-link-override"><?php _e( "Set featured area link", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-link-override" id="snpshpwp-link-override"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_link_override', true ) ); ?></textarea>
	</p>
<?php }
endif;


/**
 * Revolution Slider Metabox
*/
if ( !function_exists('snpshpwp_revolution') ) :
function snpshpwp_revolution( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'snpshpwp_nonce' ); ?>
	<?php
		if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			global $wpdb;
			$revsliders = array( 'none' );
			$current = get_post_meta( $object->ID, 'snpshpwp_revolution', true );
			if ( $current == '' ) {
				$current = 'none';
			}
			$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
			if($get_sliders) {
				foreach($get_sliders as $slider) {
					$revsliders[$slider->alias] = $slider->alias;
				}
			}
			else {
				$revsliders = array ( 'none' => 'none' );
			}
		}
		else {
			$revsliders = array ( 'none' => 'none' );
		}
	?>
	<p>
		<label for="snpshpwp-revolution"><?php _e( "Select Revolution Slider template to use one this page. This slider will be shown just bellow main navigation in full width.", 'snpshpwp' ); ?></label>
		<br /><br />
		<select name="snpshpwp-revolution" id="snpshpwp-revolution">
		<?php
			foreach ( $revsliders as $slider ) :
				printf( '<option value="%1$s" %2$s>%1$s</option>', $slider, ( ( $slider == $current ) ? 'selected' : '' ) );
			endforeach;
		?>
		</select>
	</p>
<?php }

function snpshpwp_page_options( $object, $box ) {
	global $snpshpwp_data;
?>
	<p>
		<label for="snpshpwp-page-title"><input value="" type="checkbox" name="snpshpwp-page-title" id="snpshpwp-page-title" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_page_title', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Remove page title", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<label for="snpshpwp-breadcrumbs"><input value="" type="checkbox" name="snpshpwp-breadcrumbs" id="snpshpwp-breadcrumbs" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_breadcrumbs', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Remove breadcrumbs", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<label for="snpshpwp-padding"><input value="" type="checkbox" name="snpshpwp-padding" id="snpshpwp-padding" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_padding', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Remove page padding", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<label for="snpshpwp-sidebar-hide"><input value="" type="checkbox" name="snpshpwp-sidebar-hide" id="snpshpwp-sidebar-hide" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_sidebar_hide', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<?php
			$snpshpwp_ready_sidebars = array( 'none' => 'none' );
			if ( isset($snpshpwp_data['sidebar']) ) {
				$snpshpwp_sidebars = $snpshpwp_data['sidebar'];
				foreach ( $snpshpwp_sidebars as $sidebar ) {
					$snpshpwp_ready_sidebars = $snpshpwp_ready_sidebars + array(sanitize_title( $sidebar['title'] ) => $sidebar['title']);
				}
			}
		?>
		<label for="snpshpwp-sidebar-override"><?php _e( "Override sidebar", 'snpshpwp' ); ?></label>
		<br /><br />
		<select name="snpshpwp-sidebar-override" id="snpshpwp-sidebar-override">
		<?php
			foreach ( $snpshpwp_ready_sidebars as $sidebar ) :
				printf( '<option value="%1$s" %2$s>%1$s</option>', $sidebar, ( ( $sidebar == $current ) ? 'selected' : '' ) );
			endforeach;
		?>
		</select>
	</p>
	<p>
		<hr/>
		<?php _e('Override default page background', 'snpshpwp'); ?>
	</p>
	<p>
		<label for="snpshpwp-page-bg"><?php _e( "Select background type", 'snpshpwp' ); ?> :</label>
		<?php
			$feat_areas = array (
					'none' => __('None', 'snpshpwp'),
					'html5video' => __('HTML5 Video', 'snpshpwp'),
					'videoembed' => __('Youtube Video Embed', 'snpshpwp')
				);
			$current = get_post_meta( $object->ID, 'snpshpwp_page_bg', true );
			if ( $current == '' ) {
				$current = 'none';
			}
			foreach ( $feat_areas as $s => $v ) :
		?>
		<br />
		<input type="radio" name="snpshpwp-page-bg" id="snpshpwp-page-bg" value="<?php echo $s; ?>" <?php echo ( ( $s == $current ) ? 'checked' : '' ); ?>/> <?php echo $v; ?>
		<?php endforeach; ?>
	</p>
	<p>
		<label for="snpshpwp-pagevideo-mp4"><?php _e( "Enter video URL (MP4) / HTML5 Video.", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-pagevideo-mp4" id="snpshpwp-pagevideo-mp4"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_pagevideo_mp4', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-pagevideo-ogv"><?php _e( "Enter video URL (OGV) / HTML5 Video.", 'snpshpwp' ); ?></label>
		<br />
		<textarea class="widefat" type="text" name="snpshpwp-pagevideo-ogv" id="snpshpwp-pagevideo-ogv"><?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_pagevideo_ogv', true ) ); ?></textarea>
	</p>
	<p>
		<label for="snpshpwp-pagevideo-embed"><?php _e( "Enter Youtube Video ID / Youtube Embed.", 'snpshpwp' ); ?></label>
		<br />
		<input class="widefat" type="text" name="snpshpwp-pagevideo-embed" id="snpshpwp-pagevideo-embed" value="<?php echo esc_attr( get_post_meta( $object->ID, 'snpshpwp_pagevideo_embed', true ) ); ?>" / >
	</p>
	<?php
		$mute = get_post_meta( $object->ID, 'snpshpwp_pagevideo_embed_mute', true );
	?>
	<p>
		<label for="snpshpwp-pagevideo-embed-mute"><input value="" type="checkbox" name="snpshpwp-pagevideo-embed-mute" id="snpshpwp-pagevideo-embed-mute" <?php if ( 1 == $mute ) echo 'checked="checked"'; ?>> <?php _e( "Mute Youtube Video", 'snpshpwp' ); ?></label>
	</p>
	<?php
		$loop = get_post_meta( $object->ID, 'snpshpwp_pagevideo_embed_loop', true );
	?>
	<p>
		<label for="snpshpwp-pagevideo-embed-loop"><input value="" type="checkbox" name="snpshpwp-pagevideo-embed-loop" id="snpshpwp-pagevideo-embed-loop" <?php if ( 1 == $loop ) echo 'checked="checked"'; ?>> <?php _e( "Loop Youtube Video", 'snpshpwp' ); ?></label>
	</p>
	<?php
		$hd = get_post_meta( $object->ID, 'snpshpwp_pagevideo_embed_hd', true );
	?>
	<p>
		<label for="snpshpwp-pagevideo-embed-hd"><input value="" type="checkbox" name="snpshpwp-pagevideo-embed-hd" id="snpshpwp-pagevideo-embed-hd" <?php if ( 1 == $hd ) echo 'checked="checked"'; ?>> <?php _e( "HD Youtube Video", 'snpshpwp' ); ?></label>
	</p>
<?php
}
endif;

/**
 * Revolution Post Options
*/
if ( !function_exists('snpshpwp_post_options') ) :
function snpshpwp_post_options( $object, $box ) {
	global $snpshpwp_data;
	?>
	<?php wp_nonce_field( basename( __FILE__ ), 'snpshpwp_nonce' ); ?>
	<?php
		$hide_feat = get_post_meta( $object->ID, 'snpshpwp_hide_featarea', true );
		$hide_feat = ( $hide_feat == '' ? $snpshpwp_data['snpshpwp_hide_featarea'] : $hide_feat );
	?>
	<p>
		<label for="snpshpwp-hide-featarea"><input value="" type="checkbox" name="snpshpwp-hide-featarea" id="snpshpwp-hide-featarea" <?php if ( 1 == $hide_feat ) echo 'checked="checked"'; ?>> <?php _e( "Hide featured area", 'snpshpwp' ); ?></label>
	</p>
	<?php
		$hide_title = get_post_meta( $object->ID, 'snpshpwp_hide_title', true );
		$hide_title = ( $hide_title == '' ? $snpshpwp_data['snpshpwp_hide_title'] : $hide_title );
	?>
	<p>
		<label for="snpshpwp-hide-title"><input value="" type="checkbox" name="snpshpwp-hide-title" id="snpshpwp-hide-title" <?php if ( 1 == $hide_title ) echo 'checked="checked"'; ?>> <?php _e( "Hide title", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_tags = get_post_meta( $object->ID, 'snpshpwp_hide_tags', true );
		$hide_tags = ( $hide_tags == '' ? $snpshpwp_data['snpshpwp_hide_tags'] : $hide_tags );
	?>
	<p>
		<label for="snpshpwp-hide-tags"><input value="" type="checkbox" name="snpshpwp-hide-tags" id="snpshpwp-hide-tags" <?php if ( 1 == $hide_tags ) echo 'checked="checked"'; ?>> <?php _e( "Hide tags", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_related_main = get_post_meta( $object->ID, 'snpshpwp_hide_related_main', true );
		$hide_related_main = ( $hide_related_main == '' ? $snpshpwp_data['snpshpwp_hide_related_main'] : $hide_related_main );
	?>
	<p>
		<label for="snpshpwp-hide-related-main"><input value="" type="checkbox" name="snpshpwp-hide-related-main" id="snpshpwp-hide-related-main" <?php if ( 1 == $hide_related_main ) echo 'checked="checked"'; ?>> <?php _e( "Hide related posts", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_meta = get_post_meta( $object->ID, 'snpshpwp_hide_meta', true );
		$hide_meta = ( $hide_meta == '' ? $snpshpwp_data['snpshpwp_hide_meta'] : $hide_meta );
	?>
	<p>
		<label for="snpshpwp-hide-meta"><input value="" type="checkbox" name="snpshpwp-hide-meta" id="snpshpwp-hide-meta" <?php if ( 1 == $hide_meta ) echo 'checked="checked"'; ?>> <?php _e( "Hide postmeta", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_author = get_post_meta( $object->ID, 'snpshpwp_hide_author', true );
		$hide_author = ( $hide_author == '' ? $snpshpwp_data['snpshpwp_hide_author'] : $hide_author );
	?>
	<p>
		<label for="snpshpwp-hide-author"><input value="" type="checkbox" name="snpshpwp-hide-author" id="snpshpwp-hide-author" <?php if ( 1 == $hide_author ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar author", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_postmeta = get_post_meta( $object->ID, 'snpshpwp_hide_postmeta', true );
		$hide_postmeta = ( $hide_postmeta == '' ? $snpshpwp_data['snpshpwp_hide_postmeta'] : $hide_postmeta );
	?>
	<p>
		<label for="snpshpwp-hide-postmeta"><input value="" type="checkbox" name="snpshpwp-hide-postmeta" id="snpshpwp-hide-postmeta" <?php if ( 1 == $hide_postmeta ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar post meta", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_share = get_post_meta( $object->ID, 'snpshpwp_hide_share', true );
		$hide_share = ( $hide_share == '' ? $snpshpwp_data['snpshpwp_hide_share'] : $hide_share );
	?>
	<p>
		<label for="snpshpwp-hide-share"><input value="" type="checkbox" name="snpshpwp-hide-share" id="snpshpwp-hide-share" <?php if ( 1 == $hide_share ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar social share", 'snpshpwp' ); ?></label>
	</p>

	<?php
		$hide_related_side = get_post_meta( $object->ID, 'snpshpwp_hide_related_side', true );
		$hide_related_side = ( $hide_related_side == '' ? $snpshpwp_data['snpshpwp_hide_related_side'] : $hide_related_side );
	?>
	<p>
		<label for="snpshpwp-hide-related-side"><input value="" type="checkbox" name="snpshpwp-hide-related-side" id="snpshpwp-hide-related-side" <?php if ( 1 == $hide_related_side ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar related posts", 'snpshpwp' ); ?></label>
	</p>
	<hr/>
	<p>
		<label for="snpshpwp-padding"><input value="" type="checkbox" name="snpshpwp-padding" id="snpshpwp-padding" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_padding', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Remove padding", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<label for="snpshpwp-breadcrumbs"><input value="" type="checkbox" name="snpshpwp-breadcrumbs" id="snpshpwp-breadcrumbs" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_breadcrumbs', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Remove breadcrumbs", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<label for="snpshpwp-sidebar-hide"><input value="" type="checkbox" name="snpshpwp-sidebar-hide" id="snpshpwp-sidebar-hide" <?php if ( 1 == get_post_meta( $object->ID, 'snpshpwp_sidebar_hide', true ) ) echo 'checked="checked"'; ?>> <?php _e( "Hide sidebar", 'snpshpwp' ); ?></label>
	</p>
	<p>
		<?php
			$snpshpwp_ready_sidebars = array( 'none' => 'none' );
			if ( isset($snpshpwp_data['sidebar']) ) {
				$snpshpwp_sidebars = $snpshpwp_data['sidebar'];
				foreach ( $snpshpwp_sidebars as $sidebar ) {
					$snpshpwp_ready_sidebars = $snpshpwp_ready_sidebars + array(sanitize_title( $sidebar['title'] ) => $sidebar['title']);
				}
			}
		?>
		<label for="snpshpwp-sidebar-override"><?php _e( "Override sidebar", 'snpshpwp' ); ?></label>
		<br /><br />
		<select name="snpshpwp-sidebar-override" id="snpshpwp-sidebar-override">
		<?php
			$current = get_post_meta( $object->ID, 'snpshpwp_sidebar_override', true );
			foreach ( $snpshpwp_ready_sidebars as $sidebar ) :
				printf( '<option value="%1$s" %2$s>%1$s</option>', $sidebar, ( ( $sidebar == $current ) ? 'selected' : '' ) );
			endforeach;
		?>
		</select>
	</p>
<?php }
endif;


/**
 * Save Metaboxes
*/
if ( !function_exists('snpshpwp_save_page_meta_boxes') ) :
function snpshpwp_save_page_meta_boxes( $post_id, $post ) {

	if ( !isset( $_POST['snpshpwp_nonce'] ) || !wp_verify_nonce( $_POST['snpshpwp_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	$new_meta_values = array();

	$new_meta_values[] = ( isset( $_POST['snpshpwp-revolution'] ) ? $_POST['snpshpwp-revolution'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-padding'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-page-title'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-breadcrumbs'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-featarea'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-title'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-tags'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-related-main'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-meta'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-author'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-postmeta'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-share'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-hide-related-side'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-sidebar-hide'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-sidebar-override'] ) ? $_POST['snpshpwp-sidebar-override'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-video-override'] ) ? $_POST['snpshpwp-video-override'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-video-override-ogg'] ) ? $_POST['snpshpwp-video-override-ogg'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-video-override-site'] ) ? $_POST['snpshpwp-video-override-site'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-audio-override'] ) ? $_POST['snpshpwp-audio-override'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-audio-override-ogg'] ) ? $_POST['snpshpwp-audio-override-ogg'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-audio-override-site'] ) ? $_POST['snpshpwp-audio-override-site'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-gallery-override'] ) ? $_POST['snpshpwp-gallery-override'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-link-override'] ) ? $_POST['snpshpwp-link-override'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-page-bg'] ) ? $_POST['snpshpwp-page-bg'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-mp4'] ) ? $_POST['snpshpwp-pagevideo-mp4'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-ogv'] ) ? $_POST['snpshpwp-pagevideo-ogv'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-embed'] ) ? $_POST['snpshpwp-pagevideo-embed'] : '' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-embed-mute'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-embed-loop'] ) ? 1 : 'no' );
	$new_meta_values[] = ( isset( $_POST['snpshpwp-pagevideo-embed-hd'] ) ? 1 : 'no' );

	$meta_keys = array();
	$meta_keys[] = 'snpshpwp_revolution';
	$meta_keys[] = 'snpshpwp_padding';
	$meta_keys[] = 'snpshpwp_page_title';
	$meta_keys[] = 'snpshpwp_breadcrumbs';
	$meta_keys[] = 'snpshpwp_hide_featarea';
	$meta_keys[] = 'snpshpwp_hide_title';
	$meta_keys[] = 'snpshpwp_hide_tags';
	$meta_keys[] = 'snpshpwp_hide_related_main';
	$meta_keys[] = 'snpshpwp_hide_meta';
	$meta_keys[] = 'snpshpwp_hide_author';
	$meta_keys[] = 'snpshpwp_hide_postmeta';
	$meta_keys[] = 'snpshpwp_hide_share';
	$meta_keys[] = 'snpshpwp_hide_related_side';
	$meta_keys[] = 'snpshpwp_sidebar_hide';
	$meta_keys[] = 'snpshpwp_sidebar_override';
	$meta_keys[] = 'snpshpwp_video_override';
	$meta_keys[] = 'snpshpwp_video_override_ogg';
	$meta_keys[] = 'snpshpwp_video_override_site';
	$meta_keys[] = 'snpshpwp_audio_override';
	$meta_keys[] = 'snpshpwp_audio_override_ogg';
	$meta_keys[] = 'snpshpwp_audio_override_site';
	$meta_keys[] = 'snpshpwp_gallery_override';
	$meta_keys[] = 'snpshpwp_link_override';
	$meta_keys[] = 'snpshpwp_page_bg';
	$meta_keys[] = 'snpshpwp_pagevideo_mp4';
	$meta_keys[] = 'snpshpwp_pagevideo_ogv';
	$meta_keys[] = 'snpshpwp_pagevideo_embed';
	$meta_keys[] = 'snpshpwp_pagevideo_embed_mute';
	$meta_keys[] = 'snpshpwp_pagevideo_embed_loop';
	$meta_keys[] = 'snpshpwp_pagevideo_embed_hd';

	$meta_values = array();

	$i = 0;

	foreach ( $meta_keys as $meta_key ) {
		
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_values[$i] && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_values[$i], true );

		elseif ( $new_meta_values[$i] && $new_meta_values[$i] != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_values[$i] );

		elseif ( '' == $new_meta_values[$i] && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		$i++;

	}

}
endif;

/**
 * Get Featured Area
*/
if ( !function_exists('snpshpwp_get_featarea') ) :
function snpshpwp_get_featarea( $feat_type )
{
	$type = get_post_format();

	$html = '';
	if($type != '')
	{
	$result;

	switch ($type) {
		case 'audio':
			$snpshpwp_audio_override = get_post_meta(get_the_ID(),'snpshpwp_audio_override',true);
			$snpshpwp_audio_override_ogg = get_post_meta(get_the_ID(),'snpshpwp_audio_override_ogg',true);
			$snpshpwp_audio_override_site = get_post_meta(get_the_ID(),'snpshpwp_audio_override_site',true);
				if( ( $snpshpwp_audio_override !== '' ) || ( $snpshpwp_audio_override_ogg !== '' )) {
					$add_poster = ( has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $feat_type ) : '' );
					$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
					$html .= sprintf('<audio class="fullwidth block" preload="auto" loop="loop" controls%4$s>
								<source src="%1$s" type="audio/mpeg">
								<source src="%2$s" type="audio/ogg">
								 %3$s
							</audio>',$snpshpwp_audio_override,$snpshpwp_audio_override_ogg, __( 'Your browser does not support the audio tag.', 'snpshpwp' ), ( $add_poster !== '' ? ' poster="'.$add_poster[0].'"  data-image-replacement="'.$add_poster[0].'"' : ''));
					}
				else if ($snpshpwp_audio_override_site !== 'none' || $snpshpwp_audio_override_site !== '') {
					$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
					$html .= sprintf('%1$s',$snpshpwp_audio_override_site);
				}
			break;
		
		case 'gallery':
			if ( SNPSHPWP_FBUILDER === true ) :

			if ( $feat_type == 'large' ) {
				$feat_type = 'snpshpwp-fullblog';
			}

			$old_gallery_shortcode = get_post_meta(get_the_ID(),'snpshpwp_gallery_override',true);
			$shortcode = '[fbuilder_slider ';
			$ctype = 'ctype="';
			$image_url = 'image="';
			$image_link = 'image_link="';
			$image_link_type = 'image_link_type="';
			$shortcode_html = 'html="';
			$text_align = 'text_align="';
			$back_color = 'back_color="';
			$text_color = 'text_color="';
			$randId = rand();
			$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.' fbuilder_module" data-modid="'.$randId.'">';
			if( $old_gallery_shortcode != '' ) {
				$old_gallery_shortcode = explode(' ',$old_gallery_shortcode);
				$old_ids;
				$num = count($old_gallery_shortcode);
				for($i=0; $i<count($old_gallery_shortcode); $i++ ) {
					$old_gallery_shortcode[$i] = explode('="',$old_gallery_shortcode[$i]);
				}
				$num = count($old_gallery_shortcode);
				for($i=0; $i<count($old_gallery_shortcode); $i++ ) {
					if($old_gallery_shortcode[$i][0] == 'ids')
						$old_ids = explode(',',$old_gallery_shortcode[$i][1]);
				}
				$i = 0;
				$last_id = explode('"',$old_ids[count($old_ids)-1]);
				$old_ids[count($old_ids)-1] = $last_id[0];
				$num_of_images = count($old_ids);
				foreach ($old_ids as $old_id) {
					$i++;
					$ctype .= 'image';
					$result = wp_get_attachment_image_src( intval($old_id), $feat_type);
					$image_url .= sprintf('%1$s',$result[0]);
					$shortcode_html .= '';
					$text_align .= '';
					$back_color .= '';
					$text_color .= '';
					if ($i<$num_of_images) {
						$ctype .= '|';
						$image_url .= '|';
						$image_link .= '|';
						$image_link_type .= '|';
						$shortcode_html .= '|';
						$text_align .= '|';
						$back_color .= '|';
						$text_color .= '|';
					}
					else {
						$ctype .= '" ';
						$image_url .= '" ';
						$image_link .= '" ';
						$image_link_type .= '" ';
						$shortcode_html .= '" ';
						$text_align .= '" ';
						$back_color .= '" ';
						$text_color .= '" ';
					}
				}
			}
			else if ( !empty($images) ){
				$i = 0;
			
				$images = get_attached_media( 'image' );
				$num_of_images = count($images);
				if ( !is_array($images) ) break;
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'fbuilder_module" data-modid="'.$randId.'">';
				foreach ($images as $image) {
					$i++;
					$ctype .= 'image';
					$result = wp_get_attachment_image_src( $image->ID, $feat_type);
					$image_url .= sprintf('%1$s',$result[0]);
					$image_link .= sprintf('%1$s|',$result[0]);
					$image_link_type .= 'lightbox-image';
					$shortcode_html .= '';
					$text_align .= '';
					$back_color .= '';
					$text_color .= '';
					if($i<$num_of_images) {
						$ctype .= '|';
						$image_url .= '|';
						$image_link .= '|';
						$image_link_type .= '|';
						$shortcode_html .= '|';
						$text_align .= '|';
						$back_color .= '|';
						$text_color .= '|';
					}
					else {
						$ctype .= '" ';
						$image_url .= '" ';
						$image_link .= '" ';
						$image_link_type .= '" ';
						$shortcode_html .= '" ';
						$text_align .= '" ';
						$back_color .= '" ';
						$text_color .= '" ';
					}
				}
			}
			$shortcode .= sprintf('%1$s %2$s %3$s %4$s %5$s %6$s %7$s %8$s auto_play="false" bot_margin=0 navigation="squared" pagination="false"][/fbuilder_slider]', $ctype, $image_url, $image_link, $image_link_type, $shortcode_html, $text_align, $back_color, $text_color);
			$html .= do_shortcode($shortcode);

		endif;

		break;
		
		case 'image':

			if ( has_post_thumbnail() ) {
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
				$html .= get_the_post_thumbnail(get_the_ID(),$feat_type);
			}
		break;

		case 'video':
			$snpshpwp_video_override = get_post_meta(get_the_ID(),'snpshpwp_video_override',true);
			$snpshpwp_video_override_ogg = get_post_meta(get_the_ID(),'snpshpwp_video_override_ogg',true);
			$snpshpwp_video_override_site = get_post_meta(get_the_ID(),'snpshpwp_video_override_site',true);
			if( ( $snpshpwp_video_override !== '' ) || ( $snpshpwp_video_override_ogg !== '' ) ) {
				$add_poster = ( has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $feat_type ) : '' );
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
				$html .= sprintf('<div class="video"><video class="fullwidth block" preload="auto" loop="loop" controls%4$s>
								<source src="%1$s" type="video/mp4">
								<source src="%2$s" type="video/ogg">
								%3$s
						</video></div>',$snpshpwp_video_override,$snpshpwp_video_override_ogg, __( 'Your browser does not support the video tag.', 'snpshpwp' ), ( $add_poster !== '' ? ' poster="'.$add_poster[0].'"  data-image-replacement="'.$add_poster[0].'"' : ''));
				
			}
			else if ( $snpshpwp_video_override_site !== '' ) {
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
				$html .= sprintf('%1$s', $snpshpwp_video_override_site);
			}
		break;
		case 'link':
			$result = get_post_meta(get_the_ID(),'snpshpwp_link_override',true);
			if($result !== 'none' && $result !== '') {
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_link">';
				$html .= sprintf( '<a href="%2$s" class="snpshpwp_image_hover_button" rel="bookmark">%1$s</a>', get_the_post_thumbnail(get_the_ID(),$feat_type), $result );
			}
		break;
		case 'quote':
			$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_quote snpshpwp_header_font">';
			$html .= sprintf( '%1$s', get_the_content() );
		break;
		default:
			if ( has_post_thumbnail() ) {
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_'.$type.'">';
				$html .= get_the_post_thumbnail(get_the_ID(),$feat_type);
			}
		break;
	}
	}
	else {
			if ( has_post_thumbnail() ) {
				$html = '<div class="snpshpwp_div_featarea snpshpwp_div_feat_image">';
				$html .= sprintf( '<a href="%1$s" class="snpshpwp_image">%2$s</a>', get_permalink(),  get_the_post_thumbnail(get_the_ID(),$feat_type) );
			}
			
	}
	if($html !== '')
		$html .= '</div>';
	return $html;
}
endif;


// Add Standard Post Type
function snpshpwp_query_format_standard($query) {
	if (isset($query->query_vars['post_format']) &&
		$query->query_vars['post_format'] == 'post-format-standard') {
		if (($post_formats = get_theme_support('post-formats')) &&
			is_array($post_formats[0]) && count($post_formats[0])) {
			$terms = array();
			foreach ($post_formats[0] as $format) {
				$terms[] = 'post-format-'.$format;
			}
			$query->is_tax = null;
			unset($query->query_vars['post_format']);
			unset($query->query_vars['taxonomy']);
			unset($query->query_vars['term']);
			unset($query->query['post_format']);
			$query->set('tax_query', array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'terms' => $terms,
					'field' => 'slug',
					'operator' => 'NOT IN'
				)
			));
		}
	}
}
add_action('pre_get_posts', 'snpshpwp_query_format_standard');

/**
 * SNAPSHOP Search Filter
*/
add_action( 'pre_get_posts', 'snpshpwp_search_filter' );
if ( !function_exists('snpshpwp_search_filter') ) :
function snpshpwp_search_filter( $query ) {
/*	if ( is_search() && !isset($_GET['post_type']) && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page' ) );
	return $query;*/
}
endif;


if ( SNPSHPWP_FBUILDER === true ) {
	/**
	 * Frontend Builder Activate
	*/
	if ( !function_exists('snpshpwp_factive') ) :
	function snpshpwp_factive() {
		global $fbuilder, $snpshpwp_data;
		$options = array (
			'bottom_margin' => $snpshpwp_data['fb_bmargin'],
			'high_rezolution_width' => $snpshpwp_data['content_width'],
			'high_rezolution_margin' => $snpshpwp_data['fb_hres_c'],
			'med_rezolution_width' => $snpshpwp_data['fb_mres_w'],
			'med_rezolution_margin' => $snpshpwp_data['fb_mres_c'],
			'med_rezolution_hide_sidebar' => ( $snpshpwp_data['fb_mres_s'] == 1 ) ? 'true' : 'false',
			'low_rezolution_width' => $snpshpwp_data['fb_lres_w'],
			'low_rezolution_margin' => $snpshpwp_data['fb_lres_c'],
			'low_rezolution_hide_sidebar' => ( $snpshpwp_data['fb_lres_s'] == 1 ) ? 'true' : 'false',
			'main_color' => $snpshpwp_data['theme_color'],
			'light_main_color' => $snpshpwp_data['theme_color'],
			'text_color' => $snpshpwp_data['theme_color_textt'],
			'title_color' => $snpshpwp_data['theme_color_dark'],
			'dark_back_color' => $snpshpwp_data['theme_color_dark'],
			'light_back_color' => $snpshpwp_data['theme_color_palee'],
			'dark_border_color' => $snpshpwp_data['theme_color_dark'],
			'light_border_color' => $snpshpwp_data['theme_color_palee']
		);
		$fbuilder->set_options($options);
	}
	endif;
	add_action('fbuilder_activate', 'snpshpwp_factive');


	/**
	 * Frontend Builder Activate
	*/
	if ( !function_exists('snpshpwp_addgroups') ) :
	function snpshpwp_addgroups() {
		global $fbuilder;
		$curr = array(
				'id' => 'SNAPSHOP WooCommerce',
				'label' => __('SNAPSHOP WooCommerce', 'snpshpwp'),
				'img' => get_template_directory_uri() . '/images/fbuilder/ss_woo.png'
			);
		array_push($fbuilder->groups, $curr);
		$curr = array(
				'id' => 'SNAPSHOP Elements',
				'label' => __('SNAPSHOP Elements', 'snpshpwp'),
				'img' => get_template_directory_uri() . '/images/fbuilder/ss_group.png'
			);
		array_push($fbuilder->groups, $curr);

	}
	endif;
	add_action('fbuilder_groups', 'snpshpwp_addgroups');
}


/**
 * Loop Actions
*/




	if ( !function_exists('snpshpwp_get_sidebar') ) :
	function snpshpwp_get_sidebar($curr, $curr_sidebar, $curr_width, $curr_position) {

		if ( is_page() || is_single() ) {
			if ( get_post_meta( get_the_ID(),'snpshpwp_sidebar_hide', true ) == '1' ) return;
		}

		global $snpshpwp_data;

		if ( $snpshpwp_data[$curr_sidebar] !== '1' ) return;

		if ( $snpshpwp_data[$curr_sidebar.'-position'] !== $curr_position ) return;

		$sidebar_class = snpshpwp_get_class('sidebar', $curr_sidebar, $curr_width, ( $curr_position == '1' ? 'left' : 'right' ) );

		printf('<div class="%1$s">', $sidebar_class);

		if ( is_page() || is_single() ) {
			$curr_override = get_post_meta( get_the_ID(),'snpshpwp_sidebar_override', true );

			if ( $curr_override !== '' && $curr_override !== 'none' ) {
				dynamic_sidebar( $curr_override );
			}
			else if ( $snpshpwp_data[$curr_sidebar] == '1' ) {
				dynamic_sidebar( $curr_sidebar );
			}
		}
		else {
			dynamic_sidebar( $curr_sidebar );
		}

		printf('</div>');

	}
	endif;



	if ( !function_exists('snpshpwp_get_class') ) :
	function snpshpwp_get_class($curr, $curr_sidebar, $curr_width, $curr_position) {

		$classes = '';
		$post_class = array();
		$full_class = 'fbuilder_column fbuilder_column-1-1';
		global $snpshpwp_data;

		if ( $curr == 'sidebar' ) {
		
				if ( is_page() || is_single() ) {
					if ( get_post_meta( get_the_ID(),'snpshpwp_sidebar_hide', true ) == '1' ) return;

/*					$curr_override = get_post_meta( get_the_ID(),'snpshpwp_sidebar_override', true );

					if ( $curr_override !== '' || $curr_override !== 'none' ) return $full_class;*/
				}

				if ( $snpshpwp_data[$curr_sidebar] !== '1' ) return;

				switch ($curr_width):
				case '3' :
				$sidebar_class = 'snpshpwp_sidebar_wrapper snpshpwp_sidebar_'.$curr_position.' fbuilder_column fbuilder_column-1-3';
				break;
				case '4' :
				$sidebar_class = 'snpshpwp_sidebar_wrapper snpshpwp_sidebar_'.$curr_position.' fbuilder_column fbuilder_column-1-4';
				break;
				case '5' :
				$sidebar_class = 'snpshpwp_sidebar_wrapper snpshpwp_sidebar_'.$curr_position.' fbuilder_column fbuilder_column-1-5';
				break;
				endswitch;
				
				return $sidebar_class;

		}
		else if ( $curr == 'content') {

				if ( is_page() || is_single() ) {
					if ( get_post_meta( get_the_ID(),'snpshpwp_sidebar_hide', true ) == '1' ) return $full_class;

					$curr_override = get_post_meta( get_the_ID(),'snpshpwp_sidebar_override', true );

					//if ( $curr_override == 'none' ) return $full_class;

				}

				if ( $snpshpwp_data[$curr_sidebar] !== '1' ) return $full_class;

				$sidebar_wrap_class = ( $snpshpwp_data[$curr_sidebar.'-position'] == 1 ? ' snpshpwp_sdbrctv_left' : ' snpshpwp_sdbrctv_right' );

				switch ($curr_width):
				case '3' :
				$blog_class = 'fbuilder_column fbuilder_column-2-3';
				break;
				case '4' :
				$blog_class = 'fbuilder_column fbuilder_column-3-4';
				break;
				case '5' :
				$blog_class = 'fbuilder_column fbuilder_column-4-5';
				break;
				endswitch;

				$blog_class = ' '.$blog_class.' '.$sidebar_wrap_class;

				return $blog_class;
		}

	}
	endif;



/* nav_menu */
function snpshpwp_nav_menu_img( $item_output, $item, $depth, $args) {
	$curr_img = esc_attr( get_post_meta( $item->ID, 'snpshpwp_menu_item_bg', TRUE ) );
	$curr_img_pos = esc_attr( get_post_meta( $item->ID, 'snpshpwp_menu_item_bg_pos', TRUE ) );
	if ( !empty($curr_img) ) $curr_img = sprintf('<img src="%1$s" class="snpshpwp_nav_menu_bg" data-position="%2$s" alt="%3$s" />', $curr_img, $curr_img_pos, __('Menu background', 'snpshpwp') );

	if ( $depth !== 0 ) return $item_output;
	return $curr_img.$item_output;
}
add_filter( 'walker_nav_menu_start_el', 'snpshpwp_nav_menu_img', 10, 4);

function  snpshpwp_nav_menu_css() {
	global $pagenow;

	if ( $pagenow != 'nav-menus.php' )
		return;
	wp_enqueue_style('snpshpwp-navmenu-css', get_template_directory_uri() . '/lib/snpshpwp-menu/nav-menu.css');

}
add_action( "admin_print_styles", 'snpshpwp_nav_menu_css' );

function snpshpwp_nav_menu_js() {
	global $pagenow;

	if ( $pagenow != 'nav-menus.php' )
		return;

	wp_enqueue_script('snpshpwp-navmenu-js', get_template_directory_uri() . '/lib/snpshpwp-menu/nav-menu.js');
	if ( function_exists( 'wp_enqueue_media' ) )
		wp_enqueue_media();

}
add_action( "admin_enqueue_scripts", 'snpshpwp_nav_menu_js' );







function snpshpwp_registration_form() {

	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {

		// check to make sure user registration is enabled
		$registration_enabled = get_option('users_can_register');
 
		// only show the registration form if allowed
		if($registration_enabled) {
			$output = snpshpwp_registration_form_fields();
		} else {
			$output = __('User registration is not enabled.', 'snpshpwp');
		}
		return $output;
	}
}

function snpshpwp_login_form() {

	if(!is_user_logged_in()) {

		$output = snpshpwp_login_form_fields();
	} else {
		// could show some logged in user info here
		$current_user = wp_get_current_user();
		$output = __("Logged in as", 'snpshpwp') . ' ' . $current_user->user_login;
	}
	return $output;
}


function snpshpwp_registration_form_fields() {

	ob_start(); ?>
		<h3><?php _e('Register New Account', 'snpshpwp'); ?></h3>

		<?php 
		snpshpwp_show_error_messages(); ?>

		<form id="snpshpwp_login_registration" class="snpshpwp_login_registration" action="<?php echo home_url('/'); ?>" method="POST">
			<fieldset>
				<p>
					<label for="snpshpwp_user_login_reg"><?php _e('Username', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_login" id="snpshpwp_user_login_reg" class="required" type="text" placeholder="<?php _e('Username', 'snpshpwp') ?>" />
				</p>
				<p>
					<label for="snpshpwp_user_email_reg"><?php _e('Email', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_email" id="snpshpwp_user_email_reg" class="required" type="email" placeholder="<?php _e('Email', 'snpshpwp') ?>" />
				</p>
				<p>
					<label for="snpshpwp_user_password_reg"><?php _e('Password', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_pass" id="snpshpwp_user_password_reg" class="required" type="password" placeholder="<?php _e('Password', 'snpshpwp') ?>" />
				</p>
				<p>
					<label for="snpshpwp_user_password_again_reg"><?php _e('Repeat Password', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_pass_confirm" id="snpshpwp_user_password_again_reg" class="required" type="password" placeholder="<?php _e('Repeat Password', 'snpshpwp') ?>" />
				</p>
				<p>
					<input type="hidden" name="snpshpwp_register_nonce" value="<?php echo wp_create_nonce('snpshpwp-register-nonce'); ?>"/>
					<input id="snpshpwp_login_register" type="submit" value="<?php _e('Register', 'snpshpwp'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}


function snpshpwp_login_form_fields() {
 
	ob_start(); ?>
		<h3><?php _e('Login', 'snpshpwp'); ?></h3>
 
		<?php
		// show any error messages after form submission
		snpshpwp_show_error_messages(); ?>
 
		<form id="snpshpwp_login_form"  class="snpshpwp_login_form" action="<?php echo home_url('/'); ?>" method="post">
			<fieldset>
				<p>
					<label for="snpshpwp_user_login"><?php _e('Username', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_login" id="snpshpwp_user_login" class="required" type="text" placeholder="<?php _e('Username', 'snpshpwp') ?>" />
				</p>
				<p>
					<label for="snpshpwp_user_pass"><?php _e('Password', 'snpshpwp'); ?></label>
					<input name="snpshpwp_user_pass" id="snpshpwp_user_pass" class="required" type="password" placeholder="<?php _e('Password', 'snpshpwp') ?>" />
				</p>
				<p>
					<input type="hidden" name="snpshpwp_login_nonce" value="<?php echo wp_create_nonce('snpshpwp-login-nonce'); ?>"/>
					<input id="snpshpwp_login_submit" type="submit" value="<?php _e('Login', 'snpshpwp'); ?>"/>
				</p>
				<p>
					<?php do_action( 'social_connect_form' ); ?>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

function snpshpwp_login_member() {
 
	if(isset($_POST['snpshpwp_login_nonce']) && wp_verify_nonce($_POST['snpshpwp_login_nonce'], 'snpshpwp-login-nonce')) {
 
		// this returns the user ID and other info from the user name
		$user = get_userdatabylogin($_POST['snpshpwp_user_login']);
 
		if(!$user) {
			// if the user name doesn't exist
			snpshpwp_errors()->add('empty_username', __('Invalid username', 'snpshpwp'));
		}
 
		if(!isset($_POST['snpshpwp_user_pass']) || $_POST['snpshpwp_user_pass'] == '') {
			// if no password was entered
			snpshpwp_errors()->add('empty_password', __('Please enter a password'));
		}
 
		// check the user's login with their password
		if(!wp_check_password($_POST['snpshpwp_user_pass'], $user->user_pass, $user->ID)) {
			// if the password is incorrect for the specified user
			snpshpwp_errors()->add('empty_password', __('Incorrect password', 'snpshpwp'));
		}
 
		// retrieve all error messages
		$errors = snpshpwp_errors()->get_error_messages();
 
		// only log the user in if there are no errors
		if(empty($errors)) {
 
			wp_setcookie($_POST['snpshpwp_user_login'], $_POST['snpshpwp_user_pass'], true);
			wp_set_current_user($user->ID, $_POST['snpshpwp_user_login']);	
			do_action('wp_login', $_POST['snpshpwp_user_login']);
 
			wp_redirect(home_url()); exit;
		}
	}
}
add_action('init', 'snpshpwp_login_member');

function snpshpwp_add_new_member() {
	if (isset( $_POST["snpshpwp_register_nonce"] ) && wp_verify_nonce($_POST['snpshpwp_register_nonce'], 'snpshpwp-register-nonce')) {
		$user_login		= $_POST["snpshpwp_user_login"];	
		$user_email		= $_POST["snpshpwp_user_email"];
		$user_pass		= $_POST["snpshpwp_user_pass"];
		$pass_confirm 	= $_POST["snpshpwp_user_pass_confirm"];
 
 
		if(username_exists($user_login)) {
			// Username already registered
			snpshpwp_errors()->add('username_unavailable', __('Username already taken'));
		}
		if(!validate_username($user_login)) {
			// invalid username
			snpshpwp_errors()->add('username_invalid', __('Invalid username'));
		}
		if($user_login == '') {
			// empty username
			snpshpwp_errors()->add('username_empty', __('Please enter a username'));
		}
		if(!is_email($user_email)) {
			//invalid email
			snpshpwp_errors()->add('email_invalid', __('Invalid email'));
		}
		if(email_exists($user_email)) {
			//Email address already registered
			snpshpwp_errors()->add('email_used', __('Email already registered'));
		}
		if($user_pass == '') {
			// passwords do not match
			snpshpwp_errors()->add('password_empty', __('Please enter a password'));
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			snpshpwp_errors()->add('password_mismatch', __('Passwords do not match'));
		}
 
		$errors = snpshpwp_errors()->get_error_messages();
 
		// only create the user in if there are no errors
		if(empty($errors)) {
 
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber'
				)
			);
			if($new_user_id) {
				// send an email to the admin alerting them of the registration
				wp_new_user_notification($new_user_id);
 
				// log the new user in
				wp_setcookie($user_login, $user_pass, true);
				wp_set_current_user($new_user_id, $user_login);	
				do_action('wp_login', $user_login);
 
				// send the newly created user to the home page after logging them in
				wp_redirect(home_url()); exit;
			}
 
		}
 
	}
}
add_action('init', 'snpshpwp_add_new_member');

function snpshpwp_errors(){
	static $wp_error;
	return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

function snpshpwp_show_error_messages() {
	if($codes = snpshpwp_errors()->get_error_codes()) {
		echo '<div class="snpshpwp_login_errors">';
		foreach($codes as $code){
			$message = snpshpwp_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}	
}

add_filter('social_connect_images_url', create_function( '$cols', 'return get_template_directory_uri() . "/images/login/";' ), 20 );

function snpshpwp_update() {
	if ( get_theme_mod('snpshpwp_version', false) === false ) {
		/* v1.0.1 init*/
		set_theme_mod('loader_active', '0');
		set_theme_mod('snpshpwp_version', '1.0.1');
	}
}
add_action('init', 'snpshpwp_update');

?>