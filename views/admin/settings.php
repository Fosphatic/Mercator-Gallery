<?php $view->script( 'settings', 'mercator/gallery:app/bundle/settings.js', [ 'vue' ] ); ?>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
	<div class="uk-grid pk-grid-large" data-uk-grid-margin>
		<div class="pk-width-sidebar">
			<div class="uk-panel">
				<ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
					<li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'Settings' | trans }}</a></li>
				</ul>
			</div>
		</div>
		<div class="pk-width-content">
			<ul id="tab-content" class="uk-switcher uk-margin">
				<li>
					<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
						<div data-uk-margin>
							<h2 class="uk-margin-remove">{{ 'General Settings' | trans }}</h2>
						</div>
						<div data-uk-margin>
							<button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}
							</button>
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-caching" class="uk-form-label">{{ 'Enable Cache Control' | trans }}</label>
						<div class="uk-form-controls uk-form-controls-text">
							<input id="form-caching" type="checkbox" v-model="config.caching">
						</div>
					</div>
				</li>
			</ul>
		</div>



			<div id="info" class="uk-form uk-form-horizontal" v-cloak>
				<div class="uk-grid pk-grid-large" data-uk-grid-margin>
					<div class="pk-width-sidebar">
						<div class="uk-panel">
							<ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#info-content' }">
								<li><a><i class="pk-icon-large-code uk-margin-right"></i> {{ 'Info' | trans }}</a></li>
							</ul>
						</div>
					</div>
					<div class="pk-width-content">
						<ul id="info-content" class="uk-switcher uk-margin">
							<li>
								<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
									<div data-uk-margin>
										<h2 class="uk-margin-remove">{{ 'General Information' | trans }}</h2>
									</div>

								</div>
								<div class="uk-form-row">
									<label for="form-usage" class="uk-form-label">{{ 'Usage Information:' | trans }}</label>
									<div class="uk-form-controls uk-form-controls-text">
										<ul>
											<li>Create a directory with the name "Images" within your storage folder</li><br />
											<li>For each slideshow you want to produce, create a subdirectory within your Images folder.<br /> Example: <b>show1</b></li><br />
											<li>To include a preview of your images onto your page, simply use the following widget code: <b>(mercator_gallery){"dir":"show1"}</b></li><br />
											<li>The script will automatically produce a preview of the images.</li>
										</ul>
									</div>
								</div>
								<div class="uk-form-row">
									<label for="form-options" class="uk-form-label">{{ 'Advanced Options:' | trans }}</label>
									<div class="uk-form-controls uk-form-controls-text">
										Adding advanced options is easy (add them seprated with commata in your widget code)<br /> Example: <b>(mercator_gallery){"dir":"show1","fullscreen":"false"}</b>
										<p>
									  Following Advanced Options are available:
										</p>
										<ul>
											<li><b>"mode":"carousel"</b>	---	Do not show thumbnails but produce a Carousel (see Blueimp Gallery)</li>
											<li><b>"duration":"300"</b>	---	Change the duration (in ms) each image is shown, e.g., 300ms.</li>
											<li><b>"fullscreen":"false"</b>	--- When clicking on thumbs, a slideshow will start. By default it starts fullscreen. When set to false, the show will run in the current window.</li>
											<li><b>"postion":"uk-width-1-2 uk-container-center"</b> --- When using a carousel, you can use and UIKit width statement to determine the and positioning of the carousel. If not specified, it is uk-width-1-2 uk-container-center</li>
										</ul>
									</div>
								</div>

							</li>
						</ul>
					</div>
				</div>
			</div>



	</div>



</div>
