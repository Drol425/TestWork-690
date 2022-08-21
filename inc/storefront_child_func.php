<?php

function add_custom_content_for_specific_product() {
    global $product;
    ?>
        <div class="custom-content product-id-<?php echo $product->get_id(); ?>">
            <h4><?php _e("Product Date Create", "woocommerce"); echo ' '.get_post_meta(get_the_ID(),'dataCreate',true); ?></h4>
            <h4><?php _e("Product Type", "woocommerce"); echo ': '.get_post_meta(get_the_ID(),'productType',true); ?></h4>
        </div>
    <?php
}

function my_column_width() {
    echo '<style type="text/css">';
    echo '.manage-column{ padding: 0px!important;}
          #Test_Assignment_Image{width: 14%!important;}
          #Date_Create {width: 14%!important;}
          #Product_type{width: 14%!important;}
          ';
    echo '</style>';
}

add_filter( 'manage_edit-product_columns', 'misha_brand_column', 20 );
function misha_brand_column( $columns_array ) {
  // I want to display IMAGE,Date Create,Product type columns just after the product name column
  return array_slice( $columns_array, 0, 10, true )
    + array( 'Test_Assignment_Image' => 'Image') // Create column IMAGE 
    + array( 'Date_Create' => 'Date Create' ) // CREATE column Date Create
    + array( 'Product_type' => 'Product type' ) // Create column Product type
    + array_slice( $columns_array, 10, NULL, true );

}

function testAssignment_coulms( $column_name ) {

  if( $column_name  == 'Test_Assignment_Image' ) {
    ?>
    <img width="40" height="40" src="<?php echo get_post_meta(get_the_ID(),'imageUrlUp',true); ?>">
    <?php
  }
  if( $column_name  == 'Date_Create' ) { echo get_post_meta(get_the_ID(),'dataCreate',true);}
  if( $column_name  == 'Product_type' ) {echo get_post_meta(get_the_ID(),'productType',true);}

}
function saveTest_AssignmentForm(){ // function for save data input ajax

  $idProduct = $_POST['idProduct']; //id product


  if(isset($_POST['imageUrlUp'])){
     update_post_meta($idProduct,'imageUrlUp',$_POST['imageUrlUp']); // save image
  }
  if(isset($_POST['dataCreate'])){
     update_post_meta($idProduct,'dataCreate',$_POST['dataCreate']); // save Data Create Product
  }
  if(isset($_POST['productType'])){
     update_post_meta($idProduct,'productType',$_POST['productType']); // save Product Type
  }
  die();

}
