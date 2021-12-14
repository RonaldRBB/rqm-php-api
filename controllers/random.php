<?php

/**
 * Controllers - Random
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
 * Random - Get method
 * -----------------------------------------------------------------------------
 * Send a random quote to the client.
 *
 * @return void
 */
function randomGet()
{
    $quote = new \RQM\classes\Quote();
    $quote->getRandomly();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($quote);
}
