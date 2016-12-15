<div data-role="page" id="page_track" class="type-interior" data-theme="a">

	<script type="text/javascript" charset="utf-8" src="js/leaflet.map.js"></script>

	<div data-role="content">
	</div>
	<div id="toast" class="ui-loader-verbose ui-loader-textonly hide" data-theme="a">
		<span class="ui-icon ui-icon-loading"></span>
		<h3 id="toastfact"></h3>
	</div>
	<div role="main" id="map" class="ui-content-map">

	</div>

	<div data-role="footer">
		<div data-role="navbar">
			<ul>
				<li id="hidden_btn" style="visibility: hidden;" title="Settings"><a href="#two"id="settings_btn" ><img src="images/icons-png/gear-white.png"></a></li>
					<li><a href="#" id="spot_btn" style="visibility: hidden;" title="Spot Target"><img src="images/icons-png/eye-white.png"></a></li>
						<li><a href="#" id="bar_locate" title="Locate Me"><img src="images/icons-png/icon_find2.png"></a></li>
							<li><a href="#" id="uploads_btn" title="Upload Data"><img src="images/icons-png/cloud-white.png"><span style="visibility: hidden;" class="badge" id="uploadnumber">0</span></a></li>
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
								<div id="hunting_form">
									<div data-role="fieldcontain">
										<p>Set the parameters for your scavanger hunt. Choose your activity radius and the number of targets depending on whether you explore your city on foot, by bike or public transport.<br />We will generate a custom pin for your scavanger hunt. You can share the pin with friends an explore your city together or turn it into a competition.</p>
									</div>


									<div data-role="fieldcontain">
										<label for="switch">Generate New Hunt or Load From Pin</label>
										<select name="switch" id="switch" data-role="slider">
											<option value="off">Generate New Hunt</option>
											<option value="on">Load From Pin</option>
										</select>
									</div>
									<div id="load_new">
										<div data-role="fieldcontain">
											<label for="radius_slider">Activity Radius: <span id="radius_value">1</span> km</label>
											<input type="range" name="radius_slider" id="radius_slider" value="1" min="0"  step=".5" max="10"  />
										</div>
										<div data-role="fieldcontain">
											<label for="number_slider">Number of Items: <span id="item_value">7</span></label>
											<input type="range" name="number_slider" id="number_slider" value="7" min="0" max="30"  />
										</div>

										<div data-role="fieldcontain">
											<label for="name">Your Name or Nickname:</label>
											<input type="text" name="name" id="hunter_name" value="" />
										</div>
										<div data-role="fieldcontain" class="hide">
				Your Activity Pin:<span id="hunt_pin"></span>
										</div>
										<div data-role="fieldcontain">
											<p>
												<a href="#" id="generate_hunt" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Generate Scavanger Hunt</a>
											</p>
										</div>
									</div>
									<div id="load_pin" class="hide">
										<div data-role="fieldcontain">
											<label for="pin_number">Activity Pin:</label>
											<input type="number" name="pin_number" id="pin_number" value="" />
										</div>

										<div data-role="fieldcontain">
											<label for="hunterpin_name">Your Name or Nickname:</label>
											<input type="text" name="hunterpin_name" id="hunterpin_name" value="" />
										</div>
										<div data-role="fieldcontain">
											<p id="error_msg"></p>
										</div>
										<div data-role="fieldcontain">
											<p>
												<a href="#" id="get_huntFromPin" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Load From Pin</a>
											</p>
										</div>
									</div>
									<div data-role="fieldcontain">
										<p><a href="#page_track" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b" id="backtoblack">Back To Map</a></p>
									</div>
								</div>
							</div>
				<script>
						$("#toast").slideUp();
						$(document).on("ready", function () {

						$("#bar_locate").trigger("click");

						$('#switch').change(function () {
							if ($('#switch').val() == 'off') {
								$('#load_pin').addClass('hide');
								$('#load_new').removeClass('hide');
							} else {
								$('#load_pin').removeClass('hide');
								$('#load_new').addClass('hide');
							}
						});

						if (!(localStorage.getItem("trackdata_hunt") === null)) {
							console.log("2");
							generateFromStore();
						}

						function generateFromStore() {
							var markers = [];
							json = JSON.parse(localStorage.getItem("trackdata_string"));

							// Add markers
							for (var i = 0; i < json.features.length; i++) {
								var ftr = json.features[i];

								if (ftr.properties['done'] == true) {

									// giving them a lovely Marker
									var labelIcon = L.icon({
											iconUrl: 'images/done_marker.png',
											shadowUrl: 'images/marker_shadow.png',

											iconSize: [40, 40],
											shadowSize: [45, 45],
											iconAnchor: [20, 40],
											shadowAnchor: [20, 43],
											popupAnchor: [0, -50]
										});
								} else {

									// giving them a lovely Marker
									var labelIcon = L.icon({
											iconUrl: 'images/find_marker.png',
											shadowUrl: 'images/marker_shadow.png',

											iconSize: [40, 40],
											shadowSize: [45, 45],
											iconAnchor: [20, 40],
											shadowAnchor: [20, 43],
											popupAnchor: [0, -50]
										});
								}

								var options = {
									pid: ftr.properties.OBJECTID,
									coordLat: ftr.geometry.coordinates[1],
									coordLon: ftr.geometry.coordinates[0],
									type: ftr.properties['ger_name'],
									year: ftr.properties['pflanzja_1'],
									size: ftr.properties['stammumf_1'],
									icon: labelIcon,
									draggable: false
								};
								var point = L.marker([ftr.geometry.coordinates[1], ftr.geometry.coordinates[0]], options)
									point.bindPopup("<p class=\"pop_p\">Art: " + ftr.properties['name'] + "<br />Standort: " + ftr.properties['strasse'] + "<br />Jahr: " + ftr.properties['jahr'] + "<br />Umfang: " + ftr.properties['name'] + "</p>");
								huntLayer.addLayer(point);
								markers.push(point);
							}

							huntLayer.addTo(map);
							$("#bar_locate").trigger("click");
							$("#spot_btn").attr("style", "visibility: visible");

							$('#hunting_form').html('<div data-role="fieldcontain"><br /><h3>Current Hunt</h3><br /><b>Your Pin:</b> ' + localStorage.getItem("trackdata_hunt") + '<br /><br /><b>Your Name:</b> ' + localStorage.getItem("trackdata_hunter").replace("\"", "").replace("\"", "") + '</div><div data-role="fieldcontain"><p><a id="quit_hunt" href="#" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Quit Treasure Hunt</a></p></div><div data-role="fieldcontain"><p><a href="#page_track" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b" id="backtoblack">Back To Map</a></p></div>');

							$("#quit_hunt").bind("click", function () {
								quitHunt();
							});

						}

						function quitHunt() {

							localStorage.removeItem("trackdata_hunt");
							localStorage.removeItem("trackdata_string");
							localStorage.removeItem("trackdata_hunter");

							map.eachLayer(function (layer) {
								map.removeLayer(layer);
							});

							window.location.href = "index.php?page=hunt";

						}

					});

		</script>

</div>