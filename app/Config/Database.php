<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [];
    public array $tests   = [];

    public function __construct()
    {
        parent::__construct();

        // Konfigurasi default
        $this->default = [
            'DSN'          => '',
            'hostname'     => env('database.default.hostname'),
            'username'     => env('database.default.username'),
            'password'     => env('database.default.password'),
            'database'     => env('database.default.database'),
            'DBDriver'     => env('database.default.DBDriver'),
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => (ENVIRONMENT !== 'production'),
            'charset'      => 'utf8',
            'DBCollat'     => 'utf8_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => env('database.default.port'),
            'numberNative' => false,
        ];

        // Konfigurasi untuk testing (PHPUnit)
        $this->tests = [
            'DSN'         => '',
            'hostname'    => env('database.tests.hostname'),
            'username'    => env('database.tests.username'),
            'password'    => env('database.tests.password'),
            'database'    => env('database.tests.database'),
            'DBDriver'    => env('database.tests.DBDriver'),
            'DBPrefix'    => 'db_',
            'pConnect'    => false,
            'DBDebug'     => true,
            'charset'     => 'utf8',
            'DBCollat'    => 'utf8_general_ci',
            'swapPre'     => '',
            'encrypt'     => false,
            'compress'    => false,
            'strictOn'    => false,
            'failover'    => [],
            'port'        => env('database.tests.port'),
            'foreignKeys' => true,
            'busyTimeout' => 1000,
        ];

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
