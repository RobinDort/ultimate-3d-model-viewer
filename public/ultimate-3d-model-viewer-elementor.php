<?php

class Ultimate_3D_Model_Viewer_Elementor extends \Elementor\Widget_Base {

    public function get_name(): string {
		return 'ultimate_3d_model_viewer';
	}

    public function get_title(): string {
		return esc_html__( 'Ultimate 3D Model Viewer', 'ultimate-3d-model-viewer' );
	}

    public function get_icon(): string {
		return 'eicon-navigator';
	}

    public function get_categories(): array {
		return [ '3D' ];
	}

    public function get_keywords(): array {
		return [ '3D', '3d', 'model-viewer', 'model', 'viewer', 'ultimate' ];
	}

	public function get_script_depends(): array {
		return ['model-viewer-public.min.js'];
	}

	public function get_style_depends(): array {
		return ['model-viewer-public.css'];
	}

	protected function register_controls(): void {
		$this->add_content_controls();
		$this->add_style_controls();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        require_once plugin_dir_path( dirname( __FILE__ ) ) .  'public/partials/ultimate-3d-model-viewer-public-display.php';
    }


	private function add_content_controls(): void {
		$this->start_controls_section(
			'content_section_src',
			[
				'label' => esc_html__('src', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		// Model Source (GLB, FBX, OBJ)
		$this->add_control(
			'model_viewer_src',
			[
				'label' => esc_html__( '3D Model File', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['model/gltf-binary', 'model/fbx', 'model/obj'], // Note: not enforced by Elementor UI
				'description' => esc_html__('Select a .glb, .fbx or .obj file', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'content_section_poster',
			[
				'label' => esc_html__('poster', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		// Poster Image (PNG, JPG)
		$this->add_control(
			'model_viewer_poster',
			[
				'label' => esc_html__( 'Poster Image', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['image/png', 'image/jpeg'],
				'description' => esc_html__('Select a poster image (JPG or PNG)', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'content_section_environment',
			[
				'label' => esc_html__('environment', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		// Environment Image (HDR)
		$this->add_control(
			'model_viewer_environment',
			[
				'label' => esc_html__( 'Environment HDR', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__('Select an .hdr environment image', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'content_section_skybox',
			[
				'label' => esc_html__('skybox', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		// Skybox Image (PNG, JPG)
		$this->add_control(
			'model_viewer_skybox',
			[
				'label' => esc_html__( 'Skybox Image', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__('Select a skybox image (JPG or PNG)', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_tone_mapping',
			[
				'label' => esc_html__('tone mapping', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		$this->add_control(
			'model_viewer_tone_mapping',
			[
				'label' => esc_html__( 'tone mapping', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'neutral',
				'options' => [
					'neutral' => esc_html__( 'neutral', 'ultimate-3d-model-viewer' ),
					'aces' => esc_html__( 'aces', 'ultimate-3d-model-viewer' ),
					'agx'  => esc_html__( 'agx', 'ultimate-3d-model-viewer' ),
					'reinhard' => esc_html__( 'reinhard', 'ultimate-3d-model-viewer' ),
					'cineon' => esc_html__( 'cineon', 'ultimate-3d-model-viewer' ),
					'linear' => esc_html__( 'linear', 'ultimate-3d-model-viewer' ),
					'none' => esc_html__( 'none', 'ultimate-3d-model-viewer' ),
				],
				'selectors' => [
					'{{WRAPPER}} tone-mapping' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_exposure',
			[
				'label' => esc_html__('exposure', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);


		$this->add_control(
			'model_viewer_exposure',
			[
				'label' => esc_html__('exposure', 'ultimate-3d-model-viewer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 1, 'max' => 10, 'step' => 0.01 ],
				],
				'default' => [
					'size' => 1.5,
				],
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'exposure: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_shadows',
			[
				'label' => esc_html__('shadows', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		$this->add_control(
			'model_viewer_sh_intensity',
			[
				'label' => esc_html__('shadow intensity', 'ultimate-3d-model-viewer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.01 ],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'shadow-intensity: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'model_viewer_sh_softness',
			[
				'label' => esc_html__('shadow softness', 'ultimate-3d-model-viewer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.01 ],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'shadow-softness: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_positioning',
			[
				'label' => esc_html__('camera options', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		// Camera Orbit
		$this->add_control(
			'model_viewer_camera_orbit',
			[
				'label' => esc_html__( 'Camera Orbit', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0deg 75deg 105%',
				'description' => esc_html__('Enter 3 value camera orbit (e.g., 0deg 75deg 105%)', 'ultimate-3d-model-viewer'),
			]
		);

		// Max Camera Orbit
		$this->add_control(
			'model_viewer_camera_max_orbit',
			[
				'label' => esc_html__( 'Max Camera Orbit', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'Infinity 180deg auto',
				'description' => esc_html__('Enter 3 value maximum camera orbit (e.g., Infinity 180deg auto)', 'ultimate-3d-model-viewer'),
			]
		);

		// Min Camera Orbit
		$this->add_control(
			'model_viewer_camera_min_orbit',
			[
				'label' => esc_html__( 'Min Camera Orbit', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '-Infinity 0deg auto',
				'description' => esc_html__('Enter 3 value minimum camera orbit (e.g., -Infinity 0deg auto)', 'ultimate-3d-model-viewer'),
			]
		);

		// Camera Target
		$this->add_control(
			'model_viewer_camera_target',
			[
				'label' => esc_html__( 'Camera Target', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0m 1.5m -0.5m',
				'description' => esc_html__('Enter 3 value camera target (e.g., 0m 1.5m -0.5m)', 'ultimate-3d-model-viewer'),
			]
		);


		// FOV
		$this->add_control(
			'model_viewer_camera_fov',
			[
				'label' => esc_html__( 'Field of view', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '30deg',
				'default' => 'auto',
				'description' => esc_html__('Enter field of view (e.g., 30deg)', 'ultimate-3d-model-viewer'),
			]
		);

		// Max FOV
		$this->add_control(
			'model_viewer_camera_max_fov',
			[
				'label' => esc_html__( 'Max Field of view', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'auto',
				'placeholder' => '30deg',
				'description' => esc_html__('Enter maximum field of view (e.g., 30deg)', 'ultimate-3d-model-viewer'),
			]
		);


		// Min FOV
		$this->add_control(
			'model_viewer_camera_min_fov',
			[
				'label' => esc_html__( 'Min Field of view', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '25deg',
				'placeholder' => '25deg',
				'description' => esc_html__('Enter minimum field of view (e.g., 25deg)', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_loading',
			[
				'label' => esc_html__('loading', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		$this->add_control(
			'model_viewer_loading',
			[
				'label' => esc_html__( 'loading strategy', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__( 'auto', 'ultimate-3d-model-viewer' ),
					'lazy' => esc_html__( 'lazy', 'ultimate-3d-model-viewer' ),
					'eager'  => esc_html__( 'eager', 'ultimate-3d-model-viewer' ),
				],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'content_section_auto_rotate',
			[
				'label' => esc_html__('auto rotate', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		$this->add_control(
			'model_viewer_auto_rotate',
			[
				'label' => esc_html__( 'Auto rotation', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'ultimate-3d-model-viewer' ),
				'label_off' => esc_html__( 'Off', 'ultimate-3d-model-viewer' ),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_augmented_reality',
			[
				'label' => esc_html__('augmented reality', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);

		$this->add_control(
			'model_viewer_augmented_reality',
			[
				'label' => esc_html__( 'Enable augmented reality', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'ultimate-3d-model-viewer' ),
				'label_off' => esc_html__( 'Off', 'ultimate-3d-model-viewer' ),
				'return_value' => 'true',
				'default' => '',
			]
		);


		$this->add_control(
			'model_viewer_ios_src',
			[
				'label' => esc_html__( 'IOS src model', 'ultimate-3d-model-viewer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['model/vnd.usdz+zip'],
				'description' => esc_html__('Select a special ios usdz file for the model in ar mode', 'ultimate-3d-model-viewer'),
			]
		);

		$this->end_controls_section();
	}



	private function add_style_controls(): void {
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('model viewer', 'ultimate-3d-model-viewer'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE, 
			]
		);

		// Background color
		$this->add_control(
			'model_viewer_background_color',
			[
				'label'     => esc_html__('Background Color', 'ultimate-3d-model-viewer'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Width
		$this->add_responsive_control(
			'viewer_width',
			[
				'label' => esc_html__('Width', 'ultimate-3d-model-viewer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 2000 ],
					'%'  => [ 'min' => 10, 'max' => 100 ],
					'em' => [ 'min' => 5, 'max' => 100 ],
					'rem'=> [ 'min' => 5, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Height
		$this->add_responsive_control(
			'viewer_height',
			[
				'label' => esc_html__('Height', 'ultimate-3d-model-viewer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 2000 ],
					'%'  => [ 'min' => 10, 'max' => 100 ],
					'em' => [ 'min' => 5, 'max' => 100 ],
					'rem'=> [ 'min' => 5, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} model-viewer' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

?>