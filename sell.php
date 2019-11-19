<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Furnitrde</title>
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
    <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"></span>.</label>
    <input class="box__file" type="file" name="files[]" id="file" value = "" data-multiple-caption="{count} files selected" multiple />
  </div>

  <div class="productData">
                     
       <label class="field" for="firstNames">First Name(s):</label>
       <div class="value"><input type="text" size="60" value="<?php echo $firstNames; ?>" name="firstNames" id="firstNames"/></div>
       
       <label class="field" for="lastName">Last Name:</label>
       <div class="value"><input type="text" size="60" value="<?php echo $lastName; ?>" name="lastName" id="lastName"/></div>
       
       <label class="field" for="dob">Date of Birth:</label>
       <div class="value"><input type="text" size="10" maxlength="10" value=" <?php echo $dob; ?>" name="dob" id="dob"/> <em>yyyy-mm-dd</em></div>
       
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
 
