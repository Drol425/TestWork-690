<?php
/* TEST Assignment */
function storefront_child_theme_setup() {

  if ( class_exists( 'WooCommerce' ) ) {
      add_theme_support( 'woocommerce' ); //support WooCommerce
  }

}

add_action( 'after_setup_theme', 'okfn_theme_setup' );

  add_action( "add_meta_boxes", "se20892273_add_meta_boxes_page" ); // create meta box for product page

  add_action( 'wp_ajax_uploadTestData', 'saveTest_AssignmentForm' ); // add ajax form function
  add_action( 'wp_ajax_nopriv_uploadTestData', 'saveTest_AssignmentForm' ); 

  add_action( 'manage_posts_custom_column', 'testAssignment_coulms' ); //view data column 

  add_action( 'woocommerce_single_product_summary', 'add_custom_content_for_specific_product', 15 ); //add post type and data create to product page

  add_action('admin_head', 'my_column_width'); // add custom css for admin page



  require_once("inc/meta_box_product.php");
  require_once("inc/storefront_child_func.php");