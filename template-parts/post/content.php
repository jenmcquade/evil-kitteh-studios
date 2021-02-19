<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */


$chapters = get_the_terms( get_the_ID(), 'chapters' );
$tags = get_the_terms( get_the_ID(), 'post_tag' );
$post_slug = get_post_field( 'post_name', get_post() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			if ( is_single() ) {
				twentyseventeen_posted_on();
			} else {
				echo twentyseventeen_time_link();
				twentyseventeen_edit_link();
			};
			echo '</div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a aria-label="Go to ' . get_the_title() . ' href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a aria-label="Go to ' . get_the_title() . ' href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

		<?php
			if ( '' !== get_field('subtitle') ) {
				echo '<h3>' . esc_attr( get_field('subtitle') ) . '</h3>';
			} 
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php
		if ( has_post_thumbnail()) { 
			if ( is_single() ) {
				the_post_thumbnail( 'eks2021-featured-image', array( 'title' => get_the_title() ) );
			} else {
				echo '<a href="' . get_the_permalink() . '" aria-label="Go to ' . get_the_title() . '">';
					the_post_thumbnail( 'eks2021-featured-image', array( 'title' => get_the_title() ) );
			 	echo '</a>';
			}
		}

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		echo '<ul class="post-tags">';
			foreach ($tags as $tag) {
				echo '<li class="tag"><a href="' . get_term_link( $tag->slug, 'post_tag' ) . '">' . $tag->name . '</a></li>';
			}
		echo '</ul>';

		if ( is_active_sidebar( 'post-bottom' ) ) { 
			echo '<div id="post-bottom-widget" class="widget-area">';
			echo '<h3>More from "' . $chapters[0]->name . '"</h3>';
			dynamic_sidebar( 'post-bottom' );
			echo '</div>';
		}; 	

		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		twentyseventeen_entry_footer();
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->
