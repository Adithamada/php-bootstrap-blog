<?php
require_once 'db.php';

//AUTH

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
        return [
            'status' => false,
            'error' => "Email already use.",
        ];
    }

    $username = generateUniqueUsername($name);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, created_at) VALUES (?,?,?,?, NOW())");
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        return ['status' => true];
    } else {
        return
            [
                'status' => false,
                'error' => "Registration failed! Please try again."
            ];
    }
}

function loginUser($username, $password)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return [
                'status' => true,
                'user' => $user,
            ];
        } else {
            return [
                'status' => false,
                'error' => "Incorrect password!"
            ];
        }
    } else {
        return [
            'status' => false,
            'error' => "Username not found!"
        ];
    }
}

function redirectIfNotLogged(){
    if(!isset($_SESSION['name'])){
        header("Location: /../../views/auth/login.php");
        exit;
    }
}

function redirectIfLogged(){
    if(isset($_SESSION['name'])){
        header("Location: /../../views/dashboard/");
        exit;
    }
}

// AUTH