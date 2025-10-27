<?php

namespace App\Validation;

use App\Libraries\CiAuth;
use App\Libraries\Hash;
use App\Models\User;

class IsCurrentPasswordCorrect
{
    public function check_current_password($password): bool
    {
        $password = trim($password);
        $user_id = CiAuth::id();
        $user = new User();
        $user_info = $user->asObject()->where('id', $user_id)->first();

        if (!Hash::check($password, $user_info->password)) {
            return false;
        }
        return true;
    }
}
