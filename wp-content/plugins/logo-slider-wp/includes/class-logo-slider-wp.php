<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://logichunt.com
 * @since      1.0.0
 *
 * @package    Logo_Slider_WP
 * @subpackage Logo_Slider_WP/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Logo_Slider_WP
 * @subpackage Logo_Slider_WP/includes
 * @author     LogicHunt <info.logichunt@gmail.com>
 */
class Logo_Slider_WP {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Logo_Slider_WP_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'logo-slider-wp';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Logo_Slider_WP_Loader. Orchestrates the hooks of the plugin.
	 * - Logo_Slider_WP_i18n. Defines internationalization functionality.
	 * - Logo_Slider_WP_Admin. Defines all hooks for the admin area.
	 * - Logo_Slider_WP_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-logo-slider-wp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-logo-slider-wp-i18n.php';

		/**
		 * The class responsible for defining settings functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-logo-slider-wp-setting.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-logo-slider-wp-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-logo-slider-wp-public.php';


		$this->loader = new Logo_Slider_WP_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Logo_Slider_WP_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Logo_Slider_WP_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Logo_Slider_WP_Admin( $this->get_plugin_name(), $this->get_version() );

		//Check plugin pro version is activated
        $this->loader->add_action('activated_plugin', $plugin_admin, 'pro_version_activation_checking_admin_init', 10, 2);
        $this->loader->add_action('admin_notices', $plugin_admin, 'pro_version_activation_checking_notice_warning' );


		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action('init', $plugin_admin, 'logosliderwp_initialize');

        //add metabox for custom post type
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'add_meta_boxes_metabox');

        //add plugin row meta and actions links
        $this->loader->add_filter( 'plugin_action_links_' . LSWP_PLUGIN_BASE_NAME, $plugin_admin, 'add_links_admin_plugin_page_title' );


        //logosliderwp save post
        $this->loader->add_action('save_post', $plugin_admin, 'save_post_metabox_logosliderwp', 10, 2);

		//Adding
		$this->loader->add_action('init', $plugin_admin, 'add_thumbnail_support_logo_slider');

        // Change Feature Image Position
 		$this->loader->add_action('do_meta_boxes', $plugin_admin, 'logo_slider_wp_img_box');

		//adding the setting action
		$this->loader->add_action('admin_init', $plugin_admin, 'logo_slider_wp_setting_init');

		// Add admin menu
		$this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');

		//Support Link
		$this->loader->add_filter('plugin_row_meta', $plugin_admin, 'logo_slider_wp_support_link', 10, 2);

        //Add new column head in post type listing page. Pattern --> manage_{post_type}_posts_columns.
        $this->loader->add_filter('manage_logosliderwp_posts_columns', $plugin_admin, 'add_new_column_head_for_logosliderwp' );

        //Define admin column value for column head in post type listing page. Pattern --> manage_{$post_type}_posts_custom_column.
        $this->loader->add_action( 'manage_logosliderwp_posts_custom_column', $plugin_admin, 'define_admin_column_value_for_logosliderwp', 10, 2 );


        //Retrieve custom post type post and set their order as need
        $this->loader->add_action( 'pre_get_posts', $plugin_admin, 'modify_query_get_posts' );

        //Save post order by ajax on drag & drop
        $this->loader->add_action( 'wp_ajax_lgx_ls_admin_lswp_reorder', $plugin_admin, 'save_post_reorder_for_logosliderwp', 99 );


		//Hook Tinymce
		$this->loader->add_filter("mce_external_plugins", $plugin_admin, "lgx_owl_register_tinymce_plugin");
		$this->loader->add_filter('mce_buttons', $plugin_admin, 'lgx_owl_add_tinymce_button');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Logo_Slider_WP_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//Add  Short Code
		add_shortcode('logo-slider-wp', array($plugin_public, 'logo_slider_wp_shortcode_function' ));

		//add_theme_support( 'post-thumbnails', array('logosliderwp'));


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Logo_Slider_WP_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
