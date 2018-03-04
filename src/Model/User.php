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
}
