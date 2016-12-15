<?php 

require_once(dirname(dirname(__DIR__)) . '/classes/hunt/repository.php');
	$huntMgmt = new huntMgmt();
	$species = $huntMgmt->getAllSpecies();
?>
<div data-role="page" id="page_species" class="type-interior" data-theme="a">

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
				<li id="hidden_btn" style="visibility: hidden;"><a href="#two"><img src="images/icons-png/search-white.png" title="Search Settings"></a></li>
					<li><a href="#" id="bar_locate" title="Locate Me"><img src="images/icons-png/icon_find2.png"></a></li>
						<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=home" data-ajax="false"  title="Take Me Home"><img src="images/icons-png/bars-white.png"></a></li>
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
							<p>If you want to find a specific type of tree, select the species and explore examples of that type of tree in your city.</p>
						</div>


						<div data-role="fieldcontain">
							<label for="select-species" class="select">Select Species:</label>
							<select name="select-species" id="select-species">
								<?php
					foreach ($species as &$spec){
                    echo"<option value=\"".$spec->item_scientific."\">".$spec->item_scientific."</option>";
					}
                ?>
							</select>
						</div>

						<div data-role="fieldcontain">
							<p>
								<a href="#" id="get_species_btn" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Load Species Data</a>
							</p>
						</div>

						<div data-role="fieldcontain">
							<p><a href="#page_species" data-direction="reverse" class="ui-btn ui-shadow ui-corner-all ui-btn-b">Back To Map</a></p>
						</div>
					</div>
				</div>