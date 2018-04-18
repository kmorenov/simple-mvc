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
        $token = \md5(uniqid());
        $createStatus = User::create([
            'login' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'confirmation_token' => $token
        ]);

        if($createStatus){
            $confirmLink = $_SERVER['HTTP_HOST'].'/confirm/'.$token;
            $massage = '<a href="'.$confirmLink.'">'.'Confirm User '.$email.'</a>';
            mail($email, 'Confirm Email', $massage);
        }
        return $createStatus;
    }
    
}