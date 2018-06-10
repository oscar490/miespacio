
function signOut() {
   var auth2 = gapi.auth2.getAuthInstance();
   auth2.signOut();
 }

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();

  $.ajax({
      url: url_google,
      type: 'POST',
      data: {
          email: profile.getEmail()
      },
      beforeSend: signOut(),
      success: function(data) {
          if (!data) {
              growl_error('No existe ningún usuario de Google con ese correo.');
          }
      }
  });
}
