<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */




add_filter( 'widget_text', 'do_shortcode' );

if ( SNPSHPWP_FBUILDER === true ) {

global $snpshpwp_data, $fbuilder, $wpdb;

$counter = 0;

$snpshpwp_categories = get_categories(array('order'=>'desc'));
$snpshpwp_ready_categories = array( '-1' => __('All', 'snpshpwp') );
$snpshpwp_margin = ( isset($snpshpwp_data['fb_bmargin']) ? $snpshpwp_data['fb_bmargin'] : 36 );

foreach ( $snpshpwp_categories as $category ) {
	$counter++;
	$snpshpwp_ready_categories = $snpshpwp_ready_categories + array($category->term_id=>$category->name);
}

$snpshpwp_ready_contacts = array();
$counter = 0;


$snpshpwp_ready_contacts = array();
$counter = 0;

if ( is_array( $snpshpwp_data['contact'] ) ) {
	foreach ( $snpshpwp_data['contact'] as $contact ) {
		$counter++;
		$snpshpwp_ready_contacts = $snpshpwp_ready_contacts+array($counter=>$contact['name']);
	}
}


$insert_posts_selected = 1;

$querystr = "
	SELECT $wpdb->posts.ID, $wpdb->posts.post_title
	FROM $wpdb->posts
	WHERE $wpdb->posts.post_status = 'publish'
	AND $wpdb->posts.post_type = 'post'
	ORDER BY $wpdb->posts.post_date DESC
	";
$posts_array = $wpdb->get_results($querystr, OBJECT);
$fbuilder_wp_posts = array();
$first_post = '';
foreach($posts_array as $key => $obj) {
	if($first_post == '') $first_post = $obj->ID;
	$fbuilder_wp_posts[$obj->ID] = $obj->post_title;
}

$nav_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ));
$fbuilder_menus = array();
$fbuilder_menu_std = '';
if(is_array($nav_menus)) 
	foreach($nav_menus as $menu_div) {
		if($fbuilder_menu_std == '') $fbuilder_menu_std = $menu_div->slug;
		$fbuilder_menus[$menu_div->slug] = $menu_div->name; 
	}

$admin_optionsDB = $fbuilder->option();
$opts = array();
foreach($admin_optionsDB as $opt) {
	if(isset($opt->name) && isset($opt->value))
		$opts[$opt->name] = $opt->value;
}

$animationList = array(
	'none' => __('None', 'snpshpwp'),
	'flipInX' => __('Flip in X', 'snpshpwp'),
	'flipInY' => __('Flip in Y', 'snpshpwp'),
	'fadeIn' => __('Fade in', 'snpshpwp'),
	'fadeInDown' => __('Fade in from top', 'snpshpwp'),
	'fadeInUp' => __('Fade in from bottom', 'snpshpwp'),
	'fadeInLeft' => __('Fade in from left', 'snpshpwp'),
	'fadeInRight' => __('Fade in from right', 'snpshpwp'),
	'fadeInDownBig' => __('Slide in from top', 'snpshpwp'),
	'fadeInUpBig' => __('Slide in from bottom', 'snpshpwp'),
	'fadeInLeftBig' => __('Slide in from left', 'snpshpwp'),
	'fadeInRightBig' => __('Slide in from right', 'snpshpwp'),
	'bounceIn' => __('Bounce in', 'snpshpwp'),
	'bounceInDown' => __('Bounce in from top', 'snpshpwp'),
	'bounceInUp' => __('Bounce in from bottom', 'snpshpwp'),
	'bounceInLeft' => __('Bounce in from left', 'snpshpwp'),
	'bounceInRight' => __('Bounce in from right', 'snpshpwp'),
	'rotateIn' => __('Rotate in', 'snpshpwp'),
	'rotateInDownLeft' => __('Rotate in from top-left', 'snpshpwp'),
	'rotateInDownRight' => __('Rotate in from top-right', 'snpshpwp'),
	'rotateInUpLeft' => __('Rotate in from bottom-left', 'snpshpwp'),
	'rotateInUpRight' => __('Rotate in from bottom-right', 'snpshpwp'),
	'lightSpeedIn' => __('Lightning speed', 'snpshpwp'),
	'rollIn' => __('Roll in', 'snpshpwp')
);

$animationControl = array(
	'group_animate' => array(
		'type' => 'collapsible',
		'label' => __('Animation','snpshpwp'),
		'options' => array(
			'animate' => array(
				'type' => 'select',
				'label' => __('Type:','snpshpwp'),
				'std' => 'none',
				'label_width' => 0.25,
				'control_width' => 0.75,
				'options' => $animationList
			),
			'animation_group' => array(
				'type' => 'input',
				'label' => __('Group:','snpshpwp'),
				'std' => '',
				'half_column' => 'true'
			),
			'animation_delay' => array(
				'type' => 'number',
				'label' => __('Delay:','snpshpwp'),
				'std' => 0,
				'unit' => 'ms',
				'min' => 0,
				'step' => 50,
				'max' => 10000,
				'half_column' => 'true'
			)
		)
	)
);

if(isset($opts['css_classes']) && $opts['css_classes'] == 'true') {
	$classControl = array(
		'group_css' => array(
			'type' => 'collapsible',
			'label' => __('ID & Custom CSS','snpshpwp'),
			'options' => array(
				'shortcode_id' => array(
					'type' => 'input',
					'label' => __('ID:','snpshpwp'),
					'desc' => __('For linking via hashtags','snpshpwp'),
					'label_width' => 0.25,
					'control_width' => 0.75,
					'std' => ''
				),
				'class' => array(
					'type' => 'input',
					'label' => __('Class:','snpshpwp'),
					'desc' => __('For custom css','snpshpwp'),
					'label_width' => 0.25,
					'control_width' => 0.75,
					'std' => ''
				)
			)
		)
	);
	$tabsId = array(
		'custom_id' => array(
			'type' => 'input',
			'label' => __('Tab ID:','snpshpwp'),
			'desc' => __('For use of anchor in url. Make sure that this ID is unique on the page.','snpshpwp'),
			'label_width' => 0.25,
			'std' => ''
		)
	);
}
else {
	$classControl = array();
	$tabsId = array();
}


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP TITLE */
/* -------------------------------------------------------------------------------- */
$snpshpwp_title = array(
	'snpshpwp_title' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Title','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_title.png',
		'function' => 'snpshpwp_title',
		'group' => 'SNAPSHOP Elements',
		'options' => array_merge(
		array(
			'group_title' => array(
				'type' => 'collapsible',
				'label' => __('Title','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'title' => array(
						'type' => 'textarea',
						'label' => __('Title:', 'snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'Title'
					),
					'useicon' => array(
						'type' => 'checkbox',
						'std' => 'false',
						'label' => __('Use custom icon','snpshpwp')
					),
					'icon' => array(
						'type' => 'icon',
						'label' => __('Icon:','snpshpwp'),
						'std' => 'icon-bell'
					),
					'iconsize' => array(
						'type' => 'number',
						'std' => 36,
						'unit' => 'px',
						'half_column' => 'true',
						'min' => 20,
						'max' => 100,
						'label' => __('Size:','snpshpwp')
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Text:', 'snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'Lorem ipsum'
					),
					'type' => array(
						'type' => 'select',
						'label' => __('Type:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'h3',
						'options' => array (
							'h1'=> 'h1',
							'h2'=> 'h2',
							'h3'=> 'h3',
							'h4'=> 'h4',
							'h5'=> 'h5',
							'h6'=> 'h6'
						)
					),
					'align' => array(
						'type' => 'select',
						'label' => __('Align:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'center',
						'options' => array (
							'center'=> __('Center', 'snpshpwp'),
							'left'=> __('Left', 'snpshpwp'),
							'right'=> __('Right', 'snpshpwp')
						)
					),
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP INSERT POSTS */
/* -------------------------------------------------------------------------------- */
$snpshpwp_insposts = array(
	'snpshpwp_insert_posts' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Insert Posts','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_insert_posts.png',
		'function' => 'snpshpwp_insert_posts',
		'group' => 'SNAPSHOP Elements',
		'options' => array_merge(
		array(
			'group_insposts' => array(
				'type' => 'collapsible',
				'label' => __('Posts','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'category' => array(
						'type' => 'select',
						'label' => __('Category:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '-1',
						'options' => $snpshpwp_ready_categories,
						'search' => 'true',
						'multiselect' => 'true'
					),
					'type' => array(
						'type' => 'select',
						'label' => __('Columns','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '2',
						'options' => array (
							'0' => __('1 Column Small','snpshpwp'),
							'1' => __('1 Column','snpshpwp'),
							'2' => __('2 Column','snpshpwp'),
							'3' => __('3 Column','snpshpwp'),
							'4' => __('4 Column','snpshpwp'),
							'5' => __('5 Column','snpshpwp')
							)
					),
					'rows' => array(
						'type' => 'input',
						'label' => __('Rows:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.25,
						'std' => 1
					),
					'orderby' => array(
						'type' => 'select',
						'label' => __('Sort by:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'date',
						'options' => array (
							'none' => __('None', 'snpshpwp'),
							'author' => __('Author', 'snpshpwp'),
							'comment_count'=> __('Comment Count', 'snpshpwp'),
							'date'=> __('Date', 'snpshpwp'),
							'ID' => __('ID', 'snpshpwp'),
							'name' => __('Name', 'snpshpwp'),
							'meta_value' => __('Meta Value', 'snpshpwp'),
							'meta_value_num' => __('Meta Value Numeric', 'snpshpwp'),
							'modified' => __('Modified', 'snpshpwp'),
							'parent' => __('Parent', 'snpshpwp'),
							'rand'=> __('Random', 'snpshpwp'),
							'title'=> __('Title', 'snpshpwp'),
							'type' => __('Type', 'type'),
							'post__in' => __('Preserve Post In', 'snpshpwp')
							)
					),
					'meta_key' => array(
						'type' => 'input',
						'label' => __('Meta key:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '',
						'hide_if' => array(
							'orderby' => array('none','author','comment_count','date','ID','name','modified','parent','rand','title','type','post__in')
						)
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Order:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'DESC',
						'options' => array (
							'ASC'=> __('Ascendic', 'snpshpwp'),
							'DESC'=> __('Descendic', 'snpshpwp')
							)
					),
					'excerpt_lenght' => array(
						'type' => 'number',
						'min' => 0,
						'label' => __('Excerpt:','snpshpwp'),
						'half_column' => 'true',
						'max' => 999,
						'std' => 128,
						'unit' => ''
					),
					'align' => array(
						'type' => 'select',
						'label' => __('Align:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'left',
						'options' => array (
							'left' => __('Left', 'snpshpwp'),
							'center' => __('Center', 'snpshpwp'),
							'right' => __('Right', 'snpshpwp')
							)
					),
					'ajax' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Ajax Load','snpshpwp'),
						'half_column' => 'true'
					),
					'pagination' => array(
						'type' => 'checkbox',
						'label' => __('Show Pagination','snpshpwp'),
						'std' => 'true',
						'half_column' => 'true'
					),
					'ignoresticky' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Ignore Sticky Posts','snpshpwp')
					)
				)
			),
			'group_meta' => array(
				'type' => 'collapsible',
				'label' => __('Posts','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'show_category' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Show category','snpshpwp')
					),
					'show_date' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Show date','snpshpwp')
					),
					'show_author' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Show author','snpshpwp')
					),
					'show_comments' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Show commenst','snpshpwp')
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP TEAM */
/* -------------------------------------------------------------------------------- */
$snpshpwp_team = array(
	'snpshpwp_team' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Team','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_team.png',
		'function' => 'snpshpwp_team',
		'group' => 'SNAPSHOP Elements',
		'options' => array_merge(
		array(
			'group_team' => array(
				'type' => 'collapsible',
				'label' => __('Team','snpshpwp'),
				'label_width' => 0.25,
				'control_width' => 0.75,
				'open' => 'true',
				'options' => array(
					'user' => array(
						'type' => 'select',
						'label' => __('Contact:','snpshpwp'),
						'std' => '1',
						'options' => $snpshpwp_ready_contacts,
						'search' => 'true'
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP CONTACT FORM */
/* -------------------------------------------------------------------------------- */
$snpshpwp_contactform = array(
	'snpshpwp_contactform' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Contact Form','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_cform.png',
		'function' => 'snpshpwp_contactform',
		'group' => 'SNAPSHOP Elements',
		'options' => array_merge(
		array(
			'group_contactform' => array(
				'type' => 'collapsible',
				'label' => __('Contact Form','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'users' => array(
						'type' => 'select',
						'label' => __('Contact:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'options' => $snpshpwp_ready_contacts,
						'search' => 'true',
						'multiselect' => 'true'
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);



/* -------------------------------------------------------------------------------- */
/* FEATURED LINK */
/* -------------------------------------------------------------------------------- */
$snpshpwp_featured_link = array(
	'featured_link' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Featured Link','snpshpwp'),
		'icon' =>  get_template_directory_uri() . '/images/fbuilder/ss_flink.png',
		'function' => 'snpshpwp_featured_links',
		'group' => 'SNAPSHOP Elements',
		'options' => array_merge(
		 array(
		 	'group_basic' => array(
				'type' => 'collapsible',
				'label' => __('Columns','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '3',
						'options' => array(
							'1' => __('1 Column','snpshpwp'),
							'2' => __('2 Columns','snpshpwp'),
							'3' => __('3 Columns','snpshpwp'),
							'4' => __('4 Columns','snpshpwp'),
							'5' => __('5 Columns','snpshpwp')
						)
					)
				)
			),
			'group_featured_elements' => array(
				'type' => 'collapsible',
				'label' => __('Featured Elements','snpshpwp'),
				'open' => 'true',
				
				'options' => array(
					'sortable' => array(
						'type' => 'sortable',
						'desc' => __('Elements are sortable','snpshpwp'),
						'item_name' => __('featured item','snpshpwp'),
						'label_width' => 0,
						'control_width' => 1,
						'std' => array(
							'items' => array(
								0 => array(
									'url' => '#',
									'title' => 'Title #1',
									'title_color' => '',
									'useicon' => 'false',
									'icon' => 'icon-bell',
									'iconsize' => '36',
									'type' => 'h3',
									'align' => 'center',
									'link_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
									'text_color' => '',
									'image' => '',
									'active' => 'true'
								),
								1 => array(
									'url' => '#',
									'title' => 'Title #2',
									'title_color' => '',
									'useicon' => 'false',
									'icon' => 'icon-bell',
									'iconsize' => '36',
									'type' => 'h3',
									'align' => 'center',
									'link_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
									'text_color' => '',
									'image' => '',
									'active' => 'false'
								),
								2 => array(
									'url' => '#',
									'title' => 'Title #3',
									'title_color' => '',
									'useicon' => 'false',
									'icon' => 'icon-bell',
									'iconsize' => '36',
									'type' => 'h3',
									'align' => 'center',
									'link_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
									'text_color' => '',
									'image' => '',
									'active' => 'false'
								)
							),
							'order' => array(
								0 => 0,
								1 => 1,
								2 => 2
							)
						),
						'options'=> array(
							'url' => array(
								'type' => 'input',
								'label' => __('URL:','snpshpwp'),
								'desc' => __('ex. http://yoursite.com/','snpshpwp'),
								'std' => '',
								'label_width' => 0.25,
								'control_width' => 0.75
							),
							'title' => array(
								'type' => 'textarea',
								'label' => __('Title:', 'snpshpwp'),
								'label_width' => 0.25,
								'control_width' => 0.75
							),
							'title_color' => array(
								'type' => 'color',
								'label' => __('Title color:','snpshpwp'),
								'std' => ''
							),
							'useicon' => array(
								'type' => 'checkbox',
								'label' => __('Use custom icon','snpshpwp')
							),
							'icon' => array(
								'type' => 'icon',
								'label' => __('Icon:','snpshpwp')
							),
							'iconsize' => array(
								'type' => 'number',
								'unit' => 'px',
								'half_column' => 'true',
								'min' => 20,
								'max' => 100,
								'label' => __('Size:','snpshpwp')
							),
							'type' => array(
								'type' => 'select',
								'label' => __('Type:','snpshpwp'),
								'label_width' => 0.25,
								'control_width' => 0.75,
								'options' => array (
									'h1'=> 'h1',
									'h2'=> 'h2',
									'h3'=> 'h3',
									'h4'=> 'h4',
									'h5'=> 'h5',
									'h6'=> 'h6'
								)
							),
							'align' => array(
								'type' => 'select',
								'label' => __('Align:','snpshpwp'),
								'label_width' => 0.25,
								'control_width' => 0.75,
								'options' => array (
									'center'=> __('Center', 'snpshpwp'),
									'left'=> __('Left', 'snpshpwp'),
									'right'=> __('Right', 'snpshpwp')
								)
							),
							'link_content' => array(
								'type' => 'textarea',
								'label' => __('Content:', 'snpshpwp'),
								'label_width' => 0.25,
								'control_width' => 0.75
							),
							'text_color' => array(
								'type' => 'color',
								'label' => __('Text color:','snpshpwp'),
								'std' => ''
							),
							'image' => array(
								'type' => 'image',
								'label_width' => 0.25,
								'control_width' => 0.75,
								'label' => __('Image:','snpshpwp'),
								'desc' => __('Please use square and portrait images.','snpshpwp')
							)
						)
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);



$snpshpwp_shortcodes = array_merge( $snpshpwp_title, $snpshpwp_featured_link, $snpshpwp_insposts, $snpshpwp_team, $snpshpwp_contactform );

if ( isset($fbuilder) ) {
	$fbuilder->add_new_shortcodes($snpshpwp_shortcodes);
}

$revsliders = array();

if ( SNPSHPWP_REVSLIDER === true ) {
	global $wpdb;
	$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
	if( $get_sliders ) {
		$default = $get_sliders[0]->alias;
		foreach( $get_sliders as $slider ) {
			$revsliders[$slider->alias] = $slider->title;
		}
	}
else {
	$default = array( 1 => __('No sliders set.', 'snpshpwp') );
}

	$revolution_slider = array (
		'snpshpwp_revslider' => array(
			'type' => 'draggable',
			'text' => __('SNAPSHOP Revolution Slider','snpshpwp'),
			'icon' => get_template_directory_uri() . '/images/fbuilder/ss_rev_slider.png',
			'function' => 'snpshpwp_revslider',
			'group' => 'SNAPSHOP Elements',
			'options' => array(
				'slider' => array(
					'type' => 'select',
					'label' => __('Select slider','snpshpwp'),
					'label_width' => 0.25,
					'control_width' => 0.75,
					'std' => $default,
					'options' => $revsliders
					)
				),
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
						)
					)
				)
			)
		)
	);

	if ( isset($fbuilder) ) { $fbuilder->add_new_shortcodes($revolution_slider); }

}

}


// [snpshpwp_featured_link]
if ( !function_exists('snpshpwp_featured_links') ) :
function snpshpwp_featured_links( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'columns' => '',
		'url' => '',
		'title' => '',
		'align' => '',
		'type' => '',
		'useicon' => '',
		'icon' => '',
		'iconsize' => '',
		'link_content' => '',
		'image' => '',
		'title_color' => '',
		'text_color' => '',
		'bot_margin' => 24,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );


	$bot_margin = (int)$bot_margin;
	$out = '';
	$url = explode('|', $url);
	$title = explode('|', $title);
	$type = explode('|', $type);
	$align = explode('|', $align);
	$useicon = explode('|', $useicon);
	$icon = explode('|', $icon);
	$iconsize = explode('|', $iconsize);
	$link_content = explode('|', $link_content);
	$image = explode('|', $image);
	$title_color = explode('|', $title_color);
	$text_color = explode('|', $text_color);

	if ( is_array($title) ) {

		$curr_num = count($title);

		$out .= '<div class="snpshpwp_featured_links">';

		for ($i = 0; $i < $curr_num; $i++) {

			$out .= sprintf('<div class="snpshpwp_featured_link snpshpwp_full_%1$s">', $columns);
			if ( $url[$i] !== '' ) {
				$out .= sprintf('<a href="%1$s" class="snpshpwp_featured_link_url" title="%2$s"></a>', $url[$i], esc_attr($title[$i]) );
			}
			if ( $image[$i] !== '' ) {
				$out .= sprintf('<div class="snpshpwp_featured_link_image"><img src="%1$s" alt="%2$s"/></div>', $image[$i], esc_attr($title[$i]));
			}
			$out .= '<div class="snpshpwp_featured_link_overlay"></div>';

			$icon_size = (int)$iconsize[$i];
			
			if ( $icon_size < 30 ) {
				$icon_size = 'snpshpwp_smallicon';
			}
			elseif ( $icon_size < 60 ) {
				$icon_size = 'snpshpwp_medicon';
			}
			else {
				$icon_size = 'snpshpwp_largeicon';
			}

			$out .= sprintf('<div class="snpshpwp_area %1$s text-%2$s">', $icon_size, $align[$i]);
			$out .= '<div>';


			if ( $useicon[$i] == 'false' ) {
				$add_icon = sprintf('<span class="snpshpwp_ats snpshpwp_none"><i class="snpshpwp_title_none"></i></span>', $iconsize[$i]);
			}
			else {
				if(substr($icon[$i],0,4) == 'icon') {
					$icon[$i] = '<i class="frb_features_icon '.$icon[$i].' fawesome" ></i>';
				}
				else {
					$icon[$i] = '<i class="frb_features_icon '.substr($icon[$i],0,2).' '.$icon[$i].' frb_icon" ></i>';
				}
				$add_icon = sprintf('<span class="snpshpwp_ats" style="font-size:%2$s">%1$s</span>', $icon[$i], $iconsize[$i]);
			}
			$out .= sprintf('<%1$s class="snpshpwp_ahtitle"%5$s>%2$s%4$s</%1$s>', $type[$i], $title[$i], $align[$i], $add_icon, ( is_array($title_color) && isset($title_color[$i]) && $title_color[$i] !== '' ? ' style="color:'.$title_color[$i].';"' : '' ) );
			$out .= sprintf('<div class="snpshpwp_adesc"%2$s>%1$s</div>', $link_content[$i], ( is_array($text_color) && isset($text_color[$i]) && $text_color[$i] !== '' ? ' style="color:'.$text_color[$i].';"' : '' ) );

			$out .= '</div><div class="snpshpwp_middle_align"></div>';

			$out .= '</div>';


		$out .= '</div>';




		}
		

		$out .= '</div>';
		$out .= '<div class="clearfix"></div>';


	}






	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="'.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;


// [snpshpwp_title]
if ( !function_exists('snpshpwp_title') ) :
function snpshpwp_title( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Title',
		'align' => 'center',
		'type' => 'h2',
		'useicon' => 'false',
		'icon' => 'icon-bell',
		'iconsize' => 36,
		'bot_margin' => 24,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	$bot_margin = (int)$bot_margin;
	$icon_size = (int)$iconsize;
	
	if ( $icon_size < 30 ) {
		$icon_size = 'snpshpwp_smallicon';
	}
	elseif ( $icon_size < 60 ) {
		$icon_size = 'snpshpwp_medicon';
	}
	else {
		$icon_size = 'snpshpwp_largeicon';
	}


	if ( $useicon == 'false' ) {
		$add_icon = sprintf('<span class="snpshpwp_ats snpshpwp_none"><i class="snpshpwp_title_none"></i></span>', $iconsize);
	}
	else {
		if(substr($icon,0,4) == 'icon') {
			$icon = '<i class="frb_features_icon '.$icon.' fawesome" ></i>';
		}
		else {
			$icon = '<i class="frb_features_icon '.substr($icon,0,2).' '.$icon.' frb_icon" ></i>';
		}
		$add_icon = sprintf('<span class="snpshpwp_ats" style="font-size:%2$s">%1$s</span>', $icon, $iconsize);
	}

	$out = sprintf('<%1$s class="snpshpwp_ahtitle">%2$s%4$s</%1$s>', $type, $title, $align, $add_icon);
	$out .= sprintf('<div class="snpshpwp_adesc">%1$s</div>', $content);



	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="snpshpwp_area '.$icon_size.' text-'.$align.''.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;

// [snpshpwp_team]
if ( !function_exists( 'snpshpwp_team' ) ) :
function snpshpwp_team( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'user' => 1,
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	global $snpshpwp_data;

	$bot_margin = (int)$bot_margin;

	$out = '';
	
	if ( is_array( $snpshpwp_data['contact'] ) ) $contacts = $snpshpwp_data['contact']; else return;
	$users_array = explode( ',', $user );
	if ( !is_array ( $users_array ) ) { $users_array[] = $user; }
	$counter = 0;
	$counter_clear = 0;
	$out = '';
	foreach ( $contacts as $contact ) {
		$counter++;
		$contact_networks = $contact['contact'];
		if ( in_array ( $counter, $users_array ) ) {
			$counter_clear++;
			$contact_name = $contact['name'];
			$contact_description = $contact['description'];
			$contact_url = $contact['url'];
			$contact_job = $contact['job'];

			$image_attributes = '<img class="snpshpwp_getheight attachment-full" src="'.$contact_url.'"/>';

			$out .= sprintf('<div class="team_member_module"><div class="img_wrapper margin-bottom18 relative float_left">%7$s
			<div class="hover_element">
			<div class="snpshpwp_chover">
			<div class="snpshpwp_relativw">
			<h4 class="snpshpwp_lbl">%4$s</h4><span class="snpshpwp_sfont">%1$s</span>
			<h4 class="snpshpwp_lbl">%5$s</h4><span class="snpshpwp_sfont">%2$s</span>
			<h4 class="snpshpwp_lbl">%6$s</h4><div class="tmm_text">%3$s</div>
			<nav><ul class="socials list_style text-center">', $contact_name, $contact_job, $contact_description, __('Name' , 'snpshpwp'), __('Position' , 'snpshpwp'), __('About' , 'snpshpwp'), $image_attributes );
			
			foreach ( $contact_networks as $contact_network ) {
				$out .= '<li><a href="'. $contact_network['socialnetworksurl'] .'" class="snpshpwp_hover_color"><img width="36" height="36" src="' . get_bloginfo ( 'template_directory' ) . '/images/socials/' . $contact_network['socialnetworks'] . '" target="_blank" /></a></li>';
			}

			$out .= sprintf ('</ul>
			</nav>
			</div>
			</div>
			</div>
			</div>
			</div>');


		}
	}

	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="'.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;


// [snpshpwp_insert_posts]
if ( !function_exists( 'snpshpwp_insert_posts' ) ) :
function snpshpwp_insert_posts( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'related' => 'false',
		'post' => '0',
		'type' => 1,
		'category' => "-1",
		'rows' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
		'meta_key' => '',
		'ajax' => 'true',
		'pagination' => 'true',
		'ignoresticky' => 1,
		'excerpt_lenght' => 128,
		'align' => 'left',
		'show_category' => 'true',
		'show_date' => 'true',
		'show_author' => 'true',
		'show_comments' => 'true',
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );
	$out = '';
	$post_counter = 0;
	$add_class = '';
	
	$bot_margin = (int)$bot_margin;
	$margin = ' style="margin-bottom:'.$bot_margin.'px"';

	if ( $ignoresticky == 'false' ) $ignoresticky = 0; else $ignoresticky = 1;

	global $paged;
	if ( empty( $paged ) ) $paged = 1;

	$columns = ( $type == '0' ? '1' : $type );
	$format = get_post_format();
	$image_size = ( get_theme_mod('fimage_override') == 1 && $format !== 'gallery' ? 'full' : 'snpshpwp-fullblog' );
	$words = $excerpt_lenght;

	if ( $related == 'true' ) {
		if ( $post == 0 ) {
			if ( is_single() ) {
				$post = get_the_ID();
			}
			else {
				return 'No posts set.';
			}
		}

		$tags = wp_get_post_tags($post);
		$related_ids = array();

		if ($tags) {
			$tag_ids = array();
			foreach( $tags as $individual_tag) {
				$tag_ids[] = $individual_tag->term_id;
			}
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'tag__in' => $tag_ids,
				'post__not_in' => array($post),
				'ignore_sticky_posts' => 1
				);
			$related_posts = get_posts( $args );
			foreach ($related_posts as $related_post) {
				$related_ids[] = $related_post->ID;
			}
			shuffle($related_ids);
		}

		$query_string = array(
			'post__in' => $related_ids,
			'posts_per_page' => $columns * $rows,
			'orderby' => 'post__in',
			'ignore_sticky_posts' => 1
		);
	}
	else {
		$query_string = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $columns * $rows,
			'paged' => $paged,
			'orderby' => $orderby,
			'order' => $order,
			'ignore_sticky_posts' => $ignoresticky
			);
		if ( $category !== "-1" ){
			$query_string = $query_string + array(
				'cat' => $category
				);
		}
		if ( $orderby == 'meta_value' || $orderby == 'meta_value_num' ) {
			$query_string = $query_string + array(
				'meta_key' => $meta_key
			);
		}
	}

	$query_string_ajax = str_replace('&','&amp;',http_build_query($query_string));
	$query_string_ajax = str_replace('&','&amp;',http_build_query($query_string));

	$snpshpwp_posts = new WP_Query( $query_string );
	$count = $snpshpwp_posts->post_count;

	if ( $snpshpwp_posts->have_posts() ) :

		$out .= "<div class='snpshpwp_blog snpshpwp_type_{$type} snpshpwp_align_{$align}' data-string='{$query_string_ajax}' data-shortcode='{$words}|{$columns}|{$align}|{$pagination}|{$show_category}|{$show_date}|{$show_author}|{$show_comments}'>";

			$out .= '<div class="snpshpwp_blog_separate anivia_row fbuilder_row"><div>';
			while( $snpshpwp_posts->have_posts() ): $snpshpwp_posts->the_post();

				if ( $add_class !== '' ) $out .= '</div></div><div class="snpshpwp_blog_separate anivia_row fbuilder_row"><div>';

				$feat_area = '';
				$heading = '';
				$post_counter++;

				if ( $ignoresticky == 0 && is_sticky() ) $sticky_icon = '<i class="fa fa-pushpin"></i> '; else $sticky_icon = '';

				if ( false === $format || $format == 'aside' || $format == 'chat' || $format == 'status' ) {
					$format = 'standard';
				}

				$out .= '<div class="' . implode( ' ', get_post_class() ) . ' snpshpwp_post fbuilder_column fbuilder_column-1-' . $columns . '">';

				if ( $type !== '0' ) {
					$feat_area .= snpshpwp_get_featarea( $image_size, $format );
				}
				else {
					$feat_area .= get_the_post_thumbnail( get_the_ID(), 'snpshpwp-square' );
				}

				if ( $format !== 'quote' ) {
					$heading .= '<h3 class="snpshpwp_blog_title"><a href="'.get_permalink().'" rel="bookmark">' . $sticky_icon . get_the_title() . '</a></h3>';
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
		if ( $pagination == 'true' ) {
			$out .= snpshpwp_mini_pagination($snpshpwp_posts->max_num_pages, $paged, 3, $ajax, '');
		}
		else {
			$out .= '';
		}

	endif;

	wp_reset_query();

	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="snpshpwp_div_inherit_width snpshpwp_div_touch_optimized '.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;

// [snpshpwp_title]
if ( !function_exists( 'snpshpwp_title' ) ) :
function snpshpwp_title( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'center',
		'type' => 'h3',
		'bot_margin' => 24,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	$bot_margin = (int)$bot_margin;
	$margin = ' style="padding-bottom:'.$bot_margin.'px"';

	$out = sprintf( '<%3$s class="snpshpwp_title snpshpwp_header_font text-%2$s">%1$s</%3$s>', $content, $align, $type );

	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="'.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;

// [snpshpwp_revslider]
if ( !function_exists( 'snpshpwp_revslider' ) ) :
function snpshpwp_revslider( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'slider' => '',
		'bot_margin' => 36
	), $atts ) );
	
	if ( $slider == '' ) echo 'Please set slider.';
	
	return do_shortcode('[rev_slider '.$slider.']' );
}
endif;

// [snpshpwp_contactform]
if ( !function_exists( 'snpshpwp_contactform' ) ) :
function snpshpwp_contactform( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'users' => 1,
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	$bot_margin = (int)$bot_margin;

	$out = '';
	$out .= snpshpwp_contact_form( $users, '' );

	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="'.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;


// [snpshpwp_post_pagination]
if ( !function_exists( 'snpshpwp_post_pagination' ) ) :
function snpshpwp_post_pagination( $atts, $content = null ) {
	extract (shortcode_atts( array(
		'previous' => __('Previous Post', 'snpshpwp'),
		'next' => __('Next Post', 'snpshpwp'),
		'category' => '-1',
		'post_id' => '',
		'ajax' => '',
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ));

	global $post, $wp_query;
	$wp_query->is_single = true;
	$prev_link = '';
	$next_link = '';
	$categories = $category;
	$cat_switch = explode(',', $category);

	if ( $post === NULL ) {
		$post = get_post( $post_id );
	}

	$bot_margin = (int)$bot_margin;

	if ( $category !== '-1' && strpos($category, ',') == true ) :
		$category = explode(',', $category);
		foreach ($category as $cat) {
			$child_cats = (array) get_term_children($cat, 'category');
			$cat_switch = $cat_switch + $child_cats;
		}

		$category_ids = get_all_category_ids();
		$exclude = implode(',', array_diff($category_ids, $cat_switch));

		$next_post = get_next_post(false, $exclude);
		$prev_post = get_previous_post(false, $exclude);
	elseif ( strpos($category, ',') == false ) :
		$category_ids = get_all_category_ids();
		$exclude = implode(',', array_diff($category_ids, array($category)));

		$next_post = get_next_post(false, $exclude);
		$prev_post = get_previous_post(false, $exclude);
	else :
		$next_post = get_next_post(false);
		$prev_post = get_previous_post(false);
	endif;

	if (!empty( $next_post )) {
		if ( $ajax == 'yes') {
			$ajax_fnc = ' onclick="snpshpwp_ajaxload_portfolio_single_inner(jQuery(this), \''.$next_post->ID.'\'); return false;"';
		}
		$next_link = '<div class="inline-block a-inherit"><a href="'.get_permalink( $next_post->ID ).'"'.$ajax_fnc.' data-direction="right">'.$next.'</a></div>';
	}
	else {
		$next_link = '<div class="inline-block a-inherit not-active">'.$next.'</div>';
	}

	if (!empty( $prev_post )){
		if ( $ajax == 'yes') {
			$ajax_fnc = ' onclick="snpshpwp_ajaxload_portfolio_single_inner(jQuery(this), \''.$prev_post->ID.'\'); return false;"';
		}
		$prev_link = '<div class="inline-block a-inherit"><a href="'.get_permalink( $prev_post->ID ).'"'.$ajax_fnc.' data-direction="left">'.$previous.'</a></div>';
	}
	else {
		$prev_link = '<div class="inline-block a-inherit not-active">'.$previous.'</div>';
	}

	$out = '';

	if ( empty( $next_post ) && empty( $prev_post ) ) {
		$next_link = '<div class="inline-block a-inherit not-active">'.$previous.'</div>';
		$prev_link = '<div class="inline-block a-inherit not-active">'.$next.'</div>';
	}

	$out .= sprintf( '<div class="snpshpwp_nav_element snpshpwp_header_font"%3$s>
		%2$s
		%1$s
		%4$s
	</div>', $next_link, $prev_link, ' data-categories="'.$categories.'"', '<div id="snpshpwp_port_close" class="float_right a-inherit"><a href="#"><i class="f-snpshpwp-close"></i></a></div>');

	if($animate != 'none') {
		$animate = ' frb_animated frb_'.$animate.'"';
		
		if($animation_delay != 0) {
			$animation_delay = (int)$animation_delay;
			$animate .= ' data-adelay="'.$animation_delay.'"';
		}
		if($animation_group != '') {
			$animate .= ' data-agroup="'.$animation_group.'"';
		}
	}
	else
		$animate = '"';
	$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="'.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;">'.$out.'</div>';
	return $html_animated;
}
endif;



if ( SNPSHPWP_WOOCOMMERCE === true ) {

	function refresh_woo_categories() {
		global $fbuilder, $snpshpwp_data;

		$woo_categories = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC'));
		$fbuilder_woo_categories = array();
		$first_category = '';
		$fbuilder_woo_categories_slug = array();
		$first_category_slug = '';

		foreach($woo_categories as $obj) :
			if($first_category == '') $first_category = $obj->term_id;
			$fbuilder_woo_categories[$obj->term_id] = $obj->slug;
		endforeach;

		foreach($woo_categories as $obj) :
			if($first_category_slug == '') $first_category_slug = $obj->slug;
			$fbuilder_woo_categories_slug[$obj->slug] = $obj->slug;
		endforeach;


		$woo_products = get_posts( array(
			'post_type'      => array( 'product', 'product_variation' ),
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'meta_query' => array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array('catalog', 'visible'),
					'compare' 	=> 'IN'
				)
			)
		) );

		$snpshpwp_margin = $snpshpwp_data['fb_bmargin'];
		$fbuilder_woo_products = array();
		$first_product = '';
		foreach($woo_products as $key => $obj) {
			if($first_product == '') $first_product = $obj->ID;
			$fbuilder_woo_products[$obj->ID] = $obj->post_title;
		}

$admin_optionsDB = $fbuilder->option();
$opts = array();
foreach($admin_optionsDB as $opt) {
	if(isset($opt->name) && isset($opt->value))
		$opts[$opt->name] = $opt->value;
}

		$animationList = array(
			'none' => __('None', 'snpshpwp'),
			'flipInX' => __('Flip in X', 'snpshpwp'),
			'flipInY' => __('Flip in Y', 'snpshpwp'),
			'fadeIn' => __('Fade in', 'snpshpwp'),
			'fadeInDown' => __('Fade in from top', 'snpshpwp'),
			'fadeInUp' => __('Fade in from bottom', 'snpshpwp'),
			'fadeInLeft' => __('Fade in from left', 'snpshpwp'),
			'fadeInRight' => __('Fade in from right', 'snpshpwp'),
			'fadeInDownBig' => __('Slide in from top', 'snpshpwp'),
			'fadeInUpBig' => __('Slide in from bottom', 'snpshpwp'),
			'fadeInLeftBig' => __('Slide in from left', 'snpshpwp'),
			'fadeInRightBig' => __('Slide in from right', 'snpshpwp'),
			'bounceIn' => __('Bounce in', 'snpshpwp'),
			'bounceInDown' => __('Bounce in from top', 'snpshpwp'),
			'bounceInUp' => __('Bounce in from bottom', 'snpshpwp'),
			'bounceInLeft' => __('Bounce in from left', 'snpshpwp'),
			'bounceInRight' => __('Bounce in from right', 'snpshpwp'),
			'rotateIn' => __('Rotate in', 'snpshpwp'),
			'rotateInDownLeft' => __('Rotate in from top-left', 'snpshpwp'),
			'rotateInDownRight' => __('Rotate in from top-right', 'snpshpwp'),
			'rotateInUpLeft' => __('Rotate in from bottom-left', 'snpshpwp'),
			'rotateInUpRight' => __('Rotate in from bottom-right', 'snpshpwp'),
			'lightSpeedIn' => __('Lightning speed', 'snpshpwp'),
			'rollIn' => __('Roll in', 'snpshpwp')
		);

		$animationControl = array(
			'group_animate' => array(
				'type' => 'collapsible',
				'label' => __('Animation','snpshpwp'),
				'options' => array(
					'animate' => array(
						'type' => 'select',
						'label' => __('Type:','snpshpwp'),
						'std' => 'none',
						'label_width' => 0.25,
						'control_width' => 0.75,
						'options' => $animationList
					),
					'animation_group' => array(
						'type' => 'input',
						'label' => __('Group:','snpshpwp'),
						'std' => '',
						'half_column' => 'true'
					),
					'animation_delay' => array(
						'type' => 'number',
						'label' => __('Delay:','snpshpwp'),
						'std' => 0,
						'unit' => 'ms',
						'min' => 0,
						'step' => 50,
						'max' => 10000,
						'half_column' => 'true'
					)
				)
			)
		);

		if(isset($opts['css_classes']) && $opts['css_classes'] == 'true') {
			$classControl = array(
				'group_css' => array(
					'type' => 'collapsible',
					'label' => __('ID & Custom CSS','snpshpwp'),
					'options' => array(
						'shortcode_id' => array(
							'type' => 'input',
							'label' => __('ID:','snpshpwp'),
							'desc' => __('For linking via hashtags','snpshpwp'),
							'label_width' => 0.25,
							'control_width' => 0.75,
							'std' => ''
						),
						'class' => array(
							'type' => 'input',
							'label' => __('Class:','snpshpwp'),
							'desc' => __('For custom css','snpshpwp'),
							'label_width' => 0.25,
							'control_width' => 0.75,
							'std' => ''
						)
					)
				)
			);
			$tabsId = array(
				'custom_id' => array(
					'type' => 'input',
					'label' => __('Tab ID:','snpshpwp'),
					'desc' => __('For use of anchor in url. Make sure that this ID is unique on the page.','snpshpwp'),
					'label_width' => 0.25,
					'std' => ''
				)
			);
		}
		else {
			$classControl = array();
			$tabsId = array();
		}



/* -------------------------------------------------------------------------------- */
/* SNPSHPWP PRODUCTS */
/* -------------------------------------------------------------------------------- */
$snpshpwp_products = array(
	'snpshpwp_products' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Single Products','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_woo_single_products.png',
		'function' => 'snpshpwp_products',
		'group' => 'SNAPSHOP WooCommerce',
		'options' => array_merge(
		array(
			'group_products' => array(
				'type' => 'collapsible',
				'label' => __('Products','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'ids' => array(
						'type' => 'select',
						'label' => __('Products:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '',
						'options' => $fbuilder_woo_products,
						'search' => 'true',
						'multiselect' => 'true'
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '4',
						'options' => array (
							'1'=> '1',
							'2'=> '2',
							'3'=> '3',
							'4'=> '4'
							)
					),
					'orderby' => array(
						'type' => 'select',
						'label' => __('Sort by:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'date',
						'options' => array (
							'comment_count'=> __('By comment count', 'snpshpwp'),
							'date'=> __('By date', 'snpshpwp'),
							'title'=> __('By Title', 'snpshpwp'),
							'rand'=> __('Random', 'snpshpwp')
							)
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Order:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'DESC',
						'options' => array (
							'ASC'=> __('Ascendic', 'snpshpwp'),
							'DESC'=> __('Descendic', 'snpshpwp')
							)
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP CATEGORY SLIDER */
/* -------------------------------------------------------------------------------- */
$snpshpwp_products_cat = array(
	'snpshpwp_products_category' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Insert Products','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_woo_insert_products.png',
		'function' => 'snpshpwp_products_category',
		'group' => 'SNAPSHOP WooCommerce',
		'options' => array_merge(
		array(
			'group_products_cat' => array(
				'type' => 'collapsible',
				'label' => __('Products Slider','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'ids' => array(
						'type' => 'select',
						'label' => __('Products:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '',
						'options' => $fbuilder_woo_categories_slug,
						'search' => 'true',
						'multiselect' => 'true'
					),
					'rows' => array(
						'type' => 'input',
						'label' => __('Rows:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.25,
						'std' => 1
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '4',
						'options' => array (
							'1'=> '1',
							'2'=> '2',
							'3'=> '3',
							'4'=> '4'
							)
					),
					'orderby' => array(
						'type' => 'select',
						'label' => __('Sort by:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'date',
						'options' => array (
							'none' => __('None', 'snpshpwp'),
							'author' => __('Author', 'snpshpwp'),
							'comment_count'=> __('Comment Count', 'snpshpwp'),
							'date'=> __('Date', 'snpshpwp'),
							'ID' => __('ID', 'snpshpwp'),
							'name' => __('Name', 'snpshpwp'),
							'meta_value' => __('Meta Value', 'snpshpwp'),
							'meta_value_num' => __('Meta Value Numeric', 'snpshpwp'),
							'modified' => __('Modified', 'snpshpwp'),
							'parent' => __('Parent', 'snpshpwp'),
							'rand'=> __('Random', 'snpshpwp'),
							'title'=> __('Title', 'snpshpwp'),
							'type' => __('Type', 'type'),
							'post__in' => __('Preserve Post In', 'snpshpwp')
							)
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Order:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'DESC',
						'options' => array (
							'ASC'=> __('Ascendic', 'snpshpwp'),
							'DESC'=> __('Descendic', 'snpshpwp')
							)
					),
					'meta_key' => array(
						'type' => 'input',
						'label' => __('Meta key:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '',
						'hide_if' => array(
							'orderby' => array('none','author','comment_count','date','ID','name','modified','parent','rand','title','type','post__in')
						)
					),
					'ajax' => array(
						'type' => 'checkbox',
						'std' => 'true',
						'label' => __('Ajax Load','snpshpwp'),
						'half_column' => 'true'
					),
					'pagination' => array(
						'type' => 'checkbox',
						'label' => __('Show Pagination','snpshpwp'),
						'std' => 'true',
						'half_column' => 'true'
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP CATEGORIES */
/* -------------------------------------------------------------------------------- */
$snpshpwp_products_caties = array(
	'snpshpwp_product_categories' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Product Categories','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_woo_insert_categories.png',
		'function' => 'snpshpwp_product_categories',
		'group' => 'SNAPSHOP WooCommerce',
		'options' => array_merge(
		array(
			'group_products_caties' => array(
				'type' => 'collapsible',
				'label' => __('Product Categories','snpshpwp'),
				'open' => 'true',
				'options' => array(
					'ids' => array(
						'type' => 'select',
						'label' => __('Category:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '',
						'options' => $fbuilder_woo_categories,
						'search' => 'true',
						'multiselect' => 'true'
					),
					'per_page' => array(
						'type' => 'input',
						'label' => __('Per page:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 4
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => '4',
						'options' => array (
							'1'=> '1',
							'2'=> '2',
							'3'=> '3',
							'4'=> '4'
							)
					),
					'orderby' => array(
						'type' => 'select',
						'label' => __('Sort by:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'date',
						'options' => array (
							'comment_count'=> __('By comment count', 'snpshpwp'),
							'date'=> __('By date', 'snpshpwp'),
							'title'=> __('By Title', 'snpshpwp'),
							'rand'=> __('Random', 'snpshpwp')
							)
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Order:','snpshpwp'),
						'label_width' => 0.25,
						'control_width' => 0.75,
						'std' => 'DESC',
						'options' => array (
							'ASC'=> __('Ascendic', 'snpshpwp'),
							'DESC'=> __('Descendic', 'snpshpwp')
							)
					)
				)
			)
		),
		$classControl,
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
					)
				)
			)
		),
		$animationControl
		)
	)
);


/* -------------------------------------------------------------------------------- */
/* SNPSHPWP CART */
/* -------------------------------------------------------------------------------- */
$snpshpwp_cart = array(
	'snpshpwp_cart' => array(
		'type' => 'draggable',
		'text' => __('SNAPSHOP Cart','snpshpwp'),
		'icon' => get_template_directory_uri() . '/images/fbuilder/ss_woo_cart.png',
		'function' => 'snpshpwp_cart',
		'group' => 'SNAPSHOP WooCommerce',
		'options' => array_merge(
		array(
		array(
			'group_general' => array(
				'type' => 'collapsible',
				'label' => __('General','snpshpwp'),
				'options' => array(
					'bot_margin' => array(
						'type' => 'number',
						'label' => __('Bottom margin:','snpshpwp'),
						'std' => $opts['bottom_margin'],
						'unit' => 'px'
							)
						)
					)
				)
			)
		)
	)
);

			$woocommerce_shortcodes = array_merge ( $snpshpwp_products, $snpshpwp_products_cat, $snpshpwp_products_caties, $snpshpwp_cart );

			if ( isset($fbuilder) ) {
				$fbuilder->add_new_shortcodes($woocommerce_shortcodes);
			}
		}
	add_action('init', 'refresh_woo_categories');
}

// Woo


// [snpshpwp_products]
if ( !function_exists('snpshpwp_products') ) :
function snpshpwp_products( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'ids' => '',
		'columns' => '4',
		'orderby' => 'date',
		'order' => 'DESC',
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	if ( $ids == '' ) return __('Please select products', 'snpshpwp');

	$bot_margin = (int)$bot_margin;

	$bot_margin = (int)$bot_margin;
	$margin = ' style="margin-bottom:'.$bot_margin.'px"';

	$out = '';
	$shortcode = '[products ids="'.$ids.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]';
	$out .= '<div class="snpshpwp_woo_wrap"'.$margin.'>'.do_shortcode($shortcode).'</div>';
	return $out;
}
endif;

// [snpshpwp_product_categories]
if ( !function_exists('snpshpwp_product_categories') ) :
function snpshpwp_product_categories( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'ids' => '',
		'per_page' => 4,
		'columns' => '4',
		'orderby' => 'date',
		'order' => 'DESC',
		'bot_margin' => 36,
		'hide_empty' => 1,
		'parent'     => '',
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	if ( $ids == '' ) return __('Please select categories', 'snpshpwp');

	$bot_margin = (int)$bot_margin;
	$margin = ' style="margin-bottom:'.$bot_margin.'px"';


	$out = '';

		global $woocommerce_loop;

		if ( isset( $atts[ 'ids' ] ) ) {
			$ids = explode( ',', $atts[ 'ids' ] );
			$ids = array_map( 'trim', $ids );
		} else {
			$ids = array();
		}

		$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

		$args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => 1,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent,
			'parent'     => ''
		);

		$product_categories = get_terms( 'product_cat', $args );
		$cat_num = count($product_categories);
		$product_categories = array_slice($product_categories, 0, $rows*$columns);

		$pagination = snpshpwp_mini_woo_pagination_cat($cat_num, 1, $rows*$columns, 'yes');

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

	$out .= '<div class="snpshpwp_woo_wrap div_touch_optimized snpshpwp_div_inherit_width"'.$margin.' data-shortcode="'.$bot_margin.'|'.$columns.'|'.$per_page.'|'.$order.'|'.$orderby.'|'.implode(',',$ids).'">'.do_shortcode($shortcode).$pagination.'</div>';
	return $out;

}
endif;

// [snpshpwp_products_category]
if ( !function_exists('snpshpwp_products_category') ) :
function snpshpwp_products_category( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'ids' => '',
		'rows' => 1,
		'columns' => '4',
		'orderby' => 'date',
		'order' => 'DESC',
		'meta_key'=> '',
		'ajax' => 'yes',
		'pagination' => 'yes',
		'bot_margin' => 36,
		'class' => '',
		'shortcode_id' => '',
		'animate' => 'none',
		'animation_delay' => 0,
		'animation_group' => ''
	), $atts ) );

	if ( $ids == '' ) return __('Please select categories', 'snpshpwp');
	$exploded = explode(',', $ids);

	global $paged;
	$args = array();
	if ( empty( $paged ) ) $paged = 1;



	if ( isset($_GET['orderby']) ) {
		if ( $_GET['orderby'] == 'price' || $_GET['orderby'] == 'price-desc' ) {
			$orderby = 'meta_value_num';
			$order = ( $_GET['orderby'] == 'price' ? 'ASC' : 'DESC' );
			$args = array(
				'meta_key' => '_price'
			);
		}
		else if ( $_GET['orderby'] == 'rating' ) {
			add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
		}
		else if ( $_GET['orderby'] == 'popularity' ) {
			$orderby = 'meta_value_num';
			$order = 'DESC';
			$args = array(
				'meta_key' => 'total_sales'
			);
		}
		else if ( $_GET['orderby'] == 'menu_order' ) {
			$orderby = $orderby;
		}
		else {
			$orderby = $_GET['orderby'];
		}
	}

	if ( isset($_GET['min_price']) && isset($_GET['max_price']) ) {
		$orderby = 'meta_value_num';
		$order = 'ASC';
		$args['meta_query'] = array(
			array(
				'key' => '_price',
				'value' => array(floatval($_GET['min_price']), floatval($_GET['max_price'])),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			)
		);
	}

	if ( isset($_GET['product_tag']) ) {
		$args = array_merge( $args, array(
					'product_tag' => $_GET['product_tag']
			) );

	}

	if ( isset($_GET['characteristics']) ) {
		$args = array_merge( $args, array(
					'characteristics' => $_GET['characteristics']
			) );

	}

	if ( isset($_GET['sale_products']) ) {

		$meta_query = array( 
			array(
				'key' => '_sale_price',
				'value' => 0,
				'compare' => '>',
				'type' => 'numeric'
			)
		);
		$args['meta_query'] = $meta_query;

	}

	if ( isset($_GET['product_cat']) ) {
		$args = $args + array(
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array( $_GET['product_cat'] ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			)
		);
	}
	else if ( $ids !== '0' ) {
		$args = $args + array(
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> $exploded,
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			)
		);
	}

	foreach($_GET as $k => $v){
		if (strpos($k,'pa_') !== false) {
			$args = $args + array(
				'tax_query' 			=> array(
					array(
						'taxonomy' 		=> $k,
						'terms' 		=> $v,
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				)
			);
		}
	}




	if ( !isset($args['meta_query']) ) {
		$args['meta_query'] = WC()->query->get_meta_query();
	}

	$args = $args + array(
		'post_type'				=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' 				=> $orderby,
		'order' 				=> $order,
		'posts_per_page' 		=> $columns*$rows,
		'paged' 				=> $paged,
		'meta_query' 			=> array(
			array(
				'key' 			=> '_visibility',
				'value' 		=> array('catalog', 'visible'),
				'compare' 		=> 'IN'
			)
		)
	);
	

	if ( !isset($args['meta_query']) ) {
		$args['meta_query'] = WC()->query->get_meta_query();
	}
	


	
	$query_string_ajax = http_build_query($args);

	$bot_margin = (int)$bot_margin;
	$margin = " style='margin-bottom".$bot_margin."px'";

	$out = '';
	$html_pag = '';

	global $woocommerce, $woocommerce_loop;
	
	$woocommerce_loop['columns'] = $columns;

	$products = new WP_Query( $args );

	if ( $pagination == 'true' ) {
		$html_pag = snpshpwp_mini_woo_pagination($products->max_num_pages, $paged, 3, $ajax);
	}

	ob_start();

	if ( $products->have_posts() ) : ?>

		<?php wc_get_template( 'loop/orderby.php' ); ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;

	wp_reset_postdata();
	
	$shortcode = ob_get_clean();

	$out .= do_shortcode($shortcode) . $html_pag;

		if($animate != 'none') {
			$animate = ' frb_animated frb_'.$animate.'"';
			
			if($animation_delay != 0) {
				$animation_delay = (int)$animation_delay;
				$animate .= ' data-adelay="'.$animation_delay.'"';
			}
			if($animation_group != '') {
				$animate .= ' data-agroup="'.$animation_group.'"';
			}
		}
		else
			$animate = '"';
		$html_animated = '<div '.($shortcode_id != '' ? 'id="'.$shortcode_id.'"' : '').' class="snpshpwp_woo_wrap div_touch_optimized snpshpwp_div_inherit_width '.$class.$animate.' style="padding-bottom:'.$bot_margin.'px !important;" data-string="'.$query_string_ajax.'" data-shortcode="'.$margin.'|'.$columns.'|'.$pagination.'|'.$ajax.'">'.$out.'</div>';
		return $html_animated;

}
endif;

// [snpshpwp_product_cart]
if ( !function_exists('snpshpwp_cart') ) :
function snpshpwp_cart( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'bot_margin' => 36
	), $atts ) );

	$bot_margin = (int)$bot_margin;
	$margin = ' style="padding-bottom:'.$bot_margin.'px"';

	$out = '';
	$shortcode = '[woocommerce_cart]';
	$out .= '<div class="snpshpwp_woo_wrap"'.$margin.'>'.do_shortcode($shortcode).'</div>';
	return $out;
}
endif;


// Init shortcodes
if ( !function_exists( 'snpshpwp_shortcodes' ) ) :
function snpshpwp_shortcodes() {
	add_shortcode( 'snpshpwp_team', 'snpshpwp_team' );
	add_shortcode( 'snpshpwp_contactform', 'snpshpwp_contactform' );
	add_shortcode( 'snpshpwp_insert_posts', 'snpshpwp_insert_posts' );
	add_shortcode( 'snpshpwp_title', 'snpshpwp_title' );
	add_shortcode( 'snpshpwp_revslider', 'snpshpwp_revslider' );
	add_shortcode( 'snpshpwp_post_pagination', 'snpshpwp_post_pagination' );
	add_shortcode( 'snpshpwp_featured_links', 'snpshpwp_featured_links' );


	add_shortcode( 'snpshpwp_products', 'snpshpwp_products' );
	add_shortcode( 'snpshpwp_products_category', 'snpshpwp_products_category' );
	add_shortcode( 'snpshpwp_product_categories', 'snpshpwp_product_categories' );
	add_shortcode( 'snpshpwp_cart', 'snpshpwp_cart' );
}
endif;
add_action( 'init', 'snpshpwp_shortcodes' );

?>