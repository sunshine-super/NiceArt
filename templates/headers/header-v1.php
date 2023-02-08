<?php
$reebox_theme_options = reebox_get_theme_options();

$header_classes = array();
if( $reebox_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}

if( !$reebox_theme_options['ts_enable_tiny_shopping_cart'] ){
	$header_classes[] = 'hidden-cart';
}

if( !$reebox_theme_options['ts_enable_tiny_wishlist'] || !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
	$header_classes[] = 'hidden-wishlist';
}

if( !$reebox_theme_options['ts_header_currency'] ){
	$header_classes[] = 'hidden-currency';
}

if( !$reebox_theme_options['ts_header_language'] ){
	$header_classes[] = 'hidden-language';
}

if( !$reebox_theme_options['ts_enable_search'] ){
	$header_classes[] = 'hidden-search';
}
?>

<div id="vertical-menu-sidebar" class="menu-wrapper">
	<div class="overlay"></div>
	<div class="vertical-menu-content">
		<span class="close"></span>
		
		<div class="logo-wrapper"><?php reebox_theme_logo(); ?></div>
		
		<div class="ts-menu">
			<?php 
			if ( has_nav_menu( 'vertical' ) ) {
			?>
			
			<div class="vertical-menu-wrapper">
				<?php
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Reebox_Walker_Nav_Menu() ) );
				?>
			</div>
			<?php
			}
			?>
			<?php if( $reebox_theme_options['ts_header_currency'] || $reebox_theme_options['ts_header_language'] ): ?>
			<div class="group-currency-language">
				
				<?php if( $reebox_theme_options['ts_header_language'] ): ?>
				<div class="header-language"><span><?php esc_html_e('Language:', 'reebox'); ?></span><?php reebox_wpml_language_selector(); ?></div>
				<?php endif; ?>
				
				<?php if( $reebox_theme_options['ts_header_currency'] ): ?>
				<div class="header-currency"><span><?php esc_html_e('Currency:', 'reebox'); ?></span><?php reebox_woocommerce_multilingual_currency_switcher(); ?></div>
				<?php endif; ?>
				
				
			</div>
			<?php endif; ?>
		</div>	
	</div>
</div>

<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="header-container">
		<div class="header-template">
		
			<div class="header-sticky">
			
				<div class="header-middle">
					<div class="container">
							
						<div class="logo-wrapper">
				
							<div class="icon-menu-sticky-header hidden-phone">
								<span class="icon"></span>
							</div>
							
							<?php reebox_theme_logo(); ?>
							
						</div>
						
						
						<?php if( $reebox_theme_options['ts_enable_search'] ): ?>
						<div class="ts-search-normal hidden-phone"><?php get_search_form(); ?></div>
						<?php endif; ?>
						
						<div class="header-right">
						
							<?php if( ( wp_is_mobile() && $reebox_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$reebox_theme_options['ts_only_load_mobile_menu_on_mobile'] ): ?>
							<div class="ts-mobile-icon-toggle">
								<span class="icon"></span>
							</div>
							<?php endif; ?>
							
							<?php if( $reebox_theme_options['ts_enable_search'] ): ?>
							<div class="search-button"><span class="icon"></span></div>
							<?php endif; ?>
							
							<?php if( $reebox_theme_options['ts_header_language'] ): ?>
							<div class="header-language hidden-phone"><?php reebox_wpml_language_selector(); ?></div>
							<?php endif; ?>
							
							<?php if( $reebox_theme_options['ts_header_currency'] ): ?>
							<div class="header-currency hidden-phone"><?php reebox_woocommerce_multilingual_currency_switcher(); ?></div>
							<?php endif; ?>
							
							<?php if( $reebox_theme_options['ts_enable_tiny_account'] ): ?>
							<div class="my-account-wrapper hidden-phone">
								<?php echo reebox_tiny_account(); ?>
							</div>
							<?php endif; ?>
							
							<?php if( class_exists('YITH_WCWL') && $reebox_theme_options['ts_enable_tiny_wishlist'] ): ?>
							<div class="my-wishlist-wrapper hidden-phone"><?php echo reebox_tini_wishlist(); ?></div>
							<?php endif; ?>
							
							<?php if( $reebox_theme_options['ts_enable_tiny_shopping_cart'] ): ?>					
							<div class="shopping-cart-wrapper">
								<?php echo reebox_tiny_cart(); ?>
							</div>
							<?php endif; ?>
							
						</div>
						
					</div>
				</div>
				
				<div class="header-bottom">
					<div class="container">
					
						<?php if ( has_nav_menu( 'vertical' ) ):?>			
						<div class="vertical-menu-heading"><span><?php echo reebox_get_vertical_menu_heading(); ?></span></div>
						<?php endif; ?>
						
						<div class="menu-wrapper hidden-phone">
							
							<div class="ts-menu">
								<?php 
									if ( has_nav_menu( 'primary' ) ) {
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Reebox_Walker_Nav_Menu() ) );
									}
									else{
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
									}
								?>
							</div>
							
						</div>
						
						<?php if( $reebox_theme_options['ts_header_info_1'] ): ?>
						<div class="info-right"><?php echo do_shortcode(stripslashes($reebox_theme_options['ts_header_info_1'])); ?></div>
						<?php endif; ?>
					
					</div>
				</div>
				
			</div>			
			
		</div>	
	</div>
</header>