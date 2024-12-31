<?php

namespace App\Libraries\LoginFactory;
use App\Models\UserModel;

class MobileLogin{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function loginUser($credentials){

        $userPhone = $credentials->phone ?? null;
        $userOtp = $credentials->otp ?? null;
        $getInfo = $this->userModel->getUserByPhone($userPhone);
        $validateCred = $this->validateCred($userOtp, $userPhone);

        if(!$validateCred){
            return ['status' => false, 'message' => lang('messages.mobile_login_input_error')];
        }

        if(!empty($getInfo)){
            if($this->verifyOtp($userOtp)){
                return ['status' => true, 'message' => lang('messages.mobile_login_success'), 'userData' => $getInfo['name']];
            }
            else{
                return ['status' => false, 'message' => lang('messages.mobile_login_otp_error')];
            }
        }
        else{
            return ['status' => false, 'message' => lang('messages.mobile_does_not_exists')];
        }

    }

    public function verifyOtp($otp){
        return true;
    }

    public function validateCred($otp, $userPhone){
        
        if($otp == null || $userPhone == null){
            return false;
        }
    }
}