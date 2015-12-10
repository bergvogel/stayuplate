<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
	<div class="nopassword">
		<?php _e( 'This post is password protected. Enter the password to view any comments.', 'snpshpwp' ); ?>
	</div>
	<?php return; endif;?>
	<?php if ( comments_open() ) : ?>
		<?php
			$fields =  array(
				'author' =>'<input id="author" class="input_field block margin-bottom20" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'snpshpwp' ) . '" />',

				'email' => '<input id="email" class="input_field block margin-bottom20" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'snpshpwp' ) . '"/>',

				'url' => '<input id="url" class="input_field block margin-bottom20" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website', 'snpshpwp' ) . '" />'
			);
			comment_form( array('fields'=>$fields, 'comment_field' => '<textarea id="comment" name="comment" maxlength="300" class="textarea_field block" aria-required="true">' . __( 'Your message goes here (max 300 chars)', 'snpshpwp' ) . '</textarea>', 'title_reply' => __( 'Leave a comment', 'snpshpwp' ), 'title_reply_to' => __( 'Leave a Reply to %s' , 'snpshpwp' ), 'label_submit' => __( 'Send comment', 'snpshpwp' )));
			?>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>

		<h3 class="comments_title margin-bottom36 uppercase"><?php _e( 'Comments', 'snpshpwp' ); ?> <span>/<?php echo get_comments_number(); ?>/</span></h3>

		<ul class="comments_wrapper" id="comments_wrapper">
			<?php wp_list_comments( array('reply_text' => 'Reply','avatar_size' => 200,'format' => 'html5') ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below">
			<div class="nav-previous">
				<?php previous_comments_link( __( '&larr; Older Comments', 'snpshpwp' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'snpshpwp' ) ); ?>
			</div>
		</nav>
		<?php
			endif;
			else :
			if ( comments_open() ) :
			else :
			if ( !comments_open() && !is_page() ) :
		?>
		<p class="nocomments">
			<?php _e( 'Comments are closed.', 'snpshpwp' ); ?>
		</p>
		<?php
			endif;
			endif;
		endif;
	?>

</div>