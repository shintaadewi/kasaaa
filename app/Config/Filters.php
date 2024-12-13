<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things cleaner and simpler.
     */
    public $aliases = [
        'csrf'  => \CodeIgniter\Filters\CSRF::class,
        'debug' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth'  => \App\Filters\AuthFilter::class, // Tambahkan AuthFilter di sini
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public $globals = [
        'before' => [
            // 'csrf',
        ],
        'after' => [
            'debug',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     */
    public $filters = [
        // Aktifkan AuthFilter untuk rute-rute tertentu
        'auth' => [
            'before' => [
                'dashboard/*',  // Semua rute di bawah 'dashboard/' membutuhkan autentikasi
                'dashboard',    // Rute 'dashboard' membutuhkan autentikasi
            ],
        ],
    ];
}
