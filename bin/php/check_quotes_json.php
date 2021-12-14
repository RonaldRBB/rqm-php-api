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
 * Functions
 * -----------------------------------------------------------------------------
 */
/**
 * Get Json File
 * -----------------------------------------------------------------------------
 */
function getJsonFile()
{
    $jsonFile = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/quotes.json");
    $jsonFile = json_decode($jsonFile, true);
    return $jsonFile;
}
/**
 * Get Longest Quote
 * -----------------------------------------------------------------------------
 */
function getLongestQuote($quotes)
{
    $longestQuote = 0;
    foreach ($quotes as $quote) {
        if (strlen($quote["text"]) > $longestQuote) {
            $longestQuote = $quote;
        }
    }
    return $longestQuote;
}
/**
 * Get Empty Quotes
 * -----------------------------------------------------------------------------
 */
function getEmptyQuotes($quotes)
{
    $emptyQuotes = [];
    foreach ($quotes as $quote) {
        empty($quote["text"]) ? $emptyQuotes[] = $quote : null;
    }
    return $emptyQuotes;
}
/**
 * Get Empty Author Quotes
 * -----------------------------------------------------------------------------
 */
function getEmptyAuthorQuotes($quotes)
{
    $emptyAuthorQuotes = [];
    foreach ($quotes as $quote) {
        empty($quote["author"]) ? $emptyAuthorQuotes[] = $quote : null;
    }
    return $emptyAuthorQuotes;
}
/**
 * Main
 * -----------------------------------------------------------------------------
 */
function main()
{
    $quotes = getJsonFile();
    $longestQuote = getLongestQuote($quotes);
    $emptyQuotes = getEmptyQuotes($quotes);
    $emptyAuthorQuotes = getEmptyAuthorQuotes($quotes);
    echo "Total Quotes: " . count($quotes) . "<br>";
    echo "Longest Quote Size: " . strlen($longestQuote["text"]) . "<br>";
    echo "Total Empty Quotes: " . count($emptyQuotes) . "<br>";
    echo "Total Empty Author Quotes: " . count($emptyAuthorQuotes) . "<br>";
}
main();
