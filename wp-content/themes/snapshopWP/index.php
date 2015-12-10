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
		<div class="anivia_row fbuilder_row">
		<div>
			<?php
				snpshpwp_get_sidebar('blog', 'sidebar-blog', $snpshpwp_data['sidebar-size'], '1');
			?>
			<?php if ( have_posts() ) : ?>
			<?php if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; } ?>
			<div id="snpshpwp_inner_content" class="<?php echo snpshpwp_get_class('content', 'sidebar-blog', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-blog-position']); ?>">
			<?php 
				printf( '<h1 class="snpshpwp_page_title">%1$s</h1>', __('Blog', 'snpshpwp') );
			?>
				<div class="snpshpwp_blog anivia_row fbuilder_row">
					<div>
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'snpshpwp_content' );
						endwhile;
					?>
					</div>
				</div>
			<div class="clearfix"></div>
			<?php
				echo snpshpwp_pagination($wp_query->max_num_pages, $paged, 2, 'no');
			?>
			</div>
			<?php
				else :
			?>
			<div id="snpshpwp_inner_content" class="<?php echo snpshpwp_get_class('content', 'sidebar-blog', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-blog-position']); ?>">
				<?php
					printf( '<h1 class="snpshpwp_page_title">%1$s</h1><h3>%2$s</h3>', __('NO POSTS FOUND', 'snpshpwp'), __('There are no posts within the criteria.', 'snpshpwp') );
				?>
			<div class="clearfix"></div>
			</div>
			<?php
				endif;
			?>
			<?php
				snpshpwp_get_sidebar('blog', 'sidebar-blog', $snpshpwp_data['sidebar-size'], '0');
			?>
		</div>
		</div>

	</div>
<?php get_footer(); ?>