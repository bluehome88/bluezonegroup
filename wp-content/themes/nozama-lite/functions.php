<?php
/**
 * Nozama_Lite functions and definitions
 */

if ( ! defined( 'NOZAMA_LITE_NAME' ) ) {
	define( 'NOZAMA_LITE_NAME', 'nozama-lite' );
}
if ( ! defined( 'NOZAMA_LITE_WHITELABEL' ) ) {
	// Set the following to true, if you want to remove any user-facing CSSIgniter traces.
	define( 'NOZAMA_LITE_WHITELABEL', false );
}

if ( ! function_exists( 'nozama_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nozama_lite_setup() {

	// Default content width.
	$GLOBALS['content_width'] = 960;

	// Make theme available for translation.
	load_theme_textdomain( 'nozama-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	$menus = array(
		'menu-1' => esc_html__( 'Main Menu', 'nozama-lite' ),
		'menu-2' => esc_html__( 'Main Menu - Right', 'nozama-lite' ),
	);
	register_nav_menus( $menus );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', apply_filters( 'nozama_lite_add_theme_support_html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) ) );

	// Add theme support for custom logos.
	add_theme_support( 'custom-logo', apply_filters( 'nozama_lite_add_theme_support_custom_logo', array() ) );

	// Set up the WordPress core custom background feature.
	$scss = new Nozama_Lite_SCSS_Colors( get_theme_file_path( '/css/inc/_variables.scss' ) );
	add_theme_support( 'custom-background', apply_filters( 'nozama_lite_custom_background_args', array(
		'default-color' => $scss->get( 'body-bg' ),
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );



	// Image sizes
	set_post_thumbnail_size( 960, 540, true );
	add_image_size( 'nozama_lite_item', 630, 355, true );
	add_image_size( 'nozama_lite_item_media', 520, 520, true );
	add_image_size( 'nozama_lite_item_media_sm', 90, 90, true );
	add_image_size( 'nozama_lite_fullwidth', 1290, 750, true );
	add_image_size( 'nozama_lite_block_item_lg', 910, 510, true );
	add_image_size( 'nozama_lite_block_item_long', 1290, 215, true );
	add_image_size( 'nozama_lite_block_item_md', 630, 345, true );
	add_image_size( 'nozama_lite_block_item_xl', 1290, 725, true );

	add_theme_support( 'nozama-lite-hide-single-featured', apply_filters( 'nozama_lite_theme_support_hide_single_featured_post_types', array(
		'post',
		'page',
	) ) );

	// This provides back-compat for author descriptions on WP < 4.9. Remove by WP 5.1.
	if ( ! has_filter( 'get_the_author_description', 'wpautop' ) ) {
		add_filter( 'get_the_author_description', 'wpautop' );
	}
}
endif;
add_action( 'after_setup_theme', 'nozama_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nozama_lite_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'templates/full-width-page.php' )
		|| is_page_template( 'templates/front-page.php' )
		|| is_page_template( 'templates/builder.php' )
		|| is_page_template( 'templates/builder-contained.php' )
	) {
		$content_width = 1290;
	} elseif ( is_singular() || is_home() || is_archive() ) {
		$info          = nozama_lite_get_layout_info();
		$content_width = $info['content_width'];
	}

	$GLOBALS['content_width'] = apply_filters( 'nozama_lite_content_width', $content_width );
}
add_action( 'template_redirect', 'nozama_lite_content_width', 0 );




add_filter( 'wp_page_menu', 'nozama_lite_wp_page_menu', 10, 2 );
function nozama_lite_wp_page_menu( $menu, $args ) {
	$menu = preg_replace( '#^<div .*?>#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul id="' . esc_attr( $args['menu_id'] ) . '" class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}

if ( ! function_exists( 'nozama_lite_get_columns_classes' ) ) :
	function nozama_lite_get_columns_classes( $columns ) {
		switch ( intval( $columns ) ) {
			case 1:
				$classes = 'col-12';
				break;
			case 2:
				$classes = 'col-sm-6 col-12';
				break;
			case 3:
				$classes = 'col-lg-4 col-md-4 col-12';
				break;
			case 4:
			default:
				$classes = 'col-xl-3 col-lg-4 col-sm-6 col-12';
				break;
		}

		return apply_filters( 'nozama_lite_get_columns_classes', $classes, $columns );
	}
endif;

if ( ! function_exists( 'nozama_lite_has_sidebar' ) ) :
/**
 * Determine if a sidebar is being displayed.
 */
function nozama_lite_has_sidebar() {
	$has_sidebar = false;

	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		if ( is_active_sidebar( 'shop' ) ) {
			$has_sidebar = true;
		}

		if ( is_product() ) {
			$has_sidebar = false;
		}
	} elseif ( is_home() || is_archive() ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$has_sidebar = true;
		}
	} elseif ( ! is_page() && is_active_sidebar( 'sidebar-1' ) ) {
		$has_sidebar = true;
	} elseif ( is_page() && is_active_sidebar( 'sidebar-2' ) ) {
		$has_sidebar = true;
	}

	return apply_filters( 'nozama_lite_has_sidebar', $has_sidebar );
}
endif;

if ( ! function_exists( 'nozama_lite_get_layout_info' ) ) :
/**
 * Return appropriate layout information.
 */
function nozama_lite_get_layout_info() {
	$has_sidebar = nozama_lite_has_sidebar();

	$classes = array(
		'container_classes' => $has_sidebar ? 'col-lg-9 col-12' : 'col-xl-8 col-lg-10 col-12',
		'sidebar_classes'   => $has_sidebar ? 'col-lg-3 col-12' : '',
		'content_width'     => 960,
		'has_sidebar'       => $has_sidebar,
	);

	$sidebar_option = '';
	if ( is_singular() ) {
		$sidebar_option = get_post_meta( get_queried_object_id(), 'nozama_lite_sidebar', true );
	}

	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {

		if ( is_product() ) {
			$classes = array(
				'container_classes' => 'col-12',
				'sidebar_classes'   => '',
				'content_width'     => 740,
				'has_sidebar'       => false,
			);
		} else {
			$classes = array(
				'container_classes' => 'col-lg-9 col-12',
				'sidebar_classes'   => 'col-lg-3 col-12',
				'content_width'     => 960,
				'has_sidebar'       => $has_sidebar,
			);
		}
	} elseif ( is_singular() ) {
		if ( 'none' === get_post_meta( get_the_ID(), 'nozama_lite_sidebar', true ) ) {
			$classes = array(
				'container_classes' => 'col-xl-8 col-lg-10 col-12',
				'sidebar_classes'   => '',
				'content_width'     => 960,
				'has_sidebar'       => false,
			);
		}
	}


	$classes['row_classes'] = '';
	if ( is_singular() ) {
		if ( ! $has_sidebar || 'none' === $sidebar_option ) {
			$classes['row_classes'] = 'justify-content-center';
		} elseif ( 'left' === $sidebar_option ) {
			$classes['row_classes'] = 'flex-row-reverse';
		}
	} elseif ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() ) ) {
		$classes['row_classes'] = 'flex-row-reverse';
	} elseif ( ! $has_sidebar ) {
		$classes['row_classes'] = 'justify-content-center';
	}

	return apply_filters( 'nozama_lite_layout_info', $classes, $has_sidebar );
}
endif;

add_filter( 'tiny_mce_before_init', 'nozama_lite_insert_wp_editor_formats' );
function nozama_lite_insert_wp_editor_formats( $init_array ) {
	$style_formats = array(
		array(
			'title'   => esc_html__( 'Intro text (big text)', 'nozama-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-intro',
			'wrapper' => true,
		),
		array(
			'title'   => esc_html__( '2 Column Text', 'nozama-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-column-split',
			'wrapper' => true,
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'mce_buttons_2', 'nozama_lite_mce_buttons_2' );
function nozama_lite_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_action( 'admin_init', 'nozama_lite_admin_setup_hide_single_featured' );
function nozama_lite_admin_setup_hide_single_featured() {
	if ( current_theme_supports( 'nozama-lite-hide-single-featured' ) ) {
		$hide_featured_support = get_theme_support( 'nozama-lite-hide-single-featured' );
		$hide_featured_support = $hide_featured_support[0];

		foreach ( $hide_featured_support as $supported_post_type ) {
			add_meta_box( 'nozama-lite-single-featured-visibility', esc_html__( 'Featured Image Visibility', 'nozama-lite' ), 'nozama_lite_single_featured_visibility_metabox', $supported_post_type, 'side', 'default' );
		}
	}

	add_action( 'save_post', 'nozama_lite_hide_single_featured_save_post' );
}

add_action( 'init', 'nozama_lite_setup_hide_single_featured' );
function nozama_lite_setup_hide_single_featured() {
	if ( current_theme_supports( 'nozama-lite-hide-single-featured' ) ) {
		add_filter( 'get_post_metadata', 'nozama_lite_hide_single_featured_get_post_metadata', 10, 4 );
	}
}

function nozama_lite_single_featured_visibility_metabox( $object, $box ) {
	$fieldname = 'nozama_lite_hide_single_featured';
	$checked   = get_post_meta( $object->ID, $fieldname, true );

	?>
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="check" name="<?php echo esc_attr( $fieldname ); ?>" value="1" <?php checked( $checked, 1 ); ?> />
		<label for="<?php echo esc_attr( $fieldname ); ?>"><?php esc_html_e( "Hide when viewing this post's page", 'nozama-lite' ); ?></label>
	<?php
	wp_nonce_field( 'nozama_lite_hide_single_featured_nonce', '_nozama_lite_hide_single_featured_meta_box_nonce' );
}

function nozama_lite_hide_single_featured_get_post_metadata( $value, $post_id, $meta_key, $single ) {
	$hide_featured_support = get_theme_support( 'nozama-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $value;
	}

	if ( '_thumbnail_id' === $meta_key && ( is_single( $post_id ) || is_page( $post_id ) ) && get_post_meta( $post_id, 'nozama_lite_hide_single_featured', true ) ) {
		return false;
	}

	return $value;
}

function nozama_lite_hide_single_featured_save_post( $post_id ) {
	$hide_featured_support = get_theme_support( 'nozama-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return;
	}

	if ( isset( $_POST['_nozama_lite_hide_single_featured_meta_box_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_nozama_lite_hide_single_featured_meta_box_nonce'] ), 'nozama_lite_hide_single_featured_nonce' ) ) {
		update_post_meta( $post_id, 'nozama_lite_hide_single_featured', isset( $_POST['nozama_lite_hide_single_featured'] ) ); // Input var okay.
	}
}

if ( ! function_exists( 'nozama_lite_get_template_part' ) ) :
/**
 * Load a template part into a template, optionally passing an associative array
 * that will be available as variables.
 *
 * Makes it easy for a theme to reuse sections of code in a easy to overload way
 * for child themes.
 *
 * Includes the named template part for a theme or if a name is specified then a
 * specialised part will be included. If the theme contains no {slug}.php file
 * then no template will be included.
 *
 * The template is included using require, not require_once, so you may include the
 * same template part multiple times.
 *
 * For the $name parameter, if the file is called "{slug}-special.php" then specify
 * "special".
 *
 * When $data is an array, the key of each value becomes the name of the variable,
 * and the value becomes the variable's value.
 *
 * $data_overwrite should be one of the extract() flags, as described in http://www.php.net/extract
 *
 * @uses locate_template()
 * @uses do_action() Calls 'get_template_part_{$slug}' action.
 * @uses do_action() Calls 'ci_get_template_part_{$slug}' action.
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $data A key-value array of data to be available as variables.
 * @param int $data_overwrite The EXTR_* constant to pass to extract( $data ).
 */
function nozama_lite_get_template_part( $slug, $name = null, $data = array(), $data_overwrite = EXTR_PREFIX_SAME ) {
	// Code similar to get_template_part() as of WP v4.9.8

	// Retain the same action hook, so that calls to our function respond to the same hooked functions.
	do_action( "get_template_part_{$slug}", $slug, $name );

	// Add our own action hook, so that we can hook using $data also.
	do_action( "ci_get_template_part_{$slug}", $slug, $name, $data );

	$templates = array();
	$name      = (string) $name;

	if ( '' !== $name ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	// Don't load the template ( it would normally call load_template() )
	$_template_file = locate_template( $templates, false, false );

	// Code similar to load_template()
	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	if ( is_array( $wp_query->query_vars ) ) {
		extract( $wp_query->query_vars, EXTR_SKIP );
	}

	if ( is_array( $data ) and ( count( $data ) > 0 ) ) {
		extract( $data, $data_overwrite, 'imp' );
	}

	require( $_template_file );
}
endif;


add_filter( 'get_the_archive_title', 'nozama_lite_get_the_archive_title' );
if ( ! function_exists( 'nozama_lite_get_the_archive_title' ) ) :
function nozama_lite_get_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_author() ) {
		/* translators: %s is an author's name. */
		$title = sprintf( __( 'All posts by %s', 'nozama-lite' ), '<span class="vcard">' . get_the_author() . '</span>' );
	}

	return $title;
}
endif;

function nozama_lite_post_type_listing_get_valid_columns_options( $post_type = false ) {
	$array = array(
		'min'   => 2,
		'max'   => 4,
		'range' => range( 2, 4 ),
	);

	return apply_filters( 'nozama_lite_post_type_listing_valid_columns_options', $array, $post_type );
}

/**
 * Common theme features.
 */
require_once get_theme_file_path( '/common/common.php' );

/**
 * Template tags.
 */
require_once get_theme_file_path( '/inc/template-tags.php' );

/**
 * Sanitization functions.
 */
require_once get_theme_file_path( '/inc/sanitization.php' );

/**
 * Hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/**
 * Scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 * Sidebars and widgets.
 */
require_once get_theme_file_path( '/inc/sidebars-widgets.php' );

/**
 * Customizer controls.
 */
require_once get_theme_file_path( '/inc/customizer.php' );

/**
 * Various helper functions, so that this functions.php is cleaner.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

/**
 * WooCommerce related code.
 */
require_once get_theme_file_path( '/inc/woocommerce.php' );

/**
 * MaxSlider related code.
 */
require_once get_theme_file_path( '/inc/maxslider.php' );

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );

/**
 * SCSS Colors reader.
 */
require_once get_theme_file_path( '/inc/class-scss-colors.php' );

/**
 * Presentational custom fields for pages.
 */
require_once get_theme_file_path( '/inc/custom-fields-page.php' );

// remove base url for product category
add_filter('request', function( $vars ) {
    global $wpdb;

    if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
        $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );

        $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));

        if( $exists && (strpos( $vars['category_name'], 'product-catalogue' ) !== false || strpos( $vars['category_name'], 'rental-equipment' ) !== false )){
            $old_vars = $vars;
            $vars = array('product_cat' => $slug );
            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
            if ( !empty( $old_vars['orderby'] ) )
                    $vars['orderby'] = $old_vars['orderby'];
                if ( !empty( $old_vars['order'] ) )
                    $vars['order'] = $old_vars['order'];    
        }
        else{
	        if( strpos( $vars['category_name'], 'product-catalogue' ) !== false || strpos( $vars['category_name'], 'rental-equipment' ) !== false ){
	        	$vars['post_type'] = 'product';

	        	if( $vars['name'] == 'page' && $vars['page'] > 1 ){
		        	$old_vars = $vars;
		            $vars = array('product_cat' => $vars['category_name'] );
		            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
		                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
		            if ( !empty( $old_vars['orderby'] ) )
		                    $vars['orderby'] = $old_vars['orderby'];
		                if ( !empty( $old_vars['order'] ) )
		                    $vars['order'] = $old_vars['order'];   
	        	}	        	
	        }
	        else if( $vars['category_name'] == "latest-news" ){
				$vars['pagename'] = $vars['category_name'];
				$vars['paged'] = $vars['page'] > 1 ? $vars['page'] : 1;

				unset($vars['name']);
				unset($vars['page']);
				unset($vars['category_name']);
			}
	        else if( $vars['category_name'] != "" ){
				$vars['pagename'] = $slug;
				$vars['page'] = "";
			}

        }
        
        if( strpos( $vars['category_name'], 'announcements' ) !== false ){
	        
	        // single post
	        if( $vars['name'] != "" )
		        $vars['post_type'] = 'post';
		    else
	    	{
		    	unset($vars['page']);
		    	unset($vars['pagename']);
	    	}
	    }
    }

    if( isset($vars['s']) ){
		$vars['paged'] = $vars['pagename'] > 1 ? $vars['pagename'] : 1;
		unset($vars['category_name']);
		unset($vars['pagename']);
		unset($vars['name']);
		unset($vars['page']);
    }

    return $vars;
});

add_filter('term_link', 'term_link_filter', 10, 3);
function term_link_filter( $url, $term, $taxonomy ) {
    $url=str_replace("/./","/",$url);
    return $url;
}
add_filter( 'woocommerce_register_post_type_product', function($var) {
    $var['rewrite'] = str_replace('/product/', '/', $var['rewrite']);
    return $var;
});

// Exclude proudcts for child categories on Category page
function exclude_product_cat_children($wp_query) {
if ( isset ( $wp_query->query_vars['product_cat'] ) && $wp_query->is_main_query()) {
    $wp_query->set('tax_query', array(
        array (
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $wp_query->query_vars['product_cat'],
            'include_children' => false
        )
      )
    );
  }
}
// add_filter('pre_get_posts', 'exclude_product_cat_children');

// Sepaprate Subcategories and products on Category page
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

// add subcategories before the product loop (yet after catalog_ordering and result_count -> see priority 40)
add_action( 'woocommerce_before_shop_loop', 'woocommerce_show_product_subcategories', 40 );
function woocommerce_show_product_subcategories() {
    $subcategories = woocommerce_maybe_show_product_subcategories();
        if ($subcategories) {
        	echo '<h3>Product Categories</h3>';
          	echo '<ul class="row subcategories">',$subcategories,'</ul>';
    }
}

// include importer function
require_once get_theme_file_path( '/inc/importer.php' );

add_filter('widget_text', 'do_shortcode');

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// temp code for category description
// TODO : Update category description as real one
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_archive_description', 'ts_add_to_category_description' );
    function ts_add_to_category_description() {
    	$temp_description = '<p>BlueZone has a wide product portfolio representing the leading product manufacturers worldwide.</p>
<p>Our sales team has the experience to advise you on the right product for your application.</p>
<p>View our complete range of equipment  online and <a href="/contact-us">Contact BlueZone</a> for more information.</p>';

        if ( is_product_category()) {
            $cat_desc = term_description( $cat_id, 'product_cat' );
    		if( $cat_desc != "" )
    			echo $cat_desc;
    		else
    			echo $temp_description;
    }
}

add_shortcode( 'do_hook', function( $atts = array(), $content = null, $tag = ''){
	if ( isset( $atts['hook'] ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

		remove_filter( 'woocommerce_product_tabs', 'woocommerce_default_product_tabs' );
		remove_filter( 'woocommerce_product_tabs', 'woocommerce_sort_product_tabs', 99 );

		do_action( 'woocommerce_single_product_summary' );
	}
	return;
});


add_action( 'admin_init', 'disable_autosave' );
function disable_autosave() {
	wp_deregister_script( 'autosave' );
}

add_filter( 'woocommerce_subcategory_count_html', '__return_false' );

add_filter( 'the_posts', function( $posts, $q ) 
{
    if( $q->is_main_query() && $q->is_search() ) 
    {
        usort( $posts, function( $a, $b ){
            /**
             * Sort by post type. If the post type between two posts are the same
             * sort by post date. Make sure you change your post types according to 
             * your specific post types. This is my post types on my test site
             */
            $post_types = [
                'product' => 1,
                'page'       => 2,
                'post'    => 3
            ];              
            if ( $post_types[$a->post_type] != $post_types[$b->post_type] ) {
                return $post_types[$a->post_type] - $post_types[$b->post_type];
            } else {
                return $a->post_date < $b->post_date; // Change to > if you need oldest posts first
            }
        });
    }
    return $posts;
}, 10, 2 );

if ( ! function_exists( 'nozama_lite_woocommerce_category_thumbnail' ) ) {

	/**
	 * Show subcategory thumbnails.
	 *
	 * @param mixed $category Category.
	 */
	function nozama_lite_woocommerce_category_thumbnail( $category ) {
		$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'nozama_lite_item' );
		$dimensions           = wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id         = get_term_meta( $category->term_id, 'thumbnail_id', true );

		if ( $thumbnail_id ) {
			$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
			$image        = $image[0];
			$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
			$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
		} else {
			$image        = wc_placeholder_img_src();
			$image_srcset = false;
			$image_sizes  = false;
		}

		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds.
			// Ref: https://core.trac.wordpress.org/ticket/23605.
			$image = str_replace( ' ', '%20', $image );

			// Add responsive image markup if available.
			if ( $image_srcset && $image_sizes ) {
				echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
			} else {
				echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
			}
		}
	}
}