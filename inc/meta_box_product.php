<?php
function se20892273_add_meta_boxes_page( $post )
{
    add_meta_box( 
       'Test_Assignment_meta_box', // this is HTML id
       'Test Assignment', 
       'Test_Assignment_meta_box', // the callback function
       'product', // register on post type = page
       'side', // 
       'core'
    );
}


function Test_Assignment_meta_box( $post )
{

  $get_img_url =  get_post_meta($post->ID, 'imageUrlUp', true);
  $dataCreate = get_post_meta($post->ID, 'dataCreate', true);
  $productType = get_post_meta($post->ID, 'productType', true);

    if(!$get_img_url){$noneimg = 'display:none;';}
  ?>
        <img class="header_logo" src="<?php echo $get_img_url; ?>" style="width: 100%;height: 100%; <?php echo $noneimg; ?>" />
              <input style="display: none;" class="header_logo_url" type="text" name="extra[header_logo]" value="<?php echo get_post_meta($post->ID, 'header_logo', 1); ?>"><br />
              <a href="#" class="header_logo_upload"><?php _e("Upload product image", "woocommerce");?></a><br />

              <a href="#" style="<?php echo $noneimg; ?>color:red;" class="remove_logo_upload"><?php _e("Remove product image", "woocommerce");?></a><br /><br />

              Create date<br />
                <input name="dateCreate" class="dateCreate" value="<?php echo $dataCreate; ?>" type="date"><br />
                
              Product type<br />
                <select name="typeProduct" class="typeProduct">
                  <option <?php if($productType == "no" or $productType == ""){echo ' selected ';} ?> value="no">-Select-</option>
                  <option <?php if($productType == "rare"){echo ' selected ';} ?> value="rare">rare</option>
                  <option <?php if($productType == "frequent"){echo ' selected ';} ?> value="frequent">frequent</option>
                  <option <?php if($productType == "unusual"){echo ' selected ';} ?> value="unusual">unusual</option>
                </select><br /><br />

              <a href="#" id="upload_data" class="button button-primary"><?php _e("UPDATE", "woocommerce");?></a>

              <a href="#" id="reset_data" class="button"><?php _e("RESET", "woocommerce");?></a>

              <script src="/wordpress/wp-content/themes/storefront-child/assets/js/testAssignment.js' ?>"></script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                       $('#upload_data').click(function(e) {
                          e.preventDefault();

                          var idProduct = "<?php echo $post->ID; ?>";

                          var dataImage = $(".header_logo_url").val();

                          var dataDateCreate = $(".dateCreate").val();

                          var dataTypeProduct = $(".typeProduct option:selected").val();

                              $.ajax({
                                url: '<?php echo admin_url( "admin-ajax.php" ) ?>',
                                type: 'POST',
                                data: 'action=uploadTestData&idProduct='+idProduct+'&imageUrlUp='+dataImage+'&dataCreate='+dataDateCreate+'&productType='+dataTypeProduct,
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