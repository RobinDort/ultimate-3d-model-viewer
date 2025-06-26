import { __, _x } from "@wordpress/i18n";
import { useBlockProps, MediaUpload, MediaUploadCheck, InspectorControls } from "@wordpress/block-editor";
import { Panel, PanelBody, SelectControl, RangeControl, TextControl, ToggleControl, Button } from "@wordpress/components";

const ALLOWED_MEDIA_TYPES = [
	"image/png",
	"image/jpeg",
	"image/vnd.radiance",
	"model/gltf-binary",
	"model/obj",
	"application/octet-stream",
	"model/vnd.usdz+zip",
];

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();

	const updateMedia = (prop) => (media) => {
		setAttributes({ [prop]: media.url });
	};

	return (
		<div {...blockProps}>
			<InspectorControls>
				<Panel>
					<PanelBody title={__("srcJS", "ultimate-3d-model-viewer")}>
						<MediaUploadCheck>
							<MediaUpload
								allowedTypes={ALLOWED_MEDIA_TYPES}
								render={({ open }) => (
									<div>
										{attributes.src && (
											<p>
												<code>{attributes.src.split("/").pop()}</code>
											</p>
										)}
										<Button onClick={open}>{__("Select a .glb, .fbx or .obj file", "ultimate-3d-model-viewer")}</Button>
									</div>
								)}
								onSelect={updateMedia("src")}></MediaUpload>
						</MediaUploadCheck>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={_x("poster", "block poster", "ultimate-3d-model-viewer")} initialOpen={false}>
						<MediaUploadCheck>
							<MediaUpload
								allowedTypes={ALLOWED_MEDIA_TYPES}
								render={({ open }) => (
									<div>
										{attributes.poster && (
											<p>
												<code>{attributes.poster.split("/").pop()}</code>
											</p>
										)}
										<Button onClick={open}>{_x("Select a poster image (JPG or PNG)", "block poster hint", "ultimate-3d-model-viewer")}</Button>
									</div>
								)}
								onSelect={updateMedia("poster")}></MediaUpload>
						</MediaUploadCheck>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("environment", "ultimate-3d-model-viewer")} initialOpen={false}>
						<MediaUploadCheck>
							<MediaUpload
								allowedTypes={ALLOWED_MEDIA_TYPES}
								render={({ open }) => (
									<div>
										{attributes.environment && (
											<p>
												<code>{attributes.environment.split("/").pop()}</code>
											</p>
										)}
										<Button onClick={open}>{__("Select an .hdr environment image", "ultimate-3d-model-viewer")}</Button>
									</div>
								)}
								onSelect={updateMedia("environment")}></MediaUpload>
						</MediaUploadCheck>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("skybox", "ultimate-3d-model-viewer")} initialOpen={false}>
						<MediaUploadCheck>
							<MediaUpload
								allowedTypes={ALLOWED_MEDIA_TYPES}
								render={({ open }) => (
									<div>
										{attributes.skybox && (
											<p>
												<code>{attributes.skybox.split("/").pop()}</code>
											</p>
										)}
										<Button onClick={open}>{__("Select a skybox image (JPG or PNG)", "ultimate-3d-model-viewer")}</Button>
									</div>
								)}
								onSelect={updateMedia("skybox")}></MediaUpload>
						</MediaUploadCheck>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("tone mapping", "ultimate-3d-model-viewer")} initialOpen={false}>
						<SelectControl
							label={__("tone mapping", "ultimate-3d-model-viewer")}
							value={attributes.toneMapping}
							options={[
								{ label: "neutral", value: "neutral" },
								{ label: "aces", value: "aces" },
								{ label: "agx", value: "agx" },
								{ label: "reinhard", value: "reinhard" },
								{ label: "cineon", value: "cineon" },
								{ label: "linear", value: "linear" },
								{ label: "none", value: "none" },
							]}
							onChange={(val) => setAttributes({ toneMapping: val })}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("exposure", "ultimate-3d-model-viewer")} initialOpen={false}>
						<RangeControl
							label={__("exposure", "ultimate-3d-model-viewer")}
							value={attributes.exposure}
							onChange={(val) => setAttributes({ exposure: val })}
							min={1}
							max={10}
							step={0.01}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("shadows", "ultimate-3d-model-viewer")} initialOpen={false}>
						<RangeControl
							label={__("shadow intensity", "ultimate-3d-model-viewer")}
							value={attributes.shadowIntensity}
							onChange={(val) => setAttributes({ shadowIntensity: val })}
							min={0}
							max={1}
							step={0.01}
						/>

						<RangeControl
							label={__("shadow softness", "ultimate-3d-model-viewer")}
							value={attributes.shadowSoftness}
							onChange={(val) => setAttributes({ shadowSoftness: val })}
							min={0}
							max={1}
							step={0.01}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("camera options", "ultimate-3d-model-viewer")} initialOpen={false}>
						<TextControl
							label={__("Camera Orbit", "ultimate-3d-model-viewer")}
							placeholder={__("Enter 3 value camera orbit (e.g., 0deg 75deg 105%)", "ultimate-3d-model-viewer")}
							value={attributes.cameraOrbit}
							onChange={(val) => setAttributes({ cameraOrbit: val })}
						/>

						<TextControl
							label={__("Max Camera Orbit", "ultimate-3d-model-viewer")}
							placeholder={__("Enter 3 value maximum camera orbit (e.g., Infinity 180deg auto)", "ultimate-3d-model-viewer")}
							value={attributes.maxCameraOrbit}
							onChange={(val) => setAttributes({ maxCameraOrbit: val })}
						/>

						<TextControl
							label={__("Min Camera Orbit", "ultimate-3d-model-viewer")}
							placeholder={__("Enter 3 value minimum camera orbit (e.g., -Infinity 0deg auto)", "ultimate-3d-model-viewer")}
							value={attributes.minCameraOrbit}
							onChange={(val) => setAttributes({ minCameraOrbit: val })}
						/>

						<TextControl
							label={__("Camera Target", "ultimate-3d-model-viewer")}
							placeholder={__("Enter 3 value camera target (e.g., 0m 1.5m -0.5m)", "ultimate-3d-model-viewer")}
							value={attributes.cameraTarget}
							onChange={(val) => setAttributes({ cameraTarget: val })}
						/>

						<TextControl
							label={__("Field of view", "ultimate-3d-model-viewer")}
							placeholder={__("Enter field of view (e.g., 30deg)", "ultimate-3d-model-viewer")}
							value={attributes.fieldOfView}
							onChange={(val) => setAttributes({ fieldOfView: val })}
						/>

						<TextControl
							label={__("Max Field of view", "ultimate-3d-model-viewer")}
							placeholder={__("Enter maximum field of view (e.g., 30deg)", "ultimate-3d-model-viewer")}
							value={attributes.maxFieldOfView}
							onChange={(val) => setAttributes({ maxFieldOfView: val })}
						/>

						<TextControl
							label={__("Min Field of view", "ultimate-3d-model-viewer")}
							placeholder={__("Enter minimum field of view (e.g., 25deg)", "ultimate-3d-model-viewer")}
							value={attributes.minFieldOfView}
							onChange={(val) => setAttributes({ minFieldOfView: val })}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("loading", "ultimate-3d-model-viewer")} initialOpen={false}>
						<SelectControl
							label={__("loading strategy", "ultimate-3d-model-viewer")}
							value={attributes.loading}
							options={[
								{ label: "auto", value: "auto" },
								{ label: "lazy", value: "lazy" },
								{ label: "eager", value: "eager" },
							]}
							onChange={(val) => setAttributes({ loading: val })}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("auto rotate", "ultimate-3d-model-viewer")} initialOpen={false}>
						<ToggleControl
							label={__("Auto rotation", "ultimate-3d-model-viewer")}
							checked={attributes.autoRotate}
							onChange={(val) => setAttributes({ autoRotate: val })}
						/>
					</PanelBody>
				</Panel>

				<Panel>
					<PanelBody title={__("augmented reality", "ultimate-3d-model-viewer")} initialOpen={false}>
						<ToggleControl
							label={__("Enable augmented reality", "ultimate-3d-model-viewer")}
							checked={attributes.ar}
							onChange={(val) => setAttributes({ ar: val })}
						/>

						<MediaUploadCheck>
							<MediaUpload
								onSelect={updateMedia("iosSrc")}
								allowedTypes={ALLOWED_MEDIA_TYPES}
								render={({ open }) => (
									<div>
										{attributes.iosSrc && (
											<p>
												<code>{attributes.iosSrc.split("/").pop()}</code>
											</p>
										)}
										<Button onClick={open}>{__("Select a special ios usdz file for the model in ar mode", "ultimate-3d-model-viewer")}</Button>
									</div>
								)}
							/>
						</MediaUploadCheck>
					</PanelBody>
				</Panel>
			</InspectorControls>

			<model-viewer
				class="model-viewer"
				src={attributes.src}
				poster={attributes.poster}
				environment-image={attributes.environment}
				skybox-image={attributes.skybox}
				tone-mapping={attributes.toneMapping}
				exposure={attributes.exposure}
				shadow-intensity={attributes.shadowIntensity}
				shadow-softness={attributes.shadowSoftness}
				camera-orbit={attributes.cameraOrbit}
				max-camera-orbit={attributes.maxCameraOrbit}
				min-camera-orbit={attributes.minCameraOrbit}
				camera-target={attributes.cameraTarget}
				field-of-view={attributes.fieldOfView}
				max-field-of-view={attributes.maxFieldOfView}
				min-field-of-view={attributes.minFieldOfView}
				loading={attributes.loading}
				auto-rotate={attributes.autoRotate}
				ar={attributes.ar}
				touch-action="pan-y"
				ios-src={attributes.iosSrc}
				camera-controls
				autoplay></model-viewer>
		</div>
	);
}
