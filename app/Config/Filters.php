<?php
// ===========================================
// FILE: app/Config/Filters.php
// Tambahkan konfigurasi filter
// ===========================================

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => \CodeIgniter\Filters\CSRF::class,
        'toolbar'       => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot'      => \CodeIgniter\Filters\Honeypot::class,
        'invalidchars'  => \CodeIgniter\Filters\InvalidChars::class,
        'secureheaders' => \CodeIgniter\Filters\SecureHeaders::class,
        'auth'          => \App\Filters\AuthFilter::class, // Auth filter kita
    ];

    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}
