<?php

namespace App\Libraries\LoginFactory;
use App\Models\UserModel;

class EmailLogin{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function loginUser($credentials){

        $userEmail = $credentials->email ?? null;
        $userPassword = trim($credentials->password ?? null);

        $validateCred =  $this->validateUserEmailAndPassword($userEmail, $userPassword);

        if(!$validateCred){
            return ['status' => false, 'message' => lang('messages.email_input_error')];
        }

        $getInfo = $this->userModel->getUserbyEmail($userEmail);

        if($getInfo){

            $storedPassword = $getInfo['password'];

            if (password_verify($userPassword, $storedPassword)){
                return ['status' => true, 'message' => lang('messages.email_login_success'), 'userData' => $getInfo['name']];
            }
            else{
                return ['status' => false, 'message' =>  lang('messages.email_login_password_error')];
            }
        }
        else{
            return ['status' => false, 'message' =>  lang('messages.email_does_not_exists')];
        }

    }

    public function validateUserEmailAndPassword($userEmail, $userPassword){

        if($userEmail == null || $userPassword == null)
        {
            return false;
        }
        return true;

    }
}