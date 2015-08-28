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
 * Renders a chapter of book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class ChapterRenderer extends TemplateRenderer
{

    /**
     * @var string
     */
    protected $strTemplate = 'books_chapter';

    /**
     * @var string
     */
    protected $type = 'chapter';

    /**
     * @var array
     */
    private $chapterList = null;


    protected function compile()
    {
        $this->Template->content = $this->renderContentElements();
        $this->Template->tableOfContentUrl = $this->getBookUrl();
        $this->Template->previousChapterUrl = $this->getPreviousChapterUrl();
        $this->Template->nextChapterUrl = $this->getNextChapterUrl();
    }


    /**
     * @return string
     */
    private function renderContentElements()
    {
        return ChapterModel::renderContent($this->id);
    }


    /**
     * @return string
     */
    private function getBookUrl()
    {
        return $this->generateFrontendUrl($GLOBALS['objPage']->row());
    }


    /**
     * @return string
     */
    private function getPreviousChapterUrl()
    {
        $objPreviousChapter = $this->findPreviousChapterFor(ChapterModel::findPublishedById($this->id));
        if ($objPreviousChapter !== null) {
            return ChapterModel::getUrlForChapter($objPreviousChapter);
        }

        // fallback
        return null;
    }


    /**
     * @return string
     */
    private function getNextChapterUrl()
    {
        $objNextChapter = $this->findNextChapterFor(ChapterModel::findPublishedById($this->id));
        if ($objNextChapter !== null) {
            return ChapterModel::getUrlForChapter($objNextChapter);
        }

        // fallback
        return null;
    }


    /**
     * @param ChapterModel
     * @return ChapterModel|null
     */
    private function findPreviousChapterFor($chapter)
    {
        $chapterList = $this->getChapterList();
        $chapterCount = count($chapterList);
        for ($i = 0; $i < $chapterCount; $i++) {
            if ($chapterList[$i]->id == $chapter->id) {
                if ($i > 0) {
                    return $chapterList[$i - 1];
                }
            }
        }

        // fallback
        return null;
    }


    /**
     * @param ChapterModel
     * @return ChapterModel|null
     */
    private function findNextChapterFor($chapter)
    {
        $chapterList = $this->getChapterList();
        $chapterCount = count($chapterList);
        for ($i = 0; $i < $chapterCount; $i++) {
            if ($chapterList[$i]->id == $chapter->id) {
                if ($i < $chapterCount - 2) {
                    return $chapterList[$i + 1];
                }
            }
        }

        // fallback
        return null;
    }


    /**
     * @param ChapterModel
     * @return array
     */
    private function getChapterList()
    {
        if ($this->chapterList === null) {
            $rootChapter = ChapterModel::findRoot($this->getModel());
            $this->chapterList = static::getChapterListFor(ChapterModel::findPublishedByPid($rootChapter->id));
        }
        return $this->chapterList;
    }


    /**
     * @param ChapterModel
     * @return array
     */
    private static function getChapterListFor($chapters)
    {
        if ($chapters === null) {
            return array();
        }

        $chapterList = array();
        foreach ($chapters as $chapter) {
            if (!$chapter->hide) {
                $chapterList[] = $chapter;
                $chapterList = array_merge($chapterList, static::getChapterListFor(ChapterModel::findPublishedByPid($chapter->id)));
            }
        }
        return $chapterList;
    }

}
