<?php

namespace Core;

use Model\User;

class Auth {

    private static $user;

    public static function user()
    {
        if (self::$user) {
            return self::$user;
        }
        
        if (isset($_SESSION['authorizedUser'])) {
            self::$user = User::find($_SESSION['authorizedUser']);
        }
        
        return self::$user;
    }
    
    public static function login($user)
    {
        $_SESSION['authorizedUser'] = (int)$user['id'];
    }
    
    public static function logout()
    {
        unset($_SESSION['authorizedUser']);
    }

    public static function register($email, $password)
    {
        User::create([
            'login' => $email,
            'password' => \md5($password),
            'confirmation_token' => \md5(uniqid())
        ]);
    }
    
}