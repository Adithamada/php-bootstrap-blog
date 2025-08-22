<?php
require_once 'db.php';
session_start();

function generateUniqueUsername($name)
{
    global $conn;

    $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name));
    $username = $baseUsername;
    $i = 1;

    //Cek username
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");

    do {
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $username = $baseUsername . $i;
            $i++;
        } else {
            break;
        }
    } while (true);

    return $username;
}

function registerUser($name, $email, $password)
{
    global $conn;

    $name = trim(mysqli_real_escape_string($conn, $name));
    $email = trim(mysqli_real_escape_string($conn, $email));
    $password = trim($password);

    // Cek email
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $resultEmail = $checkEmail->get_result();
    if ($resultEmail->num_rows > 0) {
        $_SESSION['error'] = "Email sudah digunakan.";
        return false;
    }

    $username = generateUniqueUsername($name);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, created_at) VALUES (?,?,?,?, NOW())");
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);
    
    if($stmt->execute()){
        $_SESSION['success']="Registration success.";
        return true;
    } else {
        $_SESSION['error']="Registration failed.";
        return false;
    }
}

