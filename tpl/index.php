<!DOCTYPE HTML>
<html lang="de">
	<head>
		<meta content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
		<meta name="msapplication-tap-highlight" content="no" />
		<link rel="icon" href="favicon.ico">
			<meta property="og:title" content="explore your urban environment" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="http://127.0.0.1" />
			<meta property="og:image" content="http://127.0.0.1/eyoe.png" />
			<meta property="og:image:secure_url" content="http://127.0.0.1/eyoe.png" />
			<meta property="og:image:type" content="image/png" />
			<meta property="og:image:width" content="400" />
			<meta property="og:image:height" content="400" />
			<meta property="og:description" content="explore your urban environment: a scavanger hunt for cities" />
			<meta property="og:site_name" content="explore your urban environment"/>
			<meta property="article:author" content="Karin Wannemacher" />
			<meta property="article:publisher" content="Karin Wannemacher" />
			<meta property="og:locale" content="en_UK" />

			<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
				<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
					<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
						<link rel="manifest" href="/manifest.json">
							<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3f8e0c">
								<meta name="theme-color" content="#ffffff">




									<title>explore your urban environment</title>

									<link rel="stylesheet" href="css/wp/jquery.mobile.wp.theme.css"/>

									<!--[if lte IE 9]>
    <link href="css/jquery.mobile.fixedToolbar.polyfill.css" rel="stylesheet" type="text/css" />
    <![endif]-->
									<link href="css/progress-bar.css" rel="stylesheet" type="text/css" />
									<link href="css/app-bar.css" rel="stylesheet" type="text/css" />
									<link href="css/toggle-button.css" rel="stylesheet" type="text/css" />
									<link href="css/mobiscroll-1.5.3.css" rel="stylesheet" type="text/css" />
									<link rel="stylesheet" href="css/leaflet.css"/>

									<style type="text/css">
        /* custom icons for toggle button*/
        .ui-icon-demo-help,
        .ui-icon-demo-set {
            background-repeat: no-repeat;
            background-position: 50% 50% ;
            background-size: 30px 30px;
        }

        .ui-toggle-checked .ui-icon-demo-help{
            background-image: url(images/help.light.png);
        }

        .ui-toggle-unchecked .ui-icon-demo-help{
            background-image: url(images/help.dark.png);
        }

        .ui-toggle-checked .ui-icon-demo-set{
            background-image: url(images/set.light.png);
        }

        .ui-toggle-unchecked .ui-icon-demo-set{
            background-image: url(images/set.dark.png);
        }

        .ui-icon-demo-help,
        .ui-icon-demo-set {
            background-repeat: no-repeat;
            background-position: 50% 50% ;
            background-size: 30px 30px;
        }

        .ui-btn-up-a .ui-icon-demo-help,
        .ui-btn-hover-a .ui-icon-demo-help,
        .ui-btn-down-b .ui-icon-demo-help{
            background-image: url(images/help.dark.png);
        }

        .ui-btn-up-b .ui-icon-demo-help,
        .ui-btn-hover-b .ui-icon-demo-help,
        .ui-btn-down-a .ui-icon-demo-help{
            background-image: url(images/help.light.png);
        }

        .ui-btn-up-a .ui-icon-demo-set,
        .ui-btn-hover-a .ui-icon-demo-set,
        .ui-btn-down-b .ui-icon-demo-set{
            background-image: url(images/set.dark.png);
        }

        .ui-btn-up-b .ui-icon-demo-set,
        .ui-btn-hover-b .ui-icon-demo-set,
        .ui-btn-down-a .ui-icon-demo-set{
            background-image: url(images/set.light.png);
        }

        @media screen and (orientation: portrait) {
            @-ms-viewport {
                width: 320px;
            }
        }

        @media screen and (orientation: landscape) {
            @-ms-viewport {
                width: 480px;
            }
        }

		.main-logo{
			width: 80%;
			max-width: 560px;
			padding-bottom: 40px;
		}
		.pic_inline{
			display: inline-block;
		}

		.hide{
			display:none;  
		}

		#map {
			height: 100%;
		}
		.ui-content-map {
			padding: 0;
			position: fixed !important;
			top : 45px !important; 
			right : 0px;
			bottom : 50px !important; 
			left : 0px !important; 
		}

		.pop_p{
		  color: #000000;	
		}

		#toast{
			background-color: #191C1F;
			position: relative;
			z-index:1000000;}

		.badge {
		  position: absolute;
		  margin-right: 44%;
		  top: 6px;
		  right: 2px;
		  display: inline-block;
		  min-width: 20px;
		  max-width: 90%;
		  height: 20px;
		  padding: 0 3px;
		  background-color: #ff0000;
		  border-radius: 20px;
		  font-size: 12px;
		  line-height: 19px;
		  font-weight: bold;
		  color: #ffffff;
		  text-overflow: ellipsis;
		  text-align: center;
		  text-shadow: 0 -1px 0 rgba(64,0,0,0.6);
		  z-index: 1000;
		}
	</style>

	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.mobile.js" type="text/javascript"></script>
	<script src="css/wp/jquery.mobile.wp.theme.init.js" type="text/javascript"></script>
	<script src="js/jquery.mobile.themeswitcher.js" type="text/javascript"></script>
	<!--[if lte IE 9]>
		<script src="js/jquery.mobile.fixedToolbar.polyfill.js" type="text/javascript"></script>
	<![endif]-->
	<script src="js/app-bar.js" type="text/javascript"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="js/mobiscroll-1.5.3.js" type="text/javascript"></script>

	<script src="js/cordova-2.5.0.js" type="text/javascript"></script>
	<script src="js/phoneTheme.js" type="text/javascript"></script>
	<script src="js/jquery.cordova.wp.themeswitcher.js" type="text/javascript"></script>
	<script src="js/dateTimePicker.js" type="text/javascript"></script>
	<script src="js/leaflet.js" type="text/javascript"></script>
	<script src="js/leaflet.geometryutil.js" type="text/javascript"></script>

	<script type="text/javascript">
        $.mobile.pushStateEnabled = false;
        var absoluteUrl = window.location.href;
        $.themesDir = absoluteUrl.substring(0, absoluteUrl.lastIndexOf('/')) + '/css/';

        $(document).bind('pagebeforeshow', function(){
            $("a[rel='external']").bind('click', function(event){
                window.open(event.target.href, '_system', 'location=yes');
                return false;
            });
        })

        $().ready( function() {
            if ((typeof window.external.Notify == "undefined") || !$.browser.msie || parseInt($.browser.version) < 10) {
                $("#noteWP8Required").show();
            }

            // special title when run in Cordova environment
            if (typeof window.external.Notify !== "undefined") {
                document.getElementById("appTitle").innerHTML = "Theme overview";
            }

            $("[data-role=header]").fixedtoolbar({ hideDuringFocus: "" });
        });
											</script>
										</head>
										<body>


											<?php require __DIR__."/pages/".$template["content_path"];?>
											<!-- Start of StatCounter Code for Default Guide -->
												<script type="text/javascript">
												var sc_project=9848626; 
												var sc_invisible=1; 
												var sc_security="47995918"; 
												var scJsHost = (("https:" == document.location.protocol) ?
												"https://secure." : "http://www.");
												document.write("<sc"+"ript type='text/javascript' src='" +
												scJsHost+
												"statcounter.com/counter/counter.js'></"+"script>");
												</script>
												<noscript><div class="statcounter"><a title="shopify stats"
												href="http://statcounter.com/shopify/" target="_blank"><img
												class="statcounter"
												src="//c.statcounter.com/9848626/0/47995918/1/" alt="shopify
												stats"></a></div></noscript>
												<!-- End of StatCounter Code for Default Guide -->
										</body>
									</html>