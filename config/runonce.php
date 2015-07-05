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
        if ($this->needUpgrade()) {
            $this->createChapterTable();
            $books = new BooksRunonce();
            $books->upgrade();
        }
    }


    /**
     * @return boolean
     */
    private function needUpgrade()
    {
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

}

class BooksRunonce extends \Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
    }


    public function upgrade()
    {
        $book = $this->Database->execute("SELECT * FROM tl_book");
        while ($book->next()) {
            $statement = $this->Database->prepare("INSERT INTO tl_chapter (tstamp, title, type, subtitle, author, language, tags, published) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(
                $book->tstamp,
                $book->title,
                "root",
                $book->subtitle,
                $book->author,
                $book->language,
                $book->category,
                $book->published
            );
            $bookId = $statement->insertId;
            $chapters = $this->Database->prepare("SELECT * FROM tl_book_chapter WHERE pid=? ORDER BY sorting")->execute($book->id);
            $chapters = new ChaptersRunonce($bookId, $chapters);
            $chapters->upgrade();
        }
    }

}

class ChaptersRunonce extends \Controller
{

    /**
     * @var array path of a chapter in the book. The first element is the books
     * id, the last element is id of current parent chapter.
     */
    private $chapterTreePath = array();

    /**
     * @var \Database\Result
     */
    private $chapters;


    public function __construct($bookId, $chapters)
    {
        parent::__construct();

        $this->chapterTreePath[] = $bookId;
        $this->chapters = $chapters;

        $this->import('Database');
    }


    public function upgrade()
    {
        while ($this->chapters->next()) {
            $statement = $this->Database->prepare("INSERT INTO tl_chapter (pid, sorting, tstamp, title, alias, type, hide, published) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(
                $this->getPid(),
                $this->chapters->sorting,
                $this->chapters->tstamp,
                $this->getChapterTitle(),
                $this->chapters->alias, "regular",
                !$this->chapters->show_in_toc,
                $this->chapters->published
            );
            $chapterId = $statement->insertId;
            $this->updateChapterTreePath($chapterId);
        }
    }


    /**
     * @return int
     */
    private function getPid()
    {
        return $this->chapterTreePath[$this->getChapterTreeLevel() - 1];
    }


    /**
     * @return string
     */
    private function getChapterTitle()
    {
        $arrHeadline = deserialize($this->chapters->title);
        $headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
        return $headline;
    }


    /**
     * @param int $chapterId id of current chapter.
     */
    private function updateChapterTreePath($chapterId)
    {
        $level = static::getChapterTreeLevel();
        $pathSize = count($this->chapterTreePath) - 1;
        if ($level > $pathSize) {
            $this->chapterTreePath[] = $chapterId;
        }
        if ($level == $pathSize) {
            $this->chapterTreePath[$pathSize] = $chapterId;
        }
        if ($level < $pathSize) {
            while ($level < $pathSize) {
                array_pop($this->chapterTreePath);
                $pathSize--;
                $this->chapterTreePath[$pathSize] = $chapterId;
            }
        }
    }


    /**
     * @return int
     */
    private
    function getChapterTreeLevel()
    {
        $arrHeadline = deserialize($this->chapters->title);
        $hl = is_array($arrHeadline) ? $arrHeadline['unit'] : 'h1';
        switch ($hl) {
            case 'h1':
                return 1;
            case 'h2':
                return 2;
            case 'h3':
                return 3;
            case 'h4':
                return 4;
            case 'h5':
                return 5;
            case 'h6':
                return 6;
            default:
                throw new \LogicException("unreachable code");
        }
    }

}

$objBooksRunonceJob = new BooksRunonceJob();
$objBooksRunonceJob->run();
