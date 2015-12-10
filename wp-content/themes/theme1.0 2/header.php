<?php
/**
 * @package WordPress
 * @subpackage template Theme stayuplate 0.9
 * @author Hilbert Kruidenier
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel='shortcut icon' type='image/x-icon' href='<?bloginfo('template_url');?>/favicon.ico' />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <title><?php wp_title(''); ?></title>

   <!-- CSS -->
    <link rel="stylesheet" href="<?bloginfo('template_url');?>/css/foundation.css">
    <link rel="stylesheet" href="<?bloginfo('template_url');?>/css/app.css">

 <?php wp_head(); ?>
    </head>
<body style="">

<div id="main" class="m-scene">
   
 <div class="overlay_transition rolloverlay"></div>
    <div id="topmenu">
       <?php wp_nav_menu( array( 'theme_location' => 'primary', 'sort_order' => 'DESC',  'show_home' => true ) ); ?>
    </div>

    <div id="header">
        <div id="hamburger_menu">
            <span class="hamburger_line1" class="clearfix">
            </span>
            <span class="hamburger_line1" class="clearfix">
            </span>
            <span class="hamburger_line1" class="clearfix">
            </span>
        </div>

       
<!--         <img id="stoofpot_logo" src="<?bloginfo('template_url');?>/img/pastedsvg%202.svg" class="image" />
 -->        <div id="social_wrapper">
            <a href="https://www.facebook.com/smkmrkt"><img id="fb" src="<?bloginfo('template_url');?>/img/fb.png" class="image" /></a>
            <a href="https://instagram.com/smaakmarkt/"><img id="instagram" src="<?bloginfo('template_url');?>/img/instagram.png" class="image" /></a>
        </div>
    </div>
         


