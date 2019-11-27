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
  ***
  
the php 

  ***
-->


<?php
  // We'll need a database connection both for retrieving records and for 
  // inserting them.  Let's get it up front and use it for both processes
  // to avoid opening the connection twice.  If we make a good connection, 
  // we'll change the $dbOk flag.
  $dbOk = false;
  
  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'charlotte', 'FurnitradeSB');
  
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true; 
  }

  // Now let's process our form:
  // Have we posted?
  $havePost = isset($_POST["save"]);
  
  // Let's do some basic validation
  $errors = '';
  if ($havePost) {
    
    // Get the output and clean it for output on-screen.
    // First, let's get the output one param at a time.
    // Could also output escape with htmlentities()
    $image = htmlspecialchars(trim($_POST["file"]));
    $category = htmlspecialchars(trim($_POST["category"]));  
    $location = htmlspecialchars(trim($_POST["location"]));
    $price = htmlspecialchars(trim($_POST["price"]));
    
    
    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array
    
    if ($file == '') {
      $errors .= '<li>Image may not be blank</li>';
      if ($focusId == '') $focusId = '#file';
    }
    if ($category == '') {
      $errors .= '<li>Category may not be blank</li>';
      if ($focusId == '') $focusId = '#category';
    }
    if ($location == '') {
      $errors .= '<li>Location may not be blank</li>';
      if ($focusId == '') $focusId = '#location';
    }
    if ($price == '') {
      $errors .= '<li>Price may not be blank</li>';
      if ($focusId == '') $focusId = '#price';
    }
  
    if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
    } else { 
      if ($dbOk) {
        // Let's trim the input for inserting into mysql
        // Note that aside from trimming, we'll do no further escaping because we
        // use prepared statements to put these values in the database.
        $imageForDb = trim($_POST["file"]);  
        $categoryForDb = trim($_POST["category"]);  
        $locationForDb = trim($_POST["location"]);
        $priceForDb = trim($_POST["price"]);
        
        // Setup a prepared statement. Alternately, we could write an insert statement - but 
        // *only* if we escape our data using addslashes() or (better) mysqli_real_escape_string().
        $insQuery = "insert into `products` (`file`,`category`,`location`,`price`) values(?,?,?)";
        $statement = $db->prepare($insQuery);
        // bind our variables to the question marks
        $statement->bind_param("sss",$imageForDB,$categoryForDb,$locationForDb,$priceForDb);
        // make it so:
        $statement->execute();
        
        // give the user some feedback
        echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' product added!</h4>';
        
        // close the prepared statement obj 
        $statement->close();
      }
    } 
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



 <!-- this is the whole form, including the image select -->

 <form id = "sell_form" class="box" method="post" action="sell.php" enctype="multipart/form-data">
  <div class="box__input">
    <label for="file" class= "file_label"> + Add Image </label>
    <input class="box__file" type="file" name="file[]" id="file" value="" data-multiple-caption="{count} files selected" multiple />
  </div>

  <div class="productData">

       <!-- <label class="field" for = "email">Seller Email:</label>
        <div class="value">
          <input type="text" size="50" value="" name="email" id="email"/>
        </div> -->
                     
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
              <!-- this is by states -->
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
 
