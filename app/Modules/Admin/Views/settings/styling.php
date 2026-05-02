<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('styling') ?>
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<link
	href="<?= base_url('assets/css-gradient-generator/src/css-gradient-generator.css') ?>"
	rel="stylesheet" type="text/css" media="all">
<link
	href="<?= base_url('assets/css-gradient-generator/resources/icomoon/sprites.css') ?>"
	rel="stylesheet" type="text/css">
<link
	href="<?= base_url('assets/css-gradient-generator/resources/bootstrap-colorpickersliders/bootstrap.colorpickersliders.css') ?>"
	rel="stylesheet" type="text/css" media="all">
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1>
		<img src="<?= base_url('assets/imgs/pages-styling.png') ?>"
			class="header-img align-middle mr-2" style="margin-top: -3px;">
		<?= lang('styling') ?>
	</h1>
	<hr>
	<div class="alert alert-info">
		<strong>Follow the steps:</strong><br>
		<ol class="mb-2">
			<li>Generate the color you want</li>
			<li>Click <strong>GET CSS</strong></li>
			<li>Paste it in the <strong>NEW STYLE</strong> field at bottom of
				page and click <strong>SAVE</strong></li>
		</ol>
		<strong>Leave it empty for default style</strong>
	</div>
	<div class="container" id="styling-page">
		<div class="css-gradient-editor-container layout-init clearfix">
			<div class="row toolbar">
				<div class="col-md-12 text-right">
					<div class="btn-group btn-group-sm">
						<a href="#"
							class="btn btn-outline-secondary css-gradient-editor-configuration"
							data-toggle="modal" data-target="#configmodal"> <span
							class="pngicon-wrench"></span> Config
						</a> <a href=""
							class="btn btn-outline-secondary css-gradient-editor-permalink">
							<span class="pngicon-share"></span> Share permalink
						</a> <a href="#"
							class="btn btn-outline-secondary css-gradient-editor-qrcode"
							title="Gradient permalink QR code" data-toggle="modal"
							data-target="#qrmodal"> <span class="pngicon-qrcode"></span> QR
							Code
						</a> <a target="_blank"
							href="<?= base_url('assets/css-gradient-generator/gradient.php') ?>"
							class="btn btn-outline-secondary css-gradient-editor-imagegradient mr-2">
							<span class="pngicon-picture"></span> Get PNG
						</a>
						<button type="button"
							class="btn btn-primary css-gradient-editor-getcss"
							data-toggle="modal" data-target="#cssoutmodal"
							style="margin-right: 10px">
							<span class="pngicon-file-css"></span> Get CSS
						</button>
						<button type="button"
							class="btn btn-outline-secondary css-gradient-editor-undo">
							<span class="pngicon-undo"></span> Undo
						</button>
						<button type="button"
							class="btn btn-outline-secondary css-gradient-editor-redo">
							<span class="pngicon-redo"></span> Redo
						</button>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Presets -->
				<div class="col-md-6">
					<div class="card css-gradient-editor-swatches-wrapper">
						<div
							class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Presets</h5>
							<div class="btn-group">
								<button type="button"
									class="btn btn-outline-secondary btn-sm css-gradient-editor-export"
									title="Export all gradients" data-toggle="modal"
									data-target="#exportallmodal">
									<span class="pngicon-arrow-up2"></span> Export all
								</button>
								<button type="button"
									class="btn btn-outline-secondary btn-sm css-gradient-editor-import"
									title="Import gradients" data-toggle="modal"
									data-target="#importmodal">
									<span class="pngicon-arrow-down2"></span> Import
								</button>
								<div
									class="css-gradient-editor-preset current btn btn-outline-secondary btn-sm">
									<span></span>
								</div>
								<button type="button"
									class="btn btn-primary btn-sm css-gradient-editor-save"
									title="Add gradient to swatches">
									<span class="pngicon-disk"></span> Save
								</button>
								<button type="button"
									class="btn btn-danger btn-sm css-gradient-editor-delete"
									title="Remove gradient from swatches">
									<span class="pngicon-remove"></span> Delete
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="content css-gradient-editor-swatches">
								<ul class="list-unstyled d-flex flex-wrap"></ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Preview -->
				<div class="col-md-6">
					<div class="card css-gradient-editor-preview-panel">
						<div
							class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Preview</h5>
							<div class="btn-group">
								<button type="button"
									class="btn btn-primary btn-sm css-gradient-editor-adjustcolor">
									<span class="pngicon-settings"></span> Adjust color
								</button>
								<button type="button"
									class="btn btn-primary btn-sm css-gradient-editor-previewpopout">
									<span class="pngicon-popup"></span> Pop out
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="css-gradient-editor-preview-container">
								<div class="css-gradient-editor-preview">
									<div class="ajax-loader">
										<span class="css-gradient-editor-preview-resize-handler"></span>
									</div>
									<span class="css-gradient-controls">
										<button type="button"
											class="btn btn-primary btn-sm css-gradient-editor-previewpopout">
											<span class="pngicon-collapse"></span>
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="card gradient-properties">
				<div
					class="card-header d-flex justify-content-between align-items-center">
					<h5 class="mb-0">Gradient properties</h5>
					<div class="btn-group">
						<a href="#"
							class="btn btn-primary btn-sm css-gradient-editor-layout-easy"
							title="IE6+, Android 2.3+, iOS 3.2+ CSS, filter, old webkit linear gradients">Simple</a>
						<a href="#"
							class="btn btn-primary btn-sm css-gradient-editor-layout-advanced"
							title="IE9+, Android 3.0+, iOS 3.2+, WP7.5+ CSS, SVG dynamic radial gradients">Advanced</a>
						<a href="#"
							class="btn btn-primary btn-sm css-gradient-editor-layout-expert"
							title="IE10+, Android 4.0+, iOS 5.0+ Only for browsers with CSS3 support experimental">Expert</a>
					</div>
				</div>

				<div class="card-body p-0">
					<div class="layout-warning-box p-2">
						<div class="alert alert-warning layout-warning-advanced mb-2">
							Current gradient needs advanced features so the desired layout is
							overwritten! ... <a href="#" class="force-layout-change">Force
								change</a>
						</div>
						<div class="alert alert-warning layout-warning-expert mb-0">
							Current gradient needs expert features so the desired layout is
							overwritten! ... <a href="#" class="force-layout-change">Force
								change</a>
						</div>
					</div>

					<!-- Easy Preferences -->
					<div class="row gradient-preferences-easy p-3">
						<div class="col-sm-5 col-12 mb-2 mb-sm-0">
							<input class="form-control" name="color_from">
						</div>

						<div class="col-sm-2 col-12 text-center mb-2 mb-sm-0">
							<div class="css-gradient-editor-linear-direction-implicit">
								<div class="btn-group-vertical d-flex">
									<button
										class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
										data-control-group="linear-direction"
										data-name="gradient_direction" data-value="top">
										<span class="pngicon-arrow-up"></span>
									</button>
									<div class="d-flex justify-content-between mt-1 mb-1">
										<button
											class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
											data-control-group="linear-direction"
											data-name="gradient_direction" data-value="left">
											<span class="pngicon-arrow-left"></span>
										</button>
										<button
											class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
											data-control-group="linear-direction"
											data-name="gradient_direction" data-value="right">
											<span class="pngicon-arrow-right"></span>
										</button>
									</div>
									<button
										class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
										data-control-group="linear-direction"
										data-name="gradient_direction" data-value="bottom">
										<span class="pngicon-arrow-down"></span>
									</button>
								</div>
							</div>
						</div>

						<div class="col-sm-5 col-12">
							<input class="form-control" name="color_to">
						</div>
					</div>

					<!-- Advanced Preferences -->
					<div class="row gradient-preferences-advanced p-3">
						<div class="col-md-6">
							<div class="css-gradient-editor-preferences">

								<div class="form-group row">
									<label class="col-3 col-form-label">Repeating:</label>
									<div class="col-9">
										<div class="btn-group">
											<button
												class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
												data-control-group="repeat" data-name="gradient_repeat"
												data-value="on">repeat</button>
											<button
												class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
												data-control-group="repeat" data-name="gradient_repeat"
												data-value="off">no repeat</button>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-3 col-form-label">Gradient type:</label>
									<div class="col-9">
										<div class="btn-group">
											<button
												class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
												data-control-group="gradient_type" data-name="gradient_type"
												data-value="linear">linear</button>
											<button
												class="btn btn-outline-secondary btn-sm css-gradient-editor-controller"
												data-control-group="gradient_type" data-name="gradient_type"
												data-value="radial">radial</button>
										</div>
									</div>
								</div>

								<!-- (keep same structure for linear & radial preferences, just replace .form-horizontal/.controls with Bootstrap 4 form-group + row + form-control + btn-group) -->

							</div>
						</div>

						<div class="col-md-6">
							<div class="css-gradient-editor-colorstops-easy mb-3">
								<div class="css-gradient-editor-stopeditor">
									<span></span>
									<div class="css-gradient-editor-stoppointmarkers"></div>
								</div>
							</div>

							<div class="css-gradient-editor-colorstops-advanced clearfix">
								<div class="css-gradient-editor-stoppointlist mb-2"></div>
								<button type="button"
									class="btn btn-outline-secondary btn-sm mr-2 css-gradient-editor-reorder-stoppoints">
									<span class="pngicon-random"></span> Update order
								</button>
								<button type="button"
									class="btn btn-primary btn-sm css-gradient-editor-add-stoppoint">
									<span class="pngicon-plus"></span> Add stop point
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- CSS Output Modal -->
			<div class="modal fade" id="cssoutmodal" tabindex="-1" role="dialog"
				aria-labelledby="cssModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="cssModalLabel">Generated CSS</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="css-gradient-editor-cssoutput-container">
								<textarea class="css-gradient-editor-cssoutput form-control"
									rows="10"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- QR Modal -->
			<div class="modal fade" id="qrmodal" tabindex="-1" role="dialog"
				aria-labelledby="permalinkModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">
								Gradient permalink <small class="text-muted">Test the current
									gradient in your mobile browser</small>
							</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-center">
							<div id="permalinkqr"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Export Modal -->
			<div class="modal fade" id="exportallmodal" tabindex="-1"
				role="dialog" aria-labelledby="exportAllModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">
								Export presets <small class="text-muted">save the content to a
									file</small>
							</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<textarea
								class="css-gradient-editor-textarea-exportall form-control"
								readonly></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Import Modal -->
			<div class="modal fade" id="importmodal" tabindex="-1" role="dialog"
				aria-labelledby="importModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">
								Import presets <small class="text-muted">paste the previously
									saved data into the textarea</small>
							</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<textarea
								class="css-gradient-editor-textarea-import form-control"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-link loaddefaults">Load
								defaults</button>
							<button type="button" class="btn btn-primary"
								data-dismiss="modal">Import</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Config Modal -->
			<div class="modal fade" id="configmodal" tabindex="-1" role="dialog"
				aria-labelledby="configModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Configuration</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">CSS selector:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"
											data-name="config_cssselector" name="config-cssselector"
											placeholder=".gradient">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Color format:</label>
									<div class="col-sm-9 btn-group" role="group">
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-control-group="config_colorformat"
											data-name="config_colorformat" data-value="rgb">rgb</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-control-group="config_colorformat"
											data-name="config_colorformat" data-value="hsl">hsl</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-control-group="config_colorformat"
											data-name="config_colorformat" data-value="hex">hex</button>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Color picker
										visible sliders:</label>
									<div class="col-sm-9 btn-group" role="group">
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_colorpicker_hsl">hsl</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_colorpicker_rgb">rgb</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_colorpicker_cie">cie</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_colorpicker_opacity">opacity</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_colorpicker_swatches">color swatches</button>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Mixed stop
										point units:</label>
									<div class="col-sm-9 btn-group" role="group">
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-control-group="config_mixedstoppointunits"
											data-name="config_mixedstoppointunits" data-value="enabled">enabled</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-control-group="config_mixedstoppointunits"
											data-name="config_mixedstoppointunits" data-value="disabled">disabled</button>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Code
										generation:</label>
									<div class="col-sm-9 btn-group" role="group">
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_bgcolor">bg color</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_iefilter">IE filter</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_svg">SVG</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_oldwebkit">old webkit</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_webkit">newer webkit</button>
										<button type="button"
											class="btn btn-secondary btn-sm css-gradient-editor-controller"
											data-name="config_generation_ms">-ms</button>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Fallback
										width:</label>
									<div class="col-sm-4">
										<div class="input-group">
											<input type="text" class="form-control"
												data-name="config_fallbackwidth" name="config-fallbackwidth">
											<div class="input-group-append">
												<span class="input-group-text">px</span>
											</div>
										</div>
										<small class="form-text text-muted">Used in some circumstances
											with old webkit and SVG generation. Using preview size if not
											specified.</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label text-right">Fallback
										height:</label>
									<div class="col-sm-4">
										<div class="input-group">
											<input type="text" class="form-control"
												data-name="config_fallbackheight"
												name="config-fallbackheight">
											<div class="input-group-append">
												<span class="input-group-text">px</span>
											</div>
										</div>
										<small class="form-text text-muted">Used in some circumstances
											with old webkit and SVG generation. Using preview size if not
											specified.</small>
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>



	<div class="container">
		<form method="POST" action="">
			<div class="form-group">
				<label for="new-style">Paste new style:</label>
				<textarea class="form-control" name="newStyle" rows="15"
					id="new-style" placeholder="Leave empty to load default styles"><?= $newStyle ?></textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Save</button>
			<a href="javascript:void(0)"
				class="btn btn-lg btn-outline-secondary clear-style">Clear Styles</a>
		</form>
	</div>

	<div id="coloroffsethtml" style="display: none;">
		<div class="coloroffset-container">
			<div class="offset-hue slider-container">
				<div class="slider-inner">
					<span class="slider-controller"></span>
				</div>
			</div>
			<div class="offset-chroma slider-container">
				<div class="slider-inner">
					<span class="slider-controller"></span>
				</div>
			</div>
			<div class="offset-lightness slider-container">
				<div class="slider-inner">
					<span class="slider-controller"></span>
				</div>
			</div>
		</div>
	</div>


	<script
		src="<?= base_url('assets/css-gradient-generator/resources/bootstrap-touchspin/bootstrap.touchspin.js') ?>"></script>
	<script
		src="<?= base_url('assets/css-gradient-generator/resources/tinycolor/tinycolor.js') ?>"></script>
	<script
		src="<?= base_url('assets/css-gradient-generator/resources/bootstrap-colorpickersliders/bootstrap.colorpickersliders.js') ?>"></script>
	<script
		src="<?= base_url('assets/css-gradient-generator/src/css-gradient-generator.js') ?>"></script>
	<script
		src="<?= base_url('assets/css-gradient-generator/resources/jquery.base64/jquery.base64.min.js') ?>"></script>
	<script
		src="<?= base_url('assets/css-gradient-generator/resources/qrcode/qrcode.min.js') ?>"></script>
	<script>
    var ge = new CSSGradientEditor($('.css-gradient-editor-container'));
    function increase_brightness(hex, percent) {
        hex = hex.replace(/^\s*#|\s*$/g, '');
        if (hex.length == 3) {
            hex = hex.replace(/(.)/g, '$1$1');
        }
        var r = parseInt(hex.substr(0, 2), 16),
                g = parseInt(hex.substr(2, 2), 16),
                b = parseInt(hex.substr(4, 2), 16);
        return '#' +
                ((0 | (1 << 8) + r + (256 - r) * percent / 100).toString(16)).substr(1) +
                ((0 | (1 << 8) + g + (256 - g) * percent / 100).toString(16)).substr(1) +
                ((0 | (1 << 8) + b + (256 - b) * percent / 100).toString(16)).substr(1);
    }
    $(document).ready(function () {
        $('button, a').tooltip();
        $('.clear-style').click(function(){
            $('#new-style').val('');
        });
    });
</script>
</div>
<?= $this->endSection() ?>