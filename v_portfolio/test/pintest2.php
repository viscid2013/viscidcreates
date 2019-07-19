<!doctype html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	
<meta property="og:url"                content="http://beamcreates.com/v_portfolio/pages/vc_home.php" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="Viscid Creates" />
<meta property="og:description"        content="Arts and such" />
<meta property="og:image"              content="http://beamcreates.com/v_portfolio/branding_icons/vc_logoSymbol_PNG.png" />
	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../styles/vstyle_W3.css">
	<link rel="stylesheet" href="../styles/vc_accordion.css">
	<link rel="stylesheet" href="../styles/vc_core/style.css">
<link href="https://fonts.googleapis.com/css?family=Assistant:200,400" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1 {font-family: 'Assistant', sans-serif}
img {margin-bottom: -7px}
.w3-row-padding img {margin-bottom: 12px}
</style>
<title>Test Pin Page</title>
</head>

<body>
	
<a href="https://api.pinterest.com/v1/pins/?image_url=http://beamcreates.com/v_portfolio/branding_icons/vc_logoSymbol_PNG.png&note=VC_Logo&link=http://beamcreates.com/v_portfolio/pages/vc_home.php">PIN IT DAMMIT!</a>
	
<a onclick="doPin( 'http://beamcreates.com/v_portfolio/branding_icons/vc_logoSymbol_PNG.png', 'VC_logo', 'http://beamcreates.com/v_portfolio/pages/vc_home.php' )">PIN IT DAMMIT!</a>
	
	
<script>
           window.pAsyncInit = function() {
               PDK.init({
                   appId: "5042655058903215727", // Change this
                   cookie: true
               });
               var acc = "";
               PDK.login({ scope : 'read_relationships,write_relationships, read_public , write_public' }, function(response){
                   if (!response || response.error) {
                   } else {
                       var pins = [];
                       var fianlData = {};
                       fianlData.data = {};
                       fianlData.access_token = response.session.accessToken;
                      // fianlData.data.board = "behzadkhodapanah/ninja2";
                       fianlData.data.note = "VC_Logo";
                       fianlData.data.link = "http://beamcreates.com/v_portfolio/pages/vc_home.php";
                       fianlData.data.image_url = "http://beamcreates.com/v_portfolio/branding_icons/vc_logoSymbol_PNG.png";
                       console.log("FD : ",fianlData.data);
                       PDK.request('v1/pins/?fields=link%2Cnote%2Curl',fianlData, function (response) {
                           if (!response || response.error) {
                           } else {
                               console.log("JSON : ",JSON.stringify(response));
                               PDK.logout();
                           }
                       });
                   }
               })


           };
           // }
            (function(d, s, id){
                var js, pjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "sdk.js";
                pjs.parentNode.insertBefore(js, pjs);
           }(document, 'script', 'pinterest-jssdk'));
        </script>
</body>
</html>