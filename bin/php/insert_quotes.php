<?php

/**
 * Bin - Php - Check Quotes Json
 * php version 8
 *
 * @category Bin
 * @package  Bin
 * @author   Ronald Bello <ronaldbello2@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

/**
 * Environment variables
 * -----------------------------------------------------------------------------
 */
require('../../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->load();

/**
 * Functions
 * -----------------------------------------------------------------------------
 */
/**
 * Get Json File
 * -----------------------------------------------------------------------------
 */
function getJsonFile()
{
    $jsonFile = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/quotes.json");
    $jsonFile = json_decode($jsonFile, true);
    return $jsonFile;
}
/**
 * Delete Duplicated Quotes
 * -----------------------------------------------------------------------------
 */
function deleteDuplicatedQuotes($quotes)
{
    $cleanQuotes = [];
    foreach ($quotes as $quote) {
        if (count($cleanQuotes) == 0) {
            $cleanQuotes[] = $quote;
        }
        $duplicated = false;
        foreach ($cleanQuotes as $cleanQuote) {
            if (strtolower($cleanQuote['text']) == strtolower($quote['text'])) {
                $duplicated = true;
            }
        }
        if (!$duplicated) {
            $cleanQuotes[] = $quote;
        }
    }
    return $cleanQuotes;
}
/**
 * Insert Quotes in Database
 * -----------------------------------------------------------------------------
 */
function insertQuotes($quotes)
{
    $db = new PDO("mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_NAME"]}", $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->beginTransaction();
    try {
        foreach ($quotes as $quote) {
            $sql = "INSERT INTO `ronaldrbb_rqm_quotes` (id, quote, author) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([null, $quote['text'], $quote['author']]);
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}
/**
 * Main
 * -----------------------------------------------------------------------------
 */
function main()
{
    $quotes = deleteDuplicatedQuotes(getJsonFile());
    // foreach ($quotes as $quote) {
    //     echo $quote['text'] . " - " . $quote['author'] . "<br>";
    // }
    insertQuotes($quotes);
}
main();
