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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./STYLE/CSS/register.css">
    <title>Register</title>
</head>

<body>
    <div class="regcontainer">
        <div class="reg-centered">

            <div class="imgcontainer">
                <h1 style="color: #D9DCDA;margin-bottom: 7px;">ROTARY </h1>
                <h1 style="color: #545454;">ADMIN REGISTER</h1> <br> <br>
                <img src="logo-whitebg.png" alt="Avatar" class="logo"> <br> <br>
            </div>
            <div class="container1">
                <?php
                if (isset($_POST['register'])) {
                    $response = register($_POST['olduser'], $_POST['oldpass'], $_POST['name'], $_POST['email'], $_POST['user'], $_POST['pass'], $_POST['confirm']);

                    if (@$response == "success") {
                        ?>
                        <p class="success"><i class="fas fa-check"></i> Your registration was successful</p>
                        <?php
                        $_POST['admin_pass'] = '';
                        $_POST['name'] = '';
                        $_POST['email'] = '';
                        $_POST['username'] = '';
                        $_POST['password'] = '';
                        $_POST['confirm-password'] = '';
                    } else if (@$response == false) {
                        ?>
                            <p class="error">
                            <?php echo '<i class="fas fa-times"></i> Database error, Please contact administrator' ?>
                            </p>
                        <?php
                    } else {
                        ?>
                            <p class="error">
                            <?php echo '<i class="fas fa-times"></i> ' . @$response; ?>
                            </p>
                        <?php
                    }

                }
                if (isset($_POST['cancel'])) {
                    header("location: ./index.php");
                }
                ?>
                <form action="" method="post" autocomplete="off">
                    <h3>Existing Account:</h3>
                    <label class="left" for="name"><b>Existing Username</b></label> <br>
                    <input type="text" placeholder="Existing Username" name="olduser" required>
                    <br>

                    <label class="left" for="email"><b>Existing Password</b></label> <br>
                    <input type="text" placeholder="Existing Password" name="oldpass" required>
                    <br>

                    <label class="left" for="name"><b>Full Name</b></label> <br>
                    <input type="text" placeholder="Enter Name" name="name" required>
                    <br>

                    <label class="left" for="email"><b>Email</b></label> <br>
                    <input type="email" placeholder="Email Address" name="email" required>
                    <br>

                    <label class="left" for="uname"><b>Username</b></label> <br>
                    <input type="text" placeholder="Enter Username" name="user" required>
                    <br>
                    <label class="left" for="psw"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="pass" required>
                    <br>
                    <label class="left" for="psw"><b>Confirm Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="confirm" required>
                    <br>
                    <br>
                    <div class="flex-container">
                        <div><input type="submit" class="button" value="Register" name="register"></div>
                    </div>
                </form>
                <form action="" method="post" autocomplete="off">
                    <div class="flex-container">
                        <div><input type="submit" class="button" value="Cancel" name="cancel"></div>
                </form>
            </div><br><br>

            <div class="">
            </div>

        </div>

    </div>

</body>

</html>