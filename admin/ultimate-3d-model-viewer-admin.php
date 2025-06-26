<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ultimate_3D_Model_Viewer
 * @subpackage Ultimate_3D_Model_Viewer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_3D_Model_Viewer
 * @subpackage Ultimate_3D_Model_Viewer/admin
 * @author     Alexander Dort GmbH <robin@alexanderdort.com>
 */
class Ultimate_3D_Model_Viewer_Admin {

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
	 * @param      string    $ultimate_3d_model_viewer   The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ultimate_3d_model_viewer, $version ) {

		$this->ultimate_3d_model_viewer = $ultimate_3d_model_viewer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->ultimate_3d_model_viewer, plugin_dir_url( __FILE__ ) . 'css/ultimate-3d-model-viewer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ultimate_3d_model_viewer, plugin_dir_url( __FILE__ ) . 'js/ultimate-3d-model-viewer-admin.js', array( 'jquery' ), $this->version, false );
	}


	public function allow_custom_mimes() {
		$mimes = [];
		$mimes['glb'] = 'model/gltf-binary';
		$mimes['gltf'] = 'model/gltf+json';
    	$mimes['usdz'] = 'model/vnd.usdz+zip';
		$mimes['fbx'] = 'application/octet-stream';
		$mimes['obj'] = 'text/plain';
		$mimes['hdr'] =	'image/vnd.radiance';

		return $mimes;
	}


	public function add_custom_gutenberg_category($categories, $post) {
		return array_merge(
			$categories,
			[
				[
					'slug'  => '3d',
					'title' => __('3D', 'ultimate-3d-model-viewer'),
					'icon'  => null, // Optional, could be a dashicon slug or SVG
				],
			]
    	);
	}
}
