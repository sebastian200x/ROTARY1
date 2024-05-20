<?php include '../db.php';
if (isset($_SESSION['id'])) {
    ?>
    <script type="text/javascript">
        window.alert("You're already logged in, Redirecting...")
        window.location = "./landing-page.php";
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="STYLE/CSS/index.css">
    <title>Admin Login</title>
</head>



<body>
    <div class="container2">
        <div class="centered">
            <form action="index.php" method="POST">
                <div class="imgcontainer">
                    <img src="./STYLE/IMAGE/img_avatar2.png" alt="Avatar" class="avatar">
                    <br><br><br>
                    <h1 style="color: #D9DCDA; margin-bottom: 5px;">ROTARY </h1>
                    <h1 style="color: #545454;">ADMIN LOGIN</h1>
                </div>

                <br><br><br><br>
                <div class="container3">
                    <label class="left" for="uname"><b>Username</b></label> <br>
                    <input type="text" placeholder="Enter Username" name="username" id="uname" required>
                    <br>
                    <label class="left" for="psw"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required>
                    <br><br>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label><br>
                </div> <br><br>
                <div class="flex-container">
                    <div><input class="button" type="submit" value="Login" name="login"></div>
                    <br>
                </div>
            </form>
            <div class="flex-container">
                <div><input class="button" type="submit" value="Register"></div>
                <br>
            </div>
            <div class="span"><span class="psw">Forgot <a href="#">password?</a></span></div>
        </div>

    </div>

    <div class="container4"><img class="image" src="./STYLE/IMAGE/rotary.png" alt="logo"></div>

    <?php

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM account WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                header("Location: landing-page.php");
                exit();
            } else {
                echo "<script>alert('Incorrect Password!') </script>";
            }
        } else {
            echo "<script>alert('Username not found!')</script>";
        }
    }
    ?>
</body>

</html>