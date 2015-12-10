<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $snpshpwp_data;

		if ( is_product() ) {
			$widgets = 'product';
		}
		elseif ( is_shop() || is_product_category() || is_product_tag() ) {
			$widgets = 'shop';
		}
		else {
			$widgets = 'none';
		}

		do_action('snpshpwp_before_content');

		echo '<div id="snpshpwp_content" class="snpshpwp_container">';

		if ( $widgets !== 'none' ) :?>
			<?php if ( isset($snpshpwp_data[$widgets.'-widgets-before']) && $snpshpwp_data[$widgets.'-widgets-before'] !== 'none' ) : ?>
			<div class="anivia_row fbuilder_row">
			<div>
				<?php
					$widgets_before = $snpshpwp_data[$widgets.'-widgets-before'];
					for ($i = 1; $i <= $widgets_before; $i++) {
						printf( '<div class="fbuilder_column fbuilder_column-1-%1$s">', $widgets_before );
						dynamic_sidebar($widgets.'-widgets-before-' . $i);
						printf( '</div><!-- fbuilder_column fbuilder_column-1-%1$s -->', $widgets_before );
					}
				?>
			</div>
			</div><!-- row -->
			<?php endif; ?>
		<?php
		endif;
		echo '<div class="anivia_row fbuilder_row"><div>';
?>