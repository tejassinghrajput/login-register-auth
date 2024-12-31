<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    
    public function getUserbyEmail($email){
        return $this->db->query("SELECT * FROM users WHERE email = '$email'")->getRowArray();
    }

    public function registerUserWithEmail($userEmail, $userPassword, $userName){
        return $this->db->query("INSERT INTO users (email , password, name) VALUES ('$userEmail', '$userPassword', '$userName')");
    }

    public function getUserByPhone($userPhone){
        return $this->db->query("SELECT * FROM users WHERE phone = '$userPhone'")->getRowArray();
    }

    public function registerUserWithPhone($userPhone, $hasedPassword, $userName){
        return $this->db->query("INSERT INTO users (phone , password, name) VALUES ('$userPhone', '$hasedPassword', '$userName')");
    }

}
