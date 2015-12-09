<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

get_header();
global $snpshpwp_data;
?>
<?php
	do_action('snpshpwp_before_content');
?>
	<div id="snpshpwp_content">
		<div class="snpshpwp_container">
			<div id="content" <?php post_class(); ?>>
				<?php
					echo do_shortcode( sprintf('[snpshpwp_title title="%1$s" align="center" type="h2" bot_margin="128"]%2$s[/snpshpwp_title]', __('404 NOT FOUND', 'snpshpwp'), __('The page you are looking for does not exist.', 'snpshpwp') ) );
				?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>