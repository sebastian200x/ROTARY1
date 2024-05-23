<?php
include './functions.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container2">
        <div class="centered">
            <form action="" method="post" autocomplete="off">
                <div class="imgcontainer">
                    <img src="./STYLE/IMAGE/img_avatar2.png" alt="Avatar" class="avatar">
                    <br><br><br>
                    <h1 style="color: #D9DCDA; margin-bottom: 5px;">ROTARY </h1>
                    <h1 style="color: #545454;">ADMIN LOGIN</h1>
                </div>

                <br><br><br><br>
                <div class="container3">
                    <p class="error">
                        <?php
                        if (isset($_POST['login'])) {
                            $response = login($_POST['username'], $_POST['password']);
                            if (@$response == false) { ?>
                            <p class="error">
                                <?php echo '<i class="fas fa-times"></i> Database error, Please contact administrator' ?>
                            </p>
                        <?php } else { ?>
                            <p class="error">
                                <?php echo '<i class="fas fa-times"></i> ' . @$response; ?>
                            </p>
                            <?php
                            }
                        }
                        if (isset($_POST['register'])) {
                            header("location: ./register.php");
                        }
                        ?>
                    </p>
                    <label class="left" for="uname"><b>Username</b></label> <br>
                    <input type="text" placeholder="Enter Username" name="username" id="uname" required
                        value="<?php echo @$_POST['username']; ?>">
                    <br>
                    <label class="left" for="psw"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required
                        value="<?php echo @$_POST['password']; ?>">
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
                <div>
                    <form action="" method="post" autocomplete="off">
                        <input class="button" type="submit" value="Register" name="register">
                    </form>
                </div>
                <br>
            </div>
            <div class="span"><span class="psw">Forgot <a href="#">password?</a></span></div>
        </div>

    </div>

    <div class="container4"><img class="image" src="./STYLE/IMAGE/rotary.png" alt="logo"></div>
</body>

</html>