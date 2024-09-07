<?php

namespace App\Filters;

use App\Models\Menu;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $permissions = session()->get('permissions');

        // validate by arguments
        if ($arguments) {
            if (!array_intersect($arguments, $permissions)) {
                return redirect()->back()->with('error', 'You do not have permission to access this page. Code P0');
            }
            return;
        }

        // get all menus
        $cache = \Config\Services::cache();
        $cacheMenus = $cache->get('menus');
        if (!$cacheMenus) {
            $menuModel = new Menu();
            $menus = $menuModel->select('name, url, icon, permission')->findAll();
            $cache->save('menus', $menus, 3600); // seconds
            $cacheMenus = $menus;
        }

        // get user menus basde on url and permissions
        $url = substr($request->getUri()->getPath(), 1);
        $accessedMenu = false;
        foreach ($cacheMenus as $key => $menu) {
            if ($menu['url'] == $url) {
                $accessedMenu = $key;
                break;
            }
        }

        if ($accessedMenu === false) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page. Code P1');
        }

        $menuPermissions = json_decode($cacheMenus[$accessedMenu]['permission'], true);
        if (!array_intersect($menuPermissions, $permissions)) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page. Code P2');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
