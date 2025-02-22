<?php
    session_start();
    if(isset($_POST['deleteCustomer'])){
        $var=$_POST['deleteCustomer'];
        $conn = mysqli_connect('localhost','root','','bookstore');
    
        if(!$conn){
            echo mysqli_connect_error();
        }
        $queryCustomer= "DELETE FROM Customer WHERE CustomerID = '$var';";
        mysqli_query($conn,$queryCustomer);
        $queryUsers= "DELETE FROM Users WHERE UserID = '$var';";
        mysqli_query($conn,$queryUsers);
        header("Location:admin.php?flagS=1");

    }else if (isset($_POST['deleteBook'])){
        $var=$_POST['deleteBook'];
        $conn = mysqli_connect('localhost','root','','bookstore');
    
        if(!$conn){
            echo mysqli_connect_error();
        }
        $queryBook= "DELETE FROM Book WHERE BookID = '$var';";
        mysqli_query($conn,$queryBook);
        header("Location:admin.php?flagS=1");
    }else{
        $bookID = $_POST['bookId'];
        $title = $_POST['title'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $author = $_POST['author'];


        $var=$_POST['addBook'];
        $conn = mysqli_connect('localhost','root','','bookstore');
    
        if(!$conn){
            echo mysqli_connect_error();
        }
        $queryBook= "INSERT INTO `book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) 
                    VALUES ('$bookID','$title','$isbn',$price,'$author','Food','image/food.jpg');";
        mysqli_query($conn,$queryBook);
        header("Location:admin.php?flagS=1");
        
    }
?>
