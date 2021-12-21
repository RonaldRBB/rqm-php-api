<?php

/**
 * Scr - Functions
 * php version 8
 *
 * @category Functions
 * @package  Scr
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

namespace RQM\functions;

/**
 * Load Database
 * -----------------------------------------------------------------------------
 *
 * @return PDO
 */
function loadDatabase()
{
    return new \MysqliDb(
        [
            "host"     => $_ENV["DB_HOST"],
            "username" => $_ENV["DB_USER"],
            "password" => $_ENV["DB_PASSWORD"],
            "db"       => $_ENV["DB_NAME"],
            "port"     => $_ENV["DB_PORT"],
            "prefix"   => $_ENV["DB_TABLE_PREFIX"],
            "charset"  => "utf8"
        ]
    );
}
/**
 * Deny Direct Access
 * -----------------------------------------------------------------------------
 * Deny access to script if is directed fo name script.
 *
 * @return void
 */
function denyDirectAccess()
{
    if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) {
        denyAccess();
        exit;
    }
}
/**
 * Deny Access
 * -----------------------------------------------------------------------------
 *
 * @return void
 */
function denyAccess()
{
    header("HTTP/1.1 403 Forbidden");
    exit;
}
