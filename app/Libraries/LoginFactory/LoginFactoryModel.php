<?php

namespace App\Libraries\LoginFactory;

use App\Libraries\LoginFactory\MobileLogin;
use App\Libraries\LoginFactory\EmailLogin;

class LoginFactoryModel
{
    public function loginMethod($type)
    {
        switch ($type) {
            case 'phone':
                if (PHONE_LOGIN_STATUS === 1) {
                    return new MobileLogin();
                } else {
                    throw new \Exception("Phone Login Not Available");
                }

            case 'email':
                if (EMAIL_LOGIN_STATUS === 1) {
                    return new EmailLogin();
                } else {
                    throw new \Exception("Email Login Not Available");
                }

            default:
                throw new \Exception("Unknown Login Type");
        }
    }
}
