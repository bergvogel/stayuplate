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
 <script src="<?bloginfo('template_url');?>/js/flowtype.js"></script>

    </head>
<body style="">

<div id="main" class="m-scene">
   <div id="topmenu_overlay" style="display:none;">
    <ul>
        <li class="page_item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
        <?php wp_list_pages('sort_column=post_date&title_li='); ?>
    </ul>
   <img class="close_menu" src="<?bloginfo('template_url');?>/img/close.png">    

</div>

    <div id="header">
   
    <div id="toggle-menu" class="hidden">
    <div>
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
    </div>
</div>
<div id="topmenu">
    <ul>
    <li class="page_item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
    <?php wp_list_pages('sort_column=post_date&title_li='); ?>
    </ul>
</div>


       

    <div id="headercontent">
        <div id="nextevent">
             <div class="lineup">
                <ul>
                    <li>Barnt</li>
                    <li>Bicep</li>
                    <li>Fatima Yamaha live</li>
                    <li>Job Jobse </li>
                    <li>Midland</li>
                    <li>Modular DJ's</li>
                    <li>Oceanic & Woody</li>
                    <li>ROD</li>  
                </ul>
            </div>
        </div>
    </div>
       
<!--         <img id="stoofpot_logo" src="<?bloginfo('template_url');?>/img/pastedsvg%202.svg" class="image" />
 -->       
    </div>
         


