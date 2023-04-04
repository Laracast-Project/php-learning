<?php

namespace Core\Middleware;
class Guest
{
    public function handle()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header('Location: /');
            exit();
        }
    }
}