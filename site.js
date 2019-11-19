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






   /*
      ***

       sell page

      ***
   */
   
   //this gathers each name and value int he field and formats it into JSON style
   $(document).ready(function() {
      $("#save").click(function(e){
         var jsonData = {};
    
       var formData = $("#sell_form").serializeArray();
    
       $.each(formData, function() {
            if (jsonData[this.name]) {
               if (!jsonData[this.name].push) {
                   jsonData[this.name] = [jsonData[this.name]];
               }
               jsonData[this.name].push(this.value || '');
           } else {
               jsonData[this.name] = this.value || '';
           }
    
    
       });

       //this part is supposed to post the newly formatted data to the json file, but it doesnt i dunnooo whyyy
       console.log(jsonData);
        $.ajax(
        {
            type: "POST",
            url : "sell_products.json",
            data : jsonData,
    
        });
        e.preventDefault(); 

        window.location="sell.php";
    });
    });




