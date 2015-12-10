<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

global $snpshpwp_data;

if ( $snpshpwp_data['footer_area'] !== '1' ) :
?>
	<div id="snpshpwp_footer" class="snpshpwp_footer">

		<?php if ( $snpshpwp_data['footer_widgets'] !== '1' ) : ?>
		<div class="snpshpwp_container snpshpwp_widgets">
			<div class="anivia_row fbuilder_row">
				<div>
					<?php
						$footer_sidebar = $snpshpwp_data['footer_sidebar'];
						for ($i = 1; $i <= $footer_sidebar; $i++) {
							printf( '<div class="fbuilder_column fbuilder_column-1-%1$s">', $footer_sidebar );
							dynamic_sidebar('footer-' . $i);
							printf( '</div><!-- fbuilder_column fbuilder_column-1-%1$s -->', $footer_sidebar );
						}
					?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $snpshpwp_data['footer_bar'] !== '1' ) : ?>
		<div class="snpshpwp_footer_elements">
			<div class="snpshpwp_bottom snpshpwp_custom_elements">
				<div class="snpshpwp_top_left float_left">
					<?php
						snpshpwp_elements('left', 'footer');
					?>
				</div>
				<div class="snpshpwp_top_right float_right">
					<?php
						snpshpwp_elements('right', 'footer');
					?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php endif; ?>


	</div>
<?php
	endif;
?>
</div>
<?php wp_footer(); ?>
</body>
</html>