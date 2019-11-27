/* Furnitrade Site JavaScript File 
   Everything here should be in functions that are well
   commented so this file can be used throughout the site */

   function loggedin(){
      //the button of the class account will change what it says if the user has
      //created an account????

      window.location="index.html";
   }

   function passinfo(){
      //alerts user of password shit

      alert("At least 8 characters\nMust contain at least one number\nMust contain at least one capital letter");
      window.location="create_account.html";
   }

   function validate(formObj) {
  
      if (formObj.file.value === '') {
        alert('Please choose an image');
        formObj.file.focus();
        return false;
      }
      
      if (formObj.category.value === '') {
        alert('Please enter a category');
        formObj.category.focus();
        return false;
      }
      
      if (formObj.location.value === '') {
        alert('Please select a location');
        formObj.location.focus();
        return false;
      }

      if (formObj.price.value === '') {
         alert('Please enter a price');
         formObj.price.focus();
         return false;
       }
        
      return true;
    }






   /*
      ***

       sell page

      ***
   */
 




   /*
      ***

       buy page

      ***
   */
	


function bought(){

   alert("You have chosen to claim this product. \n To complete the transaction please contact the seller. \n\n Contact provided below: \n");

}



