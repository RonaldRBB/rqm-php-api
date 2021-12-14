<?php

/**
 * Controllers - Main
 * php version 8
 *
 * @category Controller
 * @package  Controllers
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

namespace RQM\controllers;

/**
 * Main - Get method
 * -----------------------------------------------------------------------------
 * Send a random quote to the client.
 *
 * @return void
 */
function main()
{
    if ($_SERVER["REQUEST_URI"] == "/random") {
        \RQM\controllers\randomGet();
    } else {
        var_dump("pagina incorrecta");
    }
}
