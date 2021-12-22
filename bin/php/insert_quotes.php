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
require($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();
/**
 * Functions
 * -----------------------------------------------------------------------------
 */
/**
 * Initialize the database
 * -----------------------------------------------------------------------------
 */
function initializeDatabase()
{
    $db = new MysqliDb(array(
        "host" => $_ENV["DB_HOST"],
        "username" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"],
        "db" => $_ENV["DB_NAME"],
        "port" => $_ENV["DB_PORT"],
        "prefix" => $_ENV["DB_TABLE_PREFIX"],
        "charset" => "utf8",
    ));
    return $db;
}
/**
 * Get Csv
 * -----------------------------------------------------------------------------
 * Get the quotes from the csv file.
 *
 * @param string $file The file name
 * @return array The quotes
 */
function getCsv($file)
{
    $csv = [];
    foreach (file($file) as $row) {
        $csv[] = str_getcsv($row, ";");
    }
    return $csv;
}
/**
 * Insert Quotes
 * -----------------------------------------------------------------------------
 * Insert the quotes into the database.
 *
 * @param array $quotes The quotes
 * @param MysqliDb $db The database
 * @return void
 */
function insertQuotes($quotes, $db)
{
    foreach ($quotes as $quoteData) {
        $quote = $quoteData[0];
        $author = $quoteData[1];
        $category = $quoteData[2];
        $authorId = verifyAuthor($author, $db);
        $categoryId = verifyCategory($category, $db);
        if (verifyQuote($quote, $db) === false) {
            $db->insert("quotes", array(
                "quote" => $quote,
                "author_id" => $authorId,
                "category_id" => $categoryId,
            ));
            // echo inserted quote with id
            echo "Inserted: "  . $db->getInsertId() . " - " . $quote . "<br>\n";
        }
    }
}
/**
 * Verify Author
 * -----------------------------------------------------------------------------
 * Verify if the author exists in the database if not insert it and return the
 * id.
 *
 * @param string $author The author
 * @param MysqliDb $db The database
 * @return void
 */
function verifyAuthor($author, $db)
{
    $authorId = $db->where("name", $author)->getOne("quotes_authors");
    if ($authorId) {
        return $authorId["id"];
    } else {
        $authorId = $db->insert("quotes_authors", ["name" => $author]);
        return $authorId;
    }
}
/**
 * Verify Category
 * -----------------------------------------------------------------------------
 * Verify if the category exists in the database if not insert it and return the
 * id.
 *
 * @param string $category The category
 * @param MysqliDb $db The database
 * @return void
 */
function verifyCategory($category, $db)
{
    $categoryId = $db->where("name", $category)->getOne("quotes_categories");
    if ($categoryId) {
        return $categoryId["id"];
    } else {
        $categoryId = $db->insert("quotes_categories", ["name" => $category]);
        return $categoryId;
    }
}
/**
 * Verify Quote
 * -----------------------------------------------------------------------------
 * Verify if the quote exists in the database and return boolean.
 *
 * @param string $quote The quote
 * @param MysqliDb $db The database
 * @return void
 */
function verifyQuote($quote, $db)
{
    $quoteId = $db->where("quote", $quote)->getOne("quotes");
    if ($quoteId) {
        return true;
    } else {
        return false;
    }
}
/**
 * Main
 * -----------------------------------------------------------------------------
 */
function main()
{
    $file = $_SERVER["DOCUMENT_ROOT"] . "/" . "quotes.csv";
    $db = initializeDatabase();
    $quotes = getCsv($file);
    insertQuotes($quotes, $db);
}
main();
