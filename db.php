<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "rotary");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}