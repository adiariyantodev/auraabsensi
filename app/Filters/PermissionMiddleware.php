<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $permissions = session()->get('permissions');

        if ($arguments[0] == 'segment' && $arguments[1] != null) {
            $validUri1 = $arguments[1] == $request->getUri()->getSegment(1);
            $validSegment = in_array($request->getUri()->getSegment(2), $permissions);

            if (!$validUri1 || !$validSegment) {
                return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page.');
            }
        } elseif (!array_intersect($arguments, $permissions)) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
