<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * Convert table tl_book from v1.x to v2.x table format.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 */
class BookRunonce extends \Controller
{

    /**
     * @var ChapterRunonce
     */
    private $objChapterRunonce;


    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
        $this->objChapterRunonce = new ChapterRunonce();
    }


    public function run()
    {
        if ($this->isUpgradeNecessary()) {
            $this->renameFieldCategoryToTags();
            $this->createRootChapters();

            $this->objChapterRunonce->run();
        }
    }


    /**
     * @return bool
     */
    private function isUpgradeNecessary()
    {
        return $this->Database->tableExists('tl_book') && $this->Database->tableExists('tl_book_chapter') && !$this->Database->tableExists('tl_chapter');
    }


    private function renameFieldCategoryToTags()
    {
        if ($this->Database->fieldExists('category', 'tl_book') && !$this->Database->fieldExists('tags', 'tl_book')) {
            $this->log("Rename field tl_book.category to tl_book.tags.", __METHOD__, TL_GENERAL);
            $this->Database->execute("ALTER TABLE tl_book CHANGE category tags varchar(255) NOT NULL default ''");
        }
    }


    private function createRootChapters()
    {
        if ($this->Database->fieldExists('text', 'tl_book') && !$this->Database->fieldExists('root_chapter', 'tl_book')) {
            $this->Database->execute("ALTER TABLE tl_book ADD root_chapter int(10) unsigned NOT NULL default '0'");

            $book = $this->Database->execute("SELECT * FROM tl_book");
            while ($book->next()) {
                $this->log("Create root chapter for book " . $book->id . ".", __METHOD__, TL_GENERAL);
                $chapterId = $this->objChapterRunonce->createRootChapter($book);
                $this->Database->prepare("UPDATE tl_book SET root_chapter=? WHERE id=?")
                    ->execute($chapterId, $book->id);

            }
        }
    }

}


/**
 * Convert table tl_chapter from v1.x to v2.x table format.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Models
 * @license    BSD-2-Clause http://opensource.org/licenses/BSD-2-Clause
 */
class ChapterRunonce extends \Controller
{

    /**
     * Each path element is a chapter id. The first path element is a top level chapter. The last path element is the
     * current chapter.
     *
     * @var array
     */
    private $chapterTreePath = array();

    /**
     * The current chapter in work.
     *
     * @var \Database\Result
     */
    private $chapter;


    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
    }


    /**
     * @param $book \Database\Result
     * @return int id of the root chapter.
     */
    public function createRootChapter($book)
    {
        $this->log("Insert root chapter for book " . $book->id . ".", __METHOD__, TL_GENERAL);
        $statement = $this->Database->prepare("INSERT INTO tl_book_chapter SET published=1, text=?");
        $statement->execute($book->text);
        $chapterId = $statement->insertId;

        $this->log("Add chapters of book " . $book->id . " to root chapter " . $chapterId . ".", __METHOD__, TL_GENERAL);
        $this->Database->prepare("UPDATE tl_book_chapter SET pid=? WHERE pid=?")
            ->execute($chapterId, $book->id);

        return $chapterId;
    }


    public function run()
    {
        $this->renameTableTlBookChapterToTlChapter();
        $this->renameFieldShowInTocToHideAndToogleValue();
        $this->createFieldType();

//        $this->chapter = $this->Database->execute("SELECT * FROM tl_chapter ORDER BY pid, sorting WHERE pid>0");
//        while ($this->chapter->next()) {
//            $this->updateChapterTreePath();
//            $this->updateChapter();
//            $this->createContentElement();
//        }
    }


    private function renameTableTlBookChapterToTlChapter()
    {
        $this->log("Rename table tl_book_chapter to tl_chapter.", __METHOD__, TL_GENERAL);
        $this->Database->execute("RENAME TABLE tl_book_chapter TO tl_chapter");
    }


    private function renameFieldShowInTocToHideAndToogleValue()
    {
        if ($this->Database->fieldExists('show_in_toc', 'tl_chapter') && !$this->Database->fieldExists('hide',
                'tl_chapter')
        ) {
            $this->log("rename field tl_chapter.show_in_toc to tl_chapter.hide and toogle value.", __METHOD__, TL_GENERAL);
            $this->Database->execute("ALTER TABLE tl_chapter CHANGE show_in_toc hide char(1) NOT NULL default ''");
        }
    }


    private function createFieldType()
    {
        if (!$this->Database->fieldExists('type', 'tl_chapter')) {
            $this->log("Create field tl_chapter.type and set value.", __METHOD__, TL_GENERAL);
            $this->Database->execute("ALTER TABLE tl_chapter ADD type varchar(32) NOT NULL default ''");
            $this->Database->execute("UPDATE tl_chapter SET type='root' WHERE pid=0");
            $this->Database->execute("UPDATE tl_chapter SET type='regular' WHERE pid>0");
        }
    }


    private function updateChapterTreePath()
    {
        $level = $this::getChapterTreeLevel();
        $pathLength = count($this->chapterTreePath);
        if ($level > $pathLength) {
            $this->chapterTreePath[] = $this->chapter->id;
        } else {
            if ($level < $pathLength) {
                while ($level < $pathLength) {
                    array_pop($this->chapterTreePath);
                    $pathLength--;
                    $this->chapterTreePath[$pathLength - 1] = $this->chapter->id;
                }
            } else {
                if ($level == $pathLength) {
                    $this->chapterTreePath[$pathLength - 1] = $this->chapter->id;
                } else {
                    throw new \LogicException("unreachable code");
                }
            }
        }
    }


    private function updateChapter()
    {
        $this->Database->prepare("UPDATE tl_chapter SET title=?, book_id=?, pid=? WHERE id=?")
            ->execute($this->getChapterTitle(), $this->chapter->pid, $this->getPid(), $this->chapter->id);
    }


    private function createContentElement()
    {
        $this->Database->prepare("INSERT INTO tl_content (pid, ptable, tstamp, type, headline, text) VALUES (?, ?, ?, ?, ?, ?)")
            ->execute($this->chapter->id, 'tl_chapter', $this->chapter->tstamp, 'text', $this->chapter->title, $this->chapter->text);
    }


    /**
     * @return string
     */
    private function getChapterTitle()
    {
        $arrHeadline = deserialize($this->chapter->title);
        $headline = is_array($arrHeadline) ? $arrHeadline['value'] : $arrHeadline;
        return $headline;
    }


    /**
     * @return int
     */
    private function getPid()
    {
        $pathLength = count($this->chapterTreePath);
        if ($pathLength > 1) {
            return $this->chapterTreePath[$pathLength - 2];
        } else {
            return 0;
        }
    }


    /**
     * @return int
     */
    private function getChapterTreeLevel()
    {
        $arrHeadline = deserialize($this->chapter->title);
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

$objBookRunonce = new BookRunonce();
$objBookRunonce->run();
