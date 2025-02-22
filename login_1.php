<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_1.css?v=1.4">
    <title>Book Store</title>
</head>
<body>
    <div class="header">
            <a href="index.php"><img src="image/logo.png" alt=""></a>
    </div>
    <div class="parentContianer">
        <div class="childContainer">
            <div class="left">
                <form action="checklogin_1.php" method="post" class="formUser">
                    <p>Login</p>
                    <input type="text" placeholder='username' name="username"/>
                    <input type="password" placeholder='Password' name="pwd" />
                    <input class="button" type="submit" value="Login"/>
                </form>
                <form action="checklogin_1.php" method="post" class="formAdmin hidden">
                    <p>Login</p>
                    <input type="email" placeholder='E-mail' name="email"/>
                    <input type="password" placeholder='Password' name="pwd" />
                    <input class="button" type="submit" value="Login"/>
                </form>
                <button id="adminBtn">Admin</button>
            </div>
            <div class="right">
                <div class="img"></div>
            </div>
        </div>
    </div>
    <?php
        $errorMessage = "Error in username or password please try again";
        if (isset($_GET['errcode'])) {
            echo "<div class='error-message'>$errorMessage</div>";
        }
    ?>
    <script src="login.js"></script>
</body>
</html>