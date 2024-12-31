<?php

namespace App\Libraries\RegisterFactory;
use App\Models\UserModel;

class EmailRegister{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function registerUser($credentials){
        
        $userEmail = $credentials->email ?? null;
        $userPassword = $credentials->password ?? null;
        $userName = $credentials->name ?? null;
        $emailExists = $this->userModel->getUserbyEmail($userEmail);
        $validateCred = $this->validateCred($userEmail, $userName, $userPassword);

        if(!$validateCred){
            return ['status' => false, 'message' => lang('messages.email_registration_input_error')];
        }
        
        if($emailExists){
            return ['status' => false, 'message' => lang('messages.email_register_duplicate_error')];
        }

        $hasedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        $registerStatus = $this->userModel->registerUserWithEmail($userEmail, $hasedPassword, $userName);

        if($registerStatus){
            return ['status' => true, 'message' => lang('messages.email_register_success')];
        }
        return ['status' => false, 'message' => lang('messages.email_register_error')];
    }

    public function validateCred($email, $name, $password){

        if($email == null || $name == null || $password == null){
            return false;
        }
        return true;
    }
}