<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Validate the form inputs
$errors = [];

if (!Validator::email($email)){
    $errors['email'] = 'please provide a valid email address';
}

if (!Validator::string($password, 7, 255 )){
    $errors['password'] = 'please provide a password of at least  7 characters';
}

if (! empty($errors)){
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$db = App::resolve(Database::class);
// Check if user account already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


if ($user){
    // Someone with that email already exist
    // if yes, redirect to login page
    header('Location: /login');
    exit();
}else{
    // If No, Save one to the database then log the user in and redirect
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);

    //mark user as logged in
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('Location: /');
    exit();
}
