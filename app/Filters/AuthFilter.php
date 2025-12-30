<?php
// ===========================================
// FILE: app/Filters/AuthFilter.php
// ===========================================

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Check role if specified
        if ($arguments) {
            $userRole = session()->get('role');
            
            if (!in_array($userRole, $arguments)) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
