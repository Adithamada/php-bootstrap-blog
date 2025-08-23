<?php

function validateRegisterInput($name, $email, $password)
{
    $errors = [];

    //Nama
    if (empty(trim($name))) {
        $errors[] = "Name is required!";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters!";
    }

    if (empty(trim($email))) {
        $errors[] = "Name is required!";
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
