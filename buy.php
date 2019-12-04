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

  <!--
    ok, how is this gonna work?


    pull from sell JSON file
    somehow loop (jquery?) so that the first div always takes
    the most recent entry to the JSON file
    
    make a function (jquery or js?) that will remove JSON entrys
    temporarily based on either location or category?? aahahhahaha


    use get to fill in the divs from the json file

    make sure the html is structured well enough for this to be implemented

-> write the whole html first like as if not from a JSON, so u can replace it
-> i would say 3 divs by 10 divs down (30)
-> put them in an ordered list where each <li> item has 3 divs
-> each of those divs should contain image, then underneath category, location
    price

  -->


<body>
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
          <button class="login">
            <a href='create_account.html' class='log-in-button'>Log In</a>
          </button>
        </div>
  
        <div class="menu">
          <a href="index.html">Home</a>
          <a href="buy.php">Buy</a>
          <a href="sell.php">Sell</a>
          <a href="aboutus.html">About Us</a>
        </div>

        <!-- <div class="filter-bar"> -->

          <!-- make this have dropdowns that are all buttons with functions
             to be called on click that change the JSON file -->

            <!-- <a href="buy.html"><button class = "invisible-button">Location</button></a>
            <a href="buy.html"><button class = "invisible-button">Category</button></a>
            <a href="buy.html"><button class = "invisible-button">Price</button></a> -->
        <!-- </div> -->
  
      </div>
    </header>

      
    <h3>Products</h3>
    <table id="productTable">
    
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

      if ($dbOk) {
        
        $query = 'select * from products order by id';
        $result = $db->query($query);
        $numRecords = $result->num_rows;
        //echo ($numRecords);
        
        echo "<div class = 'big-products-block' id = 'all-products'>
        <ol>";

        for ($i=$numRecords; $i > 0; $i--) {
          $record = $result->fetch_assoc();
          //here is where you will use php to format each one the way the divs above are set
          
          if ($i%3 == 0){
            echo '<li class = "product-row">';
          }

          echo '<div class = "product-div">';
            echo '<img src = "';
            echo htmlspecialchars($record['file']);
            echo '" alt="img" width="220px" height="220px" />';

            echo '<p>';
            echo htmlspecialchars($record['category']);
            echo '</p>';

            echo '<p>';
            echo htmlspecialchars($record['location']);
            echo '</p>';

            echo '<p>';
            echo htmlspecialchars($record['price']);
            echo '</p>';
            
            echo '<button onclick = bought() >Buy</button>';
          echo '</div>';
          
          // echo htmlspecialchars($record['file']) . ', ';
          // echo htmlspecialchars($record['category']) . ', ';
          // echo htmlspecialchars($record['location']) . ', ';
          // echo htmlspecialchars($record['price']);
          // echo '</td><td>';
          
          // Uncomment the following three lines to see the underlying 
          // associative array for each record.
          // echo '<tr><td colspan="3" style="white-space: pre;">';
          // print_r($record);
          // echo '</td></tr>';
        }
        
        $result->free();
        
        // Finally, let's close the database
        $db->close();
      }
      
    ?>
    </table>





  <!-- ...
      
      product divs
    
    ... -->

        <!-- 

        -> i would say 3 divs by 10 divs down (30)
        -> put them in an ordered list where each <li> item has 3 divs
        -> each of those divs should contain image, then underneath category, location
            price
          
        -->





<!-- 

  
outputting from the database 


-->

  










  <!-- ...
      
      footer
    
    ... -->
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