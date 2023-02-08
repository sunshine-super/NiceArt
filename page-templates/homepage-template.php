<?php
/**
 *	Template Name: Homepage Template
 */	
get_header();

global $post;
setup_postdata($post);

$page_options = reebox_get_page_options();

$extra_class = '';

$page_column_class = reebox_page_layout_columns_class($page_options['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && $page_options['ts_show_breadcrumb'] );
$show_page_title = ( !is_home() && !is_front_page() && $page_options['ts_show_page_title'] );

if( $show_breadcrumb || $show_page_title ){
	$extra_class = 'show_breadcrumb_'.reebox_get_theme_options('ts_breadcrumb_layout');
}

reebox_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
	
?>
<div class="page-template blog-template page-container container-post <?php echo esc_attr($extra_class) ?>">	
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<!-- Page slider -->
		<?php if( $page_options['ts_page_slider'] && $page_options['ts_page_slider_position'] == 'before_main_content' ): ?>
		<div class="top-slideshow">
			<div class="top-slideshow-wrapper">
				<?php reebox_show_page_slider(); ?>
			</div>
		</div>
		<?php endif; ?>

		<!-- Left Sidebar -->
		<?php if( $page_column_class['left_sidebar'] ): ?>
			<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
				<?php if( is_active_sidebar($page_options['ts_left_sidebar']) ): ?>
					<?php dynamic_sidebar( $page_options['ts_left_sidebar'] ); ?>
				<?php endif; ?>
			</aside>
		<?php endif; ?>
		<div id="primary" class="site-content">
			
			<?php if( get_the_content() ): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php endif; ?>

			<!-- popular categories -->
			<section class="popular-categories">
				<div class="container">					
					<h4 class="sec-title text-center">POPULARNE KATEGORIJE</h4>
					<div class="sec-content d-flex">				
						<?php
							$args = array(
								'taxonomy' => 'product_cat',
								'orderby' => 'name',
								// 'hierarchical' => 0, // 1 for yes, 0 for no  
								'hide_empty' => 0,
								'exclude' => 1 //list of product_cat id that you want to exclude (string/array).
							);
							$all_categories = get_categories($args);

							for ($i=0; $i < 5; $i++) { 
								echo '<div class="popular-category">';

								$product_cat_term_id = $all_categories[$i]->term_id;
								// get the thumbnail id using the queried category term_id
								$thumbnail_id = get_term_meta( $product_cat_term_id, 'thumbnail_id', true ); 

								// get the image URL
								$image = wp_get_attachment_url( $thumbnail_id );

								// echo $product_cat;
								$category_link = get_term_link($all_categories[$i]->slug, 'product_cat');

								echo "
								<a href='{$category_link}'><img src='{$image}' alt='' /></a>
								<a href='{$category_link}' class='btn btn-cat-link'>{$all_categories[$i]->name}</a>
								</div>";
							}
						?>						
					</div>
				</div>
			</section>			
			
			<!-- featured post(use tag) -->
			<section class="why-us">
				<div class="container">
					<div class="sec-content d-flex">
						<?php 
							//set tag slug
							$tagSlug = "featured";

							//set the arguments for the tag
							$args = array(
								'tax_query'      => array(
									array(
										'taxonomy'  => 'post_tag',
										'field'     => 'slug',
										'terms'     => sanitize_title( $tagSlug )
									)
								)
							);
							
							//query posts
							$posts = get_posts($args);

							//printing post titles
							foreach ($posts as $post){
								$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

								echo "<div class='why-us-item'>
								<img src=".$feat_image.">
								
								<div class='content-wrapper'>
								<div class='content'>
								<h5 class='title'>".$post->post_title."</h5>".$post->post_content."								
								<a href='' class='btn btn-more btn-why-us-link'>". $post->post_excerpt ."<span class='double-arrow'>>></span></a></div>
								</div></div>
								";
							}			
						?>		
					</div>
				</div>
			</section>	
		</div>		
	</div>	
</div><!-- #container -->

<!-- newsletter section(widget) -->
<section class="newsletter-form">
	<div class="container">
		<h4 class="sec-title text-left">
			Naroči se na novice
		</h4>
		<p class="sec-description">
			in prejmi kupon za 5 % popust.
		</p>
		<a href="#" class="btn btn-more btn-application">PRIJAVA <span class="double-arrow">>></span></a>
	</div>
</section>

<!-- woocommerce product section -->
<section class="latest-products">
	<div class="container">
		<h4 class="sec-title text-center">ZADNJI IZDELKI</h4>
		<div class="sec-content">
			<?php echo do_shortcode ("[wtcpl-product-cat]"); ?>
		</div>
		<div class="action-group">
			<a href="" class="btn btn-products">OGLED VSEH IZDELKOV</a>
		</div>
	</div>
</section>

<section class="instagram-section">	
	<div class="block-t"></div>
	<div class="block-b"></div>
	<div class="sec-content">
		<div class="sec-content_header">
			<div class="title-wrapper">
				<h4 class="title">WWW.NICEART.SI</h4>				
			</div>
			<div class="desc-wrapper">
				<p>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt<br>
					NiceArt NiceArt NiceArt NiceArt NiceArt
				</p>
			</div>
			<div class="instagram-gallery-wrapper">
				<div class="container">
					<h4 class="title text-center">@FOLLOW US ON INSTAGRAM</h4>
					<p class="text-center">The best thing about a monochrome colour scheme</p>
					<div class="instagram-galleries d-flex justify-content-center">
						<a href="#" class="gallery"></a>					
						<a href="#" class="gallery"></a>					
						<a href="#" class="gallery"></a>					
						<a href="#" class="gallery"></a>					
						<a href="#" class="gallery"></a>					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>