<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

get_header();
global $snpshpwp_data;

$hide_meta = get_post_meta( get_the_ID(),'snpshpwp_hide_meta', true );
$hide_meta = ( $hide_meta == '' ? $snpshpwp_data['snpshpwp_hide_meta'] : $hide_meta );

if ( ($hide_meta !== '1') || ( $snpshpwp_data['snpshpwp_hide_meta'] !== '1' && $hide_meta !== '1') ) {

	$curr_class = 'fbuilder_column-2-3';
}
else {
	$curr_class = 'fbuilder_column-1-1';
}

?>
<?php
	do_action('snpshpwp_before_content');
?>

	<div id="snpshpwp_content" class="snpshpwp_container">
		<div class="snpshpwp_single anivia_row fbuilder_row">
		<div>
			<?php
				snpshpwp_get_sidebar('single', 'sidebar-single', $snpshpwp_data['sidebar-size'], '1');
			?>
			<?php if ( have_posts() ) : ?>
			<div id="snpshpwp_inner_content" <?php post_class(snpshpwp_get_class('content', 'sidebar-single', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-single-position'])); ?>>
				<div class="snpshpwp_blog anivia_row fbuilder_row">
				<div>
					<div class="fbuilder_column <?php echo $curr_class; ?>">

				<?php the_post(); ?>
				<div class="snpshpwp_post">
					<?php
						$hide_feat = get_post_meta( get_the_ID(),'snpshpwp_hide_featarea', true );
						$hide_feat = ( $hide_feat == '' ? $snpshpwp_data['snpshpwp_hide_featarea'] : $hide_feat );

						if ( ($hide_feat !== '1') || ( $snpshpwp_data['snpshpwp_hide_featarea'] !== '1' && $hide_feat !== '1') ) {
							echo snpshpwp_get_featarea( ( $snpshpwp_data['single_fimage_override'] == 0 ? 'snpshpwp-fullsingle' : 'full' ) );
						}
					?>
					<?php
						$hide_title = get_post_meta( get_the_ID(),'snpshpwp_hide_title', true );
						$hide_title = ( $hide_title == '' ? $snpshpwp_data['snpshpwp_hide_title'] : $hide_title );

						if ( ($hide_title !== '1') || ( $snpshpwp_data['snpshpwp_hide_title'] !== '1' && $hide_title !== '1') ) :
					?>

						<div class="snpshpwp_single_navigation">
							<?php
								$next_post = get_next_post();
								$prev_post = get_previous_post();
								if (!empty( $next_post )):
							?>
								<div class="snpshpwp_prev_link<?php if (empty( $prev_post )) echo ' last-article'; ?>">
									<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="division_header_font div_single_prev" title="<?php echo $next_post->post_title; ?>">&lt;</a></a>
								</div>
							<?php endif; ?>

							<?php	
								if (!empty( $prev_post )):
							?>
								<div class="snpshpwp_next_link<?php if (empty( $next_post )) echo ' first-article'; ?>">
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="division_header_font div_single_next" title="<?php echo $prev_post->post_title; ?>">&gt;</a>
								</div>
							<?php endif; ?>
							<div class="clearfix"></div>
						</div>

					<h1 class="snpshpwp_blog_title uppercase"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

					<?php endif; ?>

					<div id="snpshpwp_div_pure_single">
					<?php the_content(); ?>
					<div class="clearfix"></div>
					</div>
					<?php posts_nav_link(); ?>
					<?php wp_link_pages(array(
							'before'			=> '<div class="bold margin-bottom20">' . __('View', 'snpshpwp') . ': ',
							'after'				=> '</div>',
							'next_or_number'	=> 'next',
							'nextpagelink'		=> __('Next page', 'snpshpwp'),
							'previouspagelink'	=> __('Previous page', 'snpshpwp'),
							'pagelink'			=> '%',
							'echo'				=> 1
						) );
					?>

					<?php
						$hide_tags = get_post_meta( get_the_ID(),'snpshpwp_hide_tags', true );
						$hide_tags = ( $hide_tags == '' ? $snpshpwp_data['snpshpwp_hide_tags'] : $hide_tags );

						if ( ($hide_tags !== '1') || ( $hide_tags !== '1' && $snpshpwp_data['snpshpwp_hide_tags'] !== '1' ) ) :
					?>
					<?php the_tags( '<p class="tagcloud">', ' ', '</p>' ); ?>
					<?php endif; ?>
					<?php comments_template(); ?>
					<div class="clearfix"></div>
					<?php
						$hide_rel_main = get_post_meta( get_the_ID(),'snpshpwp_hide_related_main', true );
						$hide_rel_main = ( $hide_rel_main == '' ? $snpshpwp_data['snpshpwp_hide_related_main'] : $hide_rel_main );

						if ( ($hide_rel_main !== '1') || ( $snpshpwp_data['snpshpwp_hide_related_main'] !== '1' && $hide_rel_main !== '1') ) :
					?>
					<div class="snpshpwp_related">
						<h3><?php _e('Related posts', 'snpshpwp'); ?></h3>
						<?php echo do_shortcode('[snpshpwp_insert_posts related="true" type="'.$snpshpwp_data['snpshpwp_related_columns'].'" rows="1" excerpt_lenght="128" bot_margin="0" show_date="false" show_date="false" show_author="false" show_category="false" show_comments="false" pagination="false"]'); ?>
					</div>
					<?php
						endif;
					?>
					</div>
					</div>


					<?php
						$hide_meta = get_post_meta( get_the_ID(),'snpshpwp_hide_meta', true );
						$hide_meta = ( $hide_meta == '' ? $snpshpwp_data['snpshpwp_hide_meta'] : $hide_meta );

						if ( ($hide_meta !== '1') || ( $snpshpwp_data['snpshpwp_hide_meta'] !== '1' && $hide_meta !== '1') ) :

					?>

					<div class="snpshpwp_sideauthor fbuilder_column fbuilder_column-1-3">

						<?php
							$hide_author = get_post_meta( get_the_ID(),'snpshpwp_hide_author', true );
							$hide_author = ( $hide_author == '' ? $snpshpwp_data['snpshpwp_hide_author'] : $hide_author );

							if ( ($hide_author !== '1') || ( $snpshpwp_data['snpshpwp_hide_author'] !== '1' && $hide_author !== '1') ) :
						?>
						<div class="snpshpwp_post_author">
							<h3><?php _e('About the author', 'snpshpwp'); ?></h3>
							<?php the_author_meta('description'); ?>
						</div>
						<?php endif; ?>

						<?php
							$hide_post_meta = get_post_meta( get_the_ID(),'snpshpwp_hide_postmeta', true );
							$hide_post_meta = ( $hide_post_meta == '' ? $snpshpwp_data['snpshpwp_hide_postmeta'] : $hide_post_meta );

							if ( ($hide_post_meta !== '1') || ( $snpshpwp_data['snpshpwp_hide_postmeta'] !== '1' && $hide_post_meta !== '1') ) :
								$timecode = get_the_date();
								$num_comments = get_comments_number();
								if ( comments_open() ) {
									if ( $num_comments == 0 ) {
										$comments = __('still no comments', 'snpshpwp');
									} elseif ( $num_comments > 1 ) {
										$comments = $num_comments . ' ' . __('Comments', 'snpshpwp');
									} else {
										$comments = __('1 Comment', 'snpshpwp');
									}
									$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
								} else {
									$write_comments =  __('Comments are off for this post.', 'snpshpwp');
								}
								echo '<div class="snpshpwp_posts_meta">
								<div class="snpshpwp_category_meta">'.__('Category:', 'snpshpwp').' '.get_the_category_list( ', ' ).'</div> 
								<div class="snpshpwp_date_meta">'.__('Published on: ').'<a href="'.get_month_link( get_the_time('Y'), get_the_time('m') ).'" title="'.__('View all posts this month', 'snpshpwp').'">'.$timecode.'</a></div> 
								<div class="snpshpwp_author_meta">'.__('Written by:', 'snpshpwp').' '.get_the_author_link().'</div> 
								<div class="snpshpwp_comment_meta">'.__('Comments:', 'snpshpwp').' '.$write_comments.'</div></div>';
								endif;
						?>

						<?php
							$hide_pcbw = get_post_meta( get_the_ID(),'snpshpwp_hide_share', true );
							$hide_pcbw = ( $hide_pcbw == '' ? $snpshpwp_data['snpshpwp_hide_share'] : $hide_pcbw );
							if ( ($hide_pcbw !== '1') || ( $snpshpwp_data['snpshpwp_hide_share'] !== '1' && $hide_pcbw !== '1') ) :
						?>
						<div class="snpshpwp_pcbw">
							<h3><?php _e('Share this article', 'snpshpwp'); ?></h3>
							<nav class="snpshpwp_social_bar">
								<ul>
									<?php
										$title = str_replace(' ', '%20', get_the_title());
									?>
									<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large'); ?>
									<li><a class="snpshpwp_facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo $title; ?>" data-href="<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/share/facebook.png'; ?>" title="<?php _e('Share on Facebook!'); ?>" /></a></li>
									<li><a class="snpshpwp_google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/share/google.png'; ?>" title="<?php _e('Share on Google!'); ?>" /></a></li>
									<li><a class="snpshpwp_twitter" href="http://twitter.com/home/?status=<?php echo $title; ?>%20<?php the_permalink(); ?>" data-count-layout="horizontal" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/share/twitter.png'; ?>" title="<?php _e('Share on Twitter!'); ?>" /></a></li>
									<li><a class="snpshpwp_linked" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>&amp;source=<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri() . '/images/share/linkedin.png'; ?>" title="<?php _e('Share on LinkedIn!'); ?>" /></a></li>
									<li><a class="snpshpwp_pinterest" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $large_image_url[0]; ?>&amp;description=<?php echo $title; ?>" data-count-layout="horizontal"><img src="<?php echo get_template_directory_uri() . '/images/share/pinterest.png'; ?>" title="<?php _e('Share on Pinterest!'); ?>" /></a></li>
								</ul>
							</nav>
						<div class="clearfix"></div>
						</div>
						<?php
							endif;
						?>

						<?php
							$hide_rel_side = get_post_meta( get_the_ID(),'snpshpwp_hide_related_side', true );
							$hide_rel_side = ( $hide_rel_side == '' ? $snpshpwp_data['snpshpwp_hide_related_side'] : $hide_rel_side );
							if ( ($hide_rel_side !== '1') || ( $snpshpwp_data['snpshpwp_hide_related_side'] !== '1' && $hide_rel_side !== '1') ) :
						?>
						<div class="snpshpwp_related">
							<h3><?php _e('Related posts', 'snpshpwp'); ?></h3>
							<?php echo do_shortcode('[snpshpwp_insert_posts related="true" type="0" rows="5" excerpt_lenght="96" show_date="false" show_date="false" show_author="false" show_category="false" show_comments="false" pagination="false"]'); ?>
						</div>
						<?php
							endif;
						?>

					</div>
					<?php
						endif;
					?>

					</div>
				</div>
				</div>
			<?php
				else :
			?>
			<div id="snpshpwp_inner_content" <?php post_class(snpshpwp_get_class('content', 'sidebar-single', $snpshpwp_data['sidebar-size'], $snpshpwp_data['sidebar-single-position'])); ?>>
				<?php
					printf( '<h1 class="snpshpwp_page_title">%1$s</h1><h3>%2$s</h3>', __('NO POSTS FOUND', 'snpshpwp'), __('There are no posts within the criteria.', 'snpshpwp') );
				?>
			<div class="clearfix"></div>
			</div>
			<?php
				endif;
			?>
			<?php
				snpshpwp_get_sidebar('single', 'sidebar-single', $snpshpwp_data['sidebar-size'], '0');
			?>
		</div>
	</div>
	</div>

<?php get_footer(); ?>