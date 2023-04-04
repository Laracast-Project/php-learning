<?php



use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$email = $_POST['email'];
$password = $_POST['password'];

// Validate the form inputs
$errors = [];

if (!Validator::email($email)){
    $errors['email'] = 'please provide a valid email address';
}

if (!Validator::string($password, 7, 255 )){
    $errors['password'] = 'please provide a valid password';
}

if (! empty($errors)){
    return view('sessions/create.view.php', [
        'errors' => $errors
    ]);
}

// Match the credentials
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user){
    if (password_verify($password, $user['password'])){
        login([
            'email' => $email
        ]);

        header('Location: /');
        exit();
    }
}


return view('sessions/create.view.php', [
    'errors' => [
        'email' => 'No matching account find for that email address and password'
    ]
]);