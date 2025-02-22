<?php
if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['gender'])&&isset($_POST['address'])&&isset($_POST['contact'])&&isset($_POST['uname'])&&isset($_POST['upassword'])){
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $upassword = $_POST['upassword'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];


    $conn = mysqli_connect('localhost','root','','bookstore');
    if(!$conn){
        echo mysqli_connect_error();
    }


    $sqluser = "INSERT INTO users(UserName, Password) VALUES('$uname', '$upassword')";
    mysqli_query($conn,$sqluser);


    $sqlid = "SELECT UserID FROM users WHERE UserName = '$uname'";
	$result = $conn->query($sqlid);
	while($row = $result->fetch_assoc()){
	    $id = $row['UserID'];
	}


    $sqlcustomer = "INSERT INTO customer(CustomerName, CustomerPhone, CustomerEmail, CustomerAddress, CustomerGender, UserID) 
            VALUES('$name', '$contact', '$email', '$address', '$gender', '$id')";
    mysqli_query($conn,$sqlcustomer);

    header("Location:index.php");
}    



?>