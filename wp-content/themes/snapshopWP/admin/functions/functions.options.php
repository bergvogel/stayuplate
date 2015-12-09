<?php 
/**
 * SMOF Modified / SnapShopWP
 *
 * @package WordPress
 * @subpackage  SMOF
 * @theme snpshpwp
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{

		global $snpshpwp_data;

		//Ready Contacts
		$snpshpwp_ready_contacts = array( 'none' => 'none' );
		$counter = 0;
		if ( isset($snpshpwp_data['contact']) ) {
			$snpshpwp_contacts = $snpshpwp_data['contact'];
			foreach ( $snpshpwp_contacts as $contact ) {
				$counter++;
				$snpshpwp_ready_contacts = $snpshpwp_ready_contacts + array($counter=>$contact['name']);
			}
		}

		//Ready Sidebars
		$snpshpwp_ready_sidebars = array( 'none' => 'none' );
		if ( isset($snpshpwp_data['sidebar']) ) {
			$snpshpwp_sidebars = $snpshpwp_data['sidebar'];
			foreach ( $snpshpwp_sidebars as $sidebar ) {
				$snpshpwp_ready_sidebars = $snpshpwp_ready_sidebars + array(sanitize_title( $sidebar['title'] ) => $sidebar['title']);
			}
		}

		//Footer Elements
		$footer_elements_left = array (
			'disabled' => array (
				'login-link' => 'login-link',
				'menu' => 'menu',
				'network-icons' => 'network-icons',
				'tagline-alt' => 'tagline-alt',
				'to-the-top' => 'to-the-top'
			),
			"enabled" => array (
				'tagline' => 'tagline',
				'placebo' => 'placebo'
			)
		);
		$footer_elements_right = array (
			'disabled' => array (
				'login-link' => 'login-link',
				'menu' => 'menu',
				'network-icons' => 'network-icons',
				'tagline' => 'tagline',
				'tagline-alt' => 'tagline-alt',
				'to-the-top' => 'to-the-top'
			),
			"enabled" => array (
				'login-link' => 'login-link',
				'placebo' => 'placebo'
			)
		);


		//Header Elements
		$header_elements_left = array (
			'disabled' => array (
				'login-link' => 'login-link',
				'network-icons' => 'network-icons',
				'search' => 'search',
				'sidenav' => 'sidenav',
				'tagline' => 'tagline',
				'tagline-alt' => 'tagline-alt',
				'woo-cart' => 'woo-cart'
			),
			"enabled" => array (
				'logo' => 'logo',
				'menu' => 'menu',
				'placebo' => 'placebo'
			)
		);

		$header_elements_right = array (
			'disabled' => array (
				'login-link' => 'login-link',
				'logo' => 'logo',
				'menu' => 'menu',
				'network-icons' => 'network-icons',
				'sidenav' => 'sidenav',
				'tagline' => 'tagline',
				'tagline-alt' => 'tagline-alt',
				'woo-cart' => 'woo-cart'
			),
			"enabled" => array (
				'search' => 'search',
				'placebo' => 'placebo'
			)
		);

		//Header Bar Elements
		$header_bar_elements_left = array (
			'disabled' => array (
				'language-bar' => 'language-bar',
				'login-link' => 'login-link',
				'menu' => 'menu',
				'network-icons' => 'network-icons',
				'tagline-alt' => 'tagline-alt',
			),
			"enabled" => array (
				'tagline' => 'tagline',
				'placebo' => 'placebo'
			)
		);

		$header_bar_elements_right = array (
			'disabled' => array (
				'language-bar' => 'language-bar',
				'login-link' => 'login-link',
				'menu' => 'menu',
				'network-icons' => 'network-icons',
				'tagline' => 'tagline',
				'tagline-alt' => 'tagline-alt',
			),
			"enabled" => array (
				'placebo' => 'placebo'
			)
		);


		$curr_fonts = array(
			'Lovelo' => 'Lovelo',
			'Arial'=>'Arial',
			'Verdana, Geneva'=>'Verdana, Geneva',
			'Trebuchet'=>'Trebuchet',
			'Georgia' =>'Georgia',
			'Times New Roman'=>'Times New Roman',
			'Tahoma, Geneva'=>'Tahoma, Geneva',
			'Palatino'=>'Palatino',
			'Helvetica'=>'Helvetica'
		);

		//Create Menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$snpshpwp_ready_menus = array('none'=>'none');
		foreach ( $menus as $menu ) {
			$snpshpwp_ready_menus[$menu->slug] = $menu->name;
		}

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> __('General', 'snpshpwp'),
						"id"			=> "snpshpwp_grp_general",
						"type" 		=> "group"
				);
$of_options[] = array( 	"name" 		=> __('General Settings', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-logo"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Blog Archive', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_bloglayout",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Blog Archive', 'snpshpwp')."</h3>
						".__('Choose blog layout.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Blog Layout', 'snpshpwp'),
						"desc" 		=> __('Select your default blog layout.', 'snpshpwp'),
						"id" 		=> "blog_layout",
						"std" 		=> "0",
						"type" 		=> "select",
						"options" 	=> array(
										"0" => __("1 Column / Excerpt", "snpshpwp"),
										"1" => __("1 Column / More Tag", "snpshpwp"),
										"2" => __("2 Columns / Excerpt", "snpshpwp"),
										"3" => __("3 Columns / Excerpt", "snpshpwp"),
										"4" => __("4 Columns / Excerpt", "snpshpwp"),
										"5" => __("5 Columns / Excerpt", "snpshpwp")
						),
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __('Excerpt Lenght', 'snpshpwp'),
						"desc" 		=> __('If the blog option is set to excerpt you can set your excerpt lenght.', 'snpshpwp'),
						"id" 		=> "blog_excerpt",
						"std" 		=> "768",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "1024",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Blog Post', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_blogpost",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Blog Post', 'snpshpwp')."</h3>
						".__('Edit your default blog post layout.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Hide Featured Image', 'snpshpwp'),
						"desc" 		=> __('Hide featured images on single posts.', 'snpshpwp'),
						"id" 		=> "snpshpwp_hide_featarea",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __('Hide Post Title', 'snpshpwp'),
						"desc" 		=> __('Hide post titles on single posts.', 'snpshpwp'),
						"id" 		=> "snpshpwp_hide_title",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __("Hide Post Tags", "snpshpwp"),
						"desc" 		=> __("Hide post tags at the end of a single post.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_tags",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __("Hide Post Related", "snpshpwp"),
						"desc" 		=> __("Hide post realted in the main area.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_related_main",
						"std" 		=> 1,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __('Post Related Columns', 'snpshpwp'),
						"desc" 		=> __('Choose your related posts insert type.', 'snpshpwp'),
						"id" 		=> "snpshpwp_related_columns",
						"std" 		=> "3",
						"type" 		=> "select",
						"options" 	=> array(
										"0" => __('1 Column Small', 'snpshpwp'),
										"1" => __('1 Column', 'snpshpwp'),
										"2" => __('2 Columns', 'snpshpwp'),
										"3" => __('3 Columns', 'snpshpwp'),
										"4" => __('4 Columns', 'snpshpwp'),
										"5" => __('5 Columns', 'snpshpwp'),
						)
				);
$of_options[] = array( "type" 		=> "end_min" );

$of_options[] = array( 	"name" 		=> __('Blog Post Right (Meta) Sidebar', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_blogmeta",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Blog Post Right (Meta) Sidebar', 'snpshpwp')."</h3>
						".__('Edit your meta sidebar options.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Hide Post Meta Sidebar', 'snpshpwp'),
						"desc" 		=> __('Hide the post meta sidebar on single posts. This info is shown on the sinlge post right.', 'snpshpwp'),
						"id" 		=> "snpshpwp_hide_meta",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Author Information", "snpshpwp"),
						"desc" 		=> __("Hide author information in the post meta sidebar.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_author",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Post Meta", "snpshpwp"),
						"desc" 		=> __("Hide post meta in the post meta sidebar.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_postmeta",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Post Share", "snpshpwp"),
						"desc" 		=> __("Hide post share in the post meta sidebar.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_share",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Post Related", "snpshpwp"),
						"desc" 		=> __("Hide related posts in the post meta sidebar.", "snpshpwp"),
						"id" 		=> "snpshpwp_hide_related_side",
						"std" 		=> 1,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );


$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Contact Form Custom Message', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_cformmsg",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">" . __('Contact Form Custom Message', 'snpshpwp') . "</span></h3>" .
						__('Set your Contact Form custom message. This message will appear once the E-Mail is sent.', 'snpshpwp'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Contact Form Custom Message', 'snpshpwp'),
						"desc" 		=> __('Enter cutom HTML/Text.', 'snpshpwp'),
						"id" 		=> "contactform_message",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Contact', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_contacts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">" . __('Contacts Settings - (Our Team)', 'snpshpwp') . "</span></h3>" .
						__('Setup your contacts. You can use these later as your network-icons header/footer element, in SnapShop Team shortcode and in SnapShop contact form.', 'snpshpwp'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Contact Settings / Team Members', 'snpshpwp'),
						"id" 		=> "contact",
						"std" 		=> array(
										1 => array (
											'order' => 1,
											'name' => 'Your first Contact!',
											'url' => get_template_directory_uri() . '/images/team.jpg',
											'job' => 'designer',
											'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
											'email' => 'google@gmail.com',
											'contact' => array (
												1 => array (
													'socialnetworksurl' => '#',
													'socialnetworks' => 'white_facebook.png'
												)
											)
										)
						),
						"type" 		=> "contact"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Favorites Icon', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_favicons",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Favorites Icon', 'snpshpwp')."</span></h3>
						".__('Setup you favorites icon and iPad, iPhone icons for your site.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Upload Favorites Icon', 'snpshpwp'),
						"desc" 		=> __('Favorites icon (.png or .ico)', 'snpshpwp'),
						"id" 		=> "favicon",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_favicon.png',
						"type" 		=> "media",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Upload Icon - iPad, iPhone', 'snpshpwp'),
						"desc" 		=> __('iPhone icon (.png 57x57px)', 'snpshpwp'),
						"id" 		=> "apple_ti57",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_favicon.png',
						"type" 		=> "media",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Upload Icon - iPad, iPhone', 'snpshpwp'),
						"desc" 		=> __('iPad icon (.png 72x72px)', 'snpshpwp'),
						"id" 		=> "apple_ti72",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_favicon.png',
						"type" 		=> "media",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Upload Icon - iPad, iPhone', 'snpshpwp'),
						"desc" 		=> __('iPhone Retina icon (.png 114x114px)', 'snpshpwp'),
						"id" 		=> "apple_ti114",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_favicon.png',
						"type" 		=> "media",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Upload Icon - iPad, iPhone', 'snpshpwp'),
						"desc" 		=> __('iPad Retina icon (.png 144x144px)', 'snpshpwp'),
						"id" 		=> "apple_ti144",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_favicon.png',
						"type" 		=> "media",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Header Bar', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-header"
				);

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Bar', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "headerbar",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Header Bar', 'snpshpwp')."</h3>
						".__('Basic Settings', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Enable Header Bar ", "snpshpwp"),
						"desc" 		=> __("Disable/Enable Header Bar element", "snpshpwp"),
						"id" 		=> "header_bar",
						"std" 		=> 1,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Height', 'snpshpwp'),
						"desc" 		=> __('Set the header bar height. Default value 30px.', 'snpshpwp'),
						"id" 		=> "header_bar_height",
						"std" 		=> "30",
						"min" 		=> "16",
						"step"		=> "1",
						"max" 		=> "100",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Bar Elements', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "header_bar_elements",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Elements', 'snpshpwp')."</h3>
						".__('Activate and edit elements in the header bar', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Bar Left Elements', 'snpshpwp'),
						"desc" 		=> __('Left elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "header_bar_left",
						"std" 		=> $header_bar_elements_left,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Header Right Elements', 'snpshpwp'),
						"desc" 		=> __('Right elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "header_bar_right",
						"std" 		=> $header_bar_elements_right,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Menu', 'snpshpwp'),
						"desc" 		=> __('Select header bar custom menu.', 'snpshpwp'),
						"id" 		=> "header_bar_menu",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_menus,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Social Networks', 'snpshpwp'),
						"desc" 		=> __('Select contact option for the header bar network icons.', 'snpshpwp'),
						"id" 		=> "header_bar_networks",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_contacts,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Header Bar Tagline", "snpshpwp"),
						"desc" 		=> __("Enter header bar tagline text.", "snpshpwp"),
						"id" 		=> "header_bar_tagline",
						"std" 		=> 'FramedWP by br0',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Header Bar Tagline Alt", "snpshpwp"),
						"desc" 		=> __("Enter header bar tagline alternative text.", "snpshpwp"),
						"id" 		=> "header_bar_tagline_alt",
						"std" 		=> 'WordPress',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Bar Style', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "header_bar_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup custom header bar colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Bar Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_header_bar_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_bar_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_bar_lnk",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_header_bar_lnkhvr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Bar Border', 'snpshpwp'),
						"desc" 		=> __('Border <em>Default: #cccccc</em>', 'snpshpwp'),
						"id" 		=> "s_header_bar_brdr",
						"std" 		=> "#cccccc",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Bar Font', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "header_bar_font",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Header Bar Font', 'snpshpwp'),
						"desc" 		=> __('Header bar font', 'snpshpwp'),
						"id" 		=> "f_header_bar_mn",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Header Bar', 'snpshpwp'),
						"desc" 		=> __('Use Google Font', 'snpshpwp'),
						"id" 		=> "f_header_bar_mnggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Header Bar Font Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_header_bar_mnggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Header', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-header"
				);
$of_options[] = array( "type" 		=> "start_section" );

$of_options[] = array( 	"name" 		=> __('Header', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "headersettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Header', 'snpshpwp')."</h3>
						".__('Basic Settings', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Height', 'snpshpwp'),
						"desc" 		=> __('Set the header height. Default value 60px.', 'snpshpwp'),
						"id" 		=> "header_height",
						"std" 		=> "60",
						"min" 		=> "16",
						"step"		=> "1",
						"max" 		=> "150",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Sticky Header", "snpshpwp"),
						"desc" 		=> __("Enable sticky header. When users scrolls down the header will be collected and on screen at all times.", "snpshpwp"),
						"id" 		=> "header_sticky",
						"std" 		=> 1,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Area Max-Width', 'snpshpwp'),
						"desc" 		=> __('Set the header area max-width. Default value 1920px.', 'snpshpwp'),
						"id" 		=> "header_width",
						"std" 		=> "1920",
						"min" 		=> "640",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Mode', 'snpshpwp'),
						"desc" 		=> __('Choose your header mode.', 'snpshpwp'),
						"id" 		=> "header_mode",
						"std" 		=> "4",
						"type" 		=> "select",
						"options" 	=> array(
										"default" => __('Left/Right', 'snpshpwp'),
										"center" => __('Central', 'snpshpwp')
						),
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Elements', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "header_elements",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Elements', 'snpshpwp')."</h3>
						".__('Activate and edit elements in the header', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Left Elements', 'snpshpwp'),
						"desc" 		=> __('Left elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "header_left",
						"std" 		=> $header_elements_left,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Header Right Elements', 'snpshpwp'),
						"desc" 		=> __('Right elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "header_right",
						"std" 		=> $header_elements_right,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Header Logo', 'snpshpwp'),
						"desc" 		=> __('Upload your sticky logo using the native media uploader, or define the URL directly.', 'snpshpwp'),
						"id" 		=> "header_logo",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_logo.png',
						"type" 		=> "media"
				);
$of_options[] = array( 	"name" 		=> __("Header Tagline", "snpshpwp"),
						"desc" 		=> __("Enter header tagline text.", "snpshpwp"),
						"id" 		=> "header_tagline",
						"std" 		=> 'FramedWP by br0',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Header Tagline Alt", "snpshpwp"),
						"desc" 		=> __("Enter header tagline alternative text.", "snpshpwp"),
						"id" 		=> "header_tagline_alt",
						"std" 		=> 'WordPress',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Sidenav Left', 'snpshpwp'),
						"desc" 		=> __('Select sidebar for the side navigation on left.', 'snpshpwp'),
						"id" 		=> "header_left_sidenav",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_sidebars,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Sidenav Right', 'snpshpwp'),
						"desc" 		=> __('Select sidebar for the side navigation on right.', 'snpshpwp'),
						"id" 		=> "header_right_sidenav",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_sidebars,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Menu', 'snpshpwp'),
						"desc" 		=> __('Select header custom menu.', 'snpshpwp'),
						"id" 		=> "header_menu",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_menus,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Header Social Networks', 'snpshpwp'),
						"desc" 		=> __('Select contact option for the header network icons.', 'snpshpwp'),
						"id" 		=> "header_networks",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_contacts,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Custom Header Image', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_header_image",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Custom Header Image', 'snpshpwp')."</h3>
						".__('This image will appear just before the header. Use it as Header Custom Image or logo in central mode.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Custom Image', 'snpshpwp'),
						"desc" 		=> __('Upload your custom header image using the native media uploader, or define the URL directly.', 'snpshpwp'),
						"id" 		=> "header_custom",
						"std" 		=> '',
						"type" 		=> "media",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Custom Header Height', 'snpshpwp'),
						"desc" 		=> __('Set the header height. Default value 100px.', 'snpshpwp'),
						"id" 		=> "header_custom_height",
						"std" 		=> "100",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "400",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Style', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "header_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup your custom header colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Header Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_header_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_lnk",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_header_lnkhvr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Element Border', 'snpshpwp'),
						"desc" 		=> __('Border <em>Default: #cccccc</em>', 'snpshpwp'),
						"id" 		=> "s_header_brdr",
						"std" 		=> "#cccccc",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Top Border', 'snpshpwp'),
						"desc" 		=> __('Top border <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_tpbrdr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Dropdown Background', 'snpshpwp'),
						"desc" 		=> __('Dropdown background <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_header_drpdwn_bg",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Dropdown Link', 'snpshpwp'),
						"desc" 		=> __('Dropdown link <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_header_drpdwn_lnk",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Header Dropdown Link Hover', 'snpshpwp'),
						"desc" 		=> __('Dropdown link hover <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_header_drpdwn_lnkhvr",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Load Bar', 'snpshpwp'),
						"desc" 		=> __('Load bar <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_header_ldbr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Header Font', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_header_font1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Main Header Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Main Header Font', 'snpshpwp'),
						"desc" 		=> __('Main menu font', 'snpshpwp'),
						"id" 		=> "f_header_mn",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Main Header', 'snpshpwp'),
						"desc" 		=> __('Use Google Font', 'snpshpwp'),
						"id" 		=> "f_header_mnggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Main Header Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google Font', 'snpshpwp'),
						"id" 		=> "f_header_mnggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Dropdown Header Font', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_header_font2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Dropdown Header Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Dropdown Header Font', 'snpshpwp'),
						"desc" 		=> __('Dropdown font', 'snpshpwp'),
						"id" 		=> "f_header_drpdwn",
						"std" 		=> array( "face"=>"Times New Roman", "size"=>"14px", "style"=>"italic", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Header Dropdown', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_header_drpdwnggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Header Drop Down Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_header_drpdwnggl",
						"std" 		=> array( "face"=>"PT Serif", "size"=>"14px", "style"=>"italic", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );



$of_options[] = array( 	"name" 		=> __('Breadcrumbs', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-single"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Breadcrumbs', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "headersettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Breadcrumbs', 'snpshpwp')."</h3>
						".__('Setup basic breadcrumbs settings', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Disable Breadcrumbs", "snpshpwp"),
						"desc" 		=> __("This option will disable the breadcrumbs area.", "snpshpwp"),
						"id" 		=> "breadcrumbs_active",
						"std" 		=> 0,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Height', 'snpshpwp'),
						"desc" 		=> __('Set the breadcrumbs height. Default value 60px.', 'snpshpwp'),
						"id" 		=> "breadcrumbs_height",
						"std" 		=> "60",
						"min" 		=> "16",
						"step"		=> "1",
						"max" 		=> "150",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Breadcrumbs Tagline", "snpshpwp"),
						"desc" 		=> __("Enter pre breadcrumbs text. You can use icons icon font codes also.", "snpshpwp"),
						"id" 		=> "breadcrumbs_tagline",
						"std" 		=> '',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Style', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "breadcrumbs_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup your custom breadcrumbs colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_breadcrumbs_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_breadcrumbs_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_breadcrumbs_lnk",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_breadcrumbs_lnkhvr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Element Border', 'snpshpwp'),
						"desc" 		=> __('Border <em>Default: #cccccc</em>', 'snpshpwp'),
						"id" 		=> "s_breadcrumbs_brdr",
						"std" 		=> "#cccccc",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Breadcrumbs Font', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "breadcrumbs_font",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Breadcrumbs Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Breadcrumbs Font', 'snpshpwp'),
						"desc" 		=> __('Breadcrumbs font', 'snpshpwp'),
						"id" 		=> "f_breadcrumbs",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Breadcrumbs', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_breadcrumbs_ggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Breadcrumbs Font Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_breadcrumbs_ggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );


$of_options[] = array( 	"name" 		=> __('Pages and Posts', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-single"
				);

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Pages', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "pages-settings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Pages', 'snpshpwp')."</h3>
						".__('Setup your basic options for pages', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Hide Page Title', 'snpshpwp'),
						"desc" 		=> __('Hide titles on basic pages.', 'snpshpwp'),
						"id" 		=> "snpshpwp_hide_page_title",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Enable Comments on Pages", "snpshpwp"),
						"desc" 		=> __("If you need comments on pages please enable this switch.", "snpshpwp"),
						"id" 		=> "enable_comments",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Pages and Posts Colors', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "snpshpwp_pages_posts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup your custom page/post colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Pages and Posts Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_post_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_post_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Headings', 'snpshpwp'),
						"desc" 		=> __('Headings <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_post_hdr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_post_lnk",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_post_lnkhvr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Element Border', 'snpshpwp'),
						"desc" 		=> __('Border <em>Default: #cccccc</em>', 'snpshpwp'),
						"id" 		=> "s_post_brdr",
						"std" 		=> "#cccccc",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Button', 'snpshpwp'),
						"desc" 		=> __('Button background <em>Default: #555555</em>', 'snpshpwp'),
						"id" 		=> "s_post_bttn",
						"std" 		=> "#555555",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Pages and Posts Button Hover', 'snpshpwp'),
						"desc" 		=> __('Button background hover <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_post_bttnhvr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Button Link', 'snpshpwp'),
						"desc" 		=> __('Button link <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_post_bttnlnk",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Button Link Hover', 'snpshpwp'),
						"desc" 		=> __('Button link hover <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_post_bttnlnkhvr",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Pages and Posts Font #1', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "post_font1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Text Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Page/Post Text Font', 'snpshpwp'),
						"desc" 		=> __('Text font', 'snpshpwp'),
						"id" 		=> "f_post_mn",
						"std" 		=> array( "face"=>"Arial", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Pages/Posts', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_post_mnggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Pages/Posts Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_post_mnggl",
						"std" 		=> array( "face"=>"PT Serif", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Pages and Posts Font #2', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "post_font2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Headings Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Pages/Posts Heading Font', 'snpshpwp'),
						"desc" 		=> __('Headings font', 'snpshpwp'),
						"id" 		=> "f_post_hdr",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Pages/Posts Heading Font', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_post_hdrggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Pages/Posts Heading Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_post_hdrggl",
						"std" 		=> array( "face"=>"PT Serif", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Pages and Posts Font #3', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "post_font3",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Decriptions Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Page/Post Description Font', 'snpshpwp'),
						"desc" 		=> __('Description font', 'snpshpwp'),
						"id" 		=> "f_post_crsv",
						"std" 		=> array( "face"=>"Times New Roman", "size"=>"14px", "style"=>"italic", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Page/Post Description Font', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_post_crsvggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Page/Post Description Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_post_crsvggl",
						"std" 		=> array( "face"=>"PT Serif", "size"=>"14px", "style"=>"italic", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Sidebars', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-sidebar"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Sidebars', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "sidebarsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Sidebars', 'snpshpwp')."</h3>
						".__('Setup default post/product archive sidebar. Create custom sidebars to use on pages', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Sidebar Width', 'snpshpwp'),
						"desc" 		=> __('Choose your sidebars width.', 'snpshpwp'),
						"id" 		=> "sidebar-size",
						"std" 		=> "3",
						"type" 		=> "select",
						"options" 	=> array(
										"3" => "Third",
										"4" => "Fourth",
										"5" => "Fifth"
						)
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Sidebars', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_sidebars",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Activate Sidebars', 'snpshpwp')."</h3>
						".__('Setup and activate default sidebars', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Blog Archive Sidebar', 'snpshpwp'),
						"desc" 		=> __('Enable Blog Archive sidebar. This sidebar appears on Blog Archive pages.', 'snpshpwp'),
						"id" 		=> "sidebar-blog",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Sidebar Position", "snpshpwp"),
						"desc" 		=> __("Use left or right sidebar.", "snpshpwp"),
						"id" 		=> "sidebar-blog-position",
						"std" 		=> 0,
						"on" 		=> "Left",
						"off" 		=> "Right",
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Single Posts Sidebar', 'snpshpwp'),
						"desc" 		=> __('Enable Single Posts sidebar. This sidebar appears on Single Posts.', 'snpshpwp'),
						"id" 		=> "sidebar-single",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Sidebar Position", "snpshpwp"),
						"desc" 		=> __("Use left or right sidebar.", "snpshpwp"),
						"id" 		=> "sidebar-single-position",
						"std" 		=> 0,
						"on" 		=> "Left",
						"off" 		=> "Right",
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Page Sidebar', 'snpshpwp'),
						"desc" 		=> __('Enable Page sidebar. This sidebar appears on Pages.', 'snpshpwp'),
						"id" 		=> "sidebar-page",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Sidebar Position", "snpshpwp"),
						"desc" 		=> __("Use left or right sidebar.", "snpshpwp"),
						"id" 		=> "sidebar-page-position",
						"std" 		=> 0,
						"on" 		=> "Left",
						"off" 		=> "Right",
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Sidebars', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "sidebarsettingssidebars",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Sidebars Manager', 'snpshpwp')."</h3>
						".__('Create new sidebars to use in your pages and posts. Create unlimited number of sidebars and use them in Frontend Builder via Sidebar element.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Sidebars', 'snpshpwp'),
						"desc" 		=> __('Unlimited sidebars for your pages/posts.', 'snpshpwp'),
						"id" 		=> "sidebar",
						"std" 		=> array(
										1 => array(
											'order' => 1,
											'title' => 'Your first Sidebar!'
									)
						),
						"type" 		=> "sidebar"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );


$of_options[] = array( 	"name" 		=> __('Footer', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-footer"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_info_1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer', 'snpshpwp')."</h3>
						".__('Enable/Disable Footer in whole', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Enable Footer", "snpshpwp"),
						"desc" 		=> __("Disable/Enable whole footer area", "snpshpwp"),
						"id" 		=> "footer_area",
						"std" 		=> 0,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Footer', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_info_2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer Widgetized Areas', 'snpshpwp')."</h3>
						".__('Setup footer widgetized areas', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Enable Widget Areas", "snpshpwp"),
						"desc" 		=> __("Disable/Enable footer widget areas", "snpshpwp"),
						"id" 		=> "footer_widgets",
						"std" 		=> 1,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( 	"name" 		=> __('Footer Widget Areas', 'snpshpwp'),
						"desc" 		=> __('Select number of footer widget areas.', 'snpshpwp'),
						"id" 		=> "footer_sidebar",
						"std" 		=> "4",
						"type" 		=> "select",
						"options" 	=> array(
										"1" => "1",
										"2" => "2",
										"3" => "3",
										"4" => "4",
										"5" => "5"
						),
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Footer Widget Areas Max-Width', 'snpshpwp'),
						"desc" 		=> __('Set the footer widget areas max-width. Default value 1600px.', 'snpshpwp'),
						"id" 		=> "footer_width",
						"std" 		=> "1600",
						"min" 		=> "640",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Style', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup your custom footer colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Footer Top Border', 'snpshpwp'),
						"desc" 		=> __('Top border hover <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_tpbrdr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_footer_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Widget Title', 'snpshpwp'),
						"desc" 		=> __('Widget title <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_hdr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lnk",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lnkhvr",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Font #1', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_font1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer Widget Title Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Footer Widget Title Font', 'snpshpwp'),
						"desc" 		=> __('Widget title font', 'snpshpwp'),
						"id" 		=> "f_footer_wt",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Footer Widget Title Font', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_footer_wtggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Footer Widget Title Font Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_footer_wtggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );

$of_options[] = array( 	"name" 		=> __('Footer Font #2', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_font2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Widget Text Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Footer Font #2', 'snpshpwp'),
						"desc" 		=> __('Widget text font', 'snpshpwp'),
						"id" 		=> "f_footer_wtxt",
						"std" 		=> array( "face"=>"Arial", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Widget Text Font', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_footer_wtxtggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Widget Text Font Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_footer_wtxtggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Footer Bar', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_general",
						"icon" 		=> "br0admin-admin-footer"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Bar', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_bar_info_1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer Bar', 'snpshpwp')."</h3>
						".__('Enable/Disable Footer.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Enable Footer Bar", "snpshpwp"),
						"desc" 		=> __("Disable/Enable footer bar", "snpshpwp"),
						"id" 		=> "footer_bar",
						"std" 		=> 0,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( 	"name" 		=> __('Footer Bar Height', 'snpshpwp'),
						"desc" 		=> __('Set the footer bar height. Default value 60px.', 'snpshpwp'),
						"id" 		=> "footer_height",
						"std" 		=> "60",
						"min" 		=> "16",
						"step"		=> "1",
						"max" 		=> "150",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Elements', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_footer",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Elements', 'snpshpwp')."</h3>
						".__('Activate and edit elements in the footer', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Footer Left', 'snpshpwp'),
						"desc" 		=> __('Left elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "footer_left",
						"std" 		=> $footer_elements_left,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Footer Right', 'snpshpwp'),
						"desc" 		=> __('Right elements <em>Drag and drop to activate</em>', 'snpshpwp'),
						"id" 		=> "footer_right",
						"std" 		=> $footer_elements_right,
						"type" => "sorter"
				);
$of_options[] = array( 	"name" 		=> __('Footer Menu', 'snpshpwp'),
						"desc" 		=> __('Select top header custom menu.', 'snpshpwp'),
						"id" 		=> "footer_menu",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_menus,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Footer Networks', 'snpshpwp'),
						"desc" 		=> __('Select predefined contact to show its footer network icons.', 'snpshpwp'),
						"id" 		=> "footer_networks",
						"std" 		=> "none",
						"type" 		=> "select",
						"options" 	=> $snpshpwp_ready_contacts,
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Footer Tagline", "snpshpwp"),
						"desc" 		=> __("Enter header tagline text.", "snpshpwp"),
						"id" 		=> "footer_tagline",
						"std" 		=> 'SnapShopWP 2014',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Footer Tagline Alt", "snpshpwp"),
						"desc" 		=> __("Enter header tagline alternative text.", "snpshpwp"),
						"id" 		=> "footer_tagline_alt",
						"std" 		=> 'WordPress',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Footer Up Arrow", "snpshpwp"),
						"desc" 		=> __("Enter text or FontAwesome icon code for the Up Arrow.", "snpshpwp"),
						"id" 		=> "footer_up_text",
						"std" 		=> '',
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Bar Style', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_bar_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Colors', 'snpshpwp')."</h3>
						".__('Setup your custom footer colors', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Footer Bar Element Background', 'snpshpwp'),
						"desc" 		=> __('Background <em>Default: #ffffff</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lmnt_bg",
						"std" 		=> "#ffffff",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Bar Element Text', 'snpshpwp'),
						"desc" 		=> __('Text <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lmnt_txt",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Bar Element Link', 'snpshpwp'),
						"desc" 		=> __('Link <em>Default: #222222</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lmnt_lnk",
						"std" 		=> "#222222",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Bar Element Link Hover', 'snpshpwp'),
						"desc" 		=> __('Link hover <em>Default: #c74c44</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lmnt_lnkhvr",
						"std" 		=> "#c74c44",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Footer Bar Element Border', 'snpshpwp'),
						"desc" 		=> __('Border <em>Default: #cccccc</em>', 'snpshpwp'),
						"id" 		=> "s_footer_lmnt_brdr",
						"std" 		=> "#cccccc",
						"type" 		=> "color",
						"class" 	=> "of-group-smaller"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Footer Bar Font #1', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "footer_font1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer Bar Font', 'snpshpwp')."</h3>
						".__('Use override with Google Font if you wish to use font from the Google Fonts Directory.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Select Footer Bar Font', 'snpshpwp'),
						"desc" 		=> __('Footer bar font', 'snpshpwp'),
						"id" 		=> "f_footer_fbr",
						"std" 		=> array( "face"=>"Lovelo", "size"=>"16px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"options" 	=> $curr_fonts,
						"class" 	=> "of-group-google"
				);
$of_options[] = array( 	"name" 		=> __('Use Google Font for Footer Bar Font', 'snpshpwp'),
						"desc" 		=> __('Use Google font', 'snpshpwp'),
						"id" 		=> "f_footer_fbrggl_on",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-switch"
				);
$of_options[] = array( 	"name" 		=> __('Select Footer Bar Font Google Font', 'snpshpwp'),
						"desc" 		=> __('Select Google font', 'snpshpwp'),
						"id" 		=> "f_footer_fbrggl",
						"std" 		=> array( "face"=>"PT Sans", "size"=>"14px", "style"=>"normal", "weight"=>"400"),
						"type" 		=> "typography",
						"class" 	=> "of-group-google"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );


	$of_options[] = array( 	"name" 		=> __('Woocommerce', 'snpshpwp'),
							"type" 		=> "heading",
							"group" 	=> "snpshpwp_grp_general",
							"icon" 		=> "br0admin-admin-woo"
					);
	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Woocommerce General', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "woosettings-gen",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Woocommerce General', 'snpshpwp')."</h3>
							".__('Setup Woocommerce general settings.', 'snpshpwp')."",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( "type" 		=> "start_min" );
	$of_options[] = array( 	"name" 		=> __('Woocommerce Columns', 'snpshpwp'),
							"desc" 		=> __('Default number of Woocommerce columns on Shop and Archive pages.', 'snpshpwp'),
							"id" 		=> "woo-columns",
							"std" 		=> "4",
							"type" 		=> "select",
							"options" 	=> array(
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Woocommerce Related Columns', 'snpshpwp'),
							"desc" 		=> __('Default number of Woocommerce columns for related and upsells.', 'snpshpwp'),
							"id" 		=> "woo-columns-rel",
							"std" 		=> "4",
							"type" 		=> "select",
							"options" 	=> array(
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Products Per Page', 'snpshpwp'),
							"desc" 		=> __('Set number of products per page for the shop and product archives.', 'snpshpwp'),
							"id" 		=> "woo_per_page",
							"std" 		=> "9",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "50",
							"type" 		=> "sliderui",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Related Products Per Page', 'snpshpwp'),
							"desc" 		=> __('Set number of related products per page for the single product pages.', 'snpshpwp'),
							"id" 		=> "woo_rel_per_page",
							"std" 		=> "4",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "30",
							"type" 		=> "sliderui",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( "type" 		=> "end_min" );
	$of_options[] = array( "type" 		=> "end_section" );

	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Woocommerce Sidebars', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "woosettings-sid",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Woocommerce Sidebars', 'snpshpwp')."</h3>
							".__('Setup Woocommerce sidebars.', 'snpshpwp')."",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( "type" 		=> "start_min" );
	$of_options[] = array( 	"name" 		=> __('Wocommerce Archive Sidebar', 'snpshpwp'),
							"desc" 		=> __('Enable Wocommerce sidebar on Archive and Shop pages.', 'snpshpwp'),
							"id" 		=> "sidebar-woo",
							"std" 		=> 0,
							"type" 		=> "switch",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __("Woocommerce Archive Sidebar Position", "snpshpwp"),
							"desc" 		=> __("Use left or right sidebar.", "snpshpwp"),
							"id" 		=> "sidebar-woo-position",
							"std" 		=> 0,
							"on" 		=> "Left",
							"off" 		=> "Right",
							"type" 		=> "switch",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Wocommerce Product Sidebar', 'snpshpwp'),
							"desc" 		=> __('Enable Wocommerce sidebar on Single Posts.', 'snpshpwp'),
							"id" 		=> "sidebar-woo-single",
							"std" 		=> 0,
							"type" 		=> "switch",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __("Woocommerce Product Sidebar Position", "snpshpwp"),
							"desc" 		=> __("Use left or right sidebar.", "snpshpwp"),
							"id" 		=> "sidebar-woo-single-position",
							"std" 		=> 0,
							"on" 		=> "Left",
							"off" 		=> "Right",
							"type" 		=> "switch",
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Woocommerce Sidebars Width', 'snpshpwp'),
							"desc" 		=> __('Choose your Woocommerce sidebars width.', 'snpshpwp'),
							"id" 		=> "sidebar-woo-size",
							"std" 		=> "Fourth",
							"type" 		=> "select",
							"options" 	=> array(
											"3" => "Third",
											"4" => "Fourth",
											"5" => "Fifth"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( "type" 		=> "end_min" );
	$of_options[] = array( "type" 		=> "end_section" );
	
	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Woocommerce Widgetized Areas', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "woowidgets",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('WooCommerce Widgetized Areas', 'snpshpwp')."</span></h3>
							".__('Use special widgetized areas. Before and after shop archives and single products.', 'snpshpwp')."",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( "type" 		=> "start_min" );
	$of_options[] = array( 	"name" 		=> __('Woocommerce Before Shop Archive', 'snpshpwp'),
							"desc" 		=> __('Select number of widget areas before shop archives.', 'snpshpwp'),
							"id" 		=> "shop-widgets-before",
							"std" 		=> "none",
							"type" 		=> "select",
							"options" 	=> array(
											"none" => "none",
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Woocommerce After Shop Archive', 'snpshpwp'),
							"desc" 		=> __('Select number of widget areas after shop archives.', 'snpshpwp'),
							"id" 		=> "shop-widgets-after",
							"std" 		=> "none",
							"type" 		=> "select",
							"options" 	=> array(
											"none" => "none",
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Woocommerce Before Product', 'snpshpwp'),
							"desc" 		=> __('Select number of widget areas before single products.', 'snpshpwp'),
							"id" 		=> "product-widgets-before",
							"std" 		=> "none",
							"type" 		=> "select",
							"options" 	=> array(
											"none" => "none",
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( 	"name" 		=> __('Woocommerce After Product', 'snpshpwp'),
							"desc" 		=> __('Select number of widget areas after single products.', 'snpshpwp'),
							"id" 		=> "product-widgets-after",
							"std" 		=> "none",
							"type" 		=> "select",
							"options" 	=> array(
											"none" => "none",
											"1" => "1",
											"2" => "2",
											"3" => "3",
											"4" => "4",
											"5" => "5"
							),
							"class" 	=> "of-group-small"
					);
	$of_options[] = array( "type" 		=> "end_min" );
	$of_options[] = array( "type" 		=> "end_section" );


$of_options[] = array( 	"name" 		=> __('Advanced', 'snpshpwp'),
						"id"			=> "snpshpwp_grp_advanced",
						"type" 		=> "group"
				);

$of_options[] = array( 	"name" 		=> __('Advanced General', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-advanced"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Advanced General', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advanced_1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Advanced General', 'snpshpwp')."</h3>
						".__('Set boxed or wide layout and fixed or responsive layout.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Site Layout', 'snpshpwp'),
						"desc" 		=> __('Select your site layout.', 'snpshpwp'),
						"id" 		=> "site_layout",
						"std" 		=> "wide",
						"type" 		=> "select",
						"options" 	=> array(
										"boxed" => __("Boxed", "snpshpwp"),
										"wide" => __("Wide", "snpshpwp"),
										"contained" => __("Contained", "snpshpwp")
						),
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Responsive / Fixed Layout", "snpshpwp"),
						"desc" 		=> __("Enable Responsive layout or use Fixed layout insted.", "snpshpwp"),
						"id" 		=> "responsive",
						"std" 		=> 1,
						"on" 		=> __("Responsive", "snpshpwp"),
						"off" 		=> __("Fixed", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Loader Background', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advanced_2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Loader Background', 'snpshpwp')."</h3>
						".__('Set loader background.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Disable Loader", "snpshpwp"),
						"desc" 		=> __("This option will disable the curtain effect on page transitions.", "snpshpwp"),
						"id" 		=> "loader_active",
						"std" 		=> 0,
						"on" 		=> __("Disable", "snpshpwp"),
						"off" 		=> __("Enable", "snpshpwp"),
						"type" 		=> "switch",
						"class" 	=> "of-group-small of-invert-switch"
				);
$of_options[] = array( 	"name" 		=> __('Upload Loader Background', 'snpshpwp'),
						"desc" 		=> __('Upload your loader background.', 'snpshpwp'),
						"id" 		=> "loader_background",
						"std" 		=> get_template_directory_uri() . '/images/snpshpwp_loader.png',
						"type" 		=> "media",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );

$of_options[] = array( 	"name" 		=> __('Advanced General', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advanced_3",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Tracking Code', 'snpshpwp')."</h3>
						".__('Use tracking code for your site. Paste in the code provided by a tracking website.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Tracking Code', 'snpshpwp'),
						"desc" 		=> __('Paste your Google Analytics (or other) tracking code here. This will be added into the header of your site.', 'snpshpwp'),
						"id" 		=> "tracking-code",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Advanced Layout', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-advlay"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Advanced Layout', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advlayoutcontent",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Full HD Resolution', 'snpshpwp')."</h3>
						".__('Set your advanced layout settings. Set up your default margins used in the SnapShop Theme and the custom responsive resolution.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Content Width / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Responsive width for high resolutions, desktop and HD displays. Default value 1920px.', 'snpshpwp'),
						"id" 		=> "content_width",
						"std" 		=> "1920",
						"min" 		=> "960",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Element Column Margin / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Column margins for high resolutions, desktop and HD displays. Default value 36px.', 'snpshpwp'),
						"id" 		=> "fb_hres_c",
						"std" 		=> "36",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "60",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Default Element Bottom Margin / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Set the default bottom margin on all elements. Default value 36px.', 'snpshpwp'),
						"id" 		=> "fb_bmargin",
						"std" 		=> "36",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit" 		=> true,
						"type" 		=> "sliderui"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Advanced Layout', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advlayoutsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('High Resolution', 'snpshpwp')."</h3>
						".__('Set your advanced layout settings. Set up your default margins used in the SnapShop Theme and the custom responsive resolution.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Content Width / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Responsive width for laptops. Default value 1200px.', 'snpshpwp'),
						"id" 		=> "fb_hres_w",
						"std" 		=> "1200",
						"min" 		=> "960",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Column Margins / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Column margins for medium resolutions, iPad, tablets and handheld. Default value 18px.', 'snpshpwp'),
						"id" 		=> "fb_mres_c",
						"std" 		=> "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "60",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / High Resolution', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "csshsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Custom CSS / High Resolution', 'snpshpwp')."</h3>
						".__('Write some custom CSS for your high resolutions.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / High Resolution', 'snpshpwp'),
						"desc" 		=> __('Quickly add some CSS to your theme by adding it to this block.', 'snpshpwp'),
						"id" 		=> "custom-css-high",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Medium Resolution', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advmlayoutsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Medium Resolution', 'snpshpwp')."</h3>
						".__('Set your advanced layout settings. Set up your default margins used in the SnapShop Theme and the custom responsive resolution.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Content Width / Medium Resolution', 'snpshpwp'),
						"desc" 		=> __('Responsive width for medium resolutions, iPad, tablets and handheld. Default value 1024px.', 'snpshpwp'),
						"id" 		=> "fb_mres_w",
						"std" 		=> "1024",
						"min" 		=> "480",
						"step"		=> "1",
						"max" 		=> "1200",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Column Margins / Medium Resolution', 'snpshpwp'),
						"desc" 		=> __('Column margins for low resolutions. Default value 10px.', 'snpshpwp'),
						"id" 		=> "fb_lres_c",
						"std" 		=> "10",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "60",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Sidebars / Medium Resolution", "snpshpwp"),
						"desc" 		=> __("Hide sidebars in this mode.", "snpshpwp"),
						"id" 		=> "fb_mres_s",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / Medium Resolution', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "cssmsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Custom CSS / Medium Resolution', 'snpshpwp')."</h3>
						".__('Write some custom CSS for your medium resolutions.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / Medium Resolution', 'snpshpwp'),
						"desc" 		=> __('Quickly add some CSS to your theme by adding it to this block.', 'snpshpwp'),
						"id" 		=> "custom-css-med",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Low Resolution', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "advmlayoutsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Low Resolution', 'snpshpwp')."</h3>
						".__('Set your advanced layout settings. Set up your default margins used in the SnapShop Theme and the custom responsive resolution.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Content Width / Low Resolution - Mobile', 'snpshpwp'),
						"desc" 		=> __('Responsive width for low resolutions - mobile phones. Default value 768px.', 'snpshpwp'),
						"id" 		=> "fb_lres_w",
						"std" 		=> "768",
						"min" 		=> "320",
						"step"		=> "1",
						"max" 		=> "1200",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __("Hide Sidebars / Low Resolution", "snpshpwp"),
						"desc" 		=> __("Hide sidebars in this mode. In this mode sidebars are not aside the content but before and after.", "snpshpwp"),
						"id" 		=> "fb_lres_s",
						"std" 		=> 1,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / Low Resolution', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "csslsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Custom CSS / Low Resolution', 'snpshpwp')."</h3>
						".__('Write some custom CSS for your low resolutions.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS / Low Resolution', 'snpshpwp'),
						"desc" 		=> __('Quickly add some CSS to your theme by adding it to this block.', 'snpshpwp'),
						"id" 		=> "custom-css-low",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );


$of_options[] = array( 	"name" 		=> __('Featured Images', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-fimage"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Setup Featured Images', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "blog-fimage",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Shortcodes featured images', 'snpshpwp')."</span></h3>
						".__('Set your default featured image resolution for insert posts element. If you alter these default settings please regenerate your thumbnails.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Featured Image Width', 'snpshpwp'),
						"desc" 		=> __('Set fullwidth elements featured image height.', 'snpshpwp'),
						"id" 		=> "fimage_width",
						"std" 		=> "960",
						"min" 		=> "640",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);

$of_options[] = array( 	"name" 		=> __('Featured Image Height', 'snpshpwp'),
						"desc" 		=> __('Set fullwidth elements featured image height.', 'snpshpwp'),
						"id" 		=> "fimage_height",
						"std" 		=> "400",
						"min" 		=> "400",
						"step"		=> "1",
						"max" 		=> "1200",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Override Featured Image', 'snpshpwp'),
						"desc" 		=> __('Use only full resolution images for Featured image.', 'snpshpwp'),
						"id" 		=> "fimage_override",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Setup Featured Images - Single Post', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "single-fimage",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Single post featured images', 'snpshpwp')."</span></h3>
						".__('Set your default featured image resolution for single posts. If you alter these default settings please regenerate your thumbnails.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Featured Image Width', 'snpshpwp'),
						"desc" 		=> __('Set fullwidth elements featured image height.', 'snpshpwp'),
						"id" 		=> "single_fimage_width",
						"std" 		=> "960",
						"min" 		=> "640",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Featured Image Height', 'snpshpwp'),
						"desc" 		=> __('Set fullwidth elements featured image height.', 'snpshpwp'),
						"id" 		=> "single_fimage_height",
						"std" 		=> "600",
						"min" 		=> "400",
						"step"		=> "1",
						"max" 		=> "1200",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Override Featured Image', 'snpshpwp'),
						"desc" 		=> __('Use only full resolution images for Featured image.', 'snpshpwp'),
						"id" 		=> "single_fimage_override",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Twitter API', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-twitter"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Twitter API', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "desc_twitter",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Twitter API', 'snpshpwp')."</span></h3>
						".__('Set custom Twitter API keys. Go to', 'divison').' <a href="http://dev.twitter.com/" target="_blank">'.__('Twitter Developer pages', 'snpshpwp').'</a> '.__('to get your secure keys.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Consumer Key', 'snpshpwp'),
						"desc" 		=> __('Consumer key provided by dev.twitter.com', 'snpshpwp'),
						"id" 		=> "twitter_ck",
						"std" 		=> "WTpkUO8EKqFf7LIufyxymw",
						"type" 		=> "text",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Consumer Secret', 'snpshpwp'),
						"desc" 		=> __('Consumer secret provided by dev.twitter.com', 'snpshpwp'),
						"id" 		=> "twitter_cs",
						"std" 		=> "FTTyvUgl576OSiA86aFL4s3Mo3Ym7XmRoccOsN4xqU",
						"type" 		=> "text",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Access token', 'snpshpwp'),
						"desc" 		=> __('Access token provided by dev.twitter.com', 'snpshpwp'),
						"id" 		=> "twitter_at",
						"std" 		=> "966576138-B4gBnApgj9Khbt7931uowPw6KVHfBb4fB1Njp5SC",
						"type" 		=> "text",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Access token secret', 'snpshpwp'),
						"desc" 		=> __('Access token secret provided by dev.twitter.com', 'snpshpwp'),
						"id" 		=> "twitter_ats",
						"std" 		=> "gBqkVVG6cW2qC9sInSVKYBD0N0IpXgmauPsifhSg8wg4J",
						"type" 		=> "text",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('MailChimp Integration', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-newsletter"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('MailChimp Integration', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "mailchimp_1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('MailChimp Integration', 'snpshpwp')."</h3>
						".__('Setup your MailChimp newsletter service.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Use MailChimp Welcome Screen", "snpshpwp"),
						"desc" 		=> __("Enable MailChimp sign up form. This form, a welcome screen, will appear to all new users once they visit your site for the first time.", "snpshpwp"),
						"id" 		=> "mailchimp",
						"std" 		=> 0,
						"type" 		=> "switch",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( 	"name" 		=> __('Override Default Welcome Screen', 'snpshpwp'),
						"desc" 		=> __('Override default MailChimp newsletter welcome screen with your custom code.', 'snpshpwp'),
						"id" 		=> "mailchimp_override",
						"std" 		=> "",
						"type" 		=> "textarea",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __('Language Bar', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-single"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Language Bar', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "languagesettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Language Bar', 'snpshpwp')."</span></h3>
						".__('Add languages and URLs to the translated version. You can use WPML, qTranslate or other tools to translate your site. These settings work with the language-bar header element.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Languages', 'snpshpwp'),
						"desc" 		=> __('Unlimited sidebars for your pages/posts.', 'snpshpwp'),
						"id" 		=> "language",
						"std" 		=> array(
										1 => array(
											'order' => 1,
											'flag' => 'france.png',
											'langurl' => '#'
									)
						),
						"type" 		=> "language"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( 	"name" 		=> __("Backup Options", 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-backup"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __("Backup and Restore Options", 'snpshpwp'),
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'snpshpwp')
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __("Transfer Theme Options Data", 'snpshpwp'),
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click \"Import Options\"", 'snpshpwp')
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );
/*

$of_options[] = array( 	"name" 		=> __("Icon Settings", 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_advanced",
						"icon" 		=> "br0admin-admin-backup"
				);
	$of_options[] = array( 	"name" 		=> __('Icon Settings', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "c_icons",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Icon Settings', 'snpshpwp')."</h3>
							".__('Override any default layout icon with your own.', 'snpshpwp')."",
							"icon" 		=> true,
							"type" 		=> "info"
					);


$of_options[] = array( 	"name" 		=> __('Element Sidenav Left', 'snpshpwp'),
						"desc" 		=> __('Change left side navigation header element icon.', 'snpshpwp'),
						"id" 		=> "c_icons_sdnv_left",
						"std" 		=> "",
						"type" 		=> "textarea",
							"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Element Sidenav Right', 'snpshpwp'),
						"desc" 		=> __('Change right side navigation header element icon.', 'snpshpwp'),
						"id" 		=> "c_icons_sdnv_right",
						"std" 		=> "",
						"type" 		=> "textarea",
							"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Element Shop', 'snpshpwp'),
						"desc" 		=> __('Change woo-cart header element icon.', 'snpshpwp'),
						"id" 		=> "c_icons_woo_shop",
						"std" 		=> "",
						"type" 		=> "textarea",
							"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Element Search', 'snpshpwp'),
						"desc" 		=> __('Change search element icon.', 'snpshpwp'),
						"id" 		=> "c_icons_srch",
						"std" 		=> "",
						"type" 		=> "textarea",
							"class" 	=> "of-group-smaller"
				);
$of_options[] = array( 	"name" 		=> __('Element To The Top', 'snpshpwp'),
						"desc" 		=> __('Change to the top footer element icon.', 'snpshpwp'),
						"id" 		=> "c_icons_tthtp",
						"std" 		=> "",
						"type" 		=> "textarea",
							"class" 	=> "of-group-smaller"
				);

*/


if ( !get_transient('snpshpwp_remove_demo') ) {
	$of_options[] = array( 	"name" 		=> __('Demo', 'snpshpwp'),
							"id"			=> "snpshpwp_grp_demo",
							"type" 		=> "group"
					);

	$of_options[] = array( 	"name" 		=> __('One Click Demo Installation', 'snpshpwp'),
							"type" 		=> "heading",
							"group" 	=> "snpshpwp_grp_demo",
							"icon" 		=> "br0admin-admin-demo"
						);
	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Step 1', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "demo_plugins_h",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Before you begin', 'snpshpwp')."</h3>
							".__('Make sure all the required plugins are installed.', 'snpshpwp')."",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( "type" 		=> "start_min" );
	$of_options[] = array( 	"name" 		=> __('Installed Plugins', 'snpshpwp'),
							"desc" 		=> __('This list shows needed plugins. Please install and activate all the plugins before you continue with the demo installation.', 'snpshpwp'),
							"id" 		=> "demo_plugins",
							"std" 		=> "",
							"type" 		=> "demoplugins"
					);
	$of_options[] = array( "type" 		=> "end_min" );
	$of_options[] = array( "type" 		=> "end_section" );

	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Step 2', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "demo_content_h",
							"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Install Demo', 'snpshpwp')."</h3>
							".__('<strong style="color:red;">! IMPORTANT !</strong> Demo can only be installed on a fresh Wordpress installation. All data will be erased!', 'snpshpwp'),
							"icon" 		=> true,
							"type" 		=> "info"
					);

	$of_options[] = array( "type" 		=> "start_min" );
	$of_options[] = array( 	"name" 		=> __('Demo Content', 'snpshpwp'),
							"desc" 		=> __('Select options for demo installation:', 'snpshpwp').'<br/>
							<br/><label><input id="ss_install_theme" type="checkbox" checked />'.__('Install Theme Options','snpshpwp').'</label>
							<br/><label><input id="ss_install_pages" type="checkbox" checked />'.__('Install Pages, Posts and Products','snpshpwp').'</label>
							<br/><label><input id="ss_install_images" type="checkbox" checked />'.__('Download Images','snpshpwp').'</label>
							',
							"id" 		=> "demo_content",
							"std" 		=> "",
							"type" 		=> "democontent"
					);
	$of_options[] = array( "type" 		=> "end_min" );
	$of_options[] = array( "type" 		=> "end_section" );

	$of_options[] = array( "type" 		=> "start_section" );
	$of_options[] = array( 	"name" 		=> __('Remove Demo', 'snpshpwp'),
							"desc" 		=> "",
							"id" 		=> "removedemoinstallation",
							"std" 		=> "<h2 style=\"margin: 0 0 10px;\">".__('Notice', 'snpshpwp')."</h2><h2>".__("Remove Demo Tab",'snpshpwp')."</h2>
							".__('If you do not want to use the Demo Content or you have already installed demo content and you wish this tab to be removed from the SnapShopWP theme options click the Remove Demo Tab button.', 'snpshpwp')."<br/><br/><a href='#' id='demo_remove' class='of-button snpshpwp-remove-demo-tab'>".__('Remove Demo Tab', 'snpshpwp')."</a>",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( "type" 		=> "end_section" );
}

$of_options[] = array( 	"name" 		=> __('Custom CSS', 'snpshpwp'),
						"id"			=> "snpshpwp_grp_css",
						"type" 		=> "group"
				);

$of_options[] = array( 	"name" 		=> __('Classes and Custom CSS', 'snpshpwp'),
						"type" 		=> "heading",
						"group" 	=> "snpshpwp_grp_css",
						"icon" 		=> "br0admin-admin-css"
				);
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Custom CSS', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "css_info_1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Custom CSS styles', 'snpshpwp')."</span></h3>
						".__('Write in some custom CSS styles for your site easily.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Custom CSS', 'snpshpwp'),
						"desc" 		=> __('Quickly add some CSS to your theme by adding it to this block.', 'snpshpwp'),
						"id" 		=> "custom-css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );

$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Custom Classes', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "css_info_2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">.snpshp_limit_width</h3>
						".__('Use this custom class for your Frontend Builder rows in order to contain the max-width of the row.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "start_min" );
$of_options[] = array( 	"name" 		=> __('Class Width', 'snpshpwp'),
						"desc" 		=> __('Select custom width for the .snpshp_limit_width class.', 'snpshpwp'),
						"id" 		=> "custom-css-snpshp_limit_width",
						"std" 		=> "1200",
						"min" 		=> "480",
						"step"		=> "1",
						"max" 		=> "1920",
						"edit" 		=> true,
						"type" 		=> "sliderui",
						"class" 	=> "of-group-small"
				);
$of_options[] = array( "type" 		=> "end_min" );
$of_options[] = array( "type" 		=> "end_section" );
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Class Responsive', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "css_info_3",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">.snpshpwp_responsive_fix</h3>
						".__('Use this custom class for your Frontend Builder rows in order to send columns to 100% width on medium resolutions.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "end_section" );
$of_options[] = array( "type" 		=> "start_section" );
$of_options[] = array( 	"name" 		=> __('Class Smooth Scroll', 'snpshpwp'),
						"desc" 		=> "",
						"id" 		=> "css_info_3",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">.snpshpwp_scroll_to</h3>
						".__('Use this custom class for your liks or menu elements in order to have a smooth scroll effect to the link anchor.', 'snpshpwp')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "type" 		=> "end_section" );




				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>