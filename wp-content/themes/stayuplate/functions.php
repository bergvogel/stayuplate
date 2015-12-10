<?php if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 333, 250, true ); // default Post Thumbnail dimensions (cropped)
add_image_size( 'news-image', 400, 400 ); //300 pixels wide (and unlimited height)
add_image_size( 'uitgelicht', 400, 9999 ); //300 pixels wide (and unlimited height)
add_image_size( 'slider-image', 2000, 9999 ); //300 pixels wide (and unlimited height)
};

// Load jQuery
if ( !is_admin() ) {
wp_deregister_script('jquery');
wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"), false);
wp_enqueue_script('jquery');
}


// add_action( 'init', 'create_post_type' );
// function create_post_type() {
//   register_post_type( 'specials',
//     array(
//       'labels' => array(
//         'name' => __( 'Specials' ),
//         'singular_name' => __( 'Alle specials' )
//       ),
//       'public' => true,
//       'has_archive' => true,
//     )
//   );
// }

// add_action( 'init', 'slider_post_type' );

// function slider_post_type(){
//   $OurMenu_args = array(
//     'label' => __('Slider films'),
//     'singular_label' => __('Slider_films'),
//     'public'  =>  true,
//     'show_ui' =>  true,
//     'capability_type' =>  'post',
//     'hierarchical'  =>  false,
//     'rewrite' =>  true,
//     'supports'  =>  array('title', 'editor','page-attributes','thumbnail')
//     );
//     register_post_type('slider_films', $OurMenu_args);
// }

// add_theme_support( 'post-thumbnails' );
// set_post_thumbnail_size( 2000, 9999, true );

// function remove_menus(){
  
//   remove_menu_page( 'upload.php' );                 //Media
//   remove_menu_page( 'edit-comments.php' );          //Comments
//   remove_menu_page( 'themes.php' );                 //Appearance
//   remove_menu_page( 'plugins.php' );                //Plugins
//   remove_menu_page( 'tools.php' );                  //Tools
//   remove_menu_page( 'options-general.php' );        //Settings
  
// }
// add_action( 'admin_menu', 'remove_menus' );
