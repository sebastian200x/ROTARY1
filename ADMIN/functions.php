<?php
require (__DIR__ . '/config.php');

function connect()
{
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    // Error checker
    if ($mysqli->connect_errno != 0) {
        // error retriever
        $error = $mysqli->connect_error;
        // Date of error
        $error_date = date("F j, Y, g:i a");
        // Error message with date
        $message = "{$error} | {$error_date} \r\n";
        // Put the error in db-log.txt
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        return false;
    } else {
        // Connection Successful
        $mysqli->set_charset("utf8mb4");
        return $mysqli;
    }
}

function login($username, $password)
{
    $mysqli = connect();
    if (!$mysqli) {
        return false;
    }
    $username = trim($username);
    $password = trim($password);
    if ($username == "" || $password == "") {
        return "Both fields are required";
    }
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $sql = "SELECT username, password, id FROM account WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL) {
        return "Username not recognized";
    }
    if (password_verify($password, $data["password"]) == FALSE) {
        return "Wrong password";
    } else {
        $id = $data["id"];
        $_SESSION["admin"] = $id;
        header("location: home.php");
        exit();
    }
}

function register($admin_user, $admin_pass, $name, $email, $username, $password, $confirm_password)
{
    // Establish a database connection.
    $mysqli = connect();
    // If there's an error in database the program will stop function
    if (!$mysqli) {
        return false;
    }

    // Trim whitespace from input values.
    $admin_user = trim($admin_user);
    $admin_pass = trim($admin_pass);
    $name = trim($name);
    $email = trim($email);
    $username = trim($username);
    $password = trim($password);
    $confirm_password = trim($confirm_password);

    // Check if any field is empty.
    $args = func_get_args();
    foreach ($args as $value) {
        if (empty($value)) {
            // If any field is empty, return an error message.
            return "All fields are required";
        }
    }
    // Check for disallowed characters (< and >).
    foreach ($args as $value) {
        if (preg_match("/([<|>])/", $value)) {
            // If disallowed characters are found, 
            // return an error message.
            return "< and > characters are not allowed";
        }
    }
    // Validate email format.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If email is not valid, return an error message.
        return "Email is not valid";
    }
    $admin_user = filter_var($admin_user, FILTER_SANITIZE_STRING);
    $admin_pass = filter_var($admin_pass, FILTER_SANITIZE_STRING);

    // Admin account checker
    $sql = "SELECT username, password FROM account WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $admin_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL) {
        return "Account not found";
    }
    if (password_verify($admin_pass, $data["password"]) == FALSE) {
        return "Wrong Admin Password";
    }
    // Check if the email already exists in the database.
    $stmt = $mysqli->prepare("SELECT email FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != NULL) {
        // If email already exists, return an error message.
        return "Email already exists";
    }
    // Check if the username is too long. 
    if (strlen($username) > 12) {
        // If username is too long, return an error message.
        return "Username must contain max 12 characters only";
    }
    // Check if the username already exists in the database.
    $stmt = $mysqli->prepare("SELECT username FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != NULL) {
        // If username already exists, return an error message.
        return "Username already exists, please use a different username";
    }
    // Check if the password is too long.
    if (strlen($password) < 8) {
        // If password is too long, return an error message.
        return "Password is too short, must be 8-24 characters";
    }
    if (strlen($password) > 24) {
        // If password is too long, return an error message.
        return "Password is too long, must be 8-24 characters ";
    }
    // Check if the passwords match.
    if ($password != $confirm_password) {
        // If passwords don't match, return an error message.
        return "Passwords doesn't match";
    }
    // Hash the password for security.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Insert user data into the 'account' table.
    $stmt = $mysqli->prepare("INSERT INTO account (username, password, email, name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $name);
    $stmt->execute();
    // Check if the insertion was successful.
    if ($stmt->affected_rows != 1) {
        // If an error occurred during insertion, return an error message.
        return "An error occurred. Please try again";
    } else {
        // If successful, return a success message.
        return "success";
    }
}