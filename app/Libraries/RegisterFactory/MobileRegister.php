<?php

namespace App\Libraries\RegisterFactory;

use App\Models\UserModel;

class MobileRegister{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function registerUser($credentials){
        
        $userPhone = $credentials->phone ?? null;
        $userName = $credentials->name ?? null;
        $userPassword = $credentials->password ?? null;
        $phoneExists = $this->userModel->getUserByPhone($userPhone);
        $validateCred = $this->validateCred($userPhone, $userName, $userPassword);

        if(!$validateCred){
            return ['status' => false, 'message' => lang('messages.mobile_registration_input_error')];
        }

        if($phoneExists){
            return ['status' => false, 'message' => lang('messages.mobile_duplicate_error')];
        }

        $hasedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        $registerStatus = $this->userModel->registerUserWithPhone($userPhone, $hasedPassword, $userName);

    
        if($registerStatus){
            return ['status' => true, 'message' => lang('messages.mobile_register_success')];
        }
        return ['status' => false, 'message' => lang('messages.mobile_register_error')];
    }

    public function validateCred($phone, $name, $password){

        if($phone == null || $name == null || $password == null){
            return false;
        }
        return true;
    }

}