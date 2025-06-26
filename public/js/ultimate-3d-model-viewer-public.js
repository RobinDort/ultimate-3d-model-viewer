(function ($) {
	"use strict";

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(window).on("load", function () {
		self.ModelViewerElement = self.ModelViewerElement || {};

		$(".model-viewer").each(function () {
			const $modelViewer = $(this);
			const $progressText = $modelViewer.siblings(".progress-text");

			$modelViewer.on("progress", function (event) {
				const progress = Math.round(event.originalEvent.detail.totalProgress * 100);
				$progressText.text(`Loading ${progress}%`).show();

				if (progress === 100) {
					$progressText.hide();
				}
			});

			$modelViewer.on("progress", onMVWProgess);
		});
	});

	const onMVWProgess = function (event) {
		const $progressBar = $(event.target).find(".progress-bar");
		const $updatingBar = $(event.target).find(".update-bar");

		$updatingBar.css("width", event.originalEvent.detail.totalProgress * 100 + "%");

		if (event.originalEvent.detail.totalProgress === 1) {
			$progressBar.addClass("hide");
			$(event.target).off("progress", onMVWProgess);
		} else {
			$progressBar.removeClass("hide");
		}
	};
})(jQuery);
