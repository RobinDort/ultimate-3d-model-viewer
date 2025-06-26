<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<model-viewer
    class="model-viewer"
    src="<?php echo esc_url( $settings['model_viewer_src']['url'] ?? '' ); ?>"
    poster="<?php echo esc_url( $settings['model_viewer_poster']['url'] ?? '' ); ?>"
    environment-image="<?php echo esc_url( $settings['model_viewer_environment']['url'] ?? '' ); ?>"
    skybox-image="<?php echo esc_url( $settings['model_viewer_skybox']['url'] ?? '' ); ?>"
    loading="<?php echo esc_attr( $settings['model_viewer_loading'] ?? 'auto') ?>"
    tone-mapping="<?php echo esc_attr($settings['model_viewer_tone_mapping']) ?>"
    shadow-intensity="<?php echo esc_attr($settings["model_viewer_sh_intensity"] ?? '0') ?>"
    shadow-softness="<?php echo esc_attr($settings["model_viewer_sh_softness"]) ?? '0' ?>"
    exposure="<?php echo esc_attr($settings["model_viewer_exposure"]["size"] ?? '1,5') ?>"
    touch-action="pan-y"
    camera-orbit="<?php echo esc_attr( $settings['model_viewer_camera_orbit'] ?? '' ); ?>"
    max-camera-orbit="<?php echo esc_attr( $settings['model_viewer_camera_max_orbit'] ?? 'Infinity 180deg auto' ); ?>"
    min-camera-orbit="<?php echo esc_attr( $settings['model_viewer_camera_min_orbit'] ?? '-Infinity 0deg auto' ); ?>"
    camera-target="<?php echo esc_attr($settings["model_viewer_camera_target"] ?? '0m 1.5m -0.5m') ?>"
    field-of-view="<?php echo esc_attr( $settings['model_viewer_camera_fov'] ?? 'auto' ); ?>"
    max-field-of-view="<?php echo esc_attr( $settings['model_viewer_camera_max_fov'] ?? 'auto' ); ?>"
    min-field-of-view="<?php echo esc_attr( $settings['model_viewer_camera_min_fov'] ?? '25deg' ); ?>"
    camera-controls
    ios-src="<?php echo esc_url($settings['model_viewer_ios_src']['url'] ?? '') ?>"
    <?php echo !empty( $settings['model_viewer_augmented_reality'] ) ? 'ar' : ''; ?>
    <?php echo !empty( $settings['model_viewer_augmented_reality'] ) ? 'ar-modes="webxr scene-viewer quick-look"' : ''; ?>
    <?php echo !empty( $settings['model_viewer_auto_rotate'] ) ? 'auto-rotate' : ''; ?>
>
    <div id="progress-text">Loading 0%</div>
    <div class="progress-bar hide">
        <div class="update-bar"></div>
    </div>
</model-viewer>