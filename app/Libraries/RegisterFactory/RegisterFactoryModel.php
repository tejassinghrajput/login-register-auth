<?php

namespace App\Libraries\RegisterFactory;
use App\Libraries\RegisterFactory\EmailRegister;
use App\Libraries\RegisterFactory\MobileRegister;


class RegisterFactoryModel{

    public function registrationMethod($type){

        switch($type){
            
            case 'email':

                if(EMAIL_REGISTRATION_STATUS === 1){
                    return new EmailRegister();
                } else {
                    throw new \Exception('Registration Method Not Available');
                }
            
            case 'phone':
                
                if(PHONE_REGISTRATION_STATUS === 1){
                    return new MobileRegister();
                } else {
                    throw new \Exception('Registration Method Not Available');
                }
            default:
                return throw new \Exception('Registration Method Not Available');
        }
    }
}