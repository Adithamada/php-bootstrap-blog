<?php

function validateRegisterInput($name, $email, $password)
{
    $errors = [];

    if(empty(trim($name)) && empty(trim($email)) && empty(trim($password))){
        $errors[]="All field required!";
        return $errors;
    }
    if (empty(trim($name))) {
        $errors[] = "Name is required!";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters!";
    }

    if (empty(trim($email))) {
        $errors[] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    }

    if (empty(trim($password))) {
        $errors[] = "Password is required!";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters!";
    }

    return $errors;
}

function validateLoginInput($username, $password){

    $errors = [];

    if(empty(trim($username)) && empty(trim($password))){
        $errors[]="All field required!";
        return $errors;
    }

    if (empty(trim($username))) {
        $errors[] = "Username is required!";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters!";
    }

    if (empty(trim($password))) {
        $errors[] = "Password is required!";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters!";
    }
    return $errors;
}
