<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
?>
<?php global $snpshpwp_data; ?>
<?php
	if ( $snpshpwp_data['mailchimp'] == 1 && !isset($_COOKIE['visited']) ) {
		setcookie('visited', true, time() + 3600 * 24);
		$newsletter = sprintf('<div id="snpshpwp_newsletter"><div class="snpshpwp_newsletter">%1$s<a id="snpshpwp_newsletter_close" href="#">X</a></div></div>', ( SNPSHPWP_MAILCHIMP === true && $snpshpwp_data['mailchimp_override'] == '' ? do_shortcode('[mc4wp_form]') : $snpshpwp_data['mailchimp_override'] ) );
	}
	else {
		$newsletter = '';
	}
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php
	if ( is_page_template('template-onepage.php') || is_home() ) :
?>
<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
<?php
	else :
?>
<title><?php wp_title( '', true ); ?> | <?php bloginfo('name'); ?></title>
<?php
	endif;
?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ( $snpshpwp_data['responsive'] == 1 ) :	?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php else : ?>
<meta name="viewport" content="width=1200, maximum-scale=3, user-scalable=1, target-densitydpi=device-dpi">
<?php endif; ?>
<?php if ( $snpshpwp_data['favicon'] !== '' ) :	?>
<link id="snpshpwp_favicon" rel="shortcut icon" href="<?php echo $snpshpwp_data['favicon']; ?>" type='image/x-icon'>
<?php endif; ?>
<?php if ( $snpshpwp_data['apple_ti57'] !== '' ) :	?>
<link rel="apple-touch-icon" href="<?php echo $snpshpwp_data['apple_ti57']; ?>" type="image/png">
<?php endif; ?>
<?php if ( $snpshpwp_data['apple_ti72'] !== '' ) :	?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $snpshpwp_data['apple_ti72']; ?>" type="image/png">
<?php endif; ?>
<?php if ( $snpshpwp_data['apple_ti114'] !== '' ) :	?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $snpshpwp_data['apple_ti114']; ?>" type="image/png">
<?php endif; ?>
<?php if ( $snpshpwp_data['apple_ti144'] !== '' ) :	?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $snpshpwp_data['apple_ti144']; ?>" type="image/png">
<?php endif; ?>
<!--[if lt IE 9]>
<script>
	document.createElement('header');
	document.createElement('nav');
	document.createElement('section');
	document.createElement('article');
	document.createElement('aside');
	document.createElement('footer');
	document.createElement('video');
	document.createElement('audio');
</script>
<![endif]-->
<?php
	$snpshpwp_class = 'snpshpwp-layout snpshpwp_' . $snpshpwp_data['site_layout'];

	if ( SNPSHPWP_WOOCOMMERCE === true ) {
		$snpshpwp_class .= ' woocommerce';
	}

	if ( is_single() || is_page() ) {
		$padding = get_post_meta( get_the_ID(), 'snpshpwp_padding', true );
		if ( $padding == '1') $snpshpwp_class .= ' snpshpwp_remove_padding';
	}
	if ( is_page() ) {
		$page_bg = get_post_meta( get_the_ID(), 'snpshpwp_page_bg', true );
		if ( $page_bg == '' || $page_bg == 'none' ) {
			$snpshpwp_class .= ' div-nobgvideo';
		}
	}
	else {
		$snpshpwp_class .= ' div-nobgvideo';
	}
	wp_head();
?>
</head>
<body <?php body_class( $snpshpwp_class ); ?> >
<?php
	echo $newsletter;
?>
<div id="snpshpwp_loader"<?php echo ( $snpshpwp_data['loader_background'] !== '' ? ' style="background-image:url('.$snpshpwp_data['loader_background'].');"' : '' ); ?><?php echo ( $snpshpwp_data['loader_active'] !== '1' ? '' : ' class="snpshpwp_not_active"' ); ?>><div id="snpshpwp_loader_bar"></div></div>
<div id="snpshpwp_wrapper">
	<?php
		if ( is_page() ) {
			if ( $page_bg !== '' && $page_bg !== 'none' ) {
				switch ($page_bg) :
					case 'videoembed' :
						printf('<div id="snpshpwp_page_bg" class="snpshpwp_page_bg"><div id="snpshpwp_page_bg_inner"></div></div>' );
					break;
					case 'html5video' :
						$add_poster = ( has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ) : '' );
						$mp4 = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_mp4',true);
						$ogv = get_post_meta(get_the_ID(),'snpshpwp_pagevideo_ogv',true);
						$entry = sprintf('<video class="fullwidth block" preload="auto" loop="loop" autoplay%4$s>
								<source src="%1$s" type="video/mp4">
								<source src="%2$s" type="video/ogg">
								%3$s
						</video>', $mp4, $ogv, __( 'Your browser does not support the video tag.', 'snpshpwp' ), ( $add_poster !== '' ? ' poster="'.$add_poster[0].'"  data-image-replacement="'.$add_poster[0].'"' : '') );
						printf('<div id="snpshpwp_page_bg" class="snpshpwp_page_bg">%1$s</div>', $entry );
					break;
				endswitch;
			
			}
		}
	?>

	<div id="snpshpwp_header" class="snpshpwp_header<?php echo ( $snpshpwp_data['header_sticky'] !== '1' ? ' snpshpwp_deactivate_sticky' : '' ); ?>">
			<?php
				if ( $snpshpwp_data['header_bar'] !== '1' ) :
			?>
			<div class="snpshpwp_header_bar">
				<div class="snpshpwp_header_container">
					<div class="snpshpwp_header_bar_elements">
						<div class="snpshpwp_header_left float_left">
							<?php
								snpshpwp_elements('left', 'header_bar');
							?>
						</div>
						<div class="snpshpwp_header_right float_right">
							<?php
								snpshpwp_elements('right', 'header_bar');
							?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<?php
				endif;
			?>
			<?php
				if ( $snpshpwp_data['header_custom'] !== '' ) :
			?>
			<div class="snpshpwp_header_custom">
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description') ?>">
				<img src="<?php echo $snpshpwp_data['header_custom']; ?>" alt="<?php bloginfo('name') ?>" />
				</a>
			</div>
			<?php
				endif;
			?>
			<div class="snpshpwp_header_elements<?php echo ( $snpshpwp_data['header_mode'] == 'center' ? ' snpshpwp_mode_center' : ' snpshpwp_mode_default' ); ?>">
				<div class="snpshpwp_header_container">
					<div class="snpshpwp_top snpshpwp_custom_elements">
						<div class="snpshpwp_top_left float_left">
							<?php
								snpshpwp_elements('left', 'header');
							?>
						</div>
						<div class="snpshpwp_top_right float_right">
							<?php
								snpshpwp_elements('right', 'header');
							?>
						</div>
						<div class="clearfix"></div>
						<div class="snpshpwp_responsive_logo">
						<?php
							if ( $snpshpwp_data['header_logo'] !== '' ) :
						?>
							<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description') ?>">
							<img src="<?php echo $snpshpwp_data['header_logo']; ?>"  alt="<?php bloginfo('name') ?>" />
							</a>
						<?php
							else :
							printf('<a href="%1$s" title="%3$s">%2$s</a>', home_url(), get_bloginfo('name'), get_bloginfo('description') );
							endif;
						?>
						</div>
					</div>
					<?php
						if ( in_array('sidenav', $snpshpwp_data['header_left']['enabled']) ) {
					?>
					<div id="snpshpwp_sdnv_left_bar" class="snpshpwp_sdnv_bar">
						<div class="snpshpwp_sdnv_wrap">
							<?php dynamic_sidebar($snpshpwp_data['header_left_sidenav']); ?>
						</div>
					</div>
					<?php
						}
					?>

					<?php
						if ( in_array('sidenav', $snpshpwp_data['header_right']['enabled']) ) {
					?>
					<div id="snpshpwp_sdnv_right_bar" class="snpshpwp_sdnv_bar">
						<div class="snpshpwp_sdnv_wrap">
							<?php dynamic_sidebar($snpshpwp_data['header_right_sidenav']); ?>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>

	</div>

	<?php
		if ( is_page() ) {
			$rs_full = get_post_meta( get_the_ID(), 'snpshpwp_revolution', true );
			if ( $rs_full !== 'none' && $rs_full !== '' ) {
				echo do_shortcode( sprintf( '[rev_slider %1$s]', $rs_full ) );
			}
		}
	?>