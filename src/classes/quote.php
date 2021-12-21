<?php

/**
 * Src - Classes - Quote
 * php version 8
 *
 * @category Src
 * @package  Classes
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */

namespace RQM\classes;

/**
 * Quote
 * -----------------------------------------------------------------------------
 *
 * @category Src
 * @package  Classes
 * @author   Ronald Bello <ronaldbello@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://ronaldrbb.github.io/RonaldRBB/
 */
class Quote
{
    public $id = null;
    public $author = null;
    public $text = null;
    private $table = "quotes";
    /**
     * Get Quote By Id
     * -------------------------------------------------------------------------
     *
     * @param int $id Id of the quote.
     *
     * @return void
     */
    public function getById($id)
    {
        $quote = $this->getByIdFromDb($id);
        if ($quote) {
            $this->updateClass($quote);
        }
    }
    /**
     * Get QUote Randomly
     * -------------------------------------------------------------------------
     *
     * @return void
     */
    public function getRandomly()
    {
        $totalQuotes = $this->getTotalFromDb();
        $randomId = rand(1, $totalQuotes);
        $quote = $this->getByIdFromDb($randomId);
        if ($quote) {
            $this->updateClass($quote);
        }
    }
    /**
     * Update Quote
     * -------------------------------------------------------------------------
     *
     * @param array $quote Quote to update.
     *
     * @return void
     */
    private function updateClass($quote)
    {
        $this->id = $quote["id"];
        $this->author = $quote["author"];
        $this->text = $quote["quote"];
    }
    /**
     * Get Quote By ID From DB
     * -------------------------------------------------------------------------
     *
     * @param int $id ID of the quote.
     *
     * @return array
     */
    private function getByIdFromDb($id)
    {
        global $db;
        $db->where("id", $id);
        $quote = $db->get($this->table);
        return $quote[0];
    }
    /**
     * Get Total Quotes From DB
     * -------------------------------------------------------------------------
     */
    private function getTotalFromDb()
    {
        global $db;
        $db->get($this->table);
        return $db->count;
    }
}
