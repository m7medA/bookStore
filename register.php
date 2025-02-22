<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register_1.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
            <a href="index.php"><img src="image/logo.png" alt=""></a>
    </div>
    <div class="parentContianer">
        <div class="childContainer">
            <form action="checkregister_1.php" method="post">
                <h1>Register</h1>
                <label for="">Full Name:</label><input type="text" name="name" placeholder="Full Name" required>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"></span><br><br> -->

                <label for="">User Name:</label><input type="text" name="uname" placeholder="User Name" required>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $usernameErr;?></span><br><br> -->

                <label for="">Password:</label><input type="password" name="upassword" placeholder="Password" required>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $passwordErr;?></span><br><br> -->

                <label for="">E-mail:</label><input type="text" name="email" placeholder="example@email.com" required>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $emailErr;?></span><br><br> -->

                <label>Mobile Number:</label><input type="text" name="contact" placeholder="012-3456789" required>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $contactErr;?></span><br><br> -->

                <label>Gender:</label>
                <div class="gender">
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "Male") echo "checked";?> value="Male" required>Male
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "Female") echo "checked";?> value="Female">Female
                </div>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $genderErr;?></span><br><br> -->

                <label>Address:</label>
                <textarea name="address" cols="50" rows="5" placeholder="Address" required></textarea>
                <!-- <span class="error" style="color: red; font-size: 0.8em;"><?php echo $addressErr;?></span><br><br> -->

                <input class="button" type="submit" name="submitButton" value="Submit">
            </form>
        </div>
    </div>

</body>
</html>