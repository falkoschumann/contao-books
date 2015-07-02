<?php

/**
 * Contao Extension Books
 *
 * Copyright (c) 2012-2015 Falko Schumann
 * Released under the terms of the MIT License (MIT).
 */


/**
 * Namespace
 */
namespace Muspellheim\Book;


/**
 * Convert books from v1.x to v2.x table format.
 *
 * @author Falko Schumann <https://github.com/falkoschumann/contao-books>
 */
class BooksRunonceJob extends \Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
    }


    public function run()
    {
        $this->log("call books runonce", __FUNCTION__, TL_GENERAL);

        if ($this->needUpgrade()) {
            $this->createChapterTable();
            $this->upgradeBooks();
        }
    }


    /**
     * @return boolean
     */
    private function needUpgrade() {
        return !$this->Database->tableExists('tl_chapter') && $this->Database->tableExists('tl_book') && $this->Database->tableExists('tl_book_chapter');
    }

    private function createChapterTable()
    {
        $this->Database->execute(
            "CREATE TABLE `tl_chapter` ("
            . " `id` int(10) unsigned NOT NULL,"
            . " `pid` int(10) unsigned NOT NULL DEFAULT '0',"
            . " `sorting` int(10) unsigned NOT NULL DEFAULT '0',"
            . " `tstamp` int(10) unsigned NOT NULL DEFAULT '0',"
            . " `title` varchar(255) NOT NULL DEFAULT '',"
            . " `alias` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',"
            . " `type` varchar(32) NOT NULL DEFAULT '',"
            . " `subtitle` varchar(255) NOT NULL DEFAULT '',"
            . " `author` varchar(255) NOT NULL DEFAULT '',"
            . " `year` varchar(4) NOT NULL DEFAULT '',"
            . " `place` varchar(255) NOT NULL DEFAULT '',"
            . " `language` varchar(5) NOT NULL DEFAULT '',"
            . " `tags` varchar(255) NOT NULL DEFAULT '',"
            . " `cssID` varchar(255) NOT NULL DEFAULT '',"
            . " `hide` char(1) NOT NULL DEFAULT '',"
            . " `published` char(1) NOT NULL DEFAULT ''"
            . ")");
        $this->Database->execute(
            "ALTER TABLE `tl_chapter`"
            . "ADD PRIMARY KEY (`id`),"
            . "ADD KEY `pid` (`pid`),"
            . "ADD KEY `alias` (`alias`),"
            . "ADD KEY `type` (`type`)");
        $this->Database->execute(
            "ALTER TABLE `tl_chapter`"
            . " MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT"
        );
    }

    private function upgradeBooks() {
        $book = $this->Database->execute("SELECT * FROM tl_book");
        while ($book->next()) {
            $this->log("insert book " . $book->title, __FUNCTION__, TL_GENERAL);
            $statement = $this->Database->prepare("INSERT INTO tl_chapter (tstamp, title, type, subtitle, author, language, tags, published) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute($book->tstamp, $book->title, "root", $book->subtitle, $book->author, $book->language, $book->category, $book->published);
            $this->log("book with id " . $statement->insertId . " inserted", __FUNCTION__, TL_GENERAL);
        }
    }

}

$objBooksRunonceJob = new BooksRunonceJob();
$objBooksRunonceJob->run();
