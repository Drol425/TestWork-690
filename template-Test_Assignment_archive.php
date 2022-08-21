<?php
/**
 * The template for displaying the Test Assignment.
 *
 * This page template will display any functions hooked into the `Test Assignment` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 *
 * Template name: Test Assignment
 *Template Post Type: page
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			
			    <ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

                <li class="product">    

                    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                        <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
                        <?php if (get_post_meta(get_the_ID(),'imageUrlUp',true)) echo '<img src="'.get_post_meta(get_the_ID(),'imageUrlUp',true).'">'; else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>

                                         

                    </a>

                    	<span class="datecreate"> 
                        	<?php if(get_post_meta(get_the_ID(),'dataCreate',true)){
                        	 	echo 'Date Create: '. get_post_meta(get_the_ID(),'dataCreate',true).'<br />';
                        	  }
                        	  ?>
                        </span>  
                        <span class="producttype"> 
                        	<?php if(get_post_meta(get_the_ID(),'productType',true)){
                        	 	echo 'Product Type: '. get_post_meta(get_the_ID(),'productType',true).'<br />';
                        	  }
                        	  ?>
                        </span>  

                    <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul><!--/.products-->
	
			

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
