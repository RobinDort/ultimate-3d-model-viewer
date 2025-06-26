<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ultimate_3D_Model_Viewer
 * @subpackage Ultimate_3D_Model_Viewer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ultimate_3D_Model_Viewer
 * @subpackage Ultimate_3D_Model_Viewer/public
 * @author     Alexander Dort GmbH <robin@alexanderdort.com>
 */
class Ultimate_3D_Model_Viewer_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ultimate_3d_model_viewer   The ID of this plugin.
	 */
	private $ultimate_3d_model_viewer;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $model_viewer_widget      The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($ultimate_3d_model_viewer, $version ) {

		$this->ultimate_3d_model_viewer = $ultimate_3d_model_viewer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_3D_Model_Viewer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_3D_Model_Viewer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ultimate_3d_model_viewer . "-model-viewer-public", plugin_dir_url( __FILE__ ) . 'css/model-viewer-public.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->ultimate_3d_model_viewer . "-public", plugin_dir_url( __FILE__ ) . 'css/ultimate-3d-model-viewer-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_3D_Model_Viewer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_3D_Model_Viewer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script_module( $this->ultimate_3d_model_viewer . "-public", plugin_dir_url( __FILE__ ) . 'js/ultimate-3d-model-viewer-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script_module( $this->ultimate_3d_model_viewer . "-model-viewer-public", plugin_dir_url( __FILE__ ) . 'js/model-viewer-public.min.js', array('jquery'), $this->version, false);

		// Gutenberg block script registrations
		//wp_register_script( "ultimate-3d-model-viewer-block", plugin_dir_url( __FILE__ ) . 'src/index.js', array('jquery', 'wp-i18n', 'wp-blocks', 'wp-element'), $this->version, false);
	}


	/**
	 * Register the custom Elementor category for the 3D model viewer
	 *
	 * @since    1.0.0
	 */
	public function add_elementor_widget_categories( $elements_manager) {
        $elements_manager->add_category(
            "3D",
            [
                "title" => esc_html__("3D", "ultimate-3d-model-viewer"),
                "icon"  => "eicon-navigator",
            ]
        );
    }


	public function register_model_viewer_elementor_widget() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}
		require_once plugin_dir_path(dirname(__FILE__)) . "public/ultimate-3d-model-viewer-elementor.php";
		\Elementor\Plugin::instance()->widgets_manager->register( new Ultimate_3D_Model_Viewer_Elementor() );
	}


	public function register_model_viewer_gutenberg_block() {

		register_block_type(plugin_dir_path(__FILE__) . "build");
	}

}
