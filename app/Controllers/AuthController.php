<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        $data['title'] = 'Login';
        return view('pages/login', $data);
    }

    public function attempt()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Example user model; replace with your actual user model and logic
        $userModel = new User();
        $user = $userModel->where('email', $username)
            ->orWhere('phone', $username)
            ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            $session->setFlashdata('error', 'username atau password salah');
            return redirect()->back()->withInput();
        }

        $session_id = session_create_id();
        $session->set([
            'id' => $session_id,
            'name' => $user['name'],
        ]);

        $userModel->update($user['id'], [
            'session' => $session_id,
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
