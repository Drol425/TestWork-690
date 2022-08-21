<?php
/**
 * The template for displaying the Test Assignment.
 *
 * This page template will display any functions hooked into the `Test Assignment` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 *
 * Template name: Test Assignment
 *
 * @package storefront
 /*
Template Name: Single Page Test Assignment
Template Post Type: product
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); 

global $post, $product;

?>

    <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>

            <?php  wc_get_template_part( 'content', 'single-product' ); ?>

        <?php endwhile; // end of the loop. ?>

    <?php
        /**
         * woocommerce_after_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

    <?php
        /**
         * woocommerce_sidebar hook.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
    ?>


<?php get_footer();