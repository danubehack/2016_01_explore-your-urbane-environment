// Here go some variables
var map;
var marker;
var locationmarker;
var huntLayer = new L.layerGroup();
var areaLayer = new L.layerGroup();
var speciesLayer = new L.layerGroup();
var locationLayer = new L.layerGroup();

$("#two").on("pageshow", function (event, ui) {
	$("#radius_slider").bind("slidestop", function () {
		console.log('moin');
		$("#radius_value").html($("#radius_slider").val());
	});

	$("#number_slider").bind("slidestop", function () {
		console.log('moin');
		$("#item_value").html($("#number_slider").val());
	});
});

$(document).on("ready", function () {
	var southWest = L.latLng(49.037872, 17.189532),
	northEast = L.latLng(46.372299, 9.530790),
	bounds = L.latLngBounds(southWest, northEast);

	map = L.map('map');

	map.setMaxBounds([[46.35877, 8.782379], [49.037872, 17.189532]]);
	map.options.maxZoom = 17;
	map.options.minZoom = 7;

	var OSM_basemap = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			storage: 'db'
		}).addTo(map);

	var BasemapAT_basemap = L.tileLayer('http://maps{s}.wien.gv.at/basemap/geolandbasemap/normal/google3857/{z}/{y}/{x}.{format}', {
			maxZoom: 19,
			attribution: 'Datenquelle: <a href="www.basemap.at">basemap.at</a>',
			subdomains: ["", "1", "2", "3", "4"],
			format: 'png',
			bounds: [[46.35877, 8.782379], [49.037872, 17.189532]]
		}).addTo(map);

	var BasemapAT_orthofoto = L.tileLayer('http://maps{s}.wien.gv.at/basemap/bmaporthofoto30cm/normal/google3857/{z}/{y}/{x}.{format}', {
			maxZoom: 19,
			attribution: 'Datenquelle: <a href="www.basemap.at">basemap.at</a>',
			subdomains: ["", "1", "2", "3", "4"],
			format: 'jpeg',
			bounds: [[46.35877, 8.782379], [49.037872, 17.189532]]
		});
	var BasemapAT_grau = L.tileLayer('http://maps{s}.wien.gv.at/basemap/bmapgrau/normal/google3857/{z}/{y}/{x}.{format}', {
			maxZoom: 19,
			attribution: 'Datenquelle: <a href="www.basemap.at">basemap.at</a>',
			subdomains: ["", "1", "2", "3", "4"],
			format: 'png',
			bounds: [[46.35877, 8.782379], [49.037872, 17.189532]]
		});

	var wien_naturdenkmal = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'NATDENKMALPKTOGD',
			format: 'image/png',
			transparent: true
		});

	var OEFFGRUENFLOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'OEFFGRUENFLOGD',
			format: 'image/png',
			transparent: true
		});

	var NATURA2TVOGELOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'NATURA2TVOGELOGD',
			format: 'image/png',
			transparent: true
		});

	var NATURA2TOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'NATURA2TOGD',
			format: 'image/png',
			transparent: true
		});

	var NATURSCHUTZGEBOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'NATURSCHUTZGEBOGD',
			format: 'image/png',
			transparent: true
		});

	var PARKANLAGEOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'PARKANLAGEOGD',
			format: 'image/png',
			transparent: true
		});

	var BIOSPHPARKFOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'BIOSPHPARKFOGD',
			format: 'image/png',
			transparent: true
		});

	var LUFTGUETENETZOGD = L.tileLayer.wms("http://data.wien.gv.at/daten/geo", {
			layers: 'LUFTGUETENETZOGD',
			format: 'image/png',
			transparent: true
		});

	// Here goes marker stuff

	// new Icons
	var blueIcon = L.icon({
			iconUrl: 'images/sup_marker.png',
			shadowUrl: 'images/marker_shadow.png',

			iconSize: [40, 40],
			shadowSize: [45, 45],
			iconAnchor: [20, 40],
			shadowAnchor: [20, 43],
			popupAnchor: [0, -50]
		});


	// Bye bye marker
	function onPopupOpen() {
		var tempMarker = this;
		$("#marker-button").click(function () {
			map.removeLayer(tempMarker);
			marker = undefined;

			$("#hidden_btn").style.visibility = "hidden";
		});

	}

	// Layer switcher thingy
	var baseMaps = {
		"OSM": OSM_basemap
	};
	var overlays = {
		"Basemap Austria": BasemapAT_basemap,
		"Basemap Austria Orthophotos": BasemapAT_orthofoto,
		"Basemap Austria Grau": BasemapAT_grau,
		"Naturdenkmal": wien_naturdenkmal,
		"Naturschutzgebiet": NATURSCHUTZGEBOGD,
		"Natura 2000 Schutzgebiet": NATURA2TOGD,
		"Vogelschutzgebiete": NATURA2TVOGELOGD,
		"Parks": PARKANLAGEOGD,
		"Öffentliche Grünflächen": OEFFGRUENFLOGD,
		"Biosphärenpark": BIOSPHPARKFOGD,
		"Luftgütenetz": LUFTGUETENETZOGD
	};

	L.control.layers(baseMaps, overlays).addTo(map);

	L.control.scale().addTo(map);

	map.fitBounds(bounds);

	// Some Click Listeners for the buttons
	$("#home").click(function () {
		$.mobile.changePage($("#home"), "none");

	});

	$("#bar_locate").click(function () {

		function onLocationFound(e) {

			var radius = e.accuracy / 2;
			var locIcon = L.icon({
					iconUrl: 'images/me_marker.png',
					shadowUrl: 'images/marker_shadow.png',

					iconSize: [40, 40],
					shadowSize: [45, 45],
					iconAnchor: [20, 40],
					shadowAnchor: [20, 43],
					popupAnchor: [0, -50]
				});
			if (e.latlng.lng < -180) {
				e.latlng.lng = 360 + e.latlng.lng;
			}
			locationmarker = L.marker(e.latlng, {
					icon: locIcon,
					accuracy: radius
				}).addTo(map)

				L.circle(e.latlng, radius, {
					fillColor: "#ff9081",
					color: "#ff9081",
					weight: 2,
					opacity: 1,
					fillOpacity: 1,
				}).addTo(map);

			map.setView(e.latlng, 17);

			$("#hidden_btn").attr("style", "visibility: visible");
		}

		function onLocationError(e) {
			map.fitBounds(bounds, {
				padding: [0, 0]
			});
			console.log("Android Not Found");
		}
		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);
		map.locate({
			setView: false,
			maxZoom: 16
		});
	});

	$("#btn_speciespicker").click(function () {
		$("#obs_lng").val(marker.getLatLng().lng);
		$("#obs_lat").val(marker.getLatLng().lat);
		$("#obs_lnglat").val(marker.getLatLng().lng + "," + marker.getLatLng().lat);
	});

	$("#radius_slider").on('slidestop', function (event) {
		console.log('moin');
		$("#radius_value").html($("#radius_slider").val());
	});
	$("#number_slider").on('slidestop', function (event) {
		console.log('moin');
		$("#item_value").html($("#number_slider").val());
	});
	$("#get_species_btn").on('click', function (event) {
		loadSpecies($("#select-species").val())
	});
	$("#show_area").on('click', function (event) {
		loadArea();
	});
	$("#generate_hunt").on('click', function (event) {
		generateHunt();
	});
	$("#get_huntFromPin").on('click', function (event) {
		generateFromPin();
	});
	$("#load_hunt").on('click', function (event) {
		loadHunt();
	});
	$("#spot_btn").on('click', function (event) {
		spot();
	});
	$("#upload_btn").on('click', function (event) {
		uploadUserHuntData();
	});
	$("#uploads_btn").on('click', function (event) {
		getToast();
	});
	$("#quit_hunt").on('click', function (event) {
		quitHunt();
	});
	$("#quit_hunt").bind("click", function () {
		quitHunt();
	});

	function generateFromPin() {
		var hunter = $("#hunterpin_name").val();
		var pin = $("#pin_number").val();

		$.ajax({
			type: "POST",
			url: "../ajax/makeFromPin.php",
			data: "pin=" + pin + "&hunter=" + hunter,
			success: function (json) {
				console.log(json);
				if (!json) {
					$('#error_msg').html("Name ist für diesen Pin bereits belegt.")
				} else {
					var info = JSON.parse(json);
					json = JSON.parse(info.hunt_itemstring);
					var markers = [];
					localStorage.setItem("trackdata_hunt", JSON.stringify(info.hunt_pin));
					localStorage.setItem("trackdata_string", JSON.stringify(json));
					localStorage.setItem("trackdata_hunter", JSON.stringify(info.user_name));

					window.location.href = "http://explore.karin.green/index.php?page=hunt";
				}
			}

		});

	}

	function generateHunt() {
		var radius = $("#radius_slider").val();
		var no_items = $("#number_slider").val();
		var hunter = $("#hunter_name").val();
		
		$("#bar_locate").trigger("click");

		$.ajax({
			type: "POST",
			url: "../ajax/makeHunt.php",
			data: "lat=" + locationmarker.getLatLng().lat + "&lng=" + locationmarker.getLatLng().lng + "&radius=" + radius + "&no_items=" + no_items + "&hunter=" + hunter,
			success: function (json) {
				var info = JSON.parse(json);
				json = JSON.parse(info.hunt_itemstring);
				var markers = [];
				localStorage.setItem("trackdata_hunt", JSON.stringify(info.hunt_pin));
				localStorage.setItem("trackdata_string", JSON.stringify(json));
				localStorage.setItem("trackdata_hunter", JSON.stringify(info.user_name));

				window.location.href = "http://explore.karin.green/index.php?page=hunt";
			}

		});

	}

	function quitHunt() {

		localStorage.removeItem("trackdata_hunt");
		localStorage.removeItem("trackdata_string");
		localStorage.removeItem("trackdata_hunter");

		map.eachLayer(function (layer) {
			map.removeLayer(layer);
		});

		window.location.href = "http://explore.karin.green/index.php?page=hunt";

	}

	function spot() {
		$("#bar_locate").trigger("click");
		var markers = [];

		map.removeLayer(huntLayer);
		json = JSON.parse(localStorage.getItem("trackdata_string"));
		var donemaker = true;
		var spotmarker = true;
		// Add markers
		for (var i = 0; i < json.features.length; i++) {
			var ftr = json.features[i];

			if (L.GeometryUtil.distance(map, locationmarker.getLatLng(), [ftr.geometry.coordinates[1], ftr.geometry.coordinates[0]]) < 2 * locationmarker.options.accuracy + 10 || ftr.properties['done'] == true) {
				ftr.properties['done'] = true;
				spotmarker = false;
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
				donemaker = false;
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

		localStorage.setItem("trackdata_string", JSON.stringify(json));

		if (spotmarker) {
			$("#toastfact").html('You are not close enough to your target :-(');
			$("#toast").slideDown("slow", function () {});
			$("#toast").delay(6000).slideUp("slow", function () {});
		}

		if (donemaker) {
			$("#toastfact").html('Congraturlations! You finished your Treasure Hunt!');
			$("#toast").slideDown("slow", function () {});
			$("#toast").delay(6000).slideUp("slow", function () {});
		}

	}

	function uploadUserHuntData() {

		hunt_id = JSON.parse(localStorage.getItem("trackdata_hunt"));
		string = JSON.parse(localStorage.getItem("trackdata_string"));
		hunter = JSON.parse(localStorage.getItem("trackdata_hunter"));

		$.ajax({
			type: "POST",
			url: "../ajax/putHunt.php",
			data: "string=" + string + "&hunt_id=" + hunt_id + "&hunter=" + hunter,
			success: function (data) {
				("#uploadnumber").attr("style", "visibility: hidden");
				$("#uploadnumber").html("0");

			},
			error: function (e) {
				("#uploadnumber").attr("style", "visibility: visible");
				$("#uploadnumber").html("x");
			}

		});
	}

	function loadSpecies(species) {

		map.removeLayer(speciesLayer);

		var maxFeatures = 200;
		var ows = 'https://hash-salt-love.com/geoserver/ows?version=1.1.0&service=WFS&request=GetFeature&TYPENAME=Hash:baumkataster&maxFeatures=' + maxFeatures + '&outputFormat=JSON&CQL_FILTER=scientific=%27' + species + '%27';

		$.ajax({
			type: "POST",
			url: "../ajax/getSpecies.php",
			data: "lat=" + locationmarker.getLatLng().lat + "&lng=" + locationmarker.getLatLng().lng + "&species=" + species,
			success: function (json) {
				json = JSON.parse(json);
				var markers = [];

				// Add markers
				for (var i = 0; i < json.features.length; i++) {
					var ftr = json.features[i];

					// giving them a lovely Marker
					var labelIcon = L.icon({
							iconUrl: 'images/gen_marker.png',
							shadowUrl: 'images/marker_shadow.png',

							iconSize: [40, 40],
							shadowSize: [45, 45],
							iconAnchor: [20, 40],
							shadowAnchor: [20, 43],
							popupAnchor: [0, -50]
						});

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
					var point = L.marker([ftr.geometry.coordinates[1], ftr.geometry.coordinates[0]], options);
					point.bindPopup("<p class=\"pop_p\">Art: " + ftr.properties['name'] + "<br />Standort: " + ftr.properties['strasse'] + "<br />Jahr: " + ftr.properties['jahr'] + "<br />Umfang: " + ftr.properties['name'] + "</p>");
					speciesLayer.addLayer(point);

					markers.push(point);
				}

				speciesLayer.addTo(map);
			}

		});
	}

	function loadArea() {

		map.removeLayer(areaLayer);

		var maxFeatures = 200;

		$.ajax({
			type: "POST",
			url: "../ajax/getArea.php",
			data: "lat=" + locationmarker.getLatLng().lat + "&lng=" + locationmarker.getLatLng().lng,
			success: function (json) {
				json = JSON.parse(json);
				var markers = [];

				for (var i = 0; i < json.features.length; i++) {
					var ftr = json.features[i];

					// giving them a lovely Marker
					var labelIcon = L.icon({
							iconUrl: 'images/gen_marker.png',
							shadowUrl: 'images/marker_shadow.png',

							iconSize: [40, 40],
							shadowSize: [45, 45],
							iconAnchor: [20, 40],
							shadowAnchor: [20, 43],
							popupAnchor: [0, -50]
						});

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
					var point = L.marker([ftr.geometry.coordinates[1], ftr.geometry.coordinates[0]], options);
					point.bindPopup("<p class=\"pop_p\">Art: " + ftr.properties['name'] + "<br />Standort: " + ftr.properties['strasse'] + "<br />Jahr: " + ftr.properties['jahr'] + "<br />Umfang: " + ftr.properties['name'] + "</p>");
					areaLayer.addLayer(point);

					markers.push(point);
				}

				areaLayer.addTo(map);
				console.log(areaLayer);
			},
			beforeSend: function () {}

		});
	}

	// Toast Functions

	function getToast() {

		var set;
		//set = Math.floor((Math.random() * 6) + 1);
		set = 6;
		switch (set) {
		case 1:
			getParks();
			break;
		case 2:
			getProtected();
			break;
		case 3:
			getNatura();
			break;
		case 4:
			getOpenGreen();
			break;
		case 5:
			getBirds();
			break;
		case 6:
			getAir();
			break;
		default:
			getParks();
			break;
		}

	}

	function getParks() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&srsname=EPSG:4326&typenames=ogdwien:PARKANLAGEOGD&outputformat=json&BBOX=' + map.getBounds().getSouthWest().lng + ',' + map.getBounds().getSouthWest().lat + ',' + map.getBounds().getNorthEast().lng + ',' + map.getBounds().getNorthEast().lat + ',EPSG:4326';
		console.log(ows);
		$.get(ows, function (json) {
			console.log(json.totalFeatures > 0);
			if (json.totalFeatures > 0) {
				var toaststring = "There are " + json.totalFeatures + " parks within walking distance of your location";

				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

	function getProtected() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&srsname=EPSG:4326&version=1.1.0&typenames=ogdwien:NATURSCHUTZGEBOGD&outputformat=json';

		$.get(ows, function (json) {
			if (json.totalFeatures > 0) {
				var toaststring = json.totalFeatures + " ... the number of protected sites that are just a short bus ride away.";
				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

	function getNatura() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&srsname=EPSG:4326&typenames=ogdwien:NATURA2TOGD&outputformat=json';

		$.get(ows, function (json) {
			if (json.totalFeatures > 0) {
				var toaststring = "There is no space for nature within a city? Are you sure? There are " + json.totalFeatures + " Natura2000 protected sites within this very city. How cool is that :-)";
				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

	function getOpenGreen() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typenames=ogdwien:PARKANLAGEOGD&outputformat=json&srsname=EPSG:4326&BBOX=' + map.getBounds().getSouthWest().lng + ',' + map.getBounds().getSouthWest().lat + ',' + map.getBounds().getNorthEast().lng + ',' + map.getBounds().getNorthEast().lat + ',EPSG:4326';

		$.get(ows, function (json) {
			if (json.totalFeatures > 0) {
				var toaststring = "How cool are Urban Open Spaces? Very cool. There are " + json.totalFeatures + " in your area right now.";
				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

	function getBirds() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typenames=ogdwien:NATURA2TVOGELOGD&outputformat=json';

		$.get(ows, function (json) {
			if (json.totalFeatures > 0) {
				var toaststring = "We love birds. Did you know that there are  " + json.totalFeatures + " bird sanctuaries in your city?";
				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

	function getAir() {
		var ows = 'http://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typenames=ogdwien:LUFTGUETENETZOGD&outputformat=json';

		$.get(ows, function (json) {
			if (json.totalFeatures > 0) {
				var toaststring = "This city is divided into " + json.totalFeatures + " air quality districts where air quality is measured";
				$("#toastfact").html(toaststring);
				$("#toast").slideDown("slow", function () {});
				$("#toast").delay(4000).slideUp("slow", function () {});
			} else {
				return "";
			}
		});
	}

});
