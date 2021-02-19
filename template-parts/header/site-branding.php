<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage EKS
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-branding <?php if ( !is_front_page() ) { echo "category-branding"; } else {echo "home-branding"; } ?>">
	<div class="wrap">
		<div class="eks-logo">
			<div class="header-logo">
				<img class="svg-logo" src="<?php echo get_theme_file_uri() ?>/assets/images/logo.svg" alt="Evil Kitteh Studios Logo"/>
			</div>
			<div class="header-text">
				<a href="/" class="custom-logo-link">
					<img src="<?php echo get_theme_file_uri() ?>/assets/images/header.svg" alt="Evil Kitteh Studios"/>
				</a>
			</div>
			<?php the_custom_logo(); ?>
		</div>
		<?php if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif; ?>

		<?php
		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) :
		?>
			<p class="site-description"><?php echo $description; ?></p>
		<?php endif; ?>

	</div><!-- .wrap -->
</div><!-- .site-branding -->

