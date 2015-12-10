<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $snpshpwp_data;
?>
	</div>
	</div>
<?php
	if ( is_product() ) {
		$widgets = 'product';
	}
	elseif ( is_shop() || is_product_category() || is_product_tag() ) {
		$widgets = 'shop';
	}
	else {
		$widgets = 'none';
	}

	if ( $widgets !== 'none' ) :?>
		<?php if ( isset($snpshpwp_data[$widgets.'-widgets-after']) || $snpshpwp_data[$widgets.'-widgets-after'] !== 'none' ) : ?>
		<div class="anivia_row fbuilder_row">
		<div>
			<?php
				$widgets_after = $snpshpwp_data[$widgets.'-widgets-after'];
				for ($i = 1; $i <= $widgets_after; $i++) {
					printf( '<div class="fbuilder_column fbuilder_column-1-%1$s">', $widgets_after );
					dynamic_sidebar($widgets.'-widgets-after-' . $i);
					printf( '</div><!-- fbuilder_column fbuilder_column-1-%1$s -->', $widgets_after );
				}
			?>
		</div>
		</div>
		<?php endif; ?>
	<?php
	endif;
?>
</div>