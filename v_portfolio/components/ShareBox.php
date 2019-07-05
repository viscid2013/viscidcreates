<?php session_start(); 

if (isset($_REQUEST['sid'])){
	$sid = $_REQUEST['sid'];
}
if (isset($_REQUEST['loc'])){
	$loc = $_REQUEST['loc'];
}

?>
<!doctype html>
<html>



<body>

<!--<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>-->

	<div class="w3-padding-small">
		<a class="tumblr-share-button" data-color="black" data-notes="none" href="https://embed.tumblr.com/share"></a> <script>!function(d,s,id){var js,ajs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://assets.tumblr.com/share-button.js";ajs.parentNode.insertBefore(js,ajs);}}(document, "script", "tumblr-js");</script>
	</div>
	<div class="w3-padding-small">
		<iframe id="fb_iframe" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.facebook.com%2Fbeamcreate%2F&layout=button&size=small&width=59&height=20&appId" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>
	<div class="w3-padding-small" id="pinit">
		<a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=http%3A%2F%2F192.168.2.9%2Fv_portfolio%2Fpages%2Fvc_home.php%3FimgOpen%3D8&media=http%3A%2F%2F192.168.2.9%2Fv_portfolio%2Fimages%2Fcuteninjas.png&description=Pin%20it!"></a>
	</div>
	
	<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>