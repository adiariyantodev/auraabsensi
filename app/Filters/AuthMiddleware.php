<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('id') || !$session->get('user_id')) {
            return redirect()->to('/login')->with('error', 'Session invalid.');
        }

        $cache = \Config\Services::cache();
        $cacheKey = 'session_' . $session->get('user_id');
        $cacheData = $cache->get($cacheKey);

        if ($cacheData) {
            // cache validation
            if ($cacheData['session_id'] != $session->get('id')) {
                return redirect()->to('/login')->with('error', 'Session invalid.');
            }
        } else {
            // query validation
            $userModel = new \App\Models\User();
            $user = $userModel->where('id', $session->get('user_id'))
                ->where('session', $session->get('id'))
                ->first();

            if (!$user) {
                return redirect()->to('/login')->with('error', 'Session invalid.');
            }

            $cache->save($cacheKey, [
                'session_id' => $session->get('id'),
            ], 3600); // seconds
        }

        if ($arguments) {
            $permissions = $session->get('permissions');
            if (!array_intersect($arguments, $permissions)) {
                return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
