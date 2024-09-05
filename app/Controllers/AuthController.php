<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;

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

        // get roles and permissions
        $roleModel = new Role();
        $role = $roleModel->find($user['role_id']);
        $permissions = json_decode($role['permission'], true);

        // Store session data
        $session_id = session_create_id();
        $session->set([
            'id' => $session_id,
            'user_id' => $user['id'],
            'role_id' => $user['role_id'],
            'permissions' => $permissions,
            'instance_id' => $user['instance_id'],
        ]);

        $userModel->update($user['id'], [
            'session' => $session_id,
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);

        // Store session data in cache
        $cache = \Config\Services::cache();
        $cacheKey = 'session_' . $user['id'];
        $cache->save($cacheKey, [
            'session_id' => $session_id,
        ], 3600); // seconds

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $userModel = new User();
        $userModel->update(session()->get('user_id'), ['session' => null]);

        session()->destroy();

        $cache = \Config\Services::cache();
        $cacheKey = 'session_' . session()->get('user_id');
        $cache->delete($cacheKey);

        return redirect()->to('/login');
    }
}
