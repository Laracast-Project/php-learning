<?php

if (isset($_SESSION['user']) && $_SESSION['user']){
    header('Location: /');
    exit();
}

view('registration/create.view.php');