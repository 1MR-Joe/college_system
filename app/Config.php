<?php
declare(strict_types=1);

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
                'host' => $_ENV['DB_HOST'],
                'dbname' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
            ] ,
            'environment' => $_ENV['APP_ENVIRONMENT'] ?? 'production',
        ];
    }

    public function get(string $name, mixed $default = null): mixed
    {
        $path  = explode('.', $name);
        $value = $this->config[array_shift($path)] ?? null;

        if ($value === null) {
            return $default;
        }

        foreach ($path as $key) {
            if (! isset($value[$key])) {
                return $default;
            }

            $value = $value[$key];
        }

        return $value;
    }
}