<?php

namespace de\xovatec\linkify\Services;

use de\xovatec\linkify\Models\User;

class UserService
{

    public function getSessionUser(): User
    {
        return User::first();
    }

}
