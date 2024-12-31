<?php

namespace App\Controllers;
use App\Libraries\LoginFactory\LoginFactoryModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController extends BaseController {

    public function verifyUser() {

        $value = $this->request->getJSON();
        $type = $value->type ?? null;

        if ($type === null) {
            return $this->response->setJSON(['status' => false, 'message' => lang('messages.login_type_error')]);
        }

        $loginFactory = new LoginFactoryModel();
        $verifyLogin = $loginFactory->loginMethod($type);
        $loginResult = $verifyLogin->loginUser($value);

        if ($loginResult['status']) {

            $jwt = $this->generateJWTTOKEN($loginResult['userData']);

            return $this->response->setJSON([
                'status' => true,
                'message' => lang('messages.login_success'),
                'token' => $jwt
            ]);
        }
        
        return $this->response->setJSON(['status' => false, 'message' => $loginResult['message']]);
    }

    public function generateJWTTOKEN($data){

        $key = JWT_SECRET_KEY;
            $payload = [
                'email' => $data,
                'iat' => time(),
                'exp' => time() + 3600
            ];
        $jwt = JWT::encode($payload, $key, 'HS256'); 

        return $jwt;
    }

}
