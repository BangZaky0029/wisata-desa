<?php

// ===========================================
// FILE: app/Config/Routes.php
// ===========================================

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// ===========================================
// AUTH ROUTES
// ===========================================
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::loginProcess');
    $routes->get('logout', 'Auth::logout');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::registerProcess');
    $routes->get('forgot-password', 'Auth::forgotPassword');
});

// ===========================================
// ADMIN ROUTES (Protected by Auth Filter)
// ===========================================
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('profile', 'Admin\Dashboard::profile');
    $routes->post('profile/update', 'Admin\Dashboard::updateProfile');
    $routes->post('profile/change-password', 'Admin\Dashboard::changePassword');
    
    // Wisata CRUD
    $routes->group('wisata', function($routes) {
        $routes->get('', 'Admin\Wisata::index');
        $routes->get('create', 'Admin\Wisata::create');
        $routes->post('store', 'Admin\Wisata::store');
        $routes->get('show/(:num)', 'Admin\Wisata::show/$1');
        $routes->get('edit/(:num)', 'Admin\Wisata::edit/$1');
        $routes->post('update/(:num)', 'Admin\Wisata::update/$1');
        $routes->get('delete/(:num)', 'Admin\Wisata::delete/$1');
        $routes->post('toggle-status/(:num)', 'Admin\Wisata::toggleStatus/$1');
    });
    
    // Event CRUD
    $routes->group('event', function($routes) {
        $routes->get('', 'Admin\Event::index');
        $routes->get('create', 'Admin\Event::create');
        $routes->post('store', 'Admin\Event::store');
        $routes->get('edit/(:num)', 'Admin\Event::edit/$1');
        $routes->post('update/(:num)', 'Admin\Event::update/$1');
        $routes->get('delete/(:num)', 'Admin\Event::delete/$1');
    });
    
    // Paket Wisata CRUD
    $routes->group('paket', function($routes) {
        $routes->get('', 'Admin\Paket::index');
        $routes->get('create', 'Admin\Paket::create');
        $routes->post('store', 'Admin\Paket::store');
        $routes->get('edit/(:num)', 'Admin\Paket::edit/$1');
        $routes->post('update/(:num)', 'Admin\Paket::update/$1');
        $routes->get('delete/(:num)', 'Admin\Paket::delete/$1');
    });
    
    // UMKM CRUD
    $routes->group('umkm', function($routes) {
        $routes->get('', 'Admin\Umkm::index');
        $routes->get('create', 'Admin\Umkm::create');
        $routes->post('store', 'Admin\Umkm::store');
        $routes->get('edit/(:num)', 'Admin\Umkm::edit/$1');
        $routes->post('update/(:num)', 'Admin\Umkm::update/$1');
        $routes->get('delete/(:num)', 'Admin\Umkm::delete/$1');
    });
    
    // Galeri CRUD
    $routes->group('galeri', function($routes) {
        $routes->get('', 'Admin\Galeri::index');
        $routes->get('create', 'Admin\Galeri::create');
        $routes->post('store', 'Admin\Galeri::store');
        $routes->get('edit/(:num)', 'Admin\Galeri::edit/$1');
        $routes->post('update/(:num)', 'Admin\Galeri::update/$1');
        $routes->get('delete/(:num)', 'Admin\Galeri::delete/$1');
    });
    
    // Berita CRUD (Bonus)
    $routes->group('berita', function($routes) {
        $routes->get('', 'Admin\Berita::index');
        $routes->get('create', 'Admin\Berita::create');
        $routes->post('store', 'Admin\Berita::store');
        $routes->get('edit/(:num)', 'Admin\Berita::edit/$1');
        $routes->post('update/(:num)', 'Admin\Berita::update/$1');
        $routes->get('delete/(:num)', 'Admin\Berita::delete/$1');
    });
    
    // User Management (Admin Only)
    $routes->group('users', ['filter' => 'auth:admin'], function($routes) {
        $routes->get('', 'Admin\Users::index');
        $routes->get('create', 'Admin\Users::create');
        $routes->post('store', 'Admin\Users::store');
        $routes->get('edit/(:num)', 'Admin\Users::edit/$1');
        $routes->post('update/(:num)', 'Admin\Users::update/$1');
        $routes->get('delete/(:num)', 'Admin\Users::delete/$1');
    });
});

// ===========================================
// FRONTEND PUBLIC ROUTES
// ===========================================
$routes->group('', function($routes) {
    // Wisata
    $routes->get('wisata', 'Frontend\Wisata::index');
    $routes->get('wisata/(:segment)', 'Frontend\Wisata::detail/$1');
    
    // Event
    $routes->get('event', 'Frontend\Event::index');
    $routes->get('event/(:segment)', 'Frontend\Event::detail/$1');
    
    // Paket Wisata
    $routes->get('paket', 'Frontend\Paket::index');
    $routes->get('paket/(:segment)', 'Frontend\Paket::detail/$1');
    
    // UMKM
    $routes->get('umkm', 'Frontend\Umkm::index');
    $routes->get('umkm/(:segment)', 'Frontend\Umkm::detail/$1');
    
    // Galeri
    $routes->get('galeri', 'Frontend\Galeri::index');
    
    // Berita
    $routes->get('berita', 'Frontend\Berita::index');
    $routes->get('berita/(:segment)', 'Frontend\Berita::detail/$1');
    
    // Tentang & Kontak
    $routes->get('tentang', 'Frontend\Page::tentang');
    $routes->get('kontak', 'Frontend\Page::kontak');
});