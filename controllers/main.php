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
 * Main Controller
 * -----------------------------------------------------------------------------
 * Control for all pages.
 *
 * @return void
 */
function main()
{
    if ($_SERVER["REQUEST_URI"] == "/random") {
        \RQM\controllers\randomGet();
    } else {
        \RQM\functions\denyAccess();
    }
}
