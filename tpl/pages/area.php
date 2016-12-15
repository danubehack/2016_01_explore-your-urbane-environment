
<div data-role="page" id="page_track" class="type-interior" data-theme="a">

	<script type="text/javascript" charset="utf-8" src="js/leaflet.map.js"></script>

	<div data-role="content">
		<div role="main" id="map" class="ui-content-map">
		</div>

		<div data-role="panel" id="mypanel"><br /><br />
			<a href="#" data-role="button" data-inline="true" data-rel="close">close panel</a>
		</div>		
		<div data-role="panel" id="mypanel2"><br /><br />
			<a href="#" data-role="button" data-inline="true" data-rel="close">close panel</a>
		</div>
	</div>
	<div data-role="footer">
		<div data-role="navbar">
			<ul>
				<li><a href="#" id="bar_locate"><img src="images/icons-png/icon_find2.png"></a></li>
					<li id="hidden_btn" style="visibility: hidden;"><a href="#" id="show_area" title="Locate Me"><img src="images/icons-png/search-white.png"></a></li>
						<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=home" data-ajax="false" title="Take Me Home"><img src="images/icons-png/bars-white.png"></a></li>
							</ul>
						</div>
					</div>
				</div>


				<div data-role="page" id="two" data-theme="a">

					<div data-role="header">
						<h1>Activity Settings</h1>
					</div>

					<div role="main" class="ui-content">
						<div data-role="fieldcontain">
							<p>Set the parameters for your scavanger hunt. Choose your activity radius and the number of targets depending on whether you explore your city on foot, by bike or public transport.<br />We will generate a custom pin for your scavanger hunt. You can share the pin with friends an explore your city together or turn it into a competition.</p>
						</div>


						<div data-role="fieldcontain">
							<label for="radius_slider">Activity Radius: <span id="radius_value">1</span> km</label>
							<input type="range" name="radius_slider" id="radius_slider" value="1" min="0"  step=".5" max="10"  />
						</div>
						<div data-role="fieldcontain">
							<label for="number_slider">Number of Items: <span id="item_value">7</span></label>
							<input type="range" name="number_slider" id="number_slider" value="7" min="0" max="30"  />
						</div>

						<div data-role="fieldcontain">
							<label for="name">Your Activity Pin:</label>
							<input type="text" name="name" id="name" value="" />
						</div>
						<div data-role="fieldcontain">
							<p>
								<a href="#" id="generate_hunt" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Generate Scavanger Hunt</a>
							</p>
						</div>
						<div data-role="fieldcontain">
							<p>Start your hunt from with a pin.</p>
							<label for="name">Activity Pin:</label>
							<input type="text" name="name" id="name" value="" />
						</div>
						<div data-role="fieldcontain">
							<p>
								<a href="#" id="get_hunt" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Load From Pin</a>
							</p>
						</div>

						<div data-role="fieldcontain">
							<p><a href="#page_track" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Back To Map</a></p>
						</div>
					</div>

				</div>