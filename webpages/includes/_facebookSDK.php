<?php ?>
<script>
  // Initialize SDK. This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
      console.log('statusChangeCallback');
      console.log(response);
      // The response object is returned with a status field that lets the
      // app know the current login status of the person.
      if (response.status === 'connected') {
          // Logged into your app and Facebook.
          testAPI();
      } else {
          // The person is not logged into your app or we are unable to tell.
          document.getElementById('status').innerHTML = 'Please log ' +
              'into this app.';
      }
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
    appId      : '1662585234037955',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // This function gets the state of the person visiting this page and
  // can return one of three states tothe callback you provide.
  FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously

  (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
          console.log('Successful login for: ' + response.name);
          document.getElementById('status').innerHTML =
              'Thanks for logging in, ' + response.name + '!';
      });
  }
</script>