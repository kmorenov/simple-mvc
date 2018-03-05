<?php

namespace Model;

use Core\Model;

class User extends Model
{
    protected static $table = 'users';

    public function findByUsername($username) {
        $user = $this->findBy(['login' => $username], 1);
        if (!empty($user)) {
            return $user[0];
        }
    }

    public function findOneByToken($username) {
        $user = $this->findBy(['confirmation_token' => $username], 1);
        if (!empty($user)) {
            return $user[0];
        }
        return false;
    }

}
