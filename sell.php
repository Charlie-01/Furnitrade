<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Furnitrade</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="site.css"/>
    <link href='https://fonts.googleapis.com/css?family=Be Vietnam' rel='stylesheet'/>
    <link href='https://fonts.googleapis.com/css?family=Playball' rel='stylesheet'/>
    <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="site.js"></script>
  </head>

  <!-- ...
      
      main header 
    
    ... -->



    <header class = "header">
    <div class="mainheader">

      <div class="header-logo">
        <a href="index.html">
          <img src="Screen Shot 2019-10-26 at 5.09.24 PM.png" width="100" height="85" class="ladybug-logo"/>
          <img src="Screen Shot 2019-10-26 at 4.45.59 PM.png" width="300" height="100" class="furnitrade-logo"/>
        </a>
      </div>

      <div class="header-account">
          <button class="login" onclick="loggedin()">
            Log In
          </button>
      </div>

      <div class="menu">
        <a href="index.html">Home</a>
        <a href="buy.html">Buy</a>
        <a href="sell.php">Sell</a>
        <a href="trade.html">Trade</a>
      </div>

    </div>
  </header>

  
  <!-- 
    this is gonna be a js form
    values from js form go into JSON file with php?
      eg image, location, title, price, category, description

    JSON file will be called on Buy page to occupy each
   -->


<!-- 
  ***
  
the php 

  ***
-->





   <?php 
   /* some very basic form processing */
   
   // variables to hold our form values:
   $firstNames = '';  //change these namesss
   $lastName = '';
   $dob = '';
   // hold any error messages
   $errors = ''; 
   
   // have we posted?
   $havePost = isset($_POST["save"]);
   
   if ($havePost) {
     // Get the input and clean it.
     // First, let's get the input one param at a time.
     // Could also output escape with htmlentities()
     $firstNames = htmlspecialchars(trim($_POST["firstNames"]));  
     $lastName = htmlspecialchars(trim($_POST["lastName"]));
     $dob = htmlspecialchars(trim($_POST["dob"]));
     
     // special handling for the date of birth
     $dobTime = strtotime($dob); // parse the date of birth into a Unix timestamp (seconds since Jan 1, 1970)
     $dateFormat = 'Y-m-d'; // the date format we expect, yyyy-mm-dd
     // Now convert the $dobTime into a date using the specfied format.
     // Does the outcome match the input the user supplied?  
     // The right side will evaluate true or false, and this will be assigned to $dobOk
     $dobOk = (date($dateFormat, $dobTime) == $dob);  
     
     // Let's do some basic validation
     $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array
     
     if ($firstNames == '') {
       $errors .= '<li>First name may not be blank</li>';
       if ($focusId == '') $focusId = '#firstNames';
     }
     if ($lastName == '') {
       $errors .= '<li>Last name may not be blank</li>';
       if ($focusId == '') $focusId = '#lastName';
     }
     if ($dob == '') {
       $errors .= '<li>Date of birth may not be blank</li>';
       if ($focusId == '') $focusId = '#dob';
     }
     if (!$dobOk) {
       $errors .= '<li>Enter a valid date in yyyy-mm-dd format</li>';
       if ($focusId == '') $focusId = '#dob';
     }
   
     if ($errors != '') { ?>
       <div id="messages">
         <h4>Please correct the following errors:</h4>
         <ul>
           <?php echo $errors; ?>
         </ul>
         <script type="text/javascript">
           $(document).ready(function() {
             $("<?php echo $focusId ?>").focus();
           });
         </script>
       </div>
     <?php } else { ?>
       <div id="messages">
         <h4>Product Posted</h4>
       </div>
     <?php } 
   }
 ?>
 
 <?php 
   // to include client-side validation to the form below, 
   // add the following parameter:
   // onsubmit="return validate(this);"
 ?>



<!-- 
  ***

the forms

  ***
-->




 <!-- this is the whole form -->

 <form id = "sell_form" class="box" method="post" action="sell.php" enctype="multipart/form-data">
  <div class="box__input">
    <label for="file" class= "file_label"> + Add Image </label>
    <input class="box__file" type="file" name="files[]" id="file" value = "" data-multiple-caption="{count} files selected" multiple />
  </div>

  <div class="productData">

       <label class="field" for = "email">Seller Email:</label>
        <div class="value">
          <input type="text" size="50" value="" name="email" id="email"/>
        </div>
                     
       <label class="field" for = "category">Category:</label>
        <div class="value">
          <select name="category" id="category">
              <option value="--">--</option>
              <option value="seating">Seating</option>
              <option value="desks">Desks</option>
              <option value="lighting">Lighting</option>
              <option value="tables">Tables</option>
              <option value="kitchenware">Kitchenware</option>
              <option value="misc">Miscellaneous</option>
            </select>
        </div>

       <label class="field" for = "location">Location:</label>
        <div class="value">
          <select name="location" id="location">
              <!-- this is by states, i just have to go back and change these but im lazy -->
              <option value="--">--</option>
              <option value="AL">AL</option>
              <option value="AK">AK</option>
              <option value="AZ">AZ</option>
              <option value="AR">AR</option>
              <option value="CA">CA</option>
              <option value="CO">CO</option>
              <option value="CT">CT</option>
              <option value="DE">DE</option>
              <option value="FL">FL</option>
              <option value="GA">GA</option>
              <option value="HI">HI</option>
              <option value="ID">ID</option>
              <option value="IL">IL</option>
              <option value="IN">IN</option>
              <option value="IA">IA</option>
              <option value="KS">KS</option>
              <option value="KY">KY</option>
              <option value="LA">LA</option>
              <option value="ME">ME</option>
              <option value="MD">MD</option>
              <option value="MA">MA</option>
              <option value="MI">MI</option>
              <option value="MN">MN</option>
              <option value="MS">MS</option>
              <option value="MO">MO</option>
              <option value="MT">MT</option>
              <option value="NE">NE</option>
              <option value="NV">NV</option>
              <option value="NH">NH</option>
              <option value="NJ">NJ</option>
              <option value="NM">NM</option>
              <option value="NY">NY</option>
              <option value="NC">NC</option>
              <option value="ND">ND</option>
              <option value="OH">OH</option>
              <option value="OK">OK</option>
              <option value="OR">OR</option>
              <option value="PA">PA</option>
              <option value="RI">RI</option>
              <option value="SC">SC</option>
              <option value="SD">SD</option>
              <option value="TN">TN</option>
              <option value="TX">TX</option>
              <option value="UT">UT</option>
              <option value="VT">VT</option>
              <option value="VA">VA</option>
              <option value="WA">WA</option>
              <option value="WV">WV</option>
              <option value="WI">WI</option>
              <option value="WY">WY</option>
            </select>
        </div>

       <label class="field" for = "price">Price:</label>
        <div class="value">
          <input type="text" size="20" value="" name="price" id="price"/>
        </div>
       
       <input type="submit" value="save" id="save" name="save"/>
  </div>
</form>



 
       
     </div>



    <footer>
      <div class="footer">
        <p>
          <a href="https://www.instagram.com/buy.sell.furnitrade/">
            <img src="insta-logo.png" width="30" height="30" class="instagram"/>
          </a>
        </p>
        <p>
          @buy.sell.furnitrade
        </p>
        <p>
          Follow us on Instagram!
        </p>
      </div>
    </footer>

   </body>
 </html>
 
