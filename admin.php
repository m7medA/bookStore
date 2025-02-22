<?php
    if (isset($_GET['flagS'])) {
        $flagS = $_GET['flagS'];
    } else {
        $flagS = 0; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css?v=1.7">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+ES+Deco+Guides&display=swap" rel="stylesheet">
    <title>Admin Page</title>
</head>
<body>
    <div class="header">
        <div class="logoContainer">
            <a href="http://localhost/bookstore/index.php" class='logo'>Bookly</a>
        </div>
            <div class="info">
                <?php
                    session_start();
                    $id = $_SESSION["adminid"];
                    $name = $_SESSION["adminname"];
                ?>
                <p style="margin-left:10px;"><?php 
                    echo $name;
                ?></p>
            </div>
            <i class="fa-solid fa-bars" id="show"></i>
    </div>
    <div class="pContainer">
        <div class="left">
            <form method="POST" action="" class="actionForm">
                <button type="submit" name="showCustomers" class="actionBtn">Show Customers</button>
                <button type="submit" name="showBooks" class="actionBtn">Show Books</button>
                <button type="submit" name="showOrder" class="actionBtn">Show Order</button>
                <button type="submit" name="addBook" class="actionBtn">Add Book</button>
            </form>
        </div>
        <?php
        echo"<div class='right'>";
            echo"<div class='cContainer'>";
                                
                                // Database connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "bookstore";
                                
                                $conn = mysqli_connect("localhost", "root", "", "bookstore");

                                if (!$conn) {
                                    echo mysqli_connect_error();
                                }

                                // Fetch all users
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    if (isset($_POST['showCustomers'])) {
                                        echo "<table><caption>Customers</caption>";
                                        echo "<thead><tr><th>ID</th><th>name</th><th>email</th><th>phone</th><th>Gender</th><th>address</th><th>Delete</th></tr></thead><tbody>";
                                        $sql = "SELECT * FROM customer";
                                        $result = $conn->query($sql);
                        
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                <td>" . $row["CustomerID"] . "</td>
                                                <td>" . $row["CustomerName"] . "</td>
                                                <td>" . $row["CustomerEmail"] . "</td>
                                                <td>" . $row["CustomerPhone"] . "</td>
                                                <td>" . $row["CustomerGender"] . "</td>
                                                <td>" . $row["CustomerAddress"] . "</td>
                                                <td>
                                                    <form method='POST' action='adminAction.php'>
                                                        <input type='hidden' name='deleteCustomer' value='" . $row['CustomerID'] . "'>
                                                        <button type='submit' class='delete-button'>Delete</button>
                                                    </form>
                                                </td>
                                                </tr>";   }
                                        } else {
                                            echo "<tr><td colspan='6'>No users found</td></tr>";
                                        }
                                        $flagS = 0;
                                    }elseif (isset($_POST['showBooks'])) {
                                        $sql = "SELECT * FROM Book";
                                        $result = $conn->query($sql);
                        
                                        if ($result->num_rows > 0) {
                                            echo "<table><caption>Books</caption>";
                                            echo "<thead><tr><th>ID</th><th>Title</th><th>ISBN</th><th>Price</th><th>Author</th><th>Delete</th></tr></thead><tbody>";
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                <td>" . $row["BookID"]. "</td>
                                                <td>" . $row["BookTitle"]. "</td>
                                                <td>" . $row["ISBN"]. "</td>
                                                <td>" . $row["Price"]. "$</td>
                                                <td>" . $row["Author"]. "</td><td>
                                                    <form method='POST' action='adminAction.php'>
                                                        <input type='hidden' name='deleteBook' value='" . $row['BookID'] . "'>
                                                        <button type='submit' class='delete-button'>Delete</button>
                                                    </form>
                                                </td></tr>";
                                            }
                                            echo "</tbody></table>";
                                        } else {
                                            echo "<p>No books found</p>";
                                        }
                                        $flagS = 0;
                                    }elseif (isset($_POST['addBook'])) {
                                        echo "<div class='form-container'>
                                                <p>Add Book</p>
                                                <form action='adminAction.php' method='POST'>
                                                    
                                                    <label for='bookId'>Book ID:</label>
                                                    <input type='text' id='bookId' name='bookId' placeholder = 'B00-number' required>

                                                    <label for='title'>Title:</label>
                                                    <input type='text' id='title' name='title' required>

                                                    <label for='isbn'>ISBN:</label>
                                                    <input type='text' id='isbn' name='isbn' required>

                                                    <label for='price'>Price:</label>
                                                    <input type='number' id='price' name='price' required>

                                                    <label for='author'>Author:</label>
                                                    <input type='text' id='author' name='author' required>

                                                    <button type='submit' name='addBook'>Add Book</button>
                                                </form>
                                            </div>";
                                        $flagS = 0;
                                    }elseif (isset($_POST['showOrder'])) {
                                        $sql = "SELECT * FROM `Order`";
                                        $result = $conn->query($sql);
                        
                                        if ($result->num_rows > 0) {
                                            echo "<table><caption>Order</caption>";
                                            echo "<thead><tr><th>Order ID</th><th>Customer ID</th><th>Book ID</th><th>Date Purchase</th><th>Quantity</th><th>Total Price</th></tr></thead><tbody>";
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr><td>" . $row["OrderID"]. "</td><td>" . $row["CustomerID"]. "</td><td>" . $row["BookID"]. "</td><td>" . $row["DatePurchase"]. "$</td><td>" . $row["Quantity"]. "</td><td>". $row["TotalPrice"] ."</td></tr>";
                                            }
                                            echo "</tbody></table>";
                                        } else {
                                            echo "<p>No order found</p>";
                                        }
                                        $flagS = 0;
                                    }
                                }

                                $conn->close();
                    
            echo "</div>";
        echo "</div>";
        ?>

        <?php
            if ($flagS){
                echo "<div class='success-message' style='display:block;'>";
                    echo "<h2>Success</h2>";
                    echo "<p>Your action was completed successfully.</p>";
                echo "</div>";
            }
            
        ?>

    </div>

    <script src="admin.js"></script>
</body>
</html>








