<!--
<html>
<header>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=469393603449701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</header>

<body>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>

</body>
</html>

https://developers.facebook.com/tools/explorer?method=GET&path=me%3Ffields%3Dpicture&version=v2.10

-->
<!DOCTYPE html>
<html>
<head>
<title>Ingresar usando Facebook</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta charset="UTF-8">
</head>
<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
      
      document.getElementById('btnFacebook').style.display='none';
      document.getElementById('btnSalir').style.display='block';
      
    } else {
      // The person is not logged into your app or we are unable to tell.
      //document.getElementById('status').innerHTML = 'Ingresa con tu cuenta de facebook';
    }
  }


  function loginOut() {
      	FB.logout(function(response) {
	   	// Person is now logged out
		});
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '469393603449701',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{fields: 'id,name,last_name,email,gender,age_range,cover,interested_in,picture'}, function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML += 'Id: ' + response.id + '<br>';
      document.getElementById('status').innerHTML += 'picture: <img src="' + response.picture.data.url + '"><br>';
      document.getElementById('status').innerHTML += 'Nombre: ' + response.name + '<br>';
      document.getElementById('status').innerHTML += 'Last name: ' + response.last_name + '<br>';
      document.getElementById('status').innerHTML += 'Email: ' + response.email + '<br>';
      document.getElementById('status').innerHTML += 'Gender: ' + response.gender + '<br>';
      document.getElementById('status').innerHTML += 'Age range: ' + response.age_range.min + ' - ' + response.age_range.max + '<br>';
      //document.getElementById('status').innerHTML += 'Cover: <img src="' + response.cover.source + '"><br>';
      //document.getElementById('status').innerHTML += 'interested_in: ' + response.interested_in + '<br>';

      
      
      //document.getElementById('status').innerHTML += 'About: ' + response.about + '<br>';
      //document.getElementById('status').innerHTML += 'User birthday: ' + response.user_birthday + '<br>';

		/*
	    FB.api('/'+response.id+'/picture', function(response) {
		    document.getElementById('status').innerHTML += '<img src="http://graph.facebook.com/' + response.id + '/picture" />';
    	});
		*/


    });
    
  }
  
  /*
  function testAPI() {
	FB.api('/me', {fields: 'last_name'}, function(response) {
	//console.log(response);
    document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + ' '+response.last_name+'!';
  }
  });
  */


</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>-->
<div
 id="btnFacebook"
 class="fb-login-button" 
 data-max-rows="1" 
 data-size="large" 
 data-button-type="continue_with" 
 data-show-faces="false" 
 data-auto-logout-link="false" 
 data-use-continue-as="false"
 scope="public_profile,email"
 onlogin="checkLoginState();"
 ></div>

<div id="status"></div>


<div id="btnSalir" style="display:none;"><a href='?' onclick='loginOut();'>Salir</a></div>



</body>
</html>