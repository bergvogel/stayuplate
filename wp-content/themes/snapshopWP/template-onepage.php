<?php
/*
 * Template Name: SnapShopWP Homepage
 * Description: SnapShopWP homepage page template.
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
get_header();
global $snpshpwp_data;
?>
	<div id="snpshpwp_content">
		<div class="snpshpwp_container">
		<?php if ( have_posts() ) : ?>
		<div id="content" <?php post_class(); ?>>
			<?php the_post(); ?>
			<?php the_content(); ?>
		</div>
		<?php if ( $snpshpwp_data['enable_comments'] == 1 )comments_template(); ?>
		<?php else : ?>
		<div id="content">
			<?php _e('No ','snpshpwp'); ?>
		</div>
		<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>