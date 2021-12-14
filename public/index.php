<?php

/**
 * Public - Index Real
 * php version 8
 *
 * @category Index
 * @package  Index
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

/**
 * Modules
 * -----------------------------------------------------------------------------
 */
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/functions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/classes/quote.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/main.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/random.php");
/**
 * Deny Direct Access to File
 * -----------------------------------------------------------------------------
 */
\RQM\functions\denyDirectAccess();
/**
 * Environment
 * -----------------------------------------------------------------------------
 */
$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();
/**
 * Globals
 * -----------------------------------------------------------------------------
 */
$db = \RQM\functions\loadDatabase();
define("CONFIG", include("../config/config.php"));
/**
 * Main
 */
\RQM\controllers\main();
