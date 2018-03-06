<?php

namespace Controller;

use Core\Controller;
use Core\Auth;
use Model\User;

class AuthController extends Controller
{
    public function loginForm()
    {       
        return $this->render('Auth/login', [], 'layout');
    }

    public function loginCheck()
    {
        $model = $this->getModel('User');
        $user = $model->findByUsername($this->post('email'));
        
        if (!$user) {
            $this->addFlash('authError', 'User ' . $this->post('email') . ' does not exist!');
            return $this->redirect('loginForm');
        }

        if($user['confirmation_token']){
            $this->addFlash('authError', 'Confirm your email!');
            return $this->redirect('loginForm');
        }

        if (\password_verify($this->post('password'), $user['password'])) {
            Auth::login($user);
            return $this->redirect('profile');
        }


        
        $this->addFlash('authError', 'The email or password is incorrect.');
        return $this->redirect('loginForm');
    }

    public function registerForm()
    {       
        return $this->render('Auth/register', [], 'layout');
    }
    
    public function register()
    {       
        $model = $this->getModel('User');
        $user = $model->findByUsername($this->post('email'));
        
        if ($user) {
            $this->addFlash('registerError', 'User with email ' . $this->post('email') . ' already exist!');
            return $this->redirect('registerForm');
        }

        if ($this->post('password') !== $this->post('password2')) {
            $this->addFlash('registerError', 'Password does not match the confirm password!');
            return $this->redirect('registerForm');
        }

        $createStatus = Auth::register($this->post('email'), $this->post('password'));
        if($createStatus){
            $this->addFlash('registerSuccess', $this->post('email'));
        }
        return $this->redirect('confirmEmail');
    }
    
    public function logout()
    {
        Auth::logout();
        return $this->redirect('loginForm');
    }


    public function confirm($token){
        $model = $this->getModel('User');
        $user = $model->findOneByToken($token);
        if($user){
            $user['confirmation_token'] = null;
            $model->update($user['id'], ['confirmation_token'=>null]);
            Auth::login($user);
            return $this->render('Auth/confirmSuccess', ['confirmSuccess'=>true], 'layout');
        }

        return $this->render('Auth/confirmSuccess', ['confirmSuccess'=>false], 'layout');
    }

    public function confirmEmail(){
        return $this->render('Auth/confirmEmail', [], 'layout');
    }
}
