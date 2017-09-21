<?php

namespace Core;

use Model\User;

class Auth {

    private static $user;
    
    public function __construct() {
        if (isset($_SESSION['user'])) {
            self::$user = User::findOneBy(['username' => $_SESSION['user']]);
        }
    }

    public static function user()
    {
        return self::$user;
    }
    
    public static function login($username)
    {
        $_SESSION['user'] = $username;
    }
    
    public static function logout()
    {
        unset($_SESSION['user']);
    }

}