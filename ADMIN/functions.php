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
    // Establish a database connection.
    $mysqli = connect();
    // If there's an error in database the program will stop function
    if (!$mysqli) {
        return false;
    }
    // Trim leading and trailing whitespaces 
    // from username and password.
    $username = trim($username);
    $password = trim($password);
    // Check if either username or password is empty.
    if ($username == "" || $password == "") {
        return "Both fields are required";
    }
    // Sanitize username and password to prevent SQL injection.
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    // Prepare SQL statement to select username 
    // and password from account table.
    $sql = "SELECT username, password, id FROM account WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    // Bind the username parameter to the prepared statement.
    $stmt->bind_param("s", $username);
    // Execute the prepared statement to query the database.
    $stmt->execute();
    // Get the result set from the executed statement.
    $result = $stmt->get_result();
    // Fetch the associative array representing the first row of the result set.
    $data = $result->fetch_assoc();
    // Check if the username exists in the database.
    if ($data == NULL) {
        return "Username not recognized";
    }
    // Verify the provided password against the 
    // hashed password in the database.
    if (password_verify($password, $data["password"]) == FALSE) {
        return "Wrong password";
    } else {
        // If authentication is successful, 
        // set the user session and redirect to account page.
        $id = $data["id"];
        $_SESSION["admin"] = $id;
        header("location: home.php");
        exit();
    }
}