<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getAllAdmins()
    {
        return User::where('role', User::ROLE_ADMIN)->get();
    }

    public static function getAllUsers()
    {
        return User::where('role', User::ROLE_USER)->get();
}
}