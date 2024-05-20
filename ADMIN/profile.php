<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <?php include 'navbar.php'; ?>
    <link rel="stylesheet" href="./STYLE/CSS/profile.css">

</head>

<body>
    <div class="main_content">
        <div class="header">
            <?php
            $sql = "SELECT * FROM account WHERE id = " . $_SESSION['id'];
            $info = mysqli_query($db, $sql);

            $res = mysqli_fetch_assoc($info);

            // if (mysqli_num_rows($info) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         echo "id: " . $row["id"] . " - Name: " . $row["name"] . " Email: " . $row["email"] . "<br>";
            //     }
            // } else {
            //     echo "0 results";
            // }
            ?>

            <div class="center">
                <div class="prof-container">
                    <div class="text">PROFILE UPDATE</div> <br>
                    <div class="row">
                        <div class="col1"><label for="name">NAME</label></div>
                        <div class="col2"><input type="text" id="name" value="<?php echo $res['name']; ?>"><br></div>
                    </div>
                    <div class="row">
                        <div class="col1"><label for="email">EMAIL</label></div>
                        <div class="col2"><input type="email" id="email" value="<?php echo $res['email']; ?>"><br></div>
                    </div>
                    <div class="row">
                        <div class="col1"><label for="username">USERNAME</label></div>
                        <div class="col2"><input type="text" id="username" value="<?php echo $res['username']; ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col1"><label for="password">PASSWORD</label></div>
                        <div class="col2"><input type="password" id="password"
                                value="<?php echo $res['password']; ?>"><br>
                        </div>
                    </div>

                    <div class="update">
                        <div class="butun"><button class="wiws">UPDATE</button></div>
                    </div>

                </div>
                <?php
                mysqli_close($db);
                ?>

                <!-- 

                <label for="email">EMAIL</label><br>
                <input type="text" for="email"><br>

                <label for="username">USERNAME</label><br>
                <input type="text" for="username"><br>

                <label for="password">PASSWORD</label>
                <input type="text" for="password"><br> -->










            </div>


        </div>
    </div>
    </div>
</body>

</html>