<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $snpshpwp_data, $wp_query;

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

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			if ( $snpshpwp_data['sidebar-woo-position'] == 1 ) snpshpwp_get_sidebar('woo', 'sidebar-woo', $snpshpwp_data['sidebar-woo-size'], '1');
		?>

		<?php
			printf('<div id="snpshpwp_inner_content" class="%1$s">', snpshpwp_get_class('content', 'sidebar-woo', $snpshpwp_data['sidebar-woo-size'], $snpshpwp_data['sidebar-woo-position']));
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php echo '</div>'; ?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if ( $snpshpwp_data['sidebar-woo-position'] == 0 ) snpshpwp_get_sidebar('woo', 'sidebar-woo', $snpshpwp_data['sidebar-woo-size'], '0');
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