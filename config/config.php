<?php

/**
 * Config - Config
 * php version 8
 *
 * @category Config
 * @package  Config
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

return [
    "server" => [
        "name" => "RQM - PHP - API",
        "url" => $_ENV["API_URL"]
    ],
    "mysql" => [
        "host" => $_ENV["DB_HOST"],
        "user" => $_ENV["DB_USER"],
        "pass" => $_ENV["DB_PASSWORD"],
        "dd" => $_ENV["DB_NAME"],
        "port" => $_ENV["DB_PORT"],
    ]
];
