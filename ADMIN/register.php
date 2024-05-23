<html lang="en">

<head>
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
                }
                if (isset($_POST['cancel'])) {
                    header("location: ./index.php");
                }
                ?>
                <form action="" method="post" autocomplete="off">
                    <label class="left" for="name"><b>Full Name</b></label> <br>
                    <input type="text" placeholder="Enter Name" name="name" required>
                    <br>

                    <label class="left" for="email"><b>Email</b></label> <br>
                    <input type="text" placeholder="Email Address" name="email" required>
                    <br>

                    <label class="left" for="uname"><b>Username</b></label> <br>
                    <input type="text" placeholder="Enter Username" name="uname" required>
                    <br>
                    <label class="left" for="psw"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <br><br>
                    <div class="flex-container">
                        <div><input type="submit" class="button" value="Register" name="register"></div>
                        <br>
                    </div>
                </form>
                <form action="" method="post" autocomplete="off">
                    <div class="flex-container">
                        <div><input type="submit" class="button" value="Cancel" name="cancel"></div>
                        <br>
                </form>
            </div><br><br>

            <div class="">
            </div>

        </div>

    </div>

</body>

</html>