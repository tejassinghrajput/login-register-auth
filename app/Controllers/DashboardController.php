<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller{

    public function index(){
        
        $request = service('request');
        $userData = $request->userData ?? null;

        if ($userData) {
            return $this->response
                ->setJSON(['message' => 'Welcome!', 'user' => $userData]);
        }
        return $this->response
            ->setJSON(['message' => 'No user data found']);
    }
}
