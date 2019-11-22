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
            data : jsonData
    
        });
        e.preventDefault(); 

        window.location="sell.php";
    });
    });




   /*
      ***

       buy page

      ***
   */

   
  $(document).ready(function() {
	
   $.ajax({
        type: "GET",
        url: "sell_products.json",
        dataType: "json",
        success: function(responseData, status){
         var output = "<ol>";  
         $.each(responseData.menuItem, function(i, menuItem) { //how do i go through this backwards?? So most recent post comes first?
            //insert the structure of the divs on buy page, as below HELP

            //output += '<li><a href="' + menuItem.menuURL + '">';
            //output += menuItem.menuName;
            //output += '</a></li>';
       });
       $('#all-products').html(output);
     }, error: function(msg) {
                // there was a problem
       alert("There was a problem: " + msg.status + " " + msg.statusText);
     }
   });
});


function bought(){

   alert("You have chosen to claim this product. \n To complete the transaction please contact the seller. \n\n Contact provided below: \n");

}



