<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

	$out = '';
	global $snpshpwp_data;
	$feat_area = '';
	$heading = '';

	$columns = ( $snpshpwp_data['blog_layout'] !== '0' ? $snpshpwp_data['blog_layout'] : '1' );
	$format = get_post_format();

	$image_size = ( $snpshpwp_data['fimage_override'] == 1 && $format !== 'gallery' ? 'full' : 'snpshpwp-fullblog' );

	if ( is_sticky() ) $sticky_icon = '<i class="fa fa-pushpin"></i> '; else $sticky_icon = '';

	if ( false === $format || $format == 'aside' || $format == 'chat' || $format == 'status' ) {
		$format = 'standard';
	}

	$out .= '<div class="'.implode(' ', get_post_class()).' snpshpwp_post fbuilder_column fbuilder_column-1-'.$columns.'">';

	if ( $snpshpwp_data['blog_layout'] !== '1' || $snpshpwp_data['blog_layout'] !== '0' ) {
		$feat_area .= snpshpwp_get_featarea( $image_size, $format );
	}
	else {
		$feat_area .= get_the_post_thumbnail( get_the_ID(), 'snpshpwp-square' );
	}

	if ( $format !== 'quote' ) {
		$heading .= '<h3 class="snpshpwp_blog_title"><a href="'.get_permalink().'" rel="bookmark">' . $sticky_icon . get_the_title() . '</a></h3>';
	}

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
		$write_comments = __('with', 'snpshpwp') . ' ' . '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __('Comments are off for this post.', 'snpshpwp');
	}

	$heading .= '<div class="snpshpwp_posts_meta"><div class="snpshpwp_category_meta">'.__('Published in', 'snpshpwp').' '.get_the_category_list( ', ' ).'</div> <div class="snpshpwp_date_meta">'.__('on ').'<a href="'.get_month_link( get_the_time('Y'), get_the_time('m') ).'" title="'.__('View all posts this month', 'snpshpwp').'">'.$timecode.'</a></div> <div class="snpshpwp_author_meta">'.__('by', 'snpshpwp').' '.get_the_author_link().'</div> <div class="snpshpwp_comment_meta">'.$write_comments.'</div></div>';

	$out .= $feat_area . '<div class="snpshpwp_post">' . $heading;
	if ( $format !== 'quote' ) {
		if ( $snpshpwp_data['blog_layout'] !== '1' ) {
			$excerpt = get_the_excerpt();
			$out .= '<div class="snpshpwp_excerpt">'.snpshpwp_string_limit_words( $excerpt, $snpshpwp_data['blog_excerpt'] ).'</div>';
		}
		else {
			$out .= '<div class="snpshpwp_moretag">'.get_the_content_with_formatting( '<a href="'.get_permalink().'" class="snpshpwp_readmore">'.__('Read More', 'snpshpwp').'</a>' ).'</div>';
		}
	}

	$out .= '</div><div class="clearfix"></div></div>';

	echo $out;
?>