<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage EKS
 * @since 1.0
 * @version 1.0
 */

?>
<div class="custom-header <?php if ( !is_front_page() ) { echo "category-header"; } ?>">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
