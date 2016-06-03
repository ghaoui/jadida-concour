//var facebook = false ;
  function statusChangeCallback(response) {
    if (response.status === 'connected') {
     
     
     FB.api('/me', 'GET', {
        "fields": "id,name,email"
    },function(response) {
    console.log(JSON.stringify(response));
/*facebook = true;
$('#facebook-button').hide();

var str = response['name'];

$('#prenom').val(str.substr(0,str.indexOf(' ')));
$('#nom').val(str.substr(str.indexOf(' ')+1));
$('#email').val(response['email']);*/
     });

     
    } 
  }

  function checkLoginState() {
    alert('salut');
    FB.getLoginStatus(function(response) {
      if (response.hasOwnProperty("error")) {
        alert("Error: " + response.error.message);
    } else {
        //Success!
    }
      statusChangeCallback(response);
    });
  }

   window.fbAsyncInit = function() {
    
    FB.init({
    appId      : '251610031863417',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });
  };
function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            var access_token = response.authResponse.accessToken; //get access token
            var user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', 'GET', {
        "fields": "id,name,email"
    }, function(response) {
              console.log(response);
              console.log(user_id);
                var user_email = response.email; //get user email
                var user_name = response.name; //get user email
          // you can store this data into your database  
          $.ajax({
              url: 'ajax.php',
              type: 'post',
              data: {
                ajax : "setToken",
                access_token : access_token,
                user_id : user_id,
                name : user_name,               
                email : user_email              
              },
              success: function (data) {
                if(data == true){
                  var url = 'game.php';
                  window.location.href = url;
                }
              }
              });          
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'public_profile,email'
    });
}
function addVoteFb(id_image,element){
    FB.login(function(response) {
        if (response.authResponse) {
            var user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', 'GET', {
        "fields": "id"
    }, function(response) {
          $.ajax({
              url: 'ajax.php',
              type: 'post',
              data: {
                ajax : "setVote",
                user_id : user_id,              
                id_image : id_image             
              },
              success: function (data) {
                //var content = '<i class="fa fa-heart" aria-hidden="true"></i> <' + data;
                element.find('span').html(data);
              }
              });          
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'public_profile,email'
    });
}
// partage image
function partageImage(){

  var msg = 'Faites comme moi et partager une part de vous avec Tunisair. Vous pouvez gagner un billet gratuit.';
                 FB.ui(
                     {
                         method: 'feed',
                         name: 'fihamenni',
                         link: 'http://fihamenni.com/',
                         picture: 'http://www.animationresources.org/pics/achmedreiniger.jpg',
                       //  source: self._song.media,
                         caption: 'http://fihamenni.com/',
                         description: msg,
                         message: msg
                     },
                     function(response) {
                         if (response && response.post_id) {
                             self.register_share('facebook');
                         } else {
                             console.log("Post not shared");
                         }
                     }
                 );
}
function partageGallerie(name,url){

  var msg = 'Faites comme moi et partager une part de vous avec Tunisair. Vous pouvez gagner un billet gratuit.';
                 FB.ui(
                     {
                         method: 'feed',
                         name: name,
                         link: 'http://fihamenni.com/',
                         picture: 'http://localhost/jadidac/' + url,
                       //  source: self._song.media,
                         caption: 'http://fihamenni.com/',
                         description: msg,
                         message: msg
                     },
                     function(response) {
                         if (response && response.post_id) {
                             self.register_share('facebook');
                         } else {
                             console.log("Post not shared");
                         }
                     }
                 );
}
function inviteFriends(){
  /*FB.ui({ 
    method: 'apprequests',
    message: 'You should learn more about this awesome game.',
    data: 'tracking information for the user',
    action_type:'send',
  });*/
  FB.ui({
    method:'apprequests',
    message: 'Awesome application try it once' }
    , requestCallback); 
} 


function requestCallback(response) {
console.log(response);
}
// fin partage
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      
      console.log('Successful login for: ' + response.name);
      //document.getElementById('status').innerHTML =
       // 'Thanks for logging in, ' + response.name + '!';
    });
  }
