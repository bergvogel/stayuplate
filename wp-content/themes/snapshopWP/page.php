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
	<div id="snpshpwp_content" class="snpshpwp_container">
		<div class="snpshpwp_blog anivia_row fbuilder_row">
			<div>
				<?php if ( have_posts() ) : ?>
				<?php
					snpshpwp_get_sidebar('page', 'sidebar-page', $snpshpwp_data['sidebar-size'], '1');
				?>
				<div id="snpshpwp_inner_content" <?php post_class(snpshpwp_get_class('content', 'sidebar-page', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-page-position'])); ?>>
					<?php
					if ( get_post_meta(get_the_ID(),'snpshpwp_page_title',true) !== '1' && ( $snpshpwp_data['snpshpwp_hide_page_title'] !== '1' )  ) : ?>
					<h1 class="snpshpwp_page_title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php the_post(); ?>
					<?php the_content(); ?>
				</div>
				
				<?php
					snpshpwp_get_sidebar('page', 'sidebar-page', $snpshpwp_data['sidebar-size'], '0');
				?>
				<?php if ( $snpshpwp_data['enable_comments'] == 1 )comments_template(); ?>
				<?php else : ?>
				<div id="snpshpwp_inner_content" <?php post_class(snpshpwp_get_class('content', 'sidebar-page', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-page-position'])); ?>>
					<?php _e('No posts.','snpshpwp'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php
			do_action('snpshpwp_after_content');
		?>
	</div>
<?php get_footer(); ?>