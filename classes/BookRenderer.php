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
 * Renders the cover page and table of contents of a book.
 *
 * @copyright  Falko Schumann 2015
 * @author     Falko Schumann <http://www.muspellheim.de>
 * @package    Books
 */
class BookRenderer extends TemplateRenderer
{

    /**
     * @var string
     */
    protected $strTemplate = 'books_book';

    /**
     * @var string
     */
    protected $type = 'book';


    protected function compile()
    {
        $this->Template->abstract = $this->renderAbstract();
        $this->Template->contents = $this->renderTableOfContents();
    }


    /**
     * @return string
     */
    private function renderAbstract()
    {
        return ChapterModel::renderContent($this->getModel()->root_chapter);
    }


    /**
     * @return string
     */
    private function renderTableOfContents()
    {
        return static::renderChapterListForParent(ChapterModel::findPublishedById($this->objModel->root_chapter), 1);
    }


    /**
     * @param ChapterModel $parent
     * @param int          $level
     * @return string
     */
    private static function renderChapterListForParent($parent, $level)
    {
        if ($parent === null) {
            return '';
        }

        $objSubchapters = ChapterModel::findPublishedByPid($parent->id);
        if ($objSubchapters === null) {
            return '';
        }

        $objTemplate = new \FrontendTemplate('books_contents');
        $objTemplate->level = 'level_' . $level++;

        $chapters = array();
        while ($objSubchapters->next()) {
            if ($objSubchapters->hide) {
                continue;
            }

            $chapter = $objSubchapters->row();
            $chapter['href'] = ChapterModel::getUrlForChapter($objSubchapters);
            $chapter['title'] = specialchars($objSubchapters->title, true);
            $chapter['link'] = $objSubchapters->title;
            $chapter['subchapters'] = static::renderChapterListForParent(ChapterModel::findPublishedById($objSubchapters->id), $level);
            $chapters[] = $chapter;
        }
        $objTemplate->chapters = $chapters;

        return $objTemplate->parse();
    }

}
