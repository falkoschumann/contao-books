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
        $this->Template->toc = $this->renderTableOfContents();
    }


    /**
     * @return string
     */
    private function renderAbstract()
    {
        $strContent = '';
        $objElements = \ContentModel::findPublishedByPidAndTable($this->getModel()->root_chapter, 'tl_chapter');
        if ($objElements !== null) {
            while ($objElements->next()) {
                $strContent .= $this->getContentElement($objElements->id);
            }
        }
        return $strContent;
    }


    /**
     * @return string
     */
    private function renderTableOfContents()
    {
        return static::renderChapterListForParent(ChapterModel::findPublishedById($this->objModel->root_chapter));
    }


    /**
     * @param ChapterModel
     * @return string
     */
    private static function renderChapterListForParent($parent)
    {
        if ($parent === null) {
            return '';
        }

        $chapters = ChapterModel::findPublishedByPid($parent->id);
        if ($chapters === null) {
            return '';
        }

        $html = "<ul>\n";
        while ($chapters->next()) {
            if ($chapters->hide) {
                continue;
            }

            $html .= '<li><a href="' . ChapterModel::getUrlForChapter($chapters) . '">' . $chapters->title . '</a>';
            $html .= static::renderChapterListForParent(ChapterModel::findPublishedById($chapters->id));
            $html .= "</li>\n";
        }
        $html .= "</ul>\n";
        return $html;
    }

}
