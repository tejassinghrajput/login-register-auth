<?php

namespace App\Controllers;
use App\Libraries\RegisterFactory\RegisterFactoryModel;

class RegisterController extends BaseController {

    public function registerUser(){

        $value = $this->request->getJSON();
        $type = $value->type ?? null;
        
        if($type === null){
            return $this->response->setJSON(['status' => false, 'message' => lang('messages.registration_type_error')]);
        }

        $registerObj = new RegisterFactoryModel();
        $typeObj = $registerObj->registrationMethod($type);
        $registrationStatus = $typeObj->registerUser( $value);

        return $this->response->setJSON(['status' => $registrationStatus['status'], 'message' => $registrationStatus['message']]);
    }


}
