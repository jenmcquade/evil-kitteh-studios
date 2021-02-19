<?php
/**
 * Evil Kitteh Studios functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage eks2021
 * @since 1.0
 * 
 */

function eks2021_setup() {

	load_theme_textdomain( 'eks2021' );

	add_image_size( 'eks2021-featured-image', 2000, 1200, true );

	add_image_size( 'eks2021-thumbnail-avatar', 100, 100, true );

}


/**
 * Register custom fonts.
 */
function eks2021_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'eks2021' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Kirang Haerang:300,300i,400,400i,600,600i,800,800i';
		$font_families[] = 'Roboto:300,300i,400,400i,600,600i,800,800i';
		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueues scripts and styles.
 */
function eks2021_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'eks2021-fonts', eks2021_fonts_url(), array(), null );

	wp_enqueue_script( 'globaljs', get_theme_file_uri() . '/assets/js/global.js' );

	// Theme stylesheets.
	
	// Start with twentyseventeen first
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'eks2021-css-resets', get_theme_file_uri() . '/assets/css/child-resets.css', array(), the_date() );
	wp_enqueue_style( 'eks2021-css-site', get_theme_file_uri() . '/assets/css/eks.css', array(), the_date() );
	wp_enqueue_style( 'eks2021-css-branding', get_theme_file_uri() . '/assets/css/header-branding.css', array(), the_date() );
	wp_enqueue_style( 'eks2021-css-page', get_theme_file_uri() . '/assets/css/category-and-page.css', array(), the_date() );
	wp_enqueue_style( 'eks2021-xsmall', get_theme_file_uri() . '/assets/css/xsmall.css', array(), the_date(), 'screen and (max-width: 576px)' );
	wp_enqueue_style( 'eks2021-small', get_theme_file_uri() . '/assets/css/small.css', array(), the_date(), 'screen and (min-width: 576px)' );
	wp_enqueue_style( 'eks2021-medium', get_theme_file_uri() . '/assets/css/medium.css', array(), the_date(), 'screen and (min-width: 768px)' );
	wp_enqueue_style( 'eks2021-large', get_theme_file_uri() . '/assets/css/large.css', array(), the_date(), 'screen and (min-width: 992px)' );
	wp_enqueue_style( 'eks2021-xlarge', get_theme_file_uri() . '/assets/css/xlarge.css', array(), the_date(), 'screen and (min-width: 1200px)' );

}
add_action( 'wp_enqueue_scripts', 'eks2021_scripts', 150);

/**
 * Rewrite Tags to a hierarchical structure so they are all visible in Admin editing
 */
function eks2021_hierarchical_tags_register() {

	// Maintain the built-in rewrite functionality of WordPress tags
  
	global $wp_rewrite;
  
	$rewrite =  array(
	  'hierarchical'              => false, // Maintains tag permalink structure
	  'slug'                      => get_option('tag_base') ? get_option('tag_base') : 'tag',
	  'with_front'                => ! get_option('tag_base') || $wp_rewrite->using_index_permalinks(),
	  'ep_mask'                   => EP_TAGS,
	);
  
	// Redefine tag labels (or leave them the same)
	$labels = array(
	  'name'                       => _x( 'Tags', 'Taxonomy General Name', 'hierarchical_tags' ),
	  'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'hierarchical_tags' ),
	  'menu_name'                  => __( 'Taxonomy', 'hierarchical_tags' ),
	  'all_items'                  => __( 'All Tags', 'hierarchical_tags' ),
	  'parent_item'                => __( 'Parent Tag', 'hierarchical_tags' ),
	  'parent_item_colon'          => __( 'Parent Tag:', 'hierarchical_tags' ),
	  'new_item_name'              => __( 'New Tag Name', 'hierarchical_tags' ),
	  'add_new_item'               => __( 'Add New Tag', 'hierarchical_tags' ),
	  'edit_item'                  => __( 'Edit Tag', 'hierarchical_tags' ),
	  'update_item'                => __( 'Update Tag', 'hierarchical_tags' ),
	  'view_item'                  => __( 'View Tag', 'hierarchical_tags' ),
	  'separate_items_with_commas' => __( 'Separate tags with commas', 'hierarchical_tags' ),
	  'add_or_remove_items'        => __( 'Add or remove tags', 'hierarchical_tags' ),
	  'choose_from_most_used'      => __( 'Choose from the most used', 'hierarchical_tags' ),
	  'popular_items'              => __( 'Popular Tags', 'hierarchical_tags' ),
	  'search_items'               => __( 'Search Tags', 'hierarchical_tags' ),
	  'not_found'                  => __( 'Not Found', 'hierarchical_tags' ),
	);
  
	// Override structure of built-in WordPress tags
  
	register_taxonomy( 'post_tag', 'comic', array(
	  'hierarchical'              => true, // Was false, now set to true
	  'query_var'                 => 'tag',
	  'labels'                    => $labels,
	  'rewrite'                   => $rewrite,
	  'public'                    => true,
	  'show_ui'                   => true,
	  'show_admin_column'         => true,
	  '_builtin'                  => true,
	) );
  
  }
add_action('init', 'eks2021_hierarchical_tags_register');

/**
 * Custom Widgets for EKS2021 Theme
 */
function eks2021_register_custom_widget_area() {
	register_sidebar(
		array(
		'id' => 'post-bottom',
		'name' => esc_html__( 'Posts Bottom', 'eks2021' ),
		'description' => esc_html__( 'An area just below the main content', 'eks2021' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title-holder"><h3 class="widget-title">',
		'after_title' => '</h3></div>'
		)
	);
}
add_action( 'widgets_init', 'eks2021_register_custom_widget_area' );

/**
 * Character cloud widget
 */
// Creating the widget 
class eks2021_widget extends WP_Widget {
  
	function __construct() {
		parent::__construct(
		
		// Base ID of your widget
		'eks2021_widget', 
		
		// Widget name will appear in UI
		__('Character cloud', 'eks2021'), 
		
		// Widget description
		array( 'description' => __( 'A comic easel character cloud', 'eks2021' ), ) 
		);
	}
	  
	// Creating widget front-end
	  
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		
		// This is where you run the code and display the output
		$characters = get_terms(array('taxonomy'=>'characters'));
		echo '<nav role="navigation" aria-label="Characters">';
		echo '<div class="charactercloud">';
		echo '<ul class="comic-character-cloud" role="list">';
		for($i = 1; $i < count($characters); $i++) {
			echo '<li><a href="' . get_term_link( $characters[$i]->slug, 'characters' ) . '" class="character-cloud-link' . 
			'character-link-position-' . $i . '">' . $characters[$i]->name . '</a></li>';
		}

		echo "</ul></div></nav>";

		echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'New title', 'wpb_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	 
	// Class eks2021_widget ends here
} 
	
// Register and load the widget
function eks2021_load_widget() {
	register_widget( 'eks2021_widget' );
}
add_action( 'widgets_init', 'eks2021_load_widget' );

/**
 * Helper to get the current template
 */
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}
add_filter( 'template_include', 'var_template_include', 1000 );