import { useBlockProps } from "@wordpress/block-editor";

export default function Save({ attributes }) {
	const blockProps = useBlockProps.save();
	return (
		<model-viewer
			class="model-viewer"
			{...blockProps}
			src={attributes.src}
			poster={attributes.poster}
			environment-image={attributes.environment}
			skybox-image={attributes.skybox}
			tone-mapping={attributes.toneMapping}
			exposure={attributes.exposure}
			shadow-intensity={attributes.shadowIntensity}
			shadow-softness={attributes.shadowSoftness}
			camera-orbit={attributes.cameraOrbit}
			max-camera-orbit={attributes.cameraMaxOrbit}
			min-camera-orbit={attributes.cameraMinOrbit}
			camera-target={attributes.cameraTarget}
			field-of-view={attributes.fieldOfView}
			max-field-of-view={attributes.fieldOfViewMax}
			min-field-of-view={attributes.fieldOfViewMin}
			loading={attributes.loading}
			{...(attributes.autoRotate && { "auto-rotate": "" })}
			{...(attributes.ar && { ar: "" })}
			{...(attributes.ar && { "ar-modes": "webxr scene-viewer quick-look" })}
			ios-src={attributes.iosSrc}
			interaction-prompt="auto"
			touch-action="pan-y"
			camera-controls=""
			autoplay>
			<div id="progress-text">Loading 0%</div>
			<div class="progress-bar hide">
				<div class="update-bar"></div>
			</div>
		</model-viewer>
	);
}
