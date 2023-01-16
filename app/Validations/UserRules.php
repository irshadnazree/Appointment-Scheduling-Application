<?php
namespace App\Validations;
use App\Models\UserModel; 

class UserRules
{
    public function validateUser(string $str, string $fields, array $data) : bool
    {
        $model = new UserModel();
        $user = $model->where('email', $data['email'])->first();

        if(!$user)
        return false;

        return password_verify($data['password'], $user['password']);
    }

    public function is_exist($email): bool
    {
        $model = new UserModel();
        $checkExist = $model->checkEmailExist($email);
        $user = $model->where('email', $email)->first();

        if($checkExist)
            return true;
        elseif($user)
            return false;
        return true;
    }
}