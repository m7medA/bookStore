<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=
	, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style2.css?v=1.1">
	
</head>
<body>
	
<?php
session_start();

	if(isset($_POST['add'])){
		
		
		if(!isset($_SESSION['id'])){
		header("Location: login_1.php");
             
		}else{
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "SELECT * FROM book WHERE BookID = '".$_POST['add']."'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$bookID = $row['BookID'];
			$quantity = 1;
			$price = $row['Price'];
		}

		$sql = "
		SELECT CASE  
			WHEN EXISTS (
				SELECT 1 FROM cart WHERE BookID ='". $bookID."'
			)
			THEN TRUE
			ELSE FALSE
		END AS exists_flag;
	";
		
    
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($row['exists_flag']) {
		$sql = "
      SELECT Quantity AS QTY FROM cart WHERE BookID = '". $bookID."';

    ";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$qty= $row["QTY"]+1;

		$sql = "
        UPDATE cart
        SET Quantity = '". $qty ."',
		TotalPrice = '". $price."' * '".$qty."'
        WHERE BookID = '". $bookID."';

    ";
	$conn->query($sql);
		
	} else {
		$sql = "INSERT INTO cart(BookID, Quantity, Price, TotalPrice) VALUES('".$bookID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
       
    }


		
}



	}
	
	if(isset($_POST['delc'])){
		
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "DELETE FROM cart";
		$conn->query($sql);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE bookstore";
	$conn->query($sql);	

	$sql = "SELECT COUNT(*) as count FROM cart ";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$count_row= $row['count'];

	$sql = "SELECT * FROM book";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	
	
	echo '<nav>
    <div class="title"><a href="index.php">Bookly</a></div>
     <div class="leftnav">
       <div class="icon-cart">
        <svg class="w-6 h-6 text-gray-800 dark:text-white cart" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
        </svg>
        <span>'. $count_row.'</span>
      </div>
          <div class="profile">
            <img src="iimg/profile.jpg" alt="profile-img">
            <ul>
              <li><a href="edituser.php">Edit</a></li>
              <li>|</li>
              <li><a href="logout.php">Log out</a></li>
            </ul>
          </div>
       
          
    </div>
  </nav>';
}

if(!isset($_SESSION['id'])){
	
echo ' <nav>
   <div class="title"><a href="index.php">Bookly</a></div>
    <div class="leftnav">
      <div class="icon-cart">
        <svg class="w-6 h-6 text-gray-800 dark:text-white cart" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
        </svg>
        <span>'.  $count_row.'</span>
      </div>
          <div class="profile">
            <img src="iimg/profile.jpg" alt="profile-img">
            <ul>
              <li><a href="login_1.php">Log in</a></li>
              <li>|</li>
              <li><a href="register.php">Sign up</a></li>
            </ul>
          </div>
    </div>
  </nav>';
}
echo
'<div class="container">
<div class="list-of-product">';
  

    while($row = $result->fetch_assoc()) {
	echo '	<div class="item">
          <div class="image-item">
            <img src='.$row["Image"].' alt="">
          </div>
          <h5>'.$row["BookTitle"].'</h5>
          <div class="price-add">
            <p class="price">'.$row["Price"].'LE</p>
			<form  method="post">
		   <button  name="add" type="submit" value="'.$row['BookID'].'">Add To Cart</button>
	   	</form>
		   </div>
		   </div>';
		   
		}
		echo '</div>
		</div>';
		
		

	$sql = "SELECT book.BookTitle, book.Image, cart.Price, cart.Quantity, cart.TotalPrice FROM book,cart WHERE book.BookID = cart.BookID;";
	$result = $conn->query($sql);
	

	  echo '<div class="cartside">
	  <div class="top">
	<h2>Shopping Cart</h2>
	<form method="post"><input type="hidden" name="delc"/><button class="del" type="hidden" type="submit" >Empty Cart</button></form>
	</div>
	<div class="list-cart">';

    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo'<div class="item">
          <div class="image"> 
            <img src="'.$row["Image"].'" alt="">
          </div>
            <div class="name">'.$row['BookTitle'].'</div>
            <div class="t-price">
              '.$row['Price'].'LE
            </div>
            <div class="qty">
              <span class="minus"><</span>
              <span>'.$row['Quantity'].'</span>
              <span class="plus">></span>
            </div>
        </div>';
     $total += $row['TotalPrice'];
    }

       echo '
	    </div> 
		 <span class="total">Total Price : '.$total.'LE</span>
		 <form action="checkout.php" method="post"> 
        <button  type="submit" name="checkout" value="CHECKOUT" class="check">Check Out</button>
		</form>
        </div>';
	   
   

?>
<script src="app.js"></script>
</body>
</html>


