<?php include '../db.php';
if (!isset($_SESSION['id'])) {
    ?>
    <script type="text/javascript">
        window.alert("You're not logged in. Redirecting...")
        window.location = "./index.php";
    </script>
    <?php
}
?>


<link rel="stylesheet" href="./STYLE/CSS/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="nav">
    <div class="lagayan">
        <h1 style="color: #D9DCDA;">ROTARY</h1>
        <h1 style="color: #545454;">E-CLUB OF ALL STAR CAMANAVA</h1>
    </div>
</div>
<div class="wrapper">
    <div class="sidebar">
        <div class="imgcontainer">
            <img src="logo-whitebg.png" alt="Avatar" class="logo">
        </div>
        <ul>
            <li><a href="./media.php">MEDIA</a></li>
            <li><a href="./bulletin.php">BULLETIN</a></li>
            <li><a href="./events.php">EVENTS</a></li>

        </ul>
        <div class="flex">

            <a href="./profile.php" class="right">PROFILE</a>

            <a href="./logout.php" class="right">LOGOUT</a>

        </div>
    </div>
    <!-- <div class="main_content">
            <div class="header">Welcome!! Have a nice day.</div>
            <div class="info">o

            </div>
        </div> -->