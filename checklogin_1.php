<?php
session_start();
if(isset($_POST['username'])&&isset($_POST['pwd'])){

    $username=$_POST['username'];
    $pwd = $_POST['pwd'];


    $conn = mysqli_connect('localhost','root','','bookstore');

    if(!$conn){
        echo mysqli_connect_error();
    }

    $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserName = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $pwd);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($id);

    // Fetch the result
    if ($stmt->fetch()) {
        $_SESSION['adminname'] = $name;
        $_SESSION['id'] = $id;
        header("Location:index.php?");
    } else {
        header("Location:login_1.php?errcode=1");
    }

    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
}else if(isset($_POST['email'])&&isset($_POST['pwd'])){
    $email=$_POST['email'];
    $pwd = $_POST['pwd'];
    $conn = mysqli_connect('localhost','root','','bookstore');
    

    if(!$conn){
        echo mysqli_connect_error();
    }
    
    $stmt = $conn->prepare("SELECT id,name FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pwd);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($id,$name);

    // Fetch the result
    if ($stmt->fetch()) {
        $_SESSION['adminname'] = $name;
        $_SESSION['adminid'] = $id;
        header("Location:admin.php?");
    } else {
        
        header("Location:login_1.php?errcode=1");
    }

    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

?>