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

  if($_POST['idProduct']){
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
  }else{
    $product = new WC_Product_Simple(); // create product

    $product->set_name( $_POST['nameProduct'] ); // product title

    $product->set_regular_price( $_POST['priceProduct'] ); // in current shop currency

    if(isset($_POST['imageUrlUp'])){
          $product->set_image_id( pippin_get_image_id($_POST['imageUrlUp']) ); // image
    }

    $product->save();

    $idProduct = $product->get_id();

    if(isset($_POST['imageUrlUp'])){
          update_post_meta($idProduct,'imageUrlUp',$_POST['imageUrlUp']); // save image
          $product->set_image_id( pippin_get_image_id($_POST['imageUrlUp']) ); // image
    }
    if(isset($_POST['dataCreate'])){
        update_post_meta($idProduct,'dataCreate',$_POST['dataCreate']); // save Data Create Product
    }
    if(isset($_POST['productType'])){
        update_post_meta($idProduct,'productType',$_POST['productType']); // save Product Type
    }

  }
  die();

}


function Test_Assignment_create_product_by_front( ) // create form for create product
{

  if(!is_user_logged_in()){


    die('Please login to create products');
  }

  wp_enqueue_media();
  /*$get_img_url =  get_post_meta($post->ID, 'imageUrlUp', true);
  $dataCreate = get_post_meta($post->ID, 'dataCreate', true);
  $productType = get_post_meta($post->ID, 'productType', true);*/

    if(!$get_img_url){$noneimg = 'display:none;';}
  ?>
         Product Name<br />
                <input name="productName" class="productName" placeholder="Product Name" type="text"><br />
         Product Price<br />
                <input name="productPrice" class="productPrice" placeholder="Product Price" type="number">
                <br />
        <img class="header_logo" src="<?php echo $get_img_url; ?>" style="width: 20%;height: 20%; <?php echo $noneimg; ?>" />
              <input style="display: none;" class="header_logo_url" type="text" name="extra[header_logo]" value="<?php echo get_post_meta($post->ID, 'header_logo', 1); ?>">
              <a href="#" class="header_logo_upload"><?php _e("Upload product image", "woocommerce");?></a><br />

              <a href="#" style="<?php echo $noneimg; ?>color:red;" class="remove_logo_upload"><?php _e("Remove product image", "woocommerce");?></a><br />

              Create date<br />
                <input name="dateCreate" class="dateCreate" value="<?php echo $dataCreate; ?>" type="date"><br />
                
              Product type<br />
                <select name="typeProduct" class="typeProduct">
                  <option <?php if($productType == "no" or $productType == ""){echo ' selected ';} ?> value="no">-Select-</option>
                  <option <?php if($productType == "rare"){echo ' selected ';} ?> value="rare">rare</option>
                  <option <?php if($productType == "frequent"){echo ' selected ';} ?> value="frequent">frequent</option>
                  <option <?php if($productType == "unusual"){echo ' selected ';} ?> value="unusual">unusual</option>
                </select><br /><br />

              <a href="#" id="upload_data" class="button button-primary"><?php _e("CREATE", "woocommerce");?></a>

              <a href="#" id="reset_data" class="button"><?php _e("RESET", "woocommerce");?></a><br /><br /><br />

              <script src="/wordpress/wp-content/themes/storefront-child/assets/js/testAssignment.js' ?>"></script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                       $('#upload_data').click(function(e) {
                          e.preventDefault();

                          var idProduct = "<?php echo $post->ID; ?>";

                          var nameProduct = $(".productName").val();

                          var priceProduct = $(".productPrice").val();

                          var dataImage = $(".header_logo_url").val();

                          var dataDateCreate = $(".dateCreate").val();

                          var dataTypeProduct = $(".typeProduct option:selected").val();

                              $.ajax({
                                url: '<?php echo admin_url( "admin-ajax.php" ) ?>',
                                type: 'POST',
                                data: 'action=uploadTestData&nameProduct='+nameProduct+'&priceProduct='+priceProduct+'&idProduct='+idProduct+'&imageUrlUp='+dataImage+'&dataCreate='+dataDateCreate+'&productType='+dataTypeProduct,
                                  beforeSend: function( xhr ) {
                                    $('#upload_data').text('Uploading...');  
                                  },
                                  success: function( data ) {
                                    $('#upload_data').text('Save'); 
                                  }
                              });
                
            
                        });
                  }); 
              </script>
                <?php
}
function pippin_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}
