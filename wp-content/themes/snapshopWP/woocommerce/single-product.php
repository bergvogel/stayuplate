<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $snpshpwp_data;

get_header('shop'); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');

	?>

		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			if ( $snpshpwp_data['sidebar-woo-single-position'] == 1 ) snpshpwp_get_sidebar('woo-single', 'sidebar-woo-single', $snpshpwp_data['sidebar-woo-size'], '1');
		?>

		<?php
			printf('<div id="snpshpwp_inner_content" class="%1$s">', snpshpwp_get_class('content', 'sidebar-woo-single', $snpshpwp_data['sidebar-woo-size'], $snpshpwp_data['sidebar-woo-single-position']));
		?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php echo '</div>'; ?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
			if ( $snpshpwp_data['sidebar-woo-single-position'] == 0 ) snpshpwp_get_sidebar('woo-single', 'sidebar-woo-single', $snpshpwp_data['sidebar-woo-size'], '0');
	?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>