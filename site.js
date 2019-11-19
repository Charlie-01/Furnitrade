/* Furnitrade Site JavaScript File 
   Everything here should be in functions that are well
   commented so this file can be used throughout the site */

   function loggedin(){
      //the button of the class account will change what it says if the user has
      //created an account????

      window.location="create_account.html";
   }

   function passinfo(){
      //alerts user of password shit

      alert("At least 8 characters\nMust contain at least one number\nMust contain at least one capital letter");
      window.location="create_account.html";
   }

   var $button = document.querySelector('.account');
   $button.addEventListener('click', function() {
      var duration = 0.3,
         delay = 0.08;
      TweenMax.to($button, duration, {scaleY: 1.6, ease: Expo.easeOut});
      TweenMax.to($button, duration, {scaleX: 1.2, scaleY: 1, ease: Back.easeOut, easeParams: [3], delay: delay});
      TweenMax.to($button, duration * 1.25, {scaleX: 1, scaleY: 1, ease: Back.easeOut, easeParams: [6], delay: delay * 3 });
   });